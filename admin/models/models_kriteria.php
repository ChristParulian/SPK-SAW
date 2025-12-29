<?php
// models/models_kriteria.php
class models_kriteria {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAll() {
        $result = $this->conn->query('SELECT * FROM kriteria ORDER BY id_kriteria ASC');
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM kriteria WHERE id_kriteria = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function tambah($kode, $nama, $sifat) {
        $stmt = $this->conn->prepare('INSERT INTO kriteria (kode_kriteria, nama_kriteria, sifat) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $kode, $nama, $sifat);
        return $stmt->execute();
    }
    public function update($id, $kode, $nama, $sifat) {
        $stmt = $this->conn->prepare('UPDATE kriteria SET kode_kriteria=?, nama_kriteria=?, sifat=? WHERE id_kriteria=?');
        $stmt->bind_param('sssi', $kode, $nama, $sifat, $id);
        return $stmt->execute();
    }
    public function hapus($id) {
        $stmt = $this->conn->prepare('DELETE FROM kriteria WHERE id_kriteria=?');
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
