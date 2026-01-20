<?php
// src/controllers/ApiMahasiswaController.php
namespace src\controller;

require_once __DIR__ . '/../models/MahasiswaModel.php';
use MahasiswaModel;

class ApiMahasiswaController {
    private $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    /**
     * GET - Ambil semua data mahasiswa
     */
    public function index(): array {
        try {
            $data = $this->model->getAll();

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'data' => $data,
                ],
            ];
        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * GET - Ambil detail mahasiswa berdasarkan NIM
     */
    public function show(string $nim): array {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        try {
            $mahasiswa = $this->model->getByNim($nim);

            if (!$mahasiswa) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'data' => $mahasiswa,
                ],
            ];
        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * POST - Simpan data mahasiswa baru (CREATE)
     */
    public function store(array $input): array {
        // Validasi field required
        $required = ['nim', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'telepon', 'alamat'];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                return $this->badRequest("Field '$field' wajib diisi.");
            }
        }

        try {
            $ok = $this->model->insertData(
                $input['nim'],
                $input['nama'],
                $input['tempat_lahir'],
                $input['tanggal_lahir'],
                $input['jenis_kelamin'],
                $input['telepon'],
                $input['alamat']
            );

            if (!$ok) {
                return [
                    'status' => 409,
                    'body' => [
                        'success' => false,
                        'message' => 'Gagal menyimpan data. NIM mungkin sudah ada.',
                    ],
                ];
            }

            // Ambil data yang baru disimpan
            $mahasiswa = $this->model->getByNim($input['nim']);

            return [
                'status' => 201,
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil ditambahkan.',
                    'data' => $mahasiswa,
                ],
            ];
        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * PUT/PATCH - Update data mahasiswa berdasarkan NIM
     */
    public function update(string $nim, array $input): array {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        // Validasi field required
        $required = ['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'telepon', 'alamat'];
        foreach ($required as $field) {
            if (!isset($input[$field]) || $input[$field] === '') {
                return $this->badRequest("Field '$field' wajib diisi.");
            }
        }

        try {
            // Pastikan data ada
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            $ok = $this->model->updateData(
                $nim,
                $input['nama'],
                $input['tempat_lahir'],
                $input['tanggal_lahir'],
                $input['jenis_kelamin'],
                $input['telepon'],
                $input['alamat']
            );

            if (!$ok) {
                return $this->serverError(new \Exception('Gagal mengubah data.'));
            }

            $mahasiswa = $this->model->getByNim($nim);

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil diperbarui.',
                    'data' => $mahasiswa,
                ],
            ];
        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * DELETE - Hapus data mahasiswa
     */
    public function destroy(string $nim): array {
        if (trim($nim) === '') {
            return $this->badRequest('NIM tidak boleh kosong.');
        }

        try {
            $existing = $this->model->getByNim($nim);
            if (!$existing) {
                return [
                    'status' => 404,
                    'body' => [
                        'success' => false,
                        'message' => 'Mahasiswa tidak ditemukan.',
                    ],
                ];
            }

            $ok = $this->model->deleteData($nim);

            if (!$ok) {
                return $this->serverError(new \Exception('Gagal menghapus data.'));
            }

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'message' => 'Data mahasiswa berhasil dihapus.',
                ],
            ];
        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    // =============== Helper Error ===============
    
    private function badRequest(string $message): array {
        return [
            'status' => 400,
            'body' => [
                'success' => false,
                'message' => $message,
            ],
        ];
    }

    private function serverError(\Throwable $e): array {
        return [
            'status' => 500,
            'body' => [
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
                // 'error' => $e->getMessage(), // uncomment saat debugging
            ],
        ];
    }
}