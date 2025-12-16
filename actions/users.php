<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Tylko dla administratorów
if (!isset($_SESSION['user_permission']) || $_SESSION['user_permission'] !== 'admin') {
    header('Location: index.php?action=books');
    exit();
}

// Pobranie wszystkich użytkowników z bazy
$userRepo = new UserRepository();
$users = $userRepo->getAllUsers();

// Pobranie komunikatu z sesji
$editSuccess = isset($_SESSION['edit_success']) ? $_SESSION['edit_success'] : '';
unset($_SESSION['edit_success']);
?>