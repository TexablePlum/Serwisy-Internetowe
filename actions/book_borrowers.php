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

// Pobranie ID książki
$bookId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$book = null;
$borrowers = [];

if ($bookId > 0) {
    $bookRepo = new BookRepository();
    $borrowRepo = new BorrowRepository();

    // Pobranie książki i listy użytkowników, którzy ją wypożyczyli
    $book = $bookRepo->getBookById($bookId);
    if ($book) {
        $borrowers = $borrowRepo->getBookBorrowers($bookId);
    }
}

if (!$book) {
    header('Location: index.php?action=books');
    exit();
}
?>