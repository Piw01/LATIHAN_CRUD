<?php
// src/views/Home.php
include __DIR__ . '/layouts/header.php';
?>

<div class="content-card">
    <div class="text-center mb-4">
        <div style="font-size: 5rem; color: #3f61fc; margin-bottom: 2px;">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1 class="page-title justify-content-center">
            Selamat Datang di Sistem Manajemen Mahasiswa
        </h1>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 mx-auto text-center">
            <div style="background: #f1f1f1; padding: 30px; border-radius: 15px;">
                <a href="index.php?action=list" style="background-color: #3f61fc; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; display: inline-block;">
                    <i class="fas fa-arrow-right"></i> Lihat Data Mahasiswa
                </a>

                <p style="color: #666; margin-top: 25px; font-size: 1rem; ">
                    Kelola data mahasiswa Anda dengan mengklik tombol di atas.
                </p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/layouts/footer.php'; ?>