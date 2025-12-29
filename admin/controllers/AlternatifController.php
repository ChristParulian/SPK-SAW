<?php
// controllers/AlternatifController.php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/models_alternatif.php';
class AlternatifController {
    private $model;
    public function __construct() {
        global $conn;
        $this->model = new models_alternatif($conn);
    }
    public function getAll() {
        return $this->model->getAll();
    }
    public function getById($id) {
        return $this->model->getById($id);
    }
    public function tambah($judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5) {
        return $this->model->tambah($judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5);
    }
    public function update($id, $judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5) {
        return $this->model->update($id, $judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5);
    }
    public function hapus($id) {
        return $this->model->hapus($id);
    }
}
