<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Pobranie nazwy użytkownika z sesji
$userName = isset($_SESSION['user_fullname']) ? $_SESSION['user_fullname'] : '';
?>