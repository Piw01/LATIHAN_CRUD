<?php
// src/controller/ApiController.php

require_once __DIR__ . '/../models/MahasiswaModel.php';

class ApiController {
    private $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
        
        // Set header untuk JSON response
        header('Content-Type: application/json');
        
        // Enable CORS (untuk testing dengan frontend terpisah)
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    // Helper function untuk response JSON
    private function sendResponse($status, $message, $data = null) {
        http_response_code($status);
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], JSON_PRETTY_PRINT);
        exit();
    }

    // GET - Mendapatkan semua data mahasiswa
    public function getAllMahasiswa() {
        try {
            $mahasiswa = $this->model->getAll();
            
            if ($mahasiswa) {
                $this->sendResponse(200, 'Data mahasiswa berhasil diambil', $mahasiswa);
            } else {
                $this->sendResponse(200, 'Tidak ada data mahasiswa', []);
            }
        } catch (Exception $e) {
            $this->sendResponse(500, 'Error: ' . $e->getMessage());
        }
    }

    // GET - Mendapatkan data mahasiswa berdasarkan NIM
    public function getMahasiswaByNim($nim) {
        try {
            if (empty($nim)) {
                $this->sendResponse(400, 'NIM tidak boleh kosong');
            }

            $mahasiswa = $this->model->getByNim($nim);
            
            if ($mahasiswa) {
                $this->sendResponse(200, 'Data mahasiswa ditemukan', $mahasiswa);
            } else {
                $this->sendResponse(404, 'Data mahasiswa tidak ditemukan');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, 'Error: ' . $e->getMessage());
        }
    }

    // POST - Menambah data mahasiswa baru
    public function createMahasiswa() {
        try {
            // Ambil data dari request body
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Validasi data
            if (empty($data['nim']) || empty($data['nama']) || empty($data['tempat_lahir']) || 
                empty($data['tanggal_lahir']) || empty($data['jenis_kelamin'])) {
                $this->sendResponse(400, 'Data tidak lengkap. NIM, Nama, Tempat Lahir, Tanggal Lahir, dan Jenis Kelamin wajib diisi');
            }

            $nim = $data['nim'];
            $nama = $data['nama'];
            $tempat_lahir = $data['tempat_lahir'];
            $tanggal_lahir = $data['tanggal_lahir'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $telepon = $data['telepon'] ?? null;
            $alamat = $data['alamat'] ?? null;

            $result = $this->model->insertData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat);

            if ($result) {
                $this->sendResponse(201, 'Data mahasiswa berhasil ditambahkan', [
                    'nim' => $nim,
                    'nama' => $nama
                ]);
            } else {
                $this->sendResponse(409, 'Data mahasiswa gagal ditambahkan. NIM mungkin sudah ada');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, 'Error: ' . $e->getMessage());
        }
    }

    // PUT - Update data mahasiswa
    public function updateMahasiswa($nim) {
        try {
            if (empty($nim)) {
                $this->sendResponse(400, 'NIM tidak boleh kosong');
            }

            // Cek apakah data mahasiswa ada
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                $this->sendResponse(404, 'Data mahasiswa tidak ditemukan');
            }

            // Ambil data dari request body
            $data = json_decode(file_get_contents('php://input'), true);
            
            // Validasi data
            if (empty($data['nama']) || empty($data['tempat_lahir']) || 
                empty($data['tanggal_lahir']) || empty($data['jenis_kelamin'])) {
                $this->sendResponse(400, 'Data tidak lengkap. Nama, Tempat Lahir, Tanggal Lahir, dan Jenis Kelamin wajib diisi');
            }

            $nama = $data['nama'];
            $tempat_lahir = $data['tempat_lahir'];
            $tanggal_lahir = $data['tanggal_lahir'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $telepon = $data['telepon'] ?? null;
            $alamat = $data['alamat'] ?? null;

            $result = $this->model->updateData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat);

            if ($result) {
                $this->sendResponse(200, 'Data mahasiswa berhasil diupdate', [
                    'nim' => $nim,
                    'nama' => $nama
                ]);
            } else {
                $this->sendResponse(500, 'Data mahasiswa gagal diupdate');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, 'Error: ' . $e->getMessage());
        }
    }

    // DELETE - Hapus data mahasiswa
    public function deleteMahasiswa($nim) {
        try {
            if (empty($nim)) {
                $this->sendResponse(400, 'NIM tidak boleh kosong');
            }

            // Cek apakah data mahasiswa ada
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                $this->sendResponse(404, 'Data mahasiswa tidak ditemukan');
            }

            $result = $this->model->deleteData($nim);

            if ($result) {
                $this->sendResponse(200, 'Data mahasiswa berhasil dihapus', [
                    'nim' => $nim
                ]);
            } else {
                $this->sendResponse(500, 'Data mahasiswa gagal dihapus');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, 'Error: ' . $e->getMessage());
        }
    }
}