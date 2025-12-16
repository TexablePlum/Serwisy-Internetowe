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

// Pobranie wszystkich książek z bazy
$bookRepo = new BookRepository();
$books = $bookRepo->getAllBooks();

// Pobiera komunikat z sesji
$borrowSuccess = isset($_SESSION['borrow_success']) ? $_SESSION['borrow_success'] : '';
unset($_SESSION['borrow_success']);

$deleteSuccess = isset($_SESSION['delete_success']) ? $_SESSION['delete_success'] : '';
unset($_SESSION['delete_success']);

$deleteError = isset($_SESSION['delete_error']) ? $_SESSION['delete_error'] : '';
unset($_SESSION['delete_error']);
?>