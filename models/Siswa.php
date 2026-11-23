
<?php

require_once __DIR__ . '/BaseModel.php';

class Siswa extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    // Menampilkan semua siswa
    public function getAll() {
        $sql = "SELECT siswa.*, kelas.nama_kelas
                FROM siswa
                INNER JOIN kelas
                ON siswa.id_kelas = kelas.id_kelas
                ORDER BY siswa.nama ASC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mencari siswa berdasarkan nama atau NISN
    public function cari($keyword) {
        $sql = "SELECT siswa.*, kelas.nama_kelas
                FROM siswa
                INNER JOIN kelas
                ON siswa.id_kelas = kelas.id_kelas
                WHERE siswa.nama LIKE :nama
                   OR siswa.nisn LIKE :nisn
                ORDER BY siswa.nama ASC";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nama' => '%' . $keyword . '%',
            ':nisn' => '%' . $keyword . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil siswa berdasarkan NISN
    public function getByNisn($nisn) {
        $sql = "SELECT * FROM siswa
                WHERE nisn = :nisn
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nisn' => $nisn]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($nisn) {
        return $this->getByNisn($nisn);
    }

    // Menambahkan siswa
    public function tambah($nisn, $nama, $alamat, $id_kelas) {
        $sql = "INSERT INTO siswa
                (nisn, nama, alamat, id_kelas)
                VALUES
                (:nisn, :nama, :alamat, :id_kelas)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nisn' => $nisn,
            ':nama' => $nama,
            ':alamat' => $alamat,
            ':id_kelas' => $id_kelas
        ]);
    }

    // Mengedit siswa
    public function edit($nisn, $nama, $alamat, $id_kelas) {
        $sql = "UPDATE siswa
                SET nama = :nama,
                    alamat = :alamat,
                    id_kelas = :id_kelas
                WHERE nisn = :nisn";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nisn' => $nisn,
            ':nama' => $nama,
            ':alamat' => $alamat,
            ':id_kelas' => $id_kelas
        ]);
    }

    // Menghapus siswa
    public function hapus($nisn) {
        $sql = "DELETE FROM siswa
                WHERE nisn = :nisn";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':nisn' => $nisn]);
    }
}
