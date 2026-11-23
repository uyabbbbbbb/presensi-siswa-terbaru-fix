
<?php

require_once __DIR__ . '/BaseModel.php';

class Kelas extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $stmt = $this->pdo->query(
            "SELECT * FROM kelas ORDER BY id_kelas ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM kelas WHERE id_kelas = ?"
        );

        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambah($nama, $jurusan) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO kelas (nama_kelas, jurusan)
             VALUES (?, ?)"
        );

        return $stmt->execute([$nama, $jurusan]);
    }

    public function ubah($id, $nama, $jurusan) {
        $stmt = $this->pdo->prepare(
            "UPDATE kelas
             SET nama_kelas = ?, jurusan = ?
             WHERE id_kelas = ?"
        );

        return $stmt->execute([$nama, $jurusan, $id]);
    }

    public function hapus($id) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM kelas WHERE id_kelas = ?"
        );

        return $stmt->execute([$id]);
    }
}
