<?php
// Sprawdzenie, czy aplikacja została poprawnie uruchomiona
if (!defined('APP_START')) {
    header('Location: index.php');
    exit();
}

// Pobranie nazwy użytkownika z sesji (poprawiony klucz 'user_fullname')
$userName = isset($_SESSION['user_fullname']) ? $_SESSION['user_fullname'] : 'Użytkownik';

// Funkcje pomocnicze

/**
 * Sprawdza czy rok jest przestępny
 */
function czyPrzestepny($rok) {
    if ($rok % 400 == 0) return true;
    if ($rok % 100 == 0) return false;
    if ($rok % 4 == 0) return true;
    return false;
}

/**
 * Zwraca liczbę dni w danym miesiącu
 */
function dniWMiesiacu($miesiac, $rok) {
    $dni = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    
    if ($miesiac == 2 && czyPrzestepny($rok)) {
        return 29;
    }
    
    return $dni[$miesiac];
}

/**
 * Oblicza liczbę dni od początku kalendarza do podanej daty
 */
function obliczDniOdPoczatku($dzien, $miesiac, $rok) {
    $suma_dni = 0;
    
    // Zlicza dni we wszystkich pełnych latach
    for ($r = 1; $r < $rok; $r++) {
        $suma_dni += czyPrzestepny($r) ? 366 : 365;
    }
    
    // Zlicza dni we wszystkich pełnych miesiącach
    for ($m = 1; $m < $miesiac; $m++) {
        $suma_dni += dniWMiesiacu($m, $rok);
    }
    
    // Dodaje pozostałe dni
    $suma_dni += $dzien;
    
    return $suma_dni;
}

/**
 * Oblicza różnicę dni między dwiema datami
 */
function obliczRoznice($data_string) {
    // Parsuje datę z formatu YYYY-MM-DD
    $rok = (int)substr($data_string, 0, 4);
    $miesiac = (int)substr($data_string, 5, 2);
    $dzien = (int)substr($data_string, 8, 2);
    
    // Aktualna data
    $dzis = date("Y-m-d");
    $rok_dzis = (int)substr($dzis, 0, 4);
    $miesiac_dzis = (int)substr($dzis, 5, 2);
    $dzien_dzis = (int)substr($dzis, 8, 2);
    
    // Oblicza różnicę
    $dni_data = obliczDniOdPoczatku($dzien, $miesiac, $rok);
    $dni_dzisiaj = obliczDniOdPoczatku($dzien_dzis, $miesiac_dzis, $rok_dzis);
    
    return $dni_data - $dni_dzisiaj;
}

/**
 * Formatuje datę z YYYY-MM-DD do DD.MM.RRRR
 */
function formatujDate($data) {
    $dzien = substr($data, 8, 2);
    $miesiac = substr($data, 5, 2);
    $rok = substr($data, 0, 4);
    return "$dzien.$miesiac.$rok";
}

// Obsługa formularza
$wynik = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data']) && $_POST['data'] !== '') {
    $data = $_POST['data'];
    $roznica = obliczRoznice($data);
    $data_wyswietl = formatujDate($data);
    
    if ($roznica > 0) {
        $wynik = "<div class='result-message'>Do daty <strong>$data_wyswietl</strong> pozostało <strong>$roznica dni</strong>.</div>";
    } elseif ($roznica < 0) {
        $roznica_abs = abs($roznica);
        $wynik = "<div class='result-message'>Od daty <strong>$data_wyswietl</strong> minęło <strong>$roznica_abs dni</strong>.</div>";
    } else {
        $wynik = "<div class='result-message'>Podana data to <strong>dzisiaj</strong>!</div>";
    }
}
?>