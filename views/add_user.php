<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj użytkownika</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=users">Użytkownicy</a></li>
                <li><a href="index.php?action=books">Książki</a></li>
                <li><a href="index.php?action=add_user" class="wider-nav-btn">Dodaj użytkownika</a></li>
                <li><a href="index.php?action=add_book">Dodaj książkę</a></li>
                <li><a href="index.php?action=logout">Wyloguj</a></li>
            </ul>
        </nav>
        <div class="user-info">Zalogowany: <?= htmlspecialchars($_SESSION['user_fullname']) ?></div>
    </header>

    <main class="container">
        <h1 class="register-title">Dodaj użytkownika</h1>
        <form method="POST" action="index.php?action=add_user" class="register-form">
            <?php if (!empty($addError)): ?>
                <div class="error-message"><?= htmlspecialchars($addError) ?></div>
            <?php endif; ?>

            <?php if (!empty($addSuccess)): ?>
                <div class="result-message"><?= htmlspecialchars($addSuccess) ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Nazwisko:</label>
                <input type="text" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="age">Wiek:</label>
                <input type="text" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="permission">Uprawnienia:</label>
                <select id="permission" name="permission" required>
                    <option value="reader">czytelnik</option>
                    <option value="admin">administrator</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="submit-btn" value="Dodaj użytkownika">
            </div>
        </form>
        <aside class="advertisement">
            <img src="reklama.png" alt="Reklama">
        </aside>
    </main>

    <footer>
        <p>&copy; Footer</p>
    </footer>
</body>

</html>