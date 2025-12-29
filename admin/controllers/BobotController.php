<?php
// controllers/BobotController.php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/models_bobot.php';
class BobotController {
    private $model;
    public function __construct() {
        global $conn;
        $this->model = new models_bobot($conn);
    }
    public function getAll() {
        return $this->model->getAll();
    }
    public function getById($id) {
        return $this->model->getById($id);
    }
    public function tambah($nama_emosi, $w1, $w2, $w3, $w4, $w5) {
        return $this->model->tambah($nama_emosi, $w1, $w2, $w3, $w4, $w5);
    }
    public function update($id, $nama_emosi, $w1, $w2, $w3, $w4, $w5) {
        return $this->model->update($id, $nama_emosi, $w1, $w2, $w3, $w4, $w5);
    }
    public function hapus($id) {
        return $this->model->hapus($id);
    }
}
