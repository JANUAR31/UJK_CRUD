<?php
function base_url(string $path = ''): string
{
    $base = '/php_mysql_perpustakaan';
    return $base . ($path ? '/' . ltrim($path, '/') : '');
}

function redirect(string $path): void
{
    header('Location: ' . base_url($path));
    exit;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function no_cache(): void
{
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: no-cache, private", false);
    header("Pragma: no-cache");
    header("Expires: 0");
}