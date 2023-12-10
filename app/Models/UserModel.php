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

    public function getById($id) 
    {
        $sql = "SELECT * FROM utilisateurs WHERE id = :id ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();
        return $req->fetch($this->db::FETCH_ASSOC);
    }

    public function updateProfile($id, $lastname, $firstname, $city) 
    {
        $sql = "UPDATE utilisateurs SET nom = :lastname, prenom = :firstname, ville = :city WHERE id = :id ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->bindParam(':lastname',$lastname);
        $req->bindParam(':firstname', $firstname);
        $req->bindParam(':city', $city);
        $req->execute();

        $rowCount = $req->rowCount();

        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCon($id, $login, $password) 
    {
        $sql = "UPDATE utilisateurs SET login = :login, mdp = :password WHERE id = :id ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->bindParam(':login', $login);
        $req->bindParam(':password', $password);
        $req->execute();

        $rowCount = $req->rowCount();

        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

}