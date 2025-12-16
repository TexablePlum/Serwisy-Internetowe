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

if ($userId > 0) {
    $userRepo = new UserRepository();
    $borrowRepo = new BorrowRepository();
    $bookRepo = new BookRepository();

    // Najpierw zwraca wszystkie książki tego użytkownika
    $borrowedBooks = $borrowRepo->getUserBorrowedBooks($userId);
    // Pętla zwracająca każdą książkę
    foreach ($borrowedBooks as $book) {
        $borrowRepo->returnBook($userId, $book->getId());
        $bookRepo->updateBookNumber($book->getId(), 1); // Zwiększa liczbę egzemplarzy
    }

    // Usuwa użytkownika
    if ($userRepo->deleteUser($userId)) {
        $_SESSION['delete_success'] = 'Użytkownik został usunięty pomyślnie.';
    } else {
        $_SESSION['delete_error'] = 'Nie można usunąć ostatniego administratora w systemie.';
    }
}

header('Location: index.php?action=users');
exit();
?>