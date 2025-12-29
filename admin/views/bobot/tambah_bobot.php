<?php
// views/bobot/tambah_bobot.php
?>
<div class="flex justify-center items-center min-h-[60vh]">
  <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg border border-blue-100">
    <h2 class="text-3xl font-extrabold text-blue-700 mb-6 text-center tracking-tight">Tambah Bobot Emosi</h2>
    <form method="post" action="?page=bobot&action=simpan" class="space-y-5">
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Nama Emosi</label>
        <input type="text" name="nama_emosi" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required placeholder="Contoh: Happy">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 font-semibold text-gray-700">W1 (Tempo)</label>
          <input type="number" step="0.01" name="w1" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">W2 (Loudness)</label>
          <input type="number" step="0.01" name="w2" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">W3 (Energy)</label>
          <input type="number" step="0.01" name="w3" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">W4 (Valence)</label>
          <input type="number" step="0.01" name="w4" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">W5 (Mode)</label>
          <input type="number" step="0.01" name="w5" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
      </div>
      <div class="flex justify-end space-x-2 mt-6">
        <a href="?page=bobot" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">Batal</a>
        <button type="submit" class="px-5 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold shadow hover:from-blue-600 hover:to-blue-800 transition transform hover:scale-105">Simpan</button>
      </div>
    </form>
  </div>
</div>
