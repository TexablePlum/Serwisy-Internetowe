<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Dat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=home">Home</a></li>
                <li><a href="index.php?action=table">Table</a></li>
                <li><a href="index.php?action=date">Date</a></li>
                <li><a href="index.php?action=logout">Logout</a></li>
            </ul>
        </nav>
        <div class="user-info">
            Zalogowany: <strong><?= htmlspecialchars($userName) ?></strong>
        </div>
    </header>

    <main class="container">
        <h1 class="register-title">Kalkulator Dat</h1>
        <div class="register-form">
            <form method="POST" action="index.php?action=date">
                <div class="form-group">
                    <label for="data">Wybierz datę:</label>
                    <input type="date" id="data" name="data" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="submit-btn" value="Oblicz różnicę">
                </div>
            </form>
            
            <?= $wynik ?>
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
