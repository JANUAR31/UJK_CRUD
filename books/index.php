<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM books
        WHERE title LIKE ?
           OR author LIKE ?
           OR publisher LIKE ?
           OR year_published LIKE ?
        ORDER BY id DESC
    ");
    $keyword = "%$search%";
    $stmt->execute([$keyword, $keyword, $keyword, $keyword]);
} else {
    $stmt = $pdo->query('SELECT * FROM books ORDER BY id DESC');
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalBooks = count($books);
$totalStock = array_sum(array_column($books, 'stock'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="dashboard-page">
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">AnggepAjaPerpustakaan</a>
        <div class="d-flex align-items-center gap-2 text-white small">
            <span>Login sebagai <strong><?= e($_SESSION['user']['name']) ?></strong></span>
            <a href="../auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard Data Buku</h1>
        </div>
        <a href="create.php" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success">
            <?php
            $messages = [
                'created' => 'Data buku berhasil ditambahkan.',
                'updated' => 'Data buku berhasil diperbarui.',
                'deleted' => 'Data buku berhasil dihapus.'
            ];
            echo e($messages[$_GET['message']] ?? 'Operasi berhasil.');
            ?>
        </div>
    <?php endif; ?>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm stat-card h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Judul Buku</p>
                    <h2 class="fw-bold mb-0"><?= $totalBooks ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm stat-card h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Stok Buku</p>
                    <h2 class="fw-bold mb-0"><?= $totalStock ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                <h5 class="mb-0 fw-bold">Daftar Buku</h5>

                <form action="" method="GET" class="d-flex flex-column flex-sm-row gap-2">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul, penulis, penerbit, tahun..."
                        value="<?= e($search) ?>"
                    >
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                </form>
            </div>

            <?php if ($search !== ''): ?>
                <p class="text-muted small">
                    Hasil pencarian untuk: <strong><?= e($search) ?></strong>
                </p>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($totalBooks > 0): ?>
                            <?php foreach ($books as $index => $book): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="fw-semibold"><?= e($book['title']) ?></td>
                                    <td><?= e($book['author']) ?></td>
                                    <td><?= e($book['publisher']) ?></td>
                                    <td><?= e((string) $book['year_published']) ?></td>
                                    <td><span class="badge text-bg-primary"><?= e((string) $book['stock']) ?></span></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Tidak ada data buku yang sesuai dengan pencarian.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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