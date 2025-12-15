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
require_once _ROOT_PATH . '/src/User.php';
require_once _ROOT_PATH . '/src/Note.php';
require_once _ROOT_PATH . '/src/NoteRepository.php';

// Lista dozwolonych akcji dla niezalogowanych
$actionsGuest = ['login', 'table'];
// Lista dozwolonych akcji dla zalogowanych
$actionsUser = ['home', 'table', 'date', 'logout'];

// Sprawdzenie czy użytkownik jest zalogowany (wg wymagań sprawdzamy user_login)
$isLoggedIn = isset($_SESSION['user_login']);

// Ustalenie domyślnej akcji
if ($isLoggedIn) {
    $action = 'home';
    $allowedActions = $actionsUser;
} else {
    $action = 'login';
    $allowedActions = $actionsGuest;
}

// Pobranie parametru 'action' z adresu URL
if (isset($_GET['action']) && in_array($_GET['action'], $allowedActions, true)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['action'])) {
    // Jeśli akcja nie jest dozwolona, przekieruj
    if ($isLoggedIn) {
        header('Location: index.php?action=home');
    } else {
        header('Location: index.php?action=login');
    }
    exit();
}

// Przekierowanie zalogowanego użytkownika z login do home
if ($isLoggedIn && $action === 'login') {
    header('Location: index.php?action=home');
    exit();
}

// Przekierowanie niezalogowanego użytkownika z chronionych stron
if (!$isLoggedIn && in_array($action, ['home', 'date', 'logout'])) {
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