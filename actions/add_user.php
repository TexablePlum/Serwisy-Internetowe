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

// Obsługa formularza dodawania użytkownika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $age = isset($_POST['age']) ? (int) $_POST['age'] : 0;
    $permission = isset($_POST['permission']) ? $_POST['permission'] : 'reader';

    // Walidacja
    if (empty($name) || empty($surname) || empty($login) || $age <= 0) {
        $addError = 'Proszę wypełnić wszystkie pola poprawnie.';
    } elseif (!in_array($permission, ['reader', 'admin'])) {
        $addError = 'Nieprawidłowe uprawnienia.';
    } else {
        $userRepo = new UserRepository();

        // Sprawdzenie czy login już istnieje
        if ($userRepo->getUserByLogin($login)) {
            $addError = 'Użytkownik o tym loginie już istnieje.';
        } else {
            $data = [
                'name' => $name,
                'surname' => $surname,
                'login' => $login,
                'age' => $age,
                'permission' => $permission
            ];

            // Dodanie użytkownika do bazy
            if ($userRepo->addUser($data)) {
                $addSuccess = 'Użytkownik został dodany pomyślnie.';
            } else {
                $addError = 'Błąd podczas dodawania użytkownika.';
            }
        }
    }
}
?>