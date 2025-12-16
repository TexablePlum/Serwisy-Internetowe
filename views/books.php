<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki</title>
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
        <h1 class="register-title">Lista książek</h1>

        <?php if (!empty($borrowSuccess)): ?>
            <div class="result-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($borrowSuccess) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($deleteSuccess)): ?>
            <div class="result-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($deleteSuccess) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($deleteError)): ?>
            <div class="error-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($deleteError) ?>
            </div>
        <?php endif; ?>

        <div style="margin-left: 100px; margin-top: 20px; padding-right: 270px;">
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
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="5">Brak książek w bibliotece.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($books as $index => $book): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($book->getTitle()) ?></td>
                                <td><?= htmlspecialchars($book->getAuthors()) ?></td>
                                <td><?= $book->getNumber() ?></td>
                                <td>
                                    <?php if ($_SESSION['user_permission'] === 'reader' && $book->getNumber() > 0): ?>
                                        <a href="index.php?action=borrow_book&book_id=<?= $book->getId() ?>"
                                            class="action-link">pożycz</a>
                                    <?php elseif ($_SESSION['user_permission'] === 'admin'): ?>
                                        <a href="index.php?action=edit_book&id=<?= $book->getId() ?>" class="action-link">edytuj</a>
                                        <a href="index.php?action=delete_book&id=<?= $book->getId() ?>" class="action-link"
                                            onclick="return confirm('Czy na pewno chcesz usunąć tę książkę?');">usuń</a>
                                        <a href="index.php?action=book_borrowers&id=<?= $book->getId() ?>" class="action-link">kto
                                            wypożyczył</a>
                                    <?php else: ?>
                                        <span style="color: #999;">brak dostępnych</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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