<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Tylko dla zalogowanych użytkowników
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit();
}

// Pobranie wypożyczonych książek aktualnego użytkownika (zgrupowanych)
$borrowRepo = new BorrowRepository();
$borrowedBooks = $borrowRepo->getUserBorrowedBooks($_SESSION['user_id']);

// Pobranie komunikatu z sesji
$returnSuccess = isset($_SESSION['return_success']) ? $_SESSION['return_success'] : '';
unset($_SESSION['return_success']);
?>