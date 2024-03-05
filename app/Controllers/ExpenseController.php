<?php

/**
 * ExpenseController
 * 
 * ExpenseController is a expense controller
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

namespace App\Controllers;

use App\Models\ExpenseModel;

class ExpenseController extends Controller
{
    /**
     * Return the view associate with the route expense
     *
     * @return self
     */
    public function index():self
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            header("Location: ".$this->linkTo("login"));
            exit; 
        }

        $expenseModel = new ExpenseModel();

        if($_SESSION['role'] == "visiteur"){
            $expenses = $expenseModel->getAllByUser($_SESSION['id']);
        }else{
            $expenses = $expenseModel->getAll();
        }

        $this->render('expense/index.php', [
            "expenses" => $expenses
        ]);
        return $this;
    }

    /**
     * Return the view associate with the route expense_add
     *
     * @return self
     */
    public function add():self
    {
        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['role'] != "visiteur") {
            header("Location: ".$this->linkTo("login"));
            exit; 
        }

        if(isset($_POST["ffnuite"]) && isset($_POST["ffnuiteQte"]) && isset($_POST["ffnuiteM"]) && isset($_POST["ffnuiteTot"])
        && isset($_POST["ffrepas"]) && isset($_POST["ffrepasQte"]) && isset($_POST["ffrepasM"]) && isset($_POST["ffrepasTot"])
        && isset($_POST["ffkilo"]) && isset($_POST["ffkiloQte"]) && isset($_POST["ffkiloM"]) && isset($_POST["ffkiloTot"])
        ){
            $ffnuite = array();
            $ffnuite["l"] = htmlspecialchars($_POST["ffnuite"]);
            $ffnuite["qte"] = intval(htmlspecialchars($_POST["ffnuiteQte"]));
            $ffnuite["m"] = floatval(number_format(htmlspecialchars($_POST["ffnuiteM"]), 2));
            $ffnuite["tot"] = floatval(number_format(htmlspecialchars($_POST["ffnuiteTot"]), 2));

            $ffrepas = array();
            $ffrepas["l"] = htmlspecialchars($_POST["ffrepas"]);
            $ffrepas["qte"] = intval(htmlspecialchars($_POST["ffrepasQte"]));
            $ffrepas["m"] = floatval(number_format(htmlspecialchars($_POST["ffrepasM"]), 2));
            $ffrepas["tot"] = floatval(number_format(htmlspecialchars($_POST["ffrepasTot"]), 2));

            $ffkilo = array();
            $ffkilo["l"] = htmlspecialchars($_POST["ffkilo"]);
            $ffkilo["qte"] = intval(htmlspecialchars($_POST["ffkiloQte"]));
            $ffkilo["m"] = floatval(number_format(htmlspecialchars($_POST["ffkiloM"]), 2));
            $ffkilo["tot"] = floatval(number_format(htmlspecialchars($_POST["ffkiloTot"]), 2));

            $i = 1;
            $fraisHorsForfait = array();
            $tot = $ffnuite["tot"] + $ffrepas["tot"] + $ffkilo["tot"];

            while(isset($_POST['fhdate'.$i]) && isset($_POST['fhlib'.$i]) && isset($_POST['fhM'.$i])){
                $fraisHorsForfait[$i]=[$_POST['fhdate'.$i], $_POST['fhlib'.$i], $_POST['fhM'.$i]];
                $tot+=$_POST['fhM'.$i];
                $i++;
            }

            $expenseModel = new ExpenseModel();
            $expenseModel->CreateExpense( $_SESSION['id'], $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait, $tot);
        }

        $this->render('expense/add.php');
        return $this;
    }

    /**
     * Return the view associate with the route expense_edit
     *
     * @return self
     */
    public function edit(): self
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            header("Location: ".$this->linkTo("login"));
            exit; 
        }
        
        $expenseModel = new ExpenseModel();

        if(!isset($_GET['id']) || (!$expenseModel->getAccessByUser($_SESSION['id'], $_GET['id']) && $_SESSION['role'] != "compta")){
            header("Location: ".$this->linkTo("expense"));
            exit; 
        }

        $expense = $expenseModel->getById($_GET['id']);
        $states = $expenseModel->getAllState();
        $currentState = $expenseModel->getStateBy($expense['fichedefrais']['idEtat']);

        if(isset($_POST["ffnuite"]) && isset($_POST["ffnuiteQte"]) && isset($_POST["ffnuiteM"]) && isset($_POST["ffnuiteTot"])
        && isset($_POST["ffrepas"]) && isset($_POST["ffrepasQte"]) && isset($_POST["ffrepasM"]) && isset($_POST["ffrepasTot"])
        && isset($_POST["ffkilo"]) && isset($_POST["ffkiloQte"]) && isset($_POST["ffkiloM"]) && isset($_POST["ffkiloTot"])
        ){
            $ffnuite = array();
            $ffnuite['id'] = $expense['fraisforfait'][0]['id'];
            $ffnuite["l"] = htmlspecialchars($_POST["ffnuite"]);
            $ffnuite["qte"] = intval(htmlspecialchars($_POST["ffnuiteQte"]));
            $ffnuite["m"] = floatval(number_format(htmlspecialchars($_POST["ffnuiteM"]), 2));
            $ffnuite["tot"] = floatval(number_format(htmlspecialchars($_POST["ffnuiteTot"]), 2));

            $ffrepas = array();
            $ffrepas['id'] = $expense['fraisforfait'][1]['id'];
            $ffrepas["l"] = htmlspecialchars($_POST["ffrepas"]);
            $ffrepas["qte"] = intval(htmlspecialchars($_POST["ffrepasQte"]));
            $ffrepas["m"] = floatval(number_format(htmlspecialchars($_POST["ffrepasM"]), 2));
            $ffrepas["tot"] = floatval(number_format(htmlspecialchars($_POST["ffrepasTot"]), 2));

            $ffkilo = array();
            $ffkilo['id'] = $expense['fraisforfait'][2]['id'];
            $ffkilo["l"] = htmlspecialchars($_POST["ffkilo"]);
            $ffkilo["qte"] = intval(htmlspecialchars($_POST["ffkiloQte"]));
            $ffkilo["m"] = floatval(number_format(htmlspecialchars($_POST["ffkiloM"]), 2));
            $ffkilo["tot"] = floatval(number_format(htmlspecialchars($_POST["ffkiloTot"]), 2));

            $i = 0;
            $fraisHorsForfait = array();
            $tot = $ffnuite["tot"] + $ffrepas["tot"] + $ffkilo["tot"];

            while(isset($expense['fraishorsforfait'][$i])){
                $idFraisHorsForfait = $expense['fraishorsforfait'][$i]['id'];
                $fraisHorsForfait[$i]=[$idFraisHorsForfait, $_POST['fhdate'.$idFraisHorsForfait], $_POST['fhlib'.$idFraisHorsForfait], $_POST['fhM'.$idFraisHorsForfait]];
                $tot+=$_POST['fhM'.$idFraisHorsForfait];
                $i++;
            }

            $expenseModel = new ExpenseModel();
            $expenseModel->editExpense( $expense['fichedefrais']['id'], $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait, $tot);
            $expense = $expenseModel->getById($_GET['id']);
        }

        if(isset($_POST["etat"])){
            $idState = htmlspecialchars($_POST["etat"]);
            $expenseModel->changeState($idState, $expense['fichedefrais']['id']);
            $currentState = $expenseModel->getStateBy($idState);
        }

        $this->render('expense/edit.php', [
            'expense' => $expense,
            'states'  => $states,
            'currentState' => $currentState
        ]);
        return $this;
    }

    /**
     * Delete the expense associate to the id in parameter GET
     *
     * @return void
     */
    public function delete(): void
    {
        session_start();

        if (!isset($_SESSION['id']) || $_SESSION['role'] != "visiteur") {
            header("Location: ".$this->linkTo("login"));
            exit; 
        }
        
        $expenseModel = new ExpenseModel();

        if(!isset($_GET['id']) || !$expenseModel->getAccessByUser($_SESSION['id'], $_GET['id'])){
            header("Location: ".$this->linkTo("expense"));
            exit; 
        }

        $expenseModel->delete($_GET['id']);

        header("Location: ".$this->linkTo("expense"));
        exit;

    }

}