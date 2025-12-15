<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna - Notatnik</title>
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
        <h1 class="register-title">Notatnik Użytkownika</h1>
        <div class="content-wrapper">
            
            <div class="form-section">
                <h3>Dodaj nową notatkę</h3>
                
                <div class="note-form">
                    <?php if (!empty($message)): ?>
                        <p style="color: red; margin: 0 0 10px 0;"><?= htmlspecialchars($message) ?></p>
                    <?php endif; ?>
                    <form method="POST" action="index.php?action=home">
                        <label>Tytuł:</label>
                        <input type="text" name="title" required>
                        
                        <label>Treść:</label>
                        <textarea name="content" required></textarea>
                        
                        <input type="submit" name="add_note" class="submit-btn" value="Zapisz notatkę">
                    </form>
                </div>
            </div>

            <div class="notes-section">
                <h3>Twoje notatki</h3>
                
                <div class="scroll-wrapper">
                    <?php if (empty($userNotes)): ?>
                        <p style="padding: 10px;">Brak notatek do wyświetlenia.</p>
                    <?php else: ?>
                        <table class="notes-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Tytuł</th>
                                    <th>Treść</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($userNotes as $note): ?>
                                    <tr>
                                        <td style="width: 130px;"><?= $note->getCreatedAt()->format('Y-m-d H:i') ?></td>
                                        <td><?= htmlspecialchars($note->getTitle()) ?></td>
                                        <td><?= nl2br(htmlspecialchars($note->getContent())) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
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