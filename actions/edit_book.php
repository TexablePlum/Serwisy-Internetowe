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

// Zmienne dla komunikatów i danych książki
$editError = '';
$editSuccess = '';
$book = null;

$bookRepo = new BookRepository();

// Pobranie ID książki z parametru GET
$bookId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($bookId > 0) {
    $book = $bookRepo->getBookById($bookId);
}

// Jeśli książka nie istnieje, przekieruj do listy książek
if (!$book) {
    header('Location: index.php?action=books');
    exit();
}

// Obsługa formularza edycji książki
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $authors = isset($_POST['authors']) ? trim($_POST['authors']) : '';
    $number = isset($_POST['number']) ? (int) $_POST['number'] : 0;

    // Walidacja
    if (empty($title) || empty($authors) || $number < 0) {
        $editError = 'Proszę wypełnić wszystkie pola poprawnie.';
    } else {
        $data = [
            'title' => $title,
            'authors' => $authors,
            'number' => $number
        ];

        // Aktualizacja książki w bazie
        if ($bookRepo->updateBook($bookId, $data)) {
            $editSuccess = 'Książka została zaktualizowana pomyślnie.';
            // Odświeżenie danych książki
            $book = $bookRepo->getBookById($bookId);
        } else {
            $editError = 'Błąd podczas aktualizacji książki.';
        }
    }
}
?>