<?php
// src/controllers/AuthController.php

require_once __DIR__ . '/../models/AuthModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new AuthModel();
    }

    // Menampilkan halaman login
    public function showLogin() {
        // Jika sudah login, redirect ke home
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit();
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    // Proses login
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Username dan password harus diisi!";
                header("Location: index.php?action=login");
                exit();
            }

            $user = $this->model->login($username, $password);

            if ($user) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['message'] = "Login berhasil! Selamat datang, " . $user['nama_lengkap'];
                $_SESSION['type'] = "success";

                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Username atau password salah!";
                header("Location: index.php?action=login");
                exit();
            }
        }
    }

    // Logout
    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }

    // Menampilkan halaman register (opsional)
    public function showRegister() {
        include __DIR__ . '/../views/auth/register.php';
    }

    // Proses register
    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $nama_lengkap = trim($_POST['nama_lengkap']);

            // Validasi
            if (empty($username) || empty($password) || empty($nama_lengkap)) {
                $_SESSION['error'] = "Semua field harus diisi!";
                header("Location: index.php?action=register");
                exit();
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Password dan konfirmasi password tidak sama!";
                header("Location: index.php?action=register");
                exit();
            }

            if (strlen($password) < 3) {
                $_SESSION['error'] = "Password minimal 3 karakter!";
                header("Location: index.php?action=register");
                exit();
            }

            $result = $this->model->register($username, $password, $nama_lengkap);

            if ($result) {
                $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
                $_SESSION['type'] = "success";
                header("Location: index.php?action=login");
                exit();
            } else {
                $_SESSION['error'] = "Username sudah digunakan!";
                header("Location: index.php?action=register");
                exit();
            }
        }
    }
}

// Fungsi helper untuk cek login
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit();
    }
}