<?php
// Włączenie ścisłego trybu typowania
declare(strict_types=1);
// Rozpoczęcie lub wznowienie sesji
session_start();
// Ustawienie wyświetlania błędów
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Zdefiniowanie ścieżki katalogu głównego aplikacji
define('_ROOT_PATH', dirname(__FILE__));
// Stała do sprawdzania poprawności uruchomienia aplikacji
define('APP_START', true);

// Ładowanie klas (modelu)
require_once _ROOT_PATH . '/src/Database.php';
require_once _ROOT_PATH . '/src/User.php';
require_once _ROOT_PATH . '/src/Book.php';
require_once _ROOT_PATH . '/src/UserRepository.php';
require_once _ROOT_PATH . '/src/BookRepository.php';
require_once _ROOT_PATH . '/src/BorrowRepository.php';

// Sprawdzenie czy użytkownik jest zalogowany
$isLoggedIn = isset($_SESSION['user_id']);

// Lista akcji dla niezalogowanych użytkowników
$actionsGuest = ['login'];

// Lista akcji dla administratorów
$actionsAdmin = ['users', 'add_user', 'edit_user', 'delete_user', 'user_books', 'add_book', 'edit_book', 'delete_book', 'book_borrowers', 'books', 'borrow_book', 'borrowed_books', 'return_book', 'logout'];

// Lista akcji dla czytelników
$actionsReader = ['books', 'borrow_book', 'borrowed_books', 'return_book', 'logout'];

// Ustalenie domyślnej akcji i dozwolonych akcji
if ($isLoggedIn) {
    $isAdmin = isset($_SESSION['user_permission']) && $_SESSION['user_permission'] === 'admin';
    $action = $isAdmin ? 'users' : 'books';
    $allowedActions = $isAdmin ? $actionsAdmin : $actionsReader;
} else {
    $action = 'login';
    $allowedActions = $actionsGuest;
}

// Pobranie parametru 'action' z adresu URL
if (isset($_GET['action']) && in_array($_GET['action'], $allowedActions, true)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['action'])) {
    // Jeśli akcja nie jest dozwolona, przekierowuje
    if ($isLoggedIn) {
        $redirectAction = $isAdmin ? 'users' : 'books';
        header('Location: index.php?action=' . $redirectAction);
    } else {
        header('Location: index.php?action=login');
    }
    exit();
}

// Przekierowanie zalogowanego użytkownika z login do books
if ($isLoggedIn && $action === 'login') {
    header('Location: index.php?action=books');
    exit();
}

// Przekierowanie niezalogowanego użytkownika z chronionych stron
if (!$isLoggedIn && !in_array($action, $actionsGuest)) {
    header('Location: index.php?action=login');
    exit();
}

// Dołączenie pliku z logiką i odpowiadającego mu widoku
if (file_exists(_ROOT_PATH . '/actions/' . $action . '.php')) {
    include _ROOT_PATH . '/actions/' . $action . '.php';
}
if (file_exists(_ROOT_PATH . '/views/' . $action . '.php')) {
    include _ROOT_PATH . '/views/' . $action . '.php';
}
?>