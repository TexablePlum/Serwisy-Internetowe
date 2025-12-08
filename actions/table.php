<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Sprawdzenie czy użytkownik jest zalogowany
$isLoggedIn = isset($_SESSION['user_logged']) && $_SESSION['user_logged'] === true;
$userName = isset($_SESSION['user_fullName']) ? $_SESSION['user_fullName'] : '';
?>
