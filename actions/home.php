<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Pobranie danych użytkownika z sesji
$userLogin = $_SESSION['user_login'] ?? '';
$userName = $_SESSION['user_fullname'] ?? 'Użytkownik';

// Inicjalizacja repozytorium (plik w katalogu data/)
$noteRepo = new NoteRepository(_ROOT_PATH . '/data/notes.csv');
$message = '';

// Obsługa dodawania notatki
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_note'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($title && $content) {
        // Tworzymy nową notatkę (id=null, bo nada je repozytorium)
        $newNote = new Note(null, $userLogin, $title, $content);
        $noteRepo->add($newNote);
        
        // Przekierowanie, aby uniknąć ponownego wysłania formularza (PRG)
        header('Location: index.php?action=home');
        exit();
    } else {
        $message = 'Wypełnij tytuł i treść notatki.';
    }
}

// Pobranie listy notatek dla zalogowanego użytkownika
$userNotes = $noteRepo->findByUser($userLogin);
?>