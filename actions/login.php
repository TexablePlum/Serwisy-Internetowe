<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

$loginError = ''; // Komunikat o błędzie

// Obsługa formularza logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie i oczyszczenie danych z formularza
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Walidacja - sprawdzenie czy pola nie są puste
    if (empty($login) || empty($password)) {
        $loginError = 'Proszę wypełnić wszystkie pola.';
    }
    // Sprawdzenie poprawności danych logowania
    elseif ($login === VALID_LOGIN && $password === VALID_PASSWORD) {
        // Zalogowanie użytkownika
        $_SESSION['user_logged'] = true;
        $_SESSION['user_fullName'] = $login;
        
        // Przekierowanie do strony głównej
        header('Location: index.php?action=home');
        exit();
    } else {
        $loginError = 'Nieprawidłowy login lub hasło.';
    }
}
?>
