<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj użytkownika</title>
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
        <h1 class="register-title">Edytuj użytkownika</h1>
        <form method="POST" action="index.php?action=edit_user&id=<?= $user->getId() ?>" class="register-form">
            <?php if (!empty($editError)): ?>
                <div class="error-message"><?= htmlspecialchars($editError) ?></div>
            <?php endif; ?>

            <?php if (!empty($editSuccess)): ?>
                <div class="result-message"><?= htmlspecialchars($editSuccess) ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>
            </div>
            <div class="form-group">
                <label for="surname">Nazwisko:</label>
                <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user->getSurname()) ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="<?= htmlspecialchars($user->getLogin()) ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Wiek:</label>
                <input type="text" id="age" name="age" value="<?= $user->getAge() ?>" required>
            </div>
            <div class="form-group">
                <label for="permission">Uprawnienia:</label>
                <select id="permission" name="permission" required>
                    <option value="reader" <?= $user->getPermission() === 'reader' ? 'selected' : '' ?>>czytelnik</option>
                    <option value="admin" <?= $user->getPermission() === 'admin' ? 'selected' : '' ?>>administrator
                    </option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="submit-btn" value="Zaktualizuj użytkownika">
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