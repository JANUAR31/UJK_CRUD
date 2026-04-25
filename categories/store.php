<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$name = trim($_POST['name'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($name === '') {
    redirect('categories/create.php');
}

$stmt = $pdo->prepare('INSERT INTO categories (name, description) VALUES (?, ?)');
$stmt->execute([$name, $description]);

redirect('categories/index.php?message=created');
