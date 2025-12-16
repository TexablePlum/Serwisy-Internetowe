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

// Tylko czytelnicy mogą wypożyczać książki
if (!isset($_SESSION['user_permission']) || $_SESSION['user_permission'] !== 'reader') {
    header('Location: index.php?action=books');
    exit();
}

// Pobranie ID książki z parametru GET
$bookId = isset($_GET['book_id']) ? (int) $_GET['book_id'] : 0;

if ($bookId > 0) {
    $bookRepo = new BookRepository();
    $borrowRepo = new BorrowRepository();

    // Pobranie książki z bazy
    $book = $bookRepo->getBookById($bookId);

    // Sprawdzenie czy książka istnieje i jest dostępna
    if ($book && $book->getNumber() > 0) {
        // Zmniejsza liczbę egzemplarzy
        $bookRepo->updateBookNumber($bookId, -1);

        // Dodaje wypożyczenie
        $borrowRepo->borrowBook($_SESSION['user_id'], $bookId);

        // Zapisanie komunikatu sukcesu w sesji
        $_SESSION['borrow_success'] = 'Książka "' . htmlspecialchars($book->getTitle()) . '" została wypożyczona.';
    }
}

header('Location: index.php?action=books');
exit();
?>