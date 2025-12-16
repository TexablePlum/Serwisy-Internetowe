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

if ($bookId > 0) {
    $bookRepo = new BookRepository();
    $borrowRepo = new BorrowRepository();

    // Sprawdzenie czy książka jest wypożyczona
    if ($borrowRepo->isBookBorrowed($bookId)) {
        $_SESSION['delete_error'] = 'Nie można usunąć książki, która jest aktualnie wypożyczona.';
    } else {
        // Usunięcie książki z bazy
        if ($bookRepo->deleteBook($bookId)) {
            $_SESSION['delete_success'] = 'Książka została usunięta pomyślnie.';
        } else {
            $_SESSION['delete_error'] = 'Błąd podczas usuwania książki.';
        }
    }
}

header('Location: index.php?action=books');
exit();
?>