<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Wyczyszczenie wszystkich zmiennych w tablicy $_SESSION
session_unset();

// Zniszczenie sesji na serwerze
session_destroy();

// Przekierowanie użytkownika z powrotem do formularza logowania
header('Location: index.php?action=login');

// Natychmiastowe zatrzymanie wykonywania skryptu po wysłaniu nagłówka przekierowania
exit();
?>