<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class User {
    private string $login;
    private string $fullName;

    public function __construct(string $login, string $name) {
        $this->login = $login;
        $this->fullName = $name;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getFullName(): string {
        return $this->fullName;
    }
}

?>