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

// Zmienne dla komunikatów
$addError = '';
$addSuccess = '';

// Obsługa formularza dodawania książki
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $authors = isset($_POST['authors']) ? trim($_POST['authors']) : '';
    $number = isset($_POST['number']) ? (int) $_POST['number'] : 0;

    // Walidacja
    if (empty($title) || empty($authors) || $number <= 0) {
        $addError = 'Proszę wypełnić wszystkie pola poprawnie.';
    } else {
        $bookRepo = new BookRepository();

        // Przygotowanie danych do zapisu
        $data = [
            'title' => $title,
            'authors' => $authors,
            'number' => $number
        ];

        // Dodanie książki do bazy danych
        if ($bookRepo->addBook($data)) {
            $addSuccess = 'Książka została dodana pomyślnie.';
        } else {
            $addError = 'Błąd podczas dodawania książki.';
        }
    }
}
?>