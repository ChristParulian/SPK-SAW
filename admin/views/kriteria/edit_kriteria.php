<?php
// views/kriteria/edit_kriteria.php
require_once __DIR__ . '/../../controllers/KriteriaController.php';
$controller = new KriteriaController();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$kriteria = $controller->getById($id);
if (!$kriteria) {
	echo '<div class="p-6 text-red-600">Data kriteria tidak ditemukan.</div>';
	return;
}
?>
<div class="flex justify-center items-center min-h-[60vh]">
	<div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg border border-blue-100">
		<h2 class="text-3xl font-extrabold text-blue-700 mb-6 text-center tracking-tight">Edit Kriteria</h2>
		<form method="post" action="?page=kriteria&action=update&id=<?php echo $kriteria['id_kriteria']; ?>" class="space-y-5">
			<div>
				<label class="block mb-1 font-semibold text-gray-700">Kode Kriteria</label>
				<input type="text" name="kode_kriteria" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required value="<?php echo htmlspecialchars($kriteria['kode_kriteria']); ?>">
			</div>
			<div>
				<label class="block mb-1 font-semibold text-gray-700">Nama Kriteria</label>
				<input type="text" name="nama_kriteria" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required value="<?php echo htmlspecialchars($kriteria['nama_kriteria']); ?>">
			</div>
			<div>
				<label class="block mb-1 font-semibold text-gray-700">Sifat</label>
				<select name="sifat" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required>
					  <option value="benefit" <?php if ($kriteria['sifat'] == 'benefit') echo 'selected'; ?>><?php echo ucfirst('benefit'); ?></option>
					  <option value="cost" <?php if ($kriteria['sifat'] == 'cost') echo 'selected'; ?>><?php echo ucfirst('cost'); ?></option>
				</select>
			</div>
			<div class="flex justify-end space-x-2 mt-6">
				<a href="?page=kriteria" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">Batal</a>
				<button type="submit" class="px-5 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold shadow hover:from-blue-600 hover:to-blue-800 transition transform hover:scale-105">Update</button>
			</div>
		</form>
	</div>
</div>
