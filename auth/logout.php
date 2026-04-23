<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../config/helpers.php';

session_unset();
session_destroy();

no_cache();

redirect('index.php');