<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki pożyczone</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_permission']) && $_SESSION['user_permission'] === 'admin'): ?>
                    <li><a href="index.php?action=users">Użytkownicy</a></li>
                <?php endif; ?>
                <li><a href="index.php?action=books">Książki</a></li>
                <?php if (isset($_SESSION['user_permission']) && $_SESSION['user_permission'] === 'admin'): ?>
                    <li><a href="index.php?action=add_user" class="wider-nav-btn">Dodaj użytkownika</a></li>
                    <li><a href="index.php?action=add_book">Dodaj książkę</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=borrowed_books" class="wider-nav-btn">Książki pożyczone</a></li>
                <?php endif; ?>
                <li><a href="index.php?action=logout">Wyloguj</a></li>
            </ul>
        </nav>
        <div class="user-info">Zalogowany: <?= htmlspecialchars($_SESSION['user_fullname']) ?></div>
    </header>

    <main class="container">
        <h1 class="register-title">Książki pożyczone</h1>

        <?php if (!empty($returnSuccess)): ?>
            <div class="result-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($returnSuccess) ?>
            </div>
        <?php endif; ?>

        <div style="margin-left: 100px; margin-top: 20px; padding-right: 270px;">
            <?php if (empty($borrowedBooks)): ?>
                <p>Brak pożyczonych książek.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lp.</th>
                            <th>Tytuł</th>
                            <th>Autorzy</th>
                            <th>Liczba egzemplarzy</th>
                            <th>Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($borrowedBooks as $index => $book): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                                <td><?= htmlspecialchars($book->getAuthors()) ?></td>
                                <td><?= $book->getNumber() ?></td>
                                <td>
                                    <a href="index.php?action=return_book&book_id=<?= $book->getId() ?>"
                                        class="action-link">oddaj</a>
                                </td>
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