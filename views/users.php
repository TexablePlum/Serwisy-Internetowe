<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownicy</title>
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
        <h1 class="register-title">Lista użytkowników</h1>

        <?php if (isset($_SESSION['delete_success'])): ?>
            <div class="result-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($_SESSION['delete_success']) ?>
            </div>
            <?php unset($_SESSION['delete_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['delete_error'])): ?>
            <div class="error-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($_SESSION['delete_error']) ?>
            </div>
            <?php unset($_SESSION['delete_error']); ?>
        <?php endif; ?>

        <?php if (!empty($editSuccess)): ?>
            <div class="result-message" style="margin: 0 100px 15px;">
                <?= htmlspecialchars($editSuccess) ?>
            </div>
        <?php endif; ?>

        <div style="margin-left: 100px; margin-top: 20px; padding-right: 270px;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Lp.</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Login</th>
                        <th>Wiek</th>
                        <th>Uprawnienia</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="7">Brak użytkowników w systemie.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($user->getName()) ?></td>
                                <td><?= htmlspecialchars($user->getSurname()) ?></td>
                                <td><?= htmlspecialchars($user->getLogin()) ?></td>
                                <td><?= $user->getAge() ?></td>
                                <td><?= $user->getPermission() === 'admin' ? 'administrator' : 'czytelnik' ?></td>
                                <td>
                                    <a href="index.php?action=edit_user&id=<?= $user->getId() ?>" class="action-link">edytuj</a>
                                    <a href="index.php?action=delete_user&id=<?= $user->getId() ?>" class="action-link"
                                        onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">usuń</a>
                                    <a href="index.php?action=user_books&id=<?= $user->getId() ?>"
                                        class="action-link">książki</a>
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