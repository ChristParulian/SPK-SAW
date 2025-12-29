<?php
// models/models_alternatif.php
class models_alternatif {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getAll() {
        $result = $this->conn->query('SELECT * FROM alternatif ORDER BY id_alternatif ASC');
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM alternatif WHERE id_alternatif = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function tambah($judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5) {
        $stmt = $this->conn->prepare('INSERT INTO alternatif (judul_lagu, artis, lirik, c1_tempo, c2_loudness, c3_energy, c4_valence, c5_mode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssddddi', $judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5);
        return $stmt->execute();
    }
    public function update($id, $judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5) {
        $stmt = $this->conn->prepare('UPDATE alternatif SET judul_lagu=?, artis=?, lirik=?, c1_tempo=?, c2_loudness=?, c3_energy=?, c4_valence=?, c5_mode=? WHERE id_alternatif=?');
        $stmt->bind_param('sssddddii', $judul, $artis, $lirik, $c1, $c2, $c3, $c4, $c5, $id);
        return $stmt->execute();
    }
    public function hapus($id) {
        $stmt = $this->conn->prepare('DELETE FROM alternatif WHERE id_alternatif=?');
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
