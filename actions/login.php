<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

$loginError = '';

// Definicja użytkowników i ich haseł
$users = [
    'admin' => ['password' => 'admin123', 'fullName' => 'Administrator Systemu'],
    'anna' => ['password' => 'test123', 'fullName' => 'Anna Kowalska'],
    'jan' => ['password' => 'janek', 'fullName' => 'Jan Nowak'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (empty($login) || empty($password)) {
        $loginError = 'Proszę wypełnić wszystkie pola.';
    }
    // Sprawdzenie czy użytkownik istnieje w tablicy i hasło się zgadza
    elseif (array_key_exists($login, $users) && $users[$login]['password'] === $password) {
        
        // Zapisanie danych do sesji (wymagane nazwy kluczy)
        $_SESSION['user_login'] = $login;
        $_SESSION['user_fullname'] = $users[$login]['fullName'];
        
        header('Location: index.php?action=home');
        exit();
    } else {
        $loginError = 'Nieprawidłowy login lub hasło.';
    }
}
?>