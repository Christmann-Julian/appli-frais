<?php

namespace App\Controllers;

class HomeController extends Controller
{
    /**
     * Return the view associate with the route home
     *
     * @return self
     */
    public function index():self
    {
        session_start();

        // if (!isset($_SESSION['id'])) {
        //     header("Location: ".$this->linkTo("auth.login"));
        //     exit; 
        // }

        $this->render('home/index.php');
        return $this;
    }

}