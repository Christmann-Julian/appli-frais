<?php

/**
 * Handles routing of HTTP requests to the appropriate controllers
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

require('vendor/autoload.php');
require('config.php');

if(!isset($_REQUEST['page'])){
	$_REQUEST['page'] = 'login';
}

$page = $_REQUEST['page'];

switch($page){
	case 'login':{
        $controller = new App\Controllers\AuthController();
		$controller->login();
        break;
	}
	case 'logout':{
        $controller = new App\Controllers\AuthController();
		$controller->logout();
        break;
	}
	case 'home' :{
		$controller = new App\Controllers\HomeController();
		$controller->index();
        break;
	}default :{
		$controller = new App\Controllers\Controller();
		$controller->render("error404.php");
		break;
	}
}
