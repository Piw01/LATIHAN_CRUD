<?php
// src/views/auth/register.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Mahasiswa</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(240, 147, 251, 0.4);
        }

        .register-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .register-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .register-subtitle {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #f093fb;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #f093fb;
            box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.25);
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #f093fb;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(240, 147, 251, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(240, 147, 251, 0.6);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            animation: slideInDown 0.5s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .login-link a {
            color: #f093fb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-strength {
            height: 5px;
            background: #e0e0e0;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="register-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="register-title">Buat Akun Baru</h1>
                <p class="register-subtitle">Daftar untuk mengakses sistem</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form action="index.php?action=processregister" method="POST" id="registerForm">
                <div class="form-group">
                    <label for="nama_lengkap" class="form-label">
                        <i class="fas fa-user"></i> Nama Lengkap
                    </label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                           placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-at"></i> Username
                    </label>
                    <input type="text" class="form-control" id="username" name="username" 
                           placeholder="Pilih username" required>
                    <small class="text-muted">Username harus unik</small>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Buat password (min. 6 karakter)" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">
                        <i class="fas fa-lock"></i> Konfirmasi Password
                    </label>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                               placeholder="Ketik ulang password" required>
                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                <p>Sudah punya akun? <a href="index.php?action=login">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirm_password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Password strength indicator
        password.addEventListener('input', function() {
            const strength = this.value.length;
            const bar = document.getElementById('strengthBar');
            
            if (strength === 0) {
                bar.style.width = '0%';
            } else if (strength < 6) {
                bar.style.width = '33%';
                bar.style.backgroundColor = '#f5576c';
            } else if (strength < 10) {
                bar.style.width = '66%';
                bar.style.backgroundColor = '#ffa500';
            } else {
                bar.style.width = '100%';
                bar.style.backgroundColor = '#4caf50';
            }
        });

        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama_lengkap').value.trim();
            const username = document.getElementById('username').value.trim();
            const pass = document.getElementById('password').value;
            const confirmPass = document.getElementById('confirm_password').value;

            if (!nama || !username || !pass || !confirmPass) {
                e.preventDefault();
                alert('Semua field harus diisi!');
                return false;
            }

            if (pass.length < 3) {
                e.preventDefault();
                alert('Password minimal 3 karakter!');
                return false;
            }

            if (pass !== confirmPass) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak sama!');
                return false;
            }
        });
    </script>
</body>
</html>