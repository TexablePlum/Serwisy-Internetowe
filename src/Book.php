<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class Book
{
    private int $id;
    private string $title;
    private string $authors;
    private int $number;

    public function __construct(int $id, string $title, string $authors, int $number)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authors = $authors;
        $this->number = $number;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthors(): string
    {
        return $this->authors;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}

?>