<?php

namespace App\Models;

class UserModel {

    /**
     * The variable pdo connection to the database.
     *
     * @var DbConnection
     */
    private $db;

    /**
     * Create a new User instance.
     *
     * @return void
     */
    public function __construct() {
        $dbConnection = new \App\DbConnection();
        $this->db = $dbConnection->connect();
    }

    public function getByMail($email) {
        $sql = "SELECT * FROM users WHERE email = :email ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':email', $email);
        $req->execute();
        return $req->fetch($this->db::FETCH_ASSOC);
    }

}