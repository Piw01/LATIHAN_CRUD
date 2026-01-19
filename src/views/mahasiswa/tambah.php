<?php
// src/views/mahasiswa/tambah.php
include __DIR__ . '/../layouts/header.php';
?>

<div class="content-card">
    <div class="mb-4">
        <h2 class="page-title">
            <i class="fas fa-user-plus"></i>
            Tambah Data Mahasiswa
        </h2>
        <p class="page-subtitle">Isi form di bawah untuk menambahkan mahasiswa baru</p>
    </div>

    <form action="index.php?action=inputdata" method="POST" id="formTambah">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="nim" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-id-card" style="color: #667eea;"></i> NIM <span class="text-danger">*</span>
                    </label>
                    <input type="number" class="form-control" id="nim" name="nim" required 
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Masukkan NIM">
                </div>

                <div class="mb-4">
                    <label for="nama" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-user" style="color: #667eea;"></i> Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="nama" name="nama" required
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-4">
                    <label for="tempat_lahir" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-map-marker-alt" style="color: #667eea;"></i> Tempat Lahir <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Masukkan tempat lahir">
                </div>

                <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-calendar" style="color: #667eea;"></i> Tanggal Lahir <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="jenis_kelamin" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-venus-mars" style="color: #667eea;"></i> Jenis Kelamin <span class="text-danger">*</span>
                    </label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required
                            style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="telepon" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-phone" style="color: #667eea;"></i> Telepon
                    </label>
                    <input type="text" class="form-control" id="telepon" name="telepon"
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Contoh: 081234567890" maxlength="13">
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-home" style="color: #667eea;"></i> Alamat
                    </label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="5"
                              style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-top: 20px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-info-circle" style="color: #667eea; margin-right: 10px;"></i>
                    <span style="color: #666;">Field bertanda <span class="text-danger">*</span> wajib diisi</span>
                </div>
                <div>
                    <a href="index.php?action=list" class="btn btn-secondary" style="border-radius: 25px; padding: 10px 25px; margin-right: 10px;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-label {
        margin-bottom: 8px;
    }
</style>

<script>
    document.getElementById('formTambah').addEventListener('submit', function(e) {
        const nim = document.getElementById('nim').value;
        const nama = document.getElementById('nama').value;
        const tempat_lahir = document.getElementById('tempat_lahir').value;
        const tanggal_lahir = document.getElementById('tanggal_lahir').value;
        const jenis_kelamin = document.getElementById('jenis_kelamin').value;

        if (!nim || !nama || !tempat_lahir || !tanggal_lahir || !jenis_kelamin) {
            e.preventDefault();
            alert('Field yang bertanda * wajib diisi!');
            return false;
        }

        // Validasi telepon (hanya angka)
        const telepon = document.getElementById('telepon').value;
        if (telepon && !/^\d+$/.test(telepon)) {
            e.preventDefault();
            alert('Nomor telepon hanya boleh berisi angka!');
            return false;
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>