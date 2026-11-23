
<?php

require_once __DIR__ . '/BaseModel.php';

class Presensi extends BaseModel {

    public function __construct() {
        parent::__construct();
    }


    public function getAll() {
        $sql = "SELECT presensi.id,
                       siswa.nisn,
                       siswa.nama,
                       kelas.nama_kelas,
                       presensi.tanggal_waktu
                FROM presensi
                INNER JOIN siswa
                    ON presensi.nisn = siswa.nisn
                INNER JOIN kelas
                    ON siswa.id_kelas = kelas.id_kelas
                ORDER BY presensi.tanggal_waktu DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tapKartu($nisn) {
        $stmt = $this->pdo->prepare(
            "SELECT nisn, nama FROM siswa WHERE nisn = ?"
        );

        $stmt->execute([$nisn]);
        $siswa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$siswa) {
            return [
                'status' => false,
                'pesan' => 'NISN tidak ditemukan. Siswa belum terdaftar.'
            ];
        }

        $stmt = $this->pdo->prepare(
            "INSERT INTO presensi (nisn, tanggal_waktu)
             VALUES (?, NOW())"
        );

        $stmt->execute([$nisn]);

        return [
            'status' => true,
            'pesan' => 'Presensi berhasil dicatat untuk ' .
                       $siswa['nama']
        ];
    }

    public function cariPresensi($keyword = '', $tanggal = '', $id_kelas = '') {

        $sql = "SELECT presensi.id,
                       siswa.nisn,
                       siswa.nama,
                       kelas.nama_kelas,
                       presensi.tanggal_waktu
                FROM presensi
                INNER JOIN siswa
                    ON presensi.nisn = siswa.nisn
                INNER JOIN kelas
                    ON siswa.id_kelas = kelas.id_kelas
                WHERE 1 = 1";

        $params = [];

        if ($keyword !== '') {
            $sql .= " AND (siswa.nama LIKE :nama
                        OR siswa.nisn LIKE :nisn)";

            $params[':nama'] = "%$keyword%";
            $params[':nisn'] = "%$keyword%";
        }

        if ($tanggal !== '') {
            $sql .= " AND DATE(presensi.tanggal_waktu) = :tanggal";

            $params[':tanggal'] = $tanggal;
        }

        if ($id_kelas !== '') {
            $sql .= " AND kelas.id_kelas = :id_kelas";

            $params[':id_kelas'] = $id_kelas;
        }

        $sql .= " ORDER BY presensi.tanggal_waktu DESC,
                           presensi.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hapusPresensi($id) {

        $stmt = $this->pdo->prepare(
            "DELETE FROM presensi WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}
