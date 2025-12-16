<?php

// Włącza tryb ścisłego typowania
declare(strict_types=1);

class Database
{
    private static ?PDO $instance = null;

    private function __construct()
    {
        // Prywatny konstruktor zapobiega tworzeniu instancji
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $host = 'localhost';
                $dbname = 'pdo';
                $username = 'root';
                $password = '';

                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                self::$instance = new PDO($dsn, $username, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Błąd połączenia z bazą danych: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

?>