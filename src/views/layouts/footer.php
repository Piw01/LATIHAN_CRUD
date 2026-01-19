</div> <!-- End Container -->

    <!-- Footer -->
    <footer class="text-center py-4" style="background: rgba(255, 255, 255, 0.1); color: white; margin-top: 50px;">
        <div class="container">
            <p class="mb-0">
                Sistem Manajemen Mahasiswa &copy; <?= date('Y') ?>
            </p>
            <p class="mb-0" style="font-size: 0.875rem; opacity: 0.8;">
                Dibuat dengan PHP & PDO
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto hide alert after 5 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);

        // Confirm delete
        function confirmDelete(nim, nama) {
            return confirm('Apakah Anda yakin ingin menghapus data mahasiswa:\n\nNIM: ' + nim + '\nNama: ' + nama + '\n\nData yang dihapus tidak dapat dikembalikan!');
        }
    </script>
</body>
</html>