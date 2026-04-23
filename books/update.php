<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$id = (int) ($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$publisher = trim($_POST['publisher'] ?? '');
$yearPublished = (int) ($_POST['year_published'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);

if ($id <= 0 || $title === '' || $author === '' || $publisher === '' || $yearPublished <= 0 || $stock < 0) {
    redirect('books/index.php');
}

$stmt = $pdo->prepare('
    UPDATE books
    SET title = ?, author = ?, publisher = ?, year_published = ?, stock = ?
    WHERE id = ?
');
$stmt->execute([$title, $author, $publisher, $yearPublished, $stock, $id]);

redirect('books/index.php?message=updated');