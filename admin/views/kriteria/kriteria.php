<?php
// views/kriteria/kriteria.php
require_once __DIR__ . '/../../controllers/KriteriaController.php';
$controller = new KriteriaController();
$kriteria = $controller->getAll();
?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-700">Daftar Kriteria</h2>
        <a href="?page=kriteria&action=tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Kriteria</a>
    </div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-blue-100 text-blue-700">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Kode</th>
                <th class="py-2 px-4">Nama Kriteria</th>
                <th class="py-2 px-4">Sifat</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($kriteria)): ?>
                <tr><td colspan="5" class="text-center py-4 text-gray-400">Belum ada data kriteria.</td></tr>
            <?php else: ?>
                <?php foreach ($kriteria as $i => $row): ?>
                    <tr class="border-b hover:bg-blue-50">
                        <td class="py-2 px-4 text-center"><?php echo $i+1; ?></td>
                        <td class="py-2 px-4 text-center"><?php echo htmlspecialchars($row['kode_kriteria']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($row['nama_kriteria']); ?></td>
                        <td class="py-2 px-4 text-center"><?php echo htmlspecialchars($row['sifat']); ?></td>
                        <td class="py-2 px-4 text-center">
                            <a href="?page=kriteria&action=edit&id=<?php echo $row['id_kriteria']; ?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                            <a href="?page=kriteria&action=hapus&id=<?php echo $row['id_kriteria']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus kriteria ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
