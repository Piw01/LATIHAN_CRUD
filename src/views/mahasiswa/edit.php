<?php
// src/view/mahasiswa/edit.php
include __DIR__ . '/../layouts/header.php';
?>

<div class="content-card">
    <div class="mb-4">
        <h2 class="page-title">
            <i class="fas fa-edit"></i>
            Edit Data Mahasiswa
        </h2>
        <p class="page-subtitle">Perbarui informasi mahasiswa</p>
    </div>

    <!-- Info Card -->
    <div style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); padding: 20px; border-radius: 10px; margin-bottom: 30px; border-left: 5px solid #667eea;">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle" style="font-size: 2rem; color: #667eea; margin-right: 15px;"></i>
            <div>
                <strong style="color: #333;">Sedang mengedit data mahasiswa:</strong><br>
                <span style="color: #667eea; font-weight: 600;"><?= htmlspecialchars($mahasiswa['nama']) ?></span>
                <span style="color: #999;"> (NIM: <?= htmlspecialchars($mahasiswa['nim']) ?>)</span>
            </div>
        </div>
    </div>

    <form action="index.php?action=updatedata" method="POST" id="formEdit">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="nim" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-id-card" style="color: #667eea;"></i> NIM
                    </label>
                    <input type="text" class="form-control" id="nim" name="nim" 
                           value="<?= htmlspecialchars($mahasiswa['nim']) ?>" 
                           readonly style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px; background-color: #f8f9fa;">
                    <small class="text-muted">
                        <i class="fas fa-lock"></i> NIM tidak dapat diubah
                    </small>
                </div>

                <div class="mb-4">
                    <label for="nama" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-user" style="color: #667eea;"></i> Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                           value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-4">
                    <label for="tempat_lahir" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-map-marker-alt" style="color: #667eea;"></i> Tempat Lahir <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                           value="<?= htmlspecialchars($mahasiswa['tempat_lahir']) ?>" required
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Masukkan tempat lahir">
                </div>

                <div class="mb-4">
                    <label for="tanggal_lahir" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-calendar" style="color: #667eea;"></i> Tanggal Lahir <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                           value="<?= htmlspecialchars($mahasiswa['tanggal_lahir']) ?>" required
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
                        <option value="Laki-Laki" <?= $mahasiswa['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= $mahasiswa['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="telepon" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-phone" style="color: #667eea;"></i> Telepon
                    </label>
                    <input type="text" class="form-control" id="telepon" name="telepon"
                           value="<?= htmlspecialchars($mahasiswa['telepon'] ?? '') ?>"
                           style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                           placeholder="Contoh: 081234567890" maxlength="13">
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label" style="font-weight: 600; color: #333;">
                        <i class="fas fa-home" style="color: #667eea;"></i> Alamat
                    </label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="5"
                              style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px;"
                              placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($mahasiswa['alamat'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-top: 20px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-exclamation-triangle" style="color: #f5576c; margin-right: 10px;"></i>
                    <span style="color: #666;">Pastikan perubahan data sudah benar sebelum menyimpan</span>
                </div>
                <div>
                    <a href="index.php?action=list" class="btn btn-secondary" style="border-radius: 25px; padding: 10px 25px; margin-right: 10px;">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fas fa-check"></i> Simpan Perubahan
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
    document.getElementById('formEdit').addEventListener('submit', function(e) {
        const nama = document.getElementById('nama').value;
        const tempat_lahir = document.getElementById('tempat_lahir').value;
        const tanggal_lahir = document.getElementById('tanggal_lahir').value;
        const jenis_kelamin = document.getElementById('jenis_kelamin').value;

        if (!nama || !tempat_lahir || !tanggal_lahir || !jenis_kelamin) {
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

        // Konfirmasi sebelum update
        if (!confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?')) {
            e.preventDefault();
            return false;
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>