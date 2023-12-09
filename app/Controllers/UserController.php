<?php

/**
 * UserController
 * 
 * UserController is a User controller
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

namespace App\Controllers;

class UserController extends Controller
{
    /**
     * Return the view associate with the route user
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

        $this->render('user/index.php');
        return $this;
    }

}