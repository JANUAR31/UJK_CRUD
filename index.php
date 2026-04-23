<?php
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/config/helpers.php';

if (isset($_SESSION['user'])) {
    redirect('books/index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Aplikasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg overflow-hidden auth-card">
                    <div class="row g-0">
                        <div class="col-md-6 auth-side-left text-white position-relative overflow-hidden">
                            <div class="d-flex align-items-center justify-content-center text-center h-100 p-5 position-relative" style="z-index: 2;">
                                <div style="max-width: 420px;">
                                    <span class="badge rounded-pill bg-light text-primary px-3 py-2 mb-3 shadow-sm">
                                        AnggepAjaPerpustakaan
                                    </span>

                                    <h1 class="fw-bold mb-3" style="font-size: 2.3rem; line-height: 1.2;">
                                        Aplikasi Manajemen <br> Buku Perpustakaan
                                    </h1>

                                    <div class="mx-auto mb-4 rounded-pill bg-white" style="width: 90px; height: 4px; opacity: 0.9;"></div>

                                    <p class="mb-0 opacity-75 fs-6">
                                        Login admin untuk mengelola data buku secara aman, rapi, dan terstruktur.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 bg-white p-4 p-md-5 d-flex align-items-center">
                            <div class="w-100">
                                <div class="mb-4">
                                    <h2 class="fw-bold mb-1">Masuk</h2>
                                    <p class="text-muted mb-0">Silakan login untuk mengakses dashboard.</p>
                                </div>

                                <?php if (isset($_GET['success'])): ?>
                                    <div class="alert alert-success">Registrasi berhasil. Silakan login menggunakan akun Anda.</div>
                                <?php endif; ?>

                                <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger">Email atau password salah.</div>
                                <?php endif; ?>

                                <?php if (isset($_GET['expired'])): ?>
                                    <div class="alert alert-warning">Session telah berakhir. Silakan login kembali.</div>
                                <?php endif; ?>

                                <form action="auth/login_process.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="Masukkan email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Password</label>
                                        <input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="Masukkan password" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                        Login
                                    </button>
                                </form>

                                <p class="mt-4 mb-0 text-muted">
                                    Belum punya akun?
                                    <a href="auth/register.php" class="fw-semibold text-decoration-none">Daftar di sini</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>