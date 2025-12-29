<?php
// views/bobot/bobot.php
require_once __DIR__ . '/../../controllers/BobotController.php';
$controller = new BobotController();
$bobot = $controller->getAll();
?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-700">Daftar Bobot Emosi</h2>
        <a href="?page=bobot&action=tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Bobot</a>
    </div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-blue-100 text-blue-700">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Emosi</th>
                <th class="py-2 px-4">W1 (Tempo)</th>
                <th class="py-2 px-4">W2 (Loudness)</th>
                <th class="py-2 px-4">W3 (Energy)</th>
                <th class="py-2 px-4">W4 (Valence)</th>
                <th class="py-2 px-4">W5 (Mode)</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bobot)): ?>
                <tr><td colspan="8" class="text-center py-4 text-gray-400">Belum ada data bobot.</td></tr>
            <?php else: ?>
                <?php foreach ($bobot as $i => $row): ?>
                    <tr class="border-b hover:bg-blue-50">
                        <td class="py-2 px-4 text-center"><?php echo $i+1; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo htmlspecialchars($row['nama_emosi']); ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['w1']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['w2']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['w3']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['w4']; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo $row['w5']; ?></td>
                        <td class="py-2 px-4 text-center">
                            <a href="?page=bobot&action=edit&id=<?php echo $row['id_bobot']; ?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                            <a href="?page=bobot&action=hapus&id=<?php echo $row['id_bobot']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus bobot ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
