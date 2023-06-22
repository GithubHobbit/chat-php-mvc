<?php
namespace Core;
use \PDO;
use \PDOException;
use Core\Error;

class Model {
    protected PDO $db;
    public function __construct() {
        try {
            $this->db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            //echo "Connected to {$_ENV['DB_NAME']} at {$_ENV['DB_HOST']} successfully.";
        }
        catch (PDOException $e) {
            Error::ErrorPage500("Couldn't connect to database {$_ENV['DB_NAME']}: " . $e->getMessage());
        }
    }
}