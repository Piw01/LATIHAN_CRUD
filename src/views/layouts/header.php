<?php
// src/views/layouts/header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #3f61fc 100%);
            min-height: 100vh;
            padding-bottom: 50px;
        }

        /* Navbar Styles */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #3f61fc !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 2rem;
        }

        .nav-link {
            color: #3f61fc !important;
            font-weight: 500;
            margin: 0 10px;
            padding: 8px 20px !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #234bff 100%);
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #234bff 100%);
            color: white !important;
        }

        /* Container */
        .main-container {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        /* Card Styles */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 30px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Page Title */
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title i {
            color: #1944ff;
        }

        .page-subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        /* Button Styles */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #234bff 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            color: white;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            border: none;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(250, 112, 154, 0.4);
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-graduation-cap"></i>
                <span>Latihan CRUD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= !isset($_GET['action']) || $_GET['action'] == 'home' ? 'active' : '' ?>" href="index.php">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['action']) && $_GET['action'] == 'list' ? 'active' : '' ?>" href="index.php?action=list">
                            <i class="fas fa-users"></i> Data Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <?= $_SESSION['nama_lengkap'] ?? 'User' ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container main-container">