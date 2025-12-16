<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Pobiera wszystkich użytkowników
     */
    public function getAllUsers(): array
    {
        $stmt = $this->db->query("SELECT * FROM user ORDER BY id");
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

    /**
     * Pobiera użytkownika po ID
     */
    public function getUserById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new User(
            (int) $row['id'],
            $row['name'],
            $row['surname'],
            $row['login'],
            (int) $row['age'],
            $row['permission']
        );
    }

    /**
     * Pobiera użytkownika po loginie
     */
    public function getUserByLogin(string $login): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new User(
            (int) $row['id'],
            $row['name'],
            $row['surname'],
            $row['login'],
            (int) $row['age'],
            $row['permission']
        );
    }

    /**
     * Weryfikuje logowanie użytkownika
     */
    public function verifyPassword(string $login, string $password): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
        $stmt->execute([
            'login' => $login,
            'password' => sha1($password)
        ]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new User(
            (int) $row['id'],
            $row['name'],
            $row['surname'],
            $row['login'],
            (int) $row['age'],
            $row['permission']
        );
    }

    /**
     * Dodaje nowego użytkownika
     */
    public function addUser(array $data): bool
    {
        // Hasło to login zahashowany sha1
        $password = sha1($data['login']);

        $stmt = $this->db->prepare("
            INSERT INTO user (name, surname, login, password, age, permission)
            VALUES (:name, :surname, :login, :password, :age, :permission)
        ");

        return $stmt->execute([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'login' => $data['login'],
            'password' => $password,
            'age' => $data['age'],
            'permission' => $data['permission']
        ]);
    }

    /**
     * Aktualizuje użytkownika
     */
    public function updateUser(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE user 
            SET name = :name, surname = :surname, login = :login, age = :age, permission = :permission
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'surname' => $data['surname'],
            'login' => $data['login'],
            'age' => $data['age'],
            'permission' => $data['permission']
        ]);
    }

    /**
     * Usuwa użytkownika
     */
    public function deleteUser(int $id): bool
    {
        // Sprawdzenie czy nie jest ostatnim administratorem
        $user = $this->getUserById($id);
        if ($user && $user->isAdmin()) {
            if ($this->countAdmins() <= 1) {
                return false; // Nie można usunąć ostatniego admina
            }
        }

        $stmt = $this->db->prepare("DELETE FROM user WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Zlicza administratorów
     */
    public function countAdmins(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) as count FROM user WHERE permission = 'admin'");
        $row = $stmt->fetch();
        return (int) $row['count'];
    }
}

?>