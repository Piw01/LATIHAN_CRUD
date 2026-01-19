<?php
// public/index.php

session_start();

require_once __DIR__ . '/../src/controllers/MahasiswaController.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Routing
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Routes yang tidak memerlukan login
$publicRoutes = ['login', 'processlogin', 'register', 'processregister'];

// Jika bukan public route dan user belum login, redirect ke login
if (!in_array($action, $publicRoutes) && !isset($_SESSION['user_id'])) {
    header("Location: index.php?action=login");
    exit();
}

// Auth Controller
$authController = new AuthController();

// Mahasiswa Controller
$mahasiswaController = new MahasiswaController();

switch ($action) {
    // Auth Routes
    case 'login':
        $authController->showLogin();
        break;
    
    case 'processlogin':
        $authController->processLogin();
        break;
    
    case 'logout':
        $authController->logout();
        break;
    
    case 'register':
        $authController->showRegister();
        break;
    
    case 'processregister':
        $authController->processRegister();
        break;
    
    // Mahasiswa Routes (Protected)
    case 'home':
        $mahasiswaController->Home();
        break;
    
    case 'list':
        $mahasiswaController->ListMahasiswa();
        break;
    
    case 'tambah':
        $mahasiswaController->FormTambah();
        break;
    
    case 'inputdata':
        $mahasiswaController->InputData();
        break;
    
    case 'edit':
        $mahasiswaController->FormEdit();
        break;
    
    case 'updatedata':
        $mahasiswaController->UpdateData();
        break;
    
    case 'hapus':
        $mahasiswaController->HapusData();
        break;
    
    default:
        // Jika user sudah login, tampilkan home
        if (isset($_SESSION['user_id'])) {
            $mahasiswaController->Home();
        } else {
            $authController->showLogin();
        }
        break;
}