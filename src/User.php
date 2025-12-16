<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class User
{
    private int $id;
    private string $name;
    private string $surname;
    private string $login;
    private int $age;
    private string $permission;

    public function __construct(int $id, string $name, string $surname, string $login, int $age, string $permission)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->age = $age;
        $this->permission = $permission;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getPermission(): string
    {
        return $this->permission;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function isAdmin(): bool
    {
        return $this->permission === 'admin';
    }
}

?>