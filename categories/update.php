<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$id = (int) ($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($id <= 0 || $name === '') {
    redirect('categories/index.php');
}

$stmt = $pdo->prepare('UPDATE categories SET name = ?, description = ? WHERE id = ?');
$stmt->execute([$name, $description, $id]);

redirect('categories/index.php?message=updated');
