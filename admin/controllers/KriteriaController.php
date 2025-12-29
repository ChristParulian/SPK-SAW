<?php
// controllers/KriteriaController.php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/models_kriteria.php';
class KriteriaController {
    private $model;
    public function __construct() {
        global $conn;
        $this->model = new models_kriteria($conn);
    }
    public function getAll() {
        return $this->model->getAll();
    }
    public function getById($id) {
        return $this->model->getById($id);
    }
    public function tambah($kode, $nama, $sifat) {
        return $this->model->tambah($kode, $nama, $sifat);
    }
    public function update($id, $kode, $nama, $sifat) {
        return $this->model->update($id, $kode, $nama, $sifat);
    }
    public function hapus($id) {
        return $this->model->hapus($id);
    }
}
