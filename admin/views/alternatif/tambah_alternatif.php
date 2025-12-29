<?php
// views/alternatif/tambah_alternatif.php
?>
<div class="flex justify-center items-center min-h-[60vh]">
  <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg border border-blue-100">
    <h2 class="text-3xl font-extrabold text-blue-700 mb-6 text-center tracking-tight">Tambah Alternatif Lagu</h2>
    <form method="post" action="?page=alternatif&action=simpan" class="space-y-5">
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Judul Lagu</label>
        <input type="text" name="judul_lagu" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Artis</label>
        <input type="text" name="artis" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold text-gray-700">Lirik</label>
        <textarea name="lirik" rows="3" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition"></textarea>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Tempo (BPM)</label>
          <input type="number" step="0.01" name="c1_tempo" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Loudness (dB)</label>
          <input type="number" step="0.01" name="c2_loudness" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Energy (0.0-1.0)</label>
          <input type="number" step="0.01" min="0" max="1" name="c3_energy" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Valence (0.0-1.0)</label>
          <input type="number" step="0.01" min="0" max="1" name="c4_valence" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-700">Mode (1=Mayor, 0=Minor)</label>
          <select name="c5_mode" class="w-full border-2 border-blue-200 rounded-lg px-4 py-2">
            <option value="1">Mayor</option>
            <option value="0">Minor</option>
          </select>
        </div>
      </div>
      <div class="flex justify-end space-x-2 mt-6">
        <a href="?page=alternatif" class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">Batal</a>
        <button type="submit" class="px-5 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold shadow hover:from-blue-600 hover:to-blue-800 transition transform hover:scale-105">Simpan</button>
      </div>
    </form>
  </div>
</div>
