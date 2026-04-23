<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$publisher = trim($_POST['publisher'] ?? '');
$yearPublished = (int) ($_POST['year_published'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);

if ($title === '' || $author === '' || $publisher === '' || $yearPublished <= 0 || $stock < 0) {
    redirect('books/create.php');
}

$stmt = $pdo->prepare('
    INSERT INTO books (title, author, publisher, year_published, stock)
    VALUES (?, ?, ?, ?, ?)
');
$stmt->execute([$title, $author, $publisher, $yearPublished, $stock]);

redirect('books/index.php?message=created');