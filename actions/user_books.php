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

// Pobranie ID użytkownika
$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$user = null;
$borrowedBooks = [];

if ($userId > 0) {
    $userRepo = new UserRepository();
    $borrowRepo = new BorrowRepository();

    // Pobranie danych użytkownika i jego wypożyczonych książek
    $user = $userRepo->getUserById($userId);
    if ($user) {
        $borrowedBooks = $borrowRepo->getUserBorrowedBooks($userId);
    }
}

if (!$user) {
    header('Location: index.php?action=users');
    exit();
}
?>