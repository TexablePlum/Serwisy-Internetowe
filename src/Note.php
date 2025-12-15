<?php

class Note {
    private ?int $id;
    private string $userLogin;
    private string $title;
    private string $content;
    private DateTime $createdAt;

    public function __construct(?int $id, string $userLogin, string $title, string $content, ?string $createdAt = null) {
        $this->id = $id;
        $this->userLogin = $userLogin;
        $this->title = $title;
        $this->content = $content;
        
        if ($createdAt) {
            $this->createdAt = new DateTime($createdAt);
        } else {
            $this->createdAt = new DateTime();
        }
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }
    
    // Setter dla ID
    public function setId(int $id): void {
        $this->id = $id;
    }
}
?>