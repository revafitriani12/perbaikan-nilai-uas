<?php
require_once __DIR__ . '/../models/MataKuliah.php';

class MataKuliahController {
    private $model;

    public function __construct($pdo) {
        $this->model = new MataKuliah($pdo);
    }

    private function ambilInput() {
        return [
            'kode'   => trim($_POST['kode'] ?? ''),
            'nama'   => trim($_POST['nama'] ?? ''),
            'prodi'  => $_POST['prodi'] ?? '',
            'smt'    => (int)($_POST['smt'] ?? 0),
            'sks'    => (int)($_POST['sks'] ?? 0),
            'status' => $_POST['status'] ?? '',
        ];
    }

    private function valid($d) {
        return $d['kode'] !== '' && $d['nama'] !== '' && $d['prodi'] !== ''
            && $d['smt'] >= 1 && $d['smt'] <= 8
            && $d['sks'] >= 1 && $d['sks'] <= 6
            && in_array($d['status'], ['Aktif', 'Tidak Aktif'], true);
    }

    private function pesanError(PDOException $e) {
        return ($e->getCode() == 23000)
            ? 'Kode atau nama mata kuliah sudah terdaftar.'
            : 'Terjadi kesalahan pada database.';
    }

    public function index() {
        $mata_kuliah = $this->model->getAll();
        $msg = $_GET['msg'] ?? '';
        require __DIR__ . '/../views/index.php';
    }

    public function create() {
        $error = '';
        $mk = ['KodeMataKuliah'=>'', 'NamaMataKuliah'=>'', 'ProgramStudi'=>'',
               'Semester'=>'', 'SKS'=>'', 'Status'=>'Aktif'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $d = $this->ambilInput();
            $mk = ['KodeMataKuliah'=>$d['kode'], 'NamaMataKuliah'=>$d['nama'],
                   'ProgramStudi'=>$d['prodi'], 'Semester'=>$d['smt'],
                   'SKS'=>$d['sks'], 'Status'=>$d['status']];
            if (!$this->valid($d)) {
                $error = 'Data belum lengkap atau di luar rentang yang diizinkan.';
            } else {
                try {
                    $this->model->create($d);
                    header('Location: index.php?msg=created');
                    exit;
                } catch (PDOException $e) {
                    $error = $this->pesanError($e);
                }
            }
        }
        require __DIR__ . '/../views/create.php';
    }

    public function edit() {
        $error = '';
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        $mk = $this->model->getById($id);
        if (!$mk) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $d = $this->ambilInput();
            $mk = ['IdMataKuliah'=>$id, 'KodeMataKuliah'=>$d['kode'], 'NamaMataKuliah'=>$d['nama'],
                   'ProgramStudi'=>$d['prodi'], 'Semester'=>$d['smt'],
                   'SKS'=>$d['sks'], 'Status'=>$d['status']];
            if (!$this->valid($d)) {
                $error = 'Data belum lengkap atau di luar rentang yang diizinkan.';
            } else {
                try {
                    $this->model->update($id, $d);
                    header('Location: index.php?msg=updated');
                    exit;
                } catch (PDOException $e) {
                    $error = $this->pesanError($e);
                }
            }
        }
        require __DIR__ . '/../views/edit.php';
    }

    public function delete() {
        $id = (int)($_GET['id'] ?? 0);
        try {
            $this->model->delete($id);
            header('Location: index.php?msg=deleted');
        } catch (PDOException $e) {
            header('Location: index.php?msg=error');
        }
        exit;
    }
}