<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class BookRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Pobiera wszystkie książki
     */
    public function getAllBooks(): array
    {
        $stmt = $this->db->query("SELECT * FROM book ORDER BY id");
        $books = [];

        while ($row = $stmt->fetch()) {
            $books[] = new Book(
                (int) $row['id'],
                $row['title'],
                $row['authors'],
                (int) $row['number']
            );
        }

        return $books;
    }

    /**
     * Pobiera książkę po ID
     */
    public function getBookById(int $id): ?Book
    {
        $stmt = $this->db->prepare("SELECT * FROM book WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Book(
            (int) $row['id'],
            $row['title'],
            $row['authors'],
            (int) $row['number']
        );
    }

    /**
     * Dodaje nową książkę
     */
    public function addBook(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO book (title, authors, number)
            VALUES (:title, :authors, :number)
        ");

        return $stmt->execute([
            'title' => $data['title'],
            'authors' => $data['authors'],
            'number' => $data['number']
        ]);
    }

    /**
     * Zmienia liczbę egzemplarzy książki
     */
    public function updateBookNumber(int $id, int $change): bool
    {
        $stmt = $this->db->prepare("
            UPDATE book 
            SET number = number + :change
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'change' => $change
        ]);
    }

    /**
     * Aktualizuje książkę
     */
    public function updateBook(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE book 
            SET title = :title, authors = :authors, number = :number
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'authors' => $data['authors'],
            'number' => $data['number']
        ]);
    }

    /**
     * Usuwa książkę
     */
    public function deleteBook(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM book WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

?>