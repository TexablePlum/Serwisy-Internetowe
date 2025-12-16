<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki użytkownika</title>
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
        <h1 class="register-title">Książki wypożyczone przez: <?= htmlspecialchars($user->getFullName()) ?></h1>

        <div style="margin-left: 100px; margin-top: 20px; padding-right: 270px;">
            <?php if (empty($borrowedBooks)): ?>
                <p>Użytkownik nie ma żadnych wypożyczonych książek.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lp.</th>
                            <th>Tytuł</th>
                            <th>Autorzy</th>
                            <th>Liczba egzemplarzy</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($borrowedBooks as $index => $book): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                                <td><?= htmlspecialchars($book->getAuthors()) ?></td>
                                <td><?= $book->getNumber() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
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