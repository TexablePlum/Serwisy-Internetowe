<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj książkę</title>
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
        <h1 class="register-title">Edytuj książkę</h1>
        <form method="POST" action="index.php?action=edit_book&id=<?= $book->getId() ?>" class="register-form">
            <?php if (!empty($editError)): ?>
                <div class="error-message"><?= htmlspecialchars($editError) ?></div>
            <?php endif; ?>

            <?php if (!empty($editSuccess)): ?>
                <div class="result-message"><?= htmlspecialchars($editSuccess) ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Tytuł:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>" required>
            </div>
            <div class="form-group">
                <label for="authors">Autorzy:</label>
                <input type="text" id="authors" name="authors" value="<?= htmlspecialchars($book->getAuthors()) ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="number">Liczba egzemplarzy:</label>
                <input type="text" id="number" name="number" value="<?= $book->getNumber() ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" class="submit-btn" value="Zaktualizuj książkę">
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