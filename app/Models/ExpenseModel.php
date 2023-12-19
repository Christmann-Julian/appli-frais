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

class ExpenseModel {

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

    public function getAll() 
    {
        $sql = "SELECT f.id, f.mois, f.total, f.date, e.libelle, u.nom, u.prenom  FROM fichedefrais AS f
            JOIN utilisateurs AS u ON f.idUtilisateur = u.id
            JOIN etat AS e ON f.idEtat = e.id ;";
        $req = $this->db->prepare($sql);
        $req->execute();
        return $req->fetchAll($this->db::FETCH_ASSOC);
    }

    public function getAllByUser($userId) 
    {
        $sql = "SELECT f.id, f.mois, f.total, f.date, e.libelle, u.nom, u.prenom  FROM fichedefrais AS f
            JOIN utilisateurs AS u ON f.idUtilisateur = u.id
            JOIN etat AS e ON f.idEtat = e.id
            WHERE idUtilisateur = :userId  ;";
        $req = $this->db->prepare($sql);
        $req->bindParam('userId', $userId);
        $req->execute();
        return $req->fetchAll($this->db::FETCH_ASSOC);
    }

    public function getById($id) 
    {
        $sql = "SELECT * FROM fichedefrais WHERE id = :id ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();
        return $req->fetch($this->db::FETCH_ASSOC);
    }

    public function CreateExpense($userId, $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait) 
    {
        $sqlFiche= "INSERT INTO `fichedefrais`(`mois`, `total`, `date`, `idUtilisateur`, `idEtat`) VALUES (MONTH(CURDATE()), 0, CURDATE(), :userId, 1);";
        
        $reqFiche = $this->db->prepare($sqlFiche);
        
        $reqFiche->bindParam('userId', $userId);
        
        $reqFiche->execute();
        $reqFiche->closeCursor();
        
        $sqlIdFiche = "SELECT id FROM `fichedefrais` WHERE idUtilisateur = :userId ORDER BY id DESC LIMIT 1;";

        $reqIdFiche = $this->db->prepare($sqlIdFiche);
        
        $reqIdFiche->bindParam('userId', $userId);
        
        $reqIdFiche->execute();

        $idFicheDeFrais = $reqIdFiche->fetch($this->db::FETCH_ASSOC);

        $sqlFF = "INSERT INTO `fraisforfait`(`libelle`, `quantite`, `montant`, `total`, `idFicheDeFrais`) VALUES 
            ( :ffnuite, :ffnuiteQte, :ffnuiteM, :ffnuiteTot, :idFicheDeFrais),
            ( :ffrepas, :ffrepasQte, :ffrepasM, :ffrepasTot, :idFicheDeFrais),
            ( :ffkilo, :ffkiloQte, :ffkiloM, :ffkiloTot, :idFicheDeFrais);";
        
        $reqFF = $this->db->prepare($sqlFF);

        $reqFF->bindParam('ffnuite', $ffnuite['l']);
        $reqFF->bindParam('ffnuiteQte',$ffnuite['qte']);
        $reqFF->bindParam('ffnuiteM', $ffnuite['m']);
        $reqFF->bindParam('ffnuiteTot', $ffnuite['tot']);

        $reqFF->bindParam('ffrepas', $ffrepas['l']);
        $reqFF->bindParam('ffrepasQte',$ffrepas['qte']);
        $reqFF->bindParam('ffrepasM', $ffrepas['m']);
        $reqFF->bindParam('ffrepasTot', $ffrepas['tot']);

        $reqFF->bindParam('ffkilo', $ffkilo['l']);
        $reqFF->bindParam('ffkiloQte',$ffkilo['qte']);
        $reqFF->bindParam('ffkiloM', $ffkilo['m']);
        $reqFF->bindParam('ffkiloTot', $ffkilo['tot']);

        $reqFF->bindParam('idFicheDeFrais', $idFicheDeFrais['id']);

        $reqFF->execute();
        
        if(!empty($fraisHorsForfait)){
            $sqlFH = "INSERT INTO `fraishorsforfait`(`date`, `libelle`, `montant`, `idFicheDeFrais`) VALUES ";
    
            for($i=1; $i <= count($fraisHorsForfait); $i++) {
                if($i == count($fraisHorsForfait)){
                    $sqlFH.="( :date".strval($i).", :libelle".strval($i).", :montant".strval($i).", :idFicheDeFrais);";
                }else{
                    $sqlFH.="( :date".strval($i).", :libelle".strval($i).", :montant".strval($i).", :idFicheDeFrais),";
                }
            }

            $reqFH = $this->db->prepare($sqlFH);

            $k = 1;
            foreach($fraisHorsForfait as $fh){
                $reqFH->bindParam('date'.strval($k), $fh[0]);
                $reqFH->bindParam('libelle'.strval($k), $fh[1]);
                $reqFH->bindParam('montant'.strval($k), $fh[2]);
                $k++;
            }

            $reqFH->bindParam('idFicheDeFrais', $idFicheDeFrais['id']);
            $reqFH->execute();
        }

        $rowCount = $reqFiche->rowCount();

        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

}