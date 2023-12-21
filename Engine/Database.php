<?php

class Database extends PDO
{
    private static $_instance;

    public function __construct($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        try {
            // Call the parent constructor
            parent::__construct('mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME . ';charset=utf8', $DB_USER, $DB_PASS);

            // Set the character set
            $this->exec('SET CHARACTER SET utf8mb4');

            // Comment this line if you don't want error reporting
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Handle connection errors
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Prevents cloning of the instance
    private function __clone()
    {
    }

    // Singleton pattern to get the instance
    public static function getInstance()
    {
        // Create an instance if it doesn't exist
        if (self::$_instance === null) {
            self::$_instance = new self(DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }

        return self::$_instance;
    }
}
