<?php
// src/views/mahasiswa/list.php
include __DIR__ . '/../layouts/header.php';
include __DIR__ . '/../layouts/alert.php';
?>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title" style="color: #3f61fc;">
                <i class="fas fa-users"></i>
                Data Mahasiswa
            </h2>
            <p class="page-subtitle mb-0">Kelola semua data mahasiswa di sini</p>
        </div>
        <a href="index.php?action=tambah" class="btn btn-gradient">
            <i class="fas fa-plus-circle"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- Search Box -->
    <div class="mb-4">
        <div class="input-group" style="max-width: 400px;">
            <span class="input-group-text" style="background: linear-gradient(135deg, #3f61fc 0%, #3f61fc   100%); color: white; border: none;">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari mahasiswa..." style="border-left: none;">
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div style="background: linear-gradient(135deg, #3f61fc 0%, #3f61fc 100%); padding: 20px; border-radius: 15px; color: white;">
                <div class="d-flex align-items-center">
                    <div style="font-size: 3rem; margin-right: 20px;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h4 style="margin: 0; font-weight: 600;">Total Mahasiswa</h4>
                        <h2 style="margin: 5px 0 0 0; font-weight: 700;"><?= count($mahasiswa) ?> Orang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-hover" id="mahasiswaTable">
            <thead>
                <tr style="background: linear-gradient(135deg, #667eea 0%, #3f61fc 100%); color: white;">
                    <th style="border: none; padding: 15px;">No</th>
                    <th style="border: none; padding: 15px;">NIM</th>
                    <th style="border: none; padding: 15px;">Nama</th>
                    <th style="border: none; padding: 15px;">Tempat/Tgl Lahir</th>
                    <th style="border: none; padding: 15px;">Jenis Kelamin</th>
                    <th style="border: none; padding: 15px;">Telepon</th>
                    <th style="border: none; padding: 15px;">Alamat</th>
                    <th style="border: none; padding: 15px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($mahasiswa) > 0): ?>
                    <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
                    <tr style="transition: all 0.3s ease;">
                        <td style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;">
                            <span style="background: #3f61fc; color: white; padding: 5px 12px; border-radius: 15px; font-weight: 500;">
                                <?= htmlspecialchars($mhs['nim']) ?>
                            </span>
                        </td>
                        <td style="vertical-align: middle; font-weight: 500;"><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td style="vertical-align: middle;">
                            <span style="color: #3f61fc; font-weight: 500;">
                                <?= htmlspecialchars($mhs['tempat_lahir']) ?>
                            </span><br>
                            <small style="color: #999;">
                                <?= date('d/m/Y', strtotime($mhs['tanggal_lahir'])) ?>
                            </small>
                        </td>
                        <td style="vertical-align: middle;">
                            <?php 
                            $bgColor = strtolower($mhs['jenis_kelamin']) == 'laki-laki' ? '#3f61fc' : '#f093fb';
                            $icon = strtolower($mhs['jenis_kelamin']) == 'laki-laki' ? 'fa-mars' : 'fa-venus';
                            ?>
                            <span style="background: <?= $bgColor ?>; color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.875rem;">
                                <i class="fas <?= $icon ?>"></i> <?= htmlspecialchars($mhs['jenis_kelamin']) ?>
                            </span>
                        </td>
                        <td style="vertical-align: middle;">
                            <i class="fas fa-phone" style="color: #3f61fc;"></i>
                            <?= htmlspecialchars($mhs['telepon'] ?? '-') ?>
                        </td>
                        <td style="vertical-align: middle; max-width: 200px;">
                            <small><?= htmlspecialchars($mhs['alamat'] ?? '-') ?></small>
                        </td>
                        <td style="vertical-align: middle; text-align: center; white-space: nowrap;">
                            <a href="index.php?action=edit&nim=<?= $mhs['nim'] ?>" class="btn btn-edit btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?action=hapus&nim=<?= $mhs['nim'] ?>" 
                               class="btn btn-delete btn-sm"
                               onclick="return confirmDelete('<?= $mhs['nim'] ?>', '<?= htmlspecialchars($mhs['nama']) ?>')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 40px;">
                            <div style="color: #999;">
                                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                                <p style="margin: 0; font-size: 1.1rem;">Belum ada data mahasiswa</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    #mahasiswaTable tbody tr:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: scale(1.01);
    }
    
    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
    }
</style>

<script>
    // Simple search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#mahasiswaTable tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>