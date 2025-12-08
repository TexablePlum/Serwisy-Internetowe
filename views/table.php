<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if ($isLoggedIn): ?>
                    <li><a href="index.php?action=home">Home</a></li>
                    <li><a href="index.php?action=table">Table</a></li>
                    <li><a href="index.php?action=date">Date</a></li>
                    <li><a href="index.php?action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="index.php?action=login">Login</a></li>
                    <li><a href="index.php?action=table">Table</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if ($isLoggedIn): ?>
            <div class="user-info">
                Zalogowany: <strong><?= htmlspecialchars($userName) ?></strong>
            </div>
        <?php endif; ?>
    </header>

    <main class="container">
        <h1 class="register-title">Tabela</h1>
        <div class="content-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Grupa</th>
                        <th colspan="7">Data</th>
                    </tr>
                    <tr>
                        <td>1, 3</td>
                        <td class="date-header">25.11</td>
                        <td class="date-header">2.12</td>
                        <td class="date-header">9.12</td>
                        <td class="date-header">16.12</td>
                        <td class="date-header">13.01</td>
                        <td class="date-header">20.01</td>
                        <td class="date-header">27.01</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SEKCJA</td>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>2</td>
                        <td rowspan="4">Obrony</td>
                        <td>3</td>
                        <td>4</td>
                        <td rowspan="4">Obrony</td>
                        <td rowspan="4">Zal</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>3</td>
                        <td>4</td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>4</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
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
