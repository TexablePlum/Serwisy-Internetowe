<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($login) || empty($password)) {
        $loginError = 'Proszę wypełnić wszystkie pola.';
    } else {
        // Weryfikacja użytkownika przez repozytorium
        $userRepo = new UserRepository();
        $user = $userRepo->verifyPassword($login, $password);

        if ($user) {
            // Zapisanie danych do sesji
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_login'] = $user->getLogin();
            $_SESSION['user_fullname'] = $user->getFullName();
            $_SESSION['user_permission'] = $user->getPermission();

            // Przekierowanie do odpowiedniej strony w zależności od uprawnień
            $redirectAction = ($user->getPermission() === 'admin') ? 'users' : 'books';
            header('Location: index.php?action=' . $redirectAction);
            exit();
        } else {
            $loginError = 'Nieprawidłowy login lub hasło.';
        }
    }
}
?>