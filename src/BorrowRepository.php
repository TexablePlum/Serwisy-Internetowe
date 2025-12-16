<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class BorrowRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Wypożycza książkę
     */
    public function borrowBook(int $userId, int $bookId): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO borrowed_books (user_id, book_id)
            VALUES (:user_id, :book_id)
        ");

        return $stmt->execute([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);
    }

    /**
     * Zwraca książkę
     */
    public function returnBook(int $userId, int $bookId): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM borrowed_books 
            WHERE user_id = :user_id AND book_id = :book_id
            LIMIT 1
        ");

        return $stmt->execute([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);
    }

    /**
     * Pobiera wypożyczone książki użytkownika (zgrupowane z liczbą egzemplarzy)
     */
    public function getUserBorrowedBooks(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT b.id, b.title, b.authors, b.number, COUNT(*) as borrowed_count
            FROM book b
            INNER JOIN borrowed_books bb ON b.id = bb.book_id
            WHERE bb.user_id = :user_id
            GROUP BY b.id, b.title, b.authors, b.number
            ORDER BY b.title
        ");
        $stmt->execute(['user_id' => $userId]);

        $books = [];
        while ($row = $stmt->fetch()) {
            // Tworzy obiekt Book, ale w polu 'number' zapisuje liczbę wypożyczonych egzemplarzy
            $books[] = new Book(
                (int) $row['id'],
                $row['title'],
                $row['authors'],
                (int) $row['borrowed_count']  // liczba wypożyczonych egzemplarzy
            );
        }

        return $books;
    }

    /**
     * Sprawdza czy użytkownik wypożyczył daną książkę
     */
    public function isBookBorrowedByUser(int $userId, int $bookId): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM borrowed_books
            WHERE user_id = :user_id AND book_id = :book_id
        ");
        $stmt->execute([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);

        $row = $stmt->fetch();
        return (int) $row['count'] > 0;
    }

    /**
     * Zwraca wszystkie książki użytkownika (przy usuwaniu)
     */
    public function returnAllUserBooks(int $userId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM borrowed_books WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $userId]);
    }

    /**
     * Sprawdza czy książka jest wypożyczona
     */
    public function isBookBorrowed(int $bookId): bool
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count
            FROM borrowed_books
            WHERE book_id = :book_id
        ");
        $stmt->execute(['book_id' => $bookId]);

        $row = $stmt->fetch();
        return (int) $row['count'] > 0;
    }

    /**
     * Pobiera użytkowników, którzy wypożyczyli daną książkę
     */
    public function getBookBorrowers(int $bookId): array
    {
        $stmt = $this->db->prepare("
            SELECT u.* 
            FROM user u
            INNER JOIN borrowed_books bb ON u.id = bb.user_id
            WHERE bb.book_id = :book_id
            ORDER BY u.surname, u.name
        ");
        $stmt->execute(['book_id' => $bookId]);

        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = new User(
                (int) $row['id'],
                $row['name'],
                $row['surname'],
                $row['login'],
                (int) $row['age'],
                $row['permission']
            );
        }

        return $users;
    }
}

?>