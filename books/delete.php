<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare('DELETE FROM books WHERE id = ?');
$stmt->execute([$id]);

redirect('books/index.php?message=deleted');
