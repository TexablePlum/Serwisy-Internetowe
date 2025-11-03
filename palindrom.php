<?php
// Funkcje pomocnicze

/**
 * Sprawdza czy tekst jest palindromem
 */
function czyPalindrom($tekst) {
    // Lista znaków do zignorowania
    $znaki_specjalne = ['.', ',', '!', '?', ':', ';', '-', '_', '"', '\'', 
                        '(', ')', '[', ']', '{', '}', '<', '>', '/', '\\', 
                        '|', '@', '#', '$', '%', '^', '&', '*', '~', '`', '+', '='];
    
    // Czyszczenie tekstu
    $oczyszczony = str_replace($znaki_specjalne, '', $tekst);
    $oczyszczony = strtolower(str_replace(' ', '', $oczyszczony));
    
    // Porównanie z odwróconą wersją
    return $oczyszczony === strrev($oczyszczony);
}

// Obługa formularza
$wynik = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tekst']) && $_POST['tekst'] !== '') {
    $tekst = $_POST['tekst'];
    $tekst_bezpieczny = htmlspecialchars($tekst);
    
    if (czyPalindrom($tekst)) {
        $wynik = "<div class='result-message'>Tekst '<strong>$tekst_bezpieczny</strong>' <strong>jest</strong> palindromem.</div>";
    } else {
        $wynik = "<div class='result-message'>Tekst '<strong>$tekst_bezpieczny</strong>' <strong>nie jest</strong> palindromem.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprawdzanie Palindromu</title>
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
        <h1 class="page-title">Sprawdzanie Palindromu</h1>
        
        <div class="form-wrapper">
            <form method="POST">
                <div class="form-group">
                    <label for="tekst">Wprowadź tekst:</label>
                    <input type="text" id="tekst" name="tekst" placeholder="Np. Kajak" required>
                </div>
                
                <button type="submit" class="submit-btn">Sprawdź</button>
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