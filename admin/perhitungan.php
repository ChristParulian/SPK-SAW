<?php
// views/perhitungan.php
require_once __DIR__ . '/../config/database.php';

// Ambil data alternatif
$alternatif = [];
$sql = "SELECT * FROM alternatif";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $alternatif[] = $row;
}

// Ambil data bobot (default: emosi pertama)
$bobot = [];
$sql_bobot = "SELECT * FROM bobot LIMIT 1";
$res_bobot = $conn->query($sql_bobot);
if ($row = $res_bobot->fetch_assoc()) {
    $bobot = $row;
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

// Normalisasi dan simpan ke tabel normalisasi
$conn->query("TRUNCATE TABLE normalisasi");
$normalisasi = [];
foreach ($alternatif as $alt) {
    $r1 = $alt['c1_tempo'] / ($max['c1_tempo'] ?: 1);
    $r2 = $alt['c2_loudness'] / ($max['c2_loudness'] ?: 1);
    $r3 = $alt['c3_energy'] / ($max['c3_energy'] ?: 1);
    $r4 = $alt['c4_valence'] / ($max['c4_valence'] ?: 1);
    $r5 = $alt['c5_mode'] / ($max['c5_mode'] ?: 1);
    $conn->query("INSERT INTO normalisasi (id_alternatif, r1, r2, r3, r4, r5) VALUES (".$alt['id_alternatif'].",$r1,$r2,$r3,$r4,$r5)");
    $normalisasi[] = [
        'id_alternatif' => $alt['id_alternatif'],
        'judul_lagu' => $alt['judul_lagu'],
        'r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4, 'r5' => $r5
    ];
}

// Hitung perangkingan dan simpan ke tabel perangkingan
$conn->query("TRUNCATE TABLE perangkingan");
$perangkingan = [];
foreach ($normalisasi as $n) {
    $vi = $bobot['w1']*$n['r1'] + $bobot['w2']*$n['r2'] + $bobot['w3']*$n['r3'] + $bobot['w4']*$n['r4'] + $bobot['w5']*$n['r5'];
    $conn->query("INSERT INTO perangkingan (id_alternatif, nama_emosi, nilai_akhir) VALUES (".$n['id_alternatif'].", '".$bobot['nama_emosi']."', $vi)");
    $perangkingan[] = [
        'judul_lagu' => $n['judul_lagu'],
        'nilai_akhir' => $vi
    ];
}
// Urutkan perangkingan
usort($perangkingan, function($a, $b) { return $b['nilai_akhir'] <=> $a['nilai_akhir']; });
?>
<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Perhitungan SAW, Normalisasi, dan Perangkingan</h2>
    <form method="get" action="">
        <input type="hidden" name="page" value="proses_saw">
        <button type="submit" class="px-5 py-2 rounded-lg bg-green-500 text-white font-bold shadow hover:bg-green-600 transition">Proses Ulang SAW</button>
    </form>
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-blue-600 mb-2">Tabel Normalisasi</h3>
        <table class="min-w-full bg-white rounded shadow mb-8">
            <thead>
                <tr class="bg-blue-100 text-blue-700">
                    <th class="py-2 px-4">Judul Lagu</th>
                    <th class="py-2 px-4">r1 (Tempo)</th>
                    <th class="py-2 px-4">r2 (Loudness)</th>
                    <th class="py-2 px-4">r3 (Energy)</th>
                    <th class="py-2 px-4">r4 (Valence)</th>
                    <th class="py-2 px-4">r5 (Mode)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($normalisasi as $n): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?php echo htmlspecialchars($n['judul_lagu']); ?></td>
                    <td class="py-2 px-4 text-center"><?php echo round($n['r1'], 4); ?></td>
                    <td class="py-2 px-4 text-center"><?php echo round($n['r2'], 4); ?></td>
                    <td class="py-2 px-4 text-center"><?php echo round($n['r3'], 4); ?></td>
                    <td class="py-2 px-4 text-center"><?php echo round($n['r4'], 4); ?></td>
                    <td class="py-2 px-4 text-center"><?php echo round($n['r5'], 4); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3 class="text-xl font-semibold text-blue-600 mb-2">Tabel Perangkingan</h3>
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-blue-100 text-blue-700">
                    <th class="py-2 px-4">Judul Lagu</th>
                    <th class="py-2 px-4">Nilai Akhir (V<sub>i</sub>)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perangkingan as $p): ?>
                <tr class="border-b">
                    <td class="py-2 px-4"><?php echo htmlspecialchars($p['judul_lagu']); ?></td>
                    <td class="py-2 px-4 text-center font-bold text-blue-700"><?php echo round($p['nilai_akhir'], 4); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
