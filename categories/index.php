<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM categories
        WHERE name LIKE ?
           OR description LIKE ?
        ORDER BY id DESC
    ");
    $keyword = "%$search%";
    $stmt->execute([$keyword, $keyword]);
} else {
    $stmt = $pdo->query('SELECT * FROM categories ORDER BY id DESC');
}

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalCategories = count($categories);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css?v=2">
</head>
<body class="dashboard-page">
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../books/index.php">AnggepAjaPerpustakaan</a>
        <div class="d-flex align-items-center gap-2 text-white small">
            <span>Login sebagai <strong><?= e($_SESSION['user']['name']) ?></strong></span>
            <a href="../auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard Data Kategori</h1>
            <p class="text-muted mb-0">Kelola data kategori buku melalui fitur CRUD.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="../books/index.php" class="btn btn-outline-secondary">Data Buku</a>
            <a href="create.php" class="btn btn-primary">+ Tambah Kategori</a>
        </div>
    </div>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success">
            <?php
            $messages = [
                'created' => 'Data kategori berhasil ditambahkan.',
                'updated' => 'Data kategori berhasil diperbarui.',
                'deleted' => 'Data kategori berhasil dihapus.'
            ];
            echo e($messages[$_GET['message']] ?? 'Operasi berhasil.');
            ?>
        </div>
    <?php endif; ?>

    <div class="row g-3 mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm stat-card h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Kategori</p>
                    <h2 class="fw-bold mb-0"><?= $totalCategories ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                <h5 class="mb-0 fw-bold">Daftar Kategori</h5>

                <form action="" method="GET" class="d-flex flex-column flex-sm-row gap-2">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama atau deskripsi kategori..."
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
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($totalCategories > 0): ?>
                            <?php foreach ($categories as $index => $category): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td class="fw-semibold"><?= e($category['name']) ?></td>
                                    <td><?= e($category['description']) ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Tidak ada data kategori yang sesuai.
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