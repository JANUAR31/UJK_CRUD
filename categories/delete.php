<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    redirect('categories/index.php');
}

$stmt = $pdo->prepare('DELETE FROM categories WHERE id = ?');
$stmt->execute([$id]);

redirect('categories/index.php?message=deleted');
