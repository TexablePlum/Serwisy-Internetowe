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

// Zmienne dla komunikatów i danych użytkownika
$editError = '';
$editSuccess = '';
$user = null;

$userRepo = new UserRepository();

// Pobranie ID użytkownika z parametru GET
$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($userId > 0) {
    $user = $userRepo->getUserById($userId);
}

// Jeśli użytkownik nie istnieje, przekieruj do listy użytkowników
if (!$user) {
    header('Location: index.php?action=users');
    exit();
}

// Obsługa formularza edycji użytkownika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $age = isset($_POST['age']) ? (int) $_POST['age'] : 0;
    $permission = isset($_POST['permission']) ? $_POST['permission'] : 'reader';

    // Walidacja
    if (empty($name) || empty($surname) || empty($login) || $age <= 0) {
        $editError = 'Proszę wypełnić wszystkie pola poprawnie.';
    } elseif (!in_array($permission, ['reader', 'admin'])) {
        $editError = 'Nieprawidłowe uprawnienia.';
    } else {
        $data = [
            'name' => $name,
            'surname' => $surname,
            'login' => $login,
            'age' => $age,
            'permission' => $permission
        ];

        // Aktualizacja użytkownika i przekierowanie do listy
        if ($userRepo->updateUser($userId, $data)) {
            $_SESSION['edit_success'] = 'Użytkownik został zaktualizowany pomyślnie.';
            header('Location: index.php?action=users');
            exit();
        } else {
            $editError = 'Błąd podczas aktualizacji użytkownika.';
        }
    }
}
?>