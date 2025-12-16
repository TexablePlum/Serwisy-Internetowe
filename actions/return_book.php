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

// Pobranie ID książki
$bookId = isset($_GET['book_id']) ? (int) $_GET['book_id'] : 0;

if ($bookId > 0) {
    $bookRepo = new BookRepository();
    $borrowRepo = new BorrowRepository();

    // Pobranie książki z bazy
    $book = $bookRepo->getBookById($bookId);

    if ($book) {
        // Zwiększa liczbę egzemplarzy
        $bookRepo->updateBookNumber($bookId, 1);

        // Usuwa wypożyczenie
        $borrowRepo->returnBook($_SESSION['user_id'], $bookId);

        // Zapisanie komunikatu sukcesu w sesji
        $_SESSION['return_success'] = 'Książka "' . htmlspecialchars($book->getTitle()) . '" została zwrócona.';
    }
}

header('Location: index.php?action=borrowed_books');
exit();
?>