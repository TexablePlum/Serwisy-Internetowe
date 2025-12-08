<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
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
        <h1 class="register-title">Strona główna</h1>
        <div class="content-wrapper">
            <div class="welcome-message">
                <h2>Witaj, <?= htmlspecialchars($userName) ?>!</h2>
                <p>Zostałeś pomyślnie zalogowany do systemu.</p>
                <p>Wybierz jedną z opcji z menu nawigacyjnego, aby przejść do odpowiedniej sekcji.</p>
            </div>
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
