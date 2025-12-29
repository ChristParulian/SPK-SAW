<?php
require_once __DIR__ . '/../config/database.php';

// Ambil semua emosi dari tabel bobot
$emosi = [];
$res = $conn->query('SELECT * FROM bobot ORDER BY nama_emosi ASC');
while ($row = $res->fetch_assoc()) {
    $emosi[] = $row;
}

// Jika form dipilih
$selected_bobot = null;
if (isset($_GET['id_bobot'])) {
    $id_bobot = (int)$_GET['id_bobot'];
    $res_bobot = $conn->query('SELECT * FROM bobot WHERE id_bobot=' . $id_bobot);
    $selected_bobot = $res_bobot->fetch_assoc();
}

$alternatif = [];
if ($selected_bobot) {
    // Ambil data alternatif
    $sql = 'SELECT * FROM alternatif';
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $alternatif[] = $row;
    }
    // Cari nilai max tiap kriteria
    $max = [
        'c1_tempo' => 0,
        'c2_loudness' => 0,
        'c3_energy' => 0,
        'c4_valence' => 0,
        'c5_mode' => 0
    ];
    foreach ($alternatif as $alt) {
        foreach ($max as $k => $v) {
            if ($alt[$k] > $max[$k]) $max[$k] = $alt[$k];
        }
    }
    // Normalisasi
    $normalisasi = [];
    foreach ($alternatif as $alt) {
        $r1 = $alt['c1_tempo'] / ($max['c1_tempo'] ?: 1);
        $r2 = $alt['c2_loudness'] / ($max['c2_loudness'] ?: 1);
        $r3 = $alt['c3_energy'] / ($max['c3_energy'] ?: 1);
        $r4 = $alt['c4_valence'] / ($max['c4_valence'] ?: 1);
        $r5 = $alt['c5_mode'] / ($max['c5_mode'] ?: 1);
        $normalisasi[] = [
            'id_alternatif' => $alt['id_alternatif'],
            'judul_lagu' => $alt['judul_lagu'],
            'artis' => $alt['artis'],
            'r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5
        ];
    }
    // Hitung perangkingan
    $perangkingan = [];
    foreach ($normalisasi as $n) {
        $vi = $selected_bobot['w1']*$n['r1'] + $selected_bobot['w2']*$n['r2'] + $selected_bobot['w3']*$n['r3'] + $selected_bobot['w4']*$n['r4'] + $selected_bobot['w5']*$n['r5'];
        $perangkingan[] = [
            'judul_lagu' => $n['judul_lagu'],
            'artis' => $n['artis'],
            'nilai_akhir' => $vi,
            'r1' => $n['r1'],
            'r2' => $n['r2'],
            'r3' => $n['r3'],
            'r4' => $n['r4'],
            'r5' => $n['r5']
        ];
    }
    // Urutkan perangkingan
    usort($perangkingan, function($a, $b) { return $b['nilai_akhir'] <=> $a['nilai_akhir']; });
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Lagu Berdasarkan Emosi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg py-16 px-8 w-full max-w-6xl mt-10 mb-10">
        <a href="index.php" class="inline-block mb-6 px-5 py-2 rounded-lg bg-blue-500 text-white font-semibold shadow hover:bg-blue-700 transition">&larr; Back to Dashboard</a>
        <h1 class="text-2xl font-bold mb-4 text-center">Rekomendasi Lagu Berdasarkan Emosi</h1>
        <div class="mb-6">
            <div class="grid grid-cols-2 gap-4">
                <?php
                $iconList = [
                    'Happy' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" fill="#fde047"/><path stroke="#fff" stroke-width="2" d="M8 14s1.5 2 4 2 4-2 4-2"/><circle cx="9" cy="10" r="1" fill="#fff"/><circle cx="15" cy="10" r="1" fill="#fff"/></svg>',
                    'Sad' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" fill="#38bdf8"/><path stroke="#fff" stroke-width="2" d="M8 16s1.5-2 4-2 4 2 4 2"/><circle cx="9" cy="10" r="1" fill="#fff"/><circle cx="15" cy="10" r="1" fill="#fff"/></svg>',
                    'Relax' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" fill="#4ade80"/><path stroke="#fff" stroke-width="2" d="M12 8v8m-4-4h8"/></svg>',
                    'Energetic' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="12" r="10" fill="#f87171"/><path stroke="#fff" stroke-width="2" d="M13 10V7l-4 6h3v3l4-6h-3z"/></svg>',
                ];
                $colorList = [
                    'Happy' => 'bg-yellow-300 hover:bg-yellow-400 text-yellow-900',
                    'Sad' => 'bg-blue-400 hover:bg-blue-500 text-blue-900',
                    'Relax' => 'bg-green-400 hover:bg-green-500 text-green-900',
                    'Energetic' => 'bg-red-500 hover:bg-red-600 text-red-50',
                ];
                foreach ($emosi as $e) {
                    $nama = $e['nama_emosi'];
                    if (!isset($iconList[$nama])) continue;
                    $btnColor = $colorList[$nama] ?? 'bg-gray-200';
                    echo '<form method="get" action="" class="m-0">';
                    echo '<input type="hidden" name="id_bobot" value="'.$e['id_bobot'].'">';
                    echo '<button type="submit" class="w-full flex flex-col items-center justify-center rounded-xl shadow-lg py-6 px-2 font-bold text-lg transition '.$btnColor.'">';
                    echo $iconList[$nama];
                    echo '<span>'.$nama.'</span>';
                    echo '</button>';
                    echo '</form>';
                }
                ?>
            </div>
            <p class="text-gray-600 text-center mt-4">Silakan pilih emosi Anda untuk mendapatkan rekomendasi lagu terbaik!</p>
        </div>
        <?php if ($selected_bobot): ?>
        <div class="bg-blue-50 rounded-lg shadow p-6 mt-6">
            <h3 class="text-xl font-bold text-blue-700 mb-4 text-center">Hasil Rekomendasi Lagu<br><span class="text-lg font-semibold text-green-600">Emosi: <?php echo htmlspecialchars($selected_bobot['nama_emosi']); ?></span></h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead>
                        <tr class="bg-blue-100 text-blue-700">
                            <th class="py-2 px-4">#</th>
                            <th class="py-2 px-4">Judul Lagu</th>
                            <th class="py-2 px-4">Artis</th>
                            <th class="py-2 px-4">Tempo</th>
                            <th class="py-2 px-4">Loudness</th>
                            <th class="py-2 px-4">Energy</th>
                            <th class="py-2 px-4">Valence</th>
                            <th class="py-2 px-4">Mode</th>
                            <th class="py-2 px-4">Nilai Akhir (V<sub>i</sub>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perangkingan as $i => $p): ?>
                        <tr class="border-b <?php echo $i === 0 ? 'bg-green-100 font-bold text-green-700' : ''; ?>">
                            <td class="py-2 px-4 text-center"><?php echo $i+1; ?></td>
                            <td class="py-2 px-4"><?php echo htmlspecialchars($p['judul_lagu']); ?><?php if ($i === 0): ?><span class="ml-2 px-2 py-1 rounded bg-blue-200 text-blue-700 text-xs font-semibold">Rekomendasi Utama</span><?php endif; ?></td>
                            <td class="py-2 px-4 text-center"><?php echo htmlspecialchars($p['artis']); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['r1'], 4); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['r2'], 4); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['r3'], 4); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['r4'], 4); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['r5'], 4); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo round($p['nilai_akhir'], 4); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-center">
                <span class="inline-block px-4 py-2 rounded bg-green-100 text-green-700 font-semibold">Lagu dengan nilai tertinggi adalah rekomendasi utama untuk emosi ini.</span>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
