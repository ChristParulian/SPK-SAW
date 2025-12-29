<?php
// views/alternatif/alternatif.php
require_once __DIR__ . '/../../controllers/AlternatifController.php';
$controller = new AlternatifController();
$alternatif = $controller->getAll();
?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-700">Daftar Alternatif Lagu</h2>
        <a href="?page=alternatif&action=tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Alternatif</a>
    </div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-blue-100 text-blue-700">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Judul Lagu</th>
                <th class="py-2 px-4">Artis</th>
                <th class="py-2 px-4">Lirik</th>
                <th class="py-2 px-4">Tempo</th>
                <th class="py-2 px-4">Loudness</th>
                <th class="py-2 px-4">Energy</th>
                <th class="py-2 px-4">Valence</th>
                <th class="py-2 px-4">Mode</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($alternatif)): ?>
                <tr><td colspan="10" class="text-center py-4 text-gray-400">Belum ada data alternatif.</td></tr>
            <?php else: ?>
                <?php foreach ($alternatif as $i => $row): ?>
                    <tr class="border-b hover:bg-blue-50">
                        <td class="py-2 px-4 text-center"><?php echo $i+1; ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($row['judul_lagu']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($row['artis']); ?></td>
                        <td class="py-2 px-4 text-xs text-gray-500 max-w-xs truncate" title="<?php echo htmlspecialchars($row['lirik']); ?>"><?php echo htmlspecialchars(mb_strimwidth($row['lirik'], 0, 40, '...')); ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['c1_tempo']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['c2_loudness']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['c3_energy']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['c4_valence']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['c5_mode']; ?></td>
                        <td class="py-2 px-4 text-center">
                            <a href="?page=alternatif&action=edit&id=<?php echo $row['id_alternatif']; ?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                            <a href="?page=alternatif&action=hapus&id=<?php echo $row['id_alternatif']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus alternatif ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
