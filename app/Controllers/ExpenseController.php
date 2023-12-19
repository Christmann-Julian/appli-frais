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

            while(isset($_POST['fhdate'.$i]) && isset($_POST['fhlib'.$i]) && isset($_POST['fhM'.$i])){
                $fraisHorsForfait[$i]=[$_POST['fhdate'.$i], $_POST['fhlib'.$i], $_POST['fhM'.$i]];
                $i++;
            }

            $expenseModel = new ExpenseModel();
            $expenseModel->CreateExpense( $_SESSION['id'], $ffnuite, $ffrepas, $ffkilo, $fraisHorsForfait);
        }

        $this->render('expense/add.php');
        return $this;
    }

}