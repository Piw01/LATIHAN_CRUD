<?php
// src/controllers/ApiAuthController.php
namespace src\controllers;

require_once __DIR__ . '/../models/AuthModel.php';

class ApiAuthController {
    private \AuthModel $userModel;

    public function __construct() {
        $this->userModel = new \AuthModel();
    }

    /**
     * Proses login: validasi input, cek user, dan buat response API
     */
    public function login(array $input): array {
        // Validasi input dasar
        $required = ['username', 'password'];
        foreach ($required as $field) {
            if (empty($input[$field])) {
                return $this->badRequest("Field '$field' wajib diisi.");
            }
        }

        $username = trim((string) $input['username']);
        $password = (string) $input['password'];

        if ($username === '' || $password === '') {
            return $this->badRequest('Username dan password wajib diisi.');
        }

        try {
            // Cari user dan verifikasi password
            $user = $this->userModel->login($username, $password);

            if (!$user) {
                return [
                    'status' => 401,
                    'body' => [
                        'success' => false,
                        'message' => 'Username atau password salah.',
                    ],
                ];
            }

            return [
                'status' => 200,
                'body' => [
                    'success' => true,
                    'message' => 'Login berhasil.',
                    'data' => [
                        'username' => $user['username'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'role' => $user['role']
                    ],
                ],
            ];

        } catch (\Throwable $e) {
            return $this->serverError($e);
        }
    }

    /**
     * Helper untuk response 400 dengan pesan validasi
     */
    private function badRequest(string $message): array {
        return [
            'status' => 400,
            'body' => [
                'success' => false,
                'message' => $message,
            ],
        ];
    }

    /**
     * Helper untuk response 500 saat terjadi error server
     */
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