<?php

class NoteRepository {
    private string $filePath;
    
    public function __construct(string $filePath) {
        $this->filePath = $filePath;
        
        // Upewnienie się, że katalog data istnieje
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Utworzenie pliku jeśli nie istnieje
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, "");
        }
    }
    
    public function findByUser(string $login): array {
        $notes = [];
        
        if (!file_exists($this->filePath) || filesize($this->filePath) == 0) {
            return $notes;
        }
        
        if (($handle = fopen($this->filePath, 'r')) !== false) {
            // Czyta plik linia po linii używając separatora ';'
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                // Oczekuje formatu: id;login;tytuł;treść;data_utworzenia
                if (count($data) >= 5) {
                    $noteLogin = $data[1];
                    
                    if ($noteLogin === $login) {
                        $notes[] = new Note(
                            (int)$data[0], // id
                            $data[1],      // login
                            $data[2],      // title
                            $data[3],      // content
                            $data[4]       // createdAt
                        );
                    }
                }
            }
            fclose($handle);
        }
        
        return $notes;
    }

    public function add(Note $note): void {
        // Generowanie prostego ID
        $newId = 1;
        if (file_exists($this->filePath) && filesize($this->filePath) > 0) {
            $lines = file($this->filePath);
            if (!empty($lines)) {
                $lastLine = trim(end($lines));
                if (!empty($lastLine)) {
                    $data = str_getcsv($lastLine, ';');
                    if (isset($data[0]) && is_numeric($data[0])) {
                        $newId = (int)$data[0] + 1;
                    }
                }
            }
        }
        
        $note->setId($newId);

        $file = fopen($this->filePath, 'a');
        
        // Zapis w formacie: id;login;tytuł;treść;data_utworzenia
        fputcsv($file, [
            $note->getId(),
            $note->getUserLogin(),
            $note->getTitle(),
            $note->getContent(),
            $note->getCreatedAt()->format('Y-m-d H:i:s')
        ], ';');
        
        fclose($file);
    }
}
?>