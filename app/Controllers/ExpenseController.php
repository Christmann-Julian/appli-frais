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

        $this->render('expense/index.php');
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

        $this->render('expense/add.php');
        return $this;
    }

}