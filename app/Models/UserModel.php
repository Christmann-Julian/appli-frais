<?php

/**
 * UserModel
 * 
 * UserModel is a user model
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

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

    public function getByLogin($login) 
    {
        $sql = "SELECT * FROM utilisateurs WHERE login = :login ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':login', $login);
        $req->execute();
        return $req->fetch($this->db::FETCH_ASSOC);
    }

}