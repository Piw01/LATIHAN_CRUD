<?php
// src/controller/MahasiswaController.php

require_once __DIR__ . '/../models/MahasiswaModel.php';

class MahasiswaController {
    private $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    // Menampilkan halaman home
    public function Home() {
        include __DIR__ . '/../views/Home.php';
    }

    // Menampilkan list mahasiswa
    public function ListMahasiswa() {
        $mahasiswa = $this->model->getAll();
        include __DIR__ . '/../views/mahasiswa/list.php';
    }

    // Menampilkan form tambah
    public function FormTambah() {
        include __DIR__ . '/../views/mahasiswa/tambah.php';
    }

    // Proses input data
    public function InputData() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $telepon = $_POST['telepon'];
            $alamat = $_POST['alamat'];

            $result = $this->model->insertData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat);

            if ($result) {
                $_SESSION['message'] = "Data berhasil ditambahkan!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Data gagal ditambahkan! NIM mungkin sudah ada.";
                $_SESSION['type'] = "error";
            }

            header("Location: index.php?action=list");
            exit();
        }
    }

    // Menampilkan form edit
    public function FormEdit() {
        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];
            $mahasiswa = $this->model->getByNim($nim);
            
            if ($mahasiswa) {
                include __DIR__ . '/../views/mahasiswa/edit.php';
            } else {
                $_SESSION['message'] = "Data tidak ditemukan!";
                $_SESSION['type'] = "error";
                header("Location: index.php?action=list");
                exit();
            }
        }
    }

    // Proses update data
    public function UpdateData() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $telepon = $_POST['telepon'];
            $alamat = $_POST['alamat'];

            $result = $this->model->updateData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat);

            if ($result) {
                $_SESSION['message'] = "Data berhasil diperbarui!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Data gagal diperbarui!";
                $_SESSION['type'] = "error";
            }

            header("Location: index.php?action=list");
            exit();
        }
    }

    // Proses hapus data
    public function HapusData() {
        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];
            $result = $this->model->deleteData($nim);

            if ($result) {
                $_SESSION['message'] = "Data berhasil dihapus!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Data gagal dihapus!";
                $_SESSION['type'] = "error";
            }

            header("Location: index.php?action=list");
            exit();
        }
    }
}