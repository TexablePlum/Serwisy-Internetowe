<?php
// Funkcje pomocnicze

/**
 * Sprawdza czy wartość jest liczbą całkowitą
 */
function czyLiczbaCalkowita($wartosc) {
    return is_numeric($wartosc) && floor($wartosc) == $wartosc;
}

/**
 * Wykonuje operację matematyczną
 */
function wykonajOperacje($liczba1, $liczba2, $operacja) {
    switch($operacja) {
        case 'dodawanie':
            return $liczba1 + $liczba2;
        case 'odejmowanie':
            return $liczba1 - $liczba2;
        case 'mnozenie':
            return $liczba1 * $liczba2;
        default:
            return null;
    }
}

/**
 * Zwraca symbol operacji
 */
function symbolOperacji($operacja) {
    $symbole = [
        'dodawanie' => '+',
        'odejmowanie' => '-',
        'mnozenie' => '×'
    ];
    return $symbole[$operacja] ?? '?';
}

// Obługa formularza
$wynik = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdza czy wszystkie pola zostały wypełnione
    if (!isset($_POST['liczba1']) || !isset($_POST['liczba2']) || !isset($_POST['operacja'])) {
        $wynik = "<div class='result-message error'><strong>Błąd:</strong> Wszystkie pola są wymagane!</div>";
    } elseif ($_POST['liczba1'] === '' || $_POST['liczba2'] === '') {
        $wynik = "<div class='result-message error'><strong>Błąd:</strong> Oba pola muszą być wypełnione!</div>";
    } elseif (!czyLiczbaCalkowita($_POST['liczba1']) || !czyLiczbaCalkowita($_POST['liczba2'])) {
        $wynik = "<div class='result-message error'><strong>Błąd:</strong> Proszę wpisać tylko liczby całkowite!</div>";
    } else {
        $liczba1 = (int)$_POST['liczba1'];
        $liczba2 = (int)$_POST['liczba2'];
        $operacja = $_POST['operacja'];
        
        $rezultat = wykonajOperacje($liczba1, $liczba2, $operacja);
        $symbol = symbolOperacji($operacja);
        
        $wynik = "<div class='result-message'><strong>$liczba1 $symbol $liczba2 = $rezultat</strong></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Data</a></li>
                <li><a href="palindrom.php">Palindrom</a></li>
                <li><a href="kalkulator.php">Kalkulator</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1 class="page-title">Kalkulator</h1>
        
        <div class="form-wrapper">
            <form method="POST">
                <div class="form-group">
                    <label for="liczba1">Pierwsza liczba:</label>
                    <input type="number" id="liczba1" name="liczba1" step="1" required>
                    
                    <label for="liczba2">Druga liczba:</label>
                    <input type="number" id="liczba2" name="liczba2" step="1" required>
                    
                    <label for="operacja">Operacja:</label>
                    <select id="operacja" name="operacja" required>
                        <option value="dodawanie">Dodawanie</option>
                        <option value="odejmowanie">Odejmowanie</option>
                        <option value="mnozenie">Mnożenie</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Oblicz</button>
            </form>
            
            <?php echo $wynik; ?>
        </div>

        <aside class="advertisement">
            <img src="reklama.png" alt="Reklama">
        </aside>
    </main>

    <footer>
        <p>&copy; Footer</p>
    </footer>
</body>
</html>