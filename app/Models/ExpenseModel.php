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

    public function getAccessByUser($userId, $expenseId) 
    {
        $sql = "SELECT f.id, f.mois, f.total, f.date, e.libelle, u.nom, u.prenom  FROM fichedefrais AS f
            JOIN utilisateurs AS u ON f.idUtilisateur = u.id
            JOIN etat AS e ON f.idEtat = e.id
            WHERE idUtilisateur = :userId && f.id = :expenseId ;";
        $req = $this->db->prepare($sql);
        $req->bindParam('userId', $userId);
        $req->bindParam('expenseId', $expenseId);
        $req->execute();

        $rowCount = $req->rowCount();

        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id) 
    {
        $sqlF = "SELECT * FROM fichedefrais WHERE id = :id ;";
        $reqF = $this->db->prepare($sqlF);
        $reqF->bindParam(':id', $id);
        $reqF->execute();
        $fichedefrais = $reqF->fetch($this->db::FETCH_ASSOC);

        $sqlFF = "SELECT * FROM fraisforfait WHERE idFicheDeFrais = :id ;";
        $reqFF = $this->db->prepare($sqlFF);
        $reqFF->bindParam(':id', $id);
        $reqFF->execute();
        $fraisforfait = $reqFF->fetchAll($this->db::FETCH_ASSOC);

        $sqlFH = "SELECT * FROM fraishorsforfait WHERE idFicheDeFrais = :id ;";
        $reqFH = $this->db->prepare($sqlFH);
        $reqFH->bindParam(':id', $id);
        $reqFH->execute();
        $fraishorsforfait = $reqFH->fetchAll($this->db::FETCH_ASSOC);

        return [
            'fichedefrais' => $fichedefrais,
            'fraisforfait' => $fraisforfait,
            'fraishorsforfait' => $fraishorsforfait
        ];
    }

    public function getBySearch($search)
    {
        $search = "%".$search."%";
        $sql = "SELECT f.id, f.mois, f.total, f.date, e.libelle, u.nom, u.prenom FROM `fichedefrais` AS f 
                JOIN utilisateurs AS u ON f.idUtilisateur = u.id
                JOIN etat AS e ON e.id = f.idEtat
                WHERE f.mois LIKE :search OR u.nom LIKE :search OR u.prenom LIKE :search OR e.libelle LIKE :search  ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':search', $search);
        $req->execute();
        return $req->fetchAll($this->db::FETCH_ASSOC);
    }

    public function getAllState() 
    {
        $sql = "SELECT * FROM etat;";
        $req = $this->db->prepare($sql);
        $req->execute();
        return $req->fetchAll($this->db::FETCH_ASSOC);
    }

    public function getStateBy($id) 
    {
        $sql = "SELECT * FROM etat WHERE id = :id ;";
        $req = $this->db->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();
        return $req->fetch($this->db::FETCH_ASSOC);
    }

    public function changeState($idEtat, $idFicheDeFrais)
    {
        $sql = "UPDATE `fichedefrais` SET `idEtat`= :idEtat WHERE id = :idFicheDeFrais ;";
        
        $req = $this->db->prepare($sql);
        
        $req->bindParam('idEtat', $idEtat);
        $req->bindParam('idFicheDeFrais', $idFicheDeFrais);
        
        $req->execute();
        $req->closeCursor();
    }

    public function CreateExpense($userId, $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait, $tot) 
    {
        $sqlFiche= "INSERT INTO `fichedefrais`(`mois`, `total`, `date`, `idUtilisateur`, `idEtat`) VALUES (MONTH(CURDATE()), :tot, CURDATE(), :userId, 1);";
        
        $reqFiche = $this->db->prepare($sqlFiche);
        
        $reqFiche->bindParam('userId', $userId);
        $reqFiche->bindParam('tot', $tot);
        
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

    public function editExpense($expenseId, $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait, $tot) 
    {
        $sqlFiche = "UPDATE `fichedefrais` SET `total`= :tot ,`date`= CURDATE() WHERE id = :expenseId";
        
        $reqFiche = $this->db->prepare($sqlFiche);
        
        $reqFiche->bindParam('expenseId', $expenseId);
        $reqFiche->bindParam('tot', $tot);
        
        $reqFiche->execute();
        $reqFiche->closeCursor();

        $sqlFF = "UPDATE `fraisforfait` SET `quantite`= :ffnuiteQte,`montant`= :ffnuiteM,`total`= :ffnuiteTot WHERE id = :ffnuiteId ;
                UPDATE `fraisforfait` SET `quantite`= :ffrepasQte,`montant`= :ffrepasM,`total`= :ffrepasTot WHERE id = :ffrepasId ;
                UPDATE `fraisforfait` SET `quantite`= :ffkiloQte,`montant`= :ffkiloM,`total`= :ffkiloTot WHERE id = :ffkiloId ;";
        
        $reqFF = $this->db->prepare($sqlFF);

        $reqFF->bindParam('ffnuiteId', $ffnuite['id']);
        $reqFF->bindParam('ffnuiteQte',$ffnuite['qte']);
        $reqFF->bindParam('ffnuiteM', $ffnuite['m']);
        $reqFF->bindParam('ffnuiteTot', $ffnuite['tot']);

        $reqFF->bindParam('ffrepasId', $ffrepas['id']);
        $reqFF->bindParam('ffrepasQte',$ffrepas['qte']);
        $reqFF->bindParam('ffrepasM', $ffrepas['m']);
        $reqFF->bindParam('ffrepasTot', $ffrepas['tot']);

        $reqFF->bindParam('ffkiloId', $ffkilo['id']);
        $reqFF->bindParam('ffkiloQte',$ffkilo['qte']);
        $reqFF->bindParam('ffkiloM', $ffkilo['m']);
        $reqFF->bindParam('ffkiloTot', $ffkilo['tot']);

        $reqFF->execute();
        $reqFF->closeCursor();

        if(!empty($fraisHorsForfait)){
            $sqlFH = "";
    
            for($i=1; $i <= count($fraisHorsForfait); $i++) {
                $sqlFH.="UPDATE `fraishorsforfait` SET `date`= :date".strval($i).",`libelle`= :libelle".strval($i).",`montant`= :montant".strval($i)." WHERE id = :id".strval($i)." ; ";
            }

            $reqFH = $this->db->prepare($sqlFH);

            $k = 1;
            foreach($fraisHorsForfait as $fh){
                $reqFH->bindParam('id'.strval($k), $fh[0]);
                $reqFH->bindParam('date'.strval($k), $fh[1]);
                $reqFH->bindParam('libelle'.strval($k), $fh[2]);
                $reqFH->bindParam('montant'.strval($k), $fh[3]);
                $k++;
            }

            $reqFH->execute();
            $reqFH->closeCursor();
        }
    }

    public function delete($id) 
    {
        $sqlFF = "DELETE FROM fraisforfait WHERE idFicheDeFrais = :id ;";
        $reqFF = $this->db->prepare($sqlFF);
        $reqFF->bindParam(':id', $id);
        $reqFF->execute();

        $sqlFH = "DELETE FROM fraishorsforfait WHERE idFicheDeFrais = :id ;";
        $reqFH = $this->db->prepare($sqlFH);
        $reqFH->bindParam(':id', $id);
        $reqFH->execute();

        $sqlF = "DELETE FROM fichedefrais WHERE id = :id ;";
        $reqF = $this->db->prepare($sqlF);
        $reqF->bindParam(':id', $id);
        $reqF->execute();
    }

}