<?php
// models/models_bobot.php
class models_bobot {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAll() {
        $result = $this->conn->query('SELECT * FROM bobot ORDER BY id_bobot ASC');
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM bobot WHERE id_bobot = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function tambah($nama_emosi, $w1, $w2, $w3, $w4, $w5) {
        $stmt = $this->conn->prepare('INSERT INTO bobot (nama_emosi, w1, w2, w3, w4, w5) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sddddd', $nama_emosi, $w1, $w2, $w3, $w4, $w5);
        return $stmt->execute();
    }
    public function update($id, $nama_emosi, $w1, $w2, $w3, $w4, $w5) {
        $stmt = $this->conn->prepare('UPDATE bobot SET nama_emosi=?, w1=?, w2=?, w3=?, w4=?, w5=? WHERE id_bobot=?');
        $stmt->bind_param('sdddddi', $nama_emosi, $w1, $w2, $w3, $w4, $w5, $id);
        return $stmt->execute();
    }
    public function hapus($id) {
        $stmt = $this->conn->prepare('DELETE FROM bobot WHERE id_bobot=?');
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
