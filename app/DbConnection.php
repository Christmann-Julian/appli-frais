<?php

namespace App;

use PDO;
use PDOException;

class DbConnection {
    /**
     * Adress of the database
     *
     * @return string
     */
    private $host;

    /**
     * Name of the database
     *
     * @return string
     */
    private $dbname;

    /**
     * User of the database
     *
     * @return string
     */
    private $username;

    /**
     * User password
     *
     * @return string
     */
    private $password;

    /**
     * Charset of the database
     *
     * @return string
     */
    private $charset;

    /**
     * Create a new DbConnection instance.
     *
     * @return void
     */
    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->charset = $_ENV['DB_CHARSET'];
    }

    /**
     * Establishes a connection to the database using PDO.
     *
     * @return PDO|null The PDO object representing the database connection, or null on error.
     */
    public function connect() {
        try {
            return new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset, $this->username, $this->password);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}