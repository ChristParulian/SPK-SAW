<?php
// admin/sidebar.php
?>
<aside class="w-64 bg-white shadow flex flex-col min-h-screen py-8 px-4">
    <div class="mb-10 text-center">
        <div class="flex justify-center mb-2">
            <!-- Logo SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="#3b82f6"/>
                <path stroke="#fff" stroke-width="2" d="M9 9l6 3-6 3V9z"/>
            </svg>
        </div>
        <span class="text-2xl font-bold text-blue-700">SPK Lagu</span>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4">
            <li><a href="index.php" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-semibold">Dashboard</a></li>
            <li><a href="?page=kriteria" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-semibold">Kriteria</a></li>
            <li><a href="?page=alternatif" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-semibold">Alternatif</a></li>
            <li><a href="?page=bobot" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-semibold">Bobot</a></li>
            <li><a href="?page=proses_saw" class="block py-2 px-4 rounded hover:bg-blue-100 text-blue-700 font-semibold">Perhitungan</a></li>
            <li><a href="rekomendasi.php" class="block py-2 px-4 rounded hover:bg-green-100 text-green-700 font-semibold">Rekomendasi</a></li>
        </ul>
    </nav>
    <div class="mt-10">
        <a href="logout.php" class="block py-2 px-4 rounded bg-red-100 text-red-500 font-semibold hover:bg-red-200 text-center">Logout</a>
    </div>
</aside>
