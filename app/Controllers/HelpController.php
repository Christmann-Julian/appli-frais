<?php

/**
 * HelpController
 * 
 * HelpController is a help controller
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

namespace App\Controllers;

class HelpController extends Controller
{
    /**
     * Return the view associate with the route help
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

        $this->render('help/index.php');
        return $this;
    }

}