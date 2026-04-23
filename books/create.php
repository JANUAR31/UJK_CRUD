<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/helpers.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-page">
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">AnggepAjaPerpustakaan</a>
        <div class="d-flex align-items-center gap-2 text-white small">
            <span>Login sebagai <strong><?= e($_SESSION['user']['name']) ?></strong></span>
            <a href="../auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Tambah Data Buku</h1>
        <p class="text-muted mb-0">Isi form berikut untuk menambahkan buku baru ke sistem.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="store.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penulis</label>
                        <input type="text" name="author" class="form-control" placeholder="Masukkan nama penulis" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="publisher" class="form-control" placeholder="Masukkan nama penerbit" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="year_published" class="form-control" min="1900" max="2099" placeholder="Contoh: 2024" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stock" class="form-control" min="0" placeholder="Jumlah stok" required>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        window.location.reload();
    }
});

window.addEventListener('popstate', function () {
    window.location.reload();
});
</script>
</body>
</html>