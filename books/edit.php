<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    redirect('books/index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
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
        <h1 class="h3 fw-bold mb-1">Edit Data Buku</h1>
        <p class="text-muted mb-0">Ubah informasi buku sesuai kebutuhan.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?= $book['id'] ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" name="title" class="form-control" value="<?= e($book['title']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penulis</label>
                        <input type="text" name="author" class="form-control" value="<?= e($book['author']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Penerbit</label>
                        <input type="text" name="publisher" class="form-control" value="<?= e($book['publisher']) ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Tahun Terbit</label>
                        <input type="number" name="year_published" class="form-control" min="1900" max="2099" value="<?= e((string) $book['year_published']) ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stock" class="form-control" min="0" value="<?= e((string) $book['stock']) ?>" required>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
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