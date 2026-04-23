<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/helpers.php';

no_cache();

if (!isset($_SESSION['user'])) {
    redirect('index.php');
}

$timeout = 1800; // 30 menit

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    redirect('index.php?expired=1');
}

$_SESSION['last_activity'] = time();