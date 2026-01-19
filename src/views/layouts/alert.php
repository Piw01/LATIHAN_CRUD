<?php
// src/view/layout/alert.php

if (isset($_SESSION['message']) && isset($_SESSION['type'])):
    $alertType = $_SESSION['type'] == 'success' ? 'success' : 'danger';
    $icon = $_SESSION['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    $bgGradient = $_SESSION['type'] == 'success' 
        ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' 
        : 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)';
?>

<div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert" 
     style="border: none; border-radius: 15px; background: <?= $bgGradient ?>; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 25px; animation: slideInDown 0.5s ease;">
    <div class="d-flex align-items-center">
        <i class="fas <?= $icon ?>" style="font-size: 1.5rem; margin-right: 15px;"></i>
        <div>
            <strong><?= $_SESSION['type'] == 'success' ? 'Berhasil!' : 'Gagal!' ?></strong>
            <p style="margin: 5px 0 0 0;"><?= $_SESSION['message'] ?></p>
        </div>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<style>
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
</style>

<?php
    // Hapus session message setelah ditampilkan
    unset($_SESSION['message']);
    unset($_SESSION['type']);
endif;
?>