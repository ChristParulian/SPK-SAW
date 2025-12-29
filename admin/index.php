<?php
// admin/index.php
// Dashboard Admin - Sistem Pendukung Keputusan Pemilihan Lagu (SAW)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php include __DIR__ . '/sidebar.php'; ?>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col p-10">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : '';
            $action = isset($_GET['action']) ? $_GET['action'] : '';
            if ($page === 'kriteria') {
                require_once __DIR__ . '/controllers/KriteriaController.php';
                $controller = new KriteriaController();
                if ($action === 'tambah') {
                    include __DIR__ . '/views/kriteria/tambah_kriteria.php';
                } elseif ($action === 'edit' && isset($_GET['id'])) {
                    include __DIR__ . '/views/kriteria/edit_kriteria.php';
                } elseif ($action === 'simpan' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->tambah($_POST['kode_kriteria'], $_POST['nama_kriteria'], $_POST['sifat']);
                    echo '<script>window.location="?page=kriteria";</script>';
                } elseif ($action === 'update' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update((int)$_GET['id'], $_POST['kode_kriteria'], $_POST['nama_kriteria'], $_POST['sifat']);
                    echo '<script>window.location="?page=kriteria";</script>';
                } elseif ($action === 'hapus' && isset($_GET['id'])) {
                    $controller->hapus((int)$_GET['id']);
                    echo '<script>window.location="?page=kriteria";</script>';
                } else {
                    include __DIR__ . '/views/kriteria/kriteria.php';
                }
            } elseif ($page === 'alternatif') {
                require_once __DIR__ . '/controllers/AlternatifController.php';
                $controller = new AlternatifController();
                if ($action === 'tambah') {
                    include __DIR__ . '/views/alternatif/tambah_alternatif.php';
                } elseif ($action === 'edit' && isset($_GET['id'])) {
                    include __DIR__ . '/views/alternatif/edit_alternatif.php';
                } elseif ($action === 'simpan' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->tambah(
                        $_POST['judul_lagu'],
                        $_POST['artis'],
                        $_POST['lirik'],
                        $_POST['c1_tempo'],
                        $_POST['c2_loudness'],
                        $_POST['c3_energy'],
                        $_POST['c4_valence'],
                        $_POST['c5_mode']
                    );
                    echo '<script>window.location="?page=alternatif";</script>';
                } elseif ($action === 'update' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update(
                        (int)$_GET['id'],
                        $_POST['judul_lagu'],
                        $_POST['artis'],
                        $_POST['lirik'],
                        $_POST['c1_tempo'],
                        $_POST['c2_loudness'],
                        $_POST['c3_energy'],
                        $_POST['c4_valence'],
                        $_POST['c5_mode']
                    );
                    echo '<script>window.location="?page=alternatif";</script>';
                } elseif ($action === 'hapus' && isset($_GET['id'])) {
                    $controller->hapus((int)$_GET['id']);
                    echo '<script>window.location="?page=alternatif";</script>';
                } else {
                    include __DIR__ . '/views/alternatif/alternatif.php';
                }
            } elseif ($page === 'bobot') {
                require_once __DIR__ . '/controllers/BobotController.php';
                $controller = new BobotController();
                if ($action === 'tambah') {
                    include __DIR__ . '/views/bobot/tambah_bobot.php';
                } elseif ($action === 'edit' && isset($_GET['id'])) {
                    include __DIR__ . '/views/bobot/edit_bobot.php';
                } elseif ($action === 'simpan' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->tambah(
                        $_POST['nama_emosi'],
                        $_POST['w1'],
                        $_POST['w2'],
                        $_POST['w3'],
                        $_POST['w4'],
                        $_POST['w5']
                    );
                    echo '<script>window.location="?page=bobot";</script>';
                } elseif ($action === 'update' && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update(
                        (int)$_GET['id'],
                        $_POST['nama_emosi'],
                        $_POST['w1'],
                        $_POST['w2'],
                        $_POST['w3'],
                        $_POST['w4'],
                        $_POST['w5']
                    );
                    echo '<script>window.location="?page=bobot";</script>';
                } elseif ($action === 'hapus' && isset($_GET['id'])) {
                    $controller->hapus((int)$_GET['id']);
                    echo '<script>window.location="?page=bobot";</script>';
                } else {
                    include __DIR__ . '/views/bobot/bobot.php';
                }
            } elseif ($page === 'proses_saw') {
                include __DIR__ . '/perhitungan.php';
            } else {
                // Statistik jumlah data
                require_once __DIR__ . '/controllers/KriteriaController.php';
                require_once __DIR__ . '/controllers/AlternatifController.php';
                require_once __DIR__ . '/controllers/BobotController.php';
                $kriteriaCount = count((new KriteriaController())->getAll());
                $alternatifCount = count((new AlternatifController())->getAll());
                $bobotCount = count((new BobotController())->getAll());
                // Saran tambahan: jumlah user admin
                $userCount = 0;
                $conn = null;
                if (file_exists(__DIR__ . '/../config/database.php')) {
                    require __DIR__ . '/../config/database.php';
                    $res = $conn->query('SELECT COUNT(*) as total FROM user');
                    if ($res) {
                        $row = $res->fetch_assoc();
                        $userCount = (int)$row['total'];
                    }
                }
            ?>
            <h1 class="text-3xl font-extrabold text-blue-700 mb-2 tracking-tight">Dashboard Admin</h1>
            <p class="text-gray-500 text-center mb-2">Selamat datang di halaman admin.</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8 mb-8">
                <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2"><?php echo $kriteriaCount; ?></div>
                    <div class="text-gray-700 font-semibold">Kriteria</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-4xl font-bold text-green-600 mb-2"><?php echo $alternatifCount; ?></div>
                    <div class="text-gray-700 font-semibold">Alternatif Lagu</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-4xl font-bold text-yellow-500 mb-2"><?php echo $bobotCount; ?></div>
                    <div class="text-gray-700 font-semibold">Bobot Emosi</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2"><?php echo $userCount; ?></div>
                    <div class="text-gray-700 font-semibold">User Admin</div>
                </div>
            </div>
            <div class="mt-6 text-sm text-gray-400">Sistem Pendukung Keputusan Pemilihan Lagu<br>Metode Simple Additive Weighting (SAW)</div>
            <?php } ?>
        </main>
    </div>
</body>
</html>
