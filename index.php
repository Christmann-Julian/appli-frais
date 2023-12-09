<?php

use App\Controllers\HelpController;

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
	case 'expense' :{
		$controller = new App\Controllers\ExpenseController();
		$controller->index();
        break;
	}case 'expense_add' :{
		$controller = new App\Controllers\ExpenseController();
		$controller->add();
        break;
	}case 'user' :{
		$controller = new App\Controllers\UserController();
		$controller->index();
        break;
	}case 'help' :{
		$controller = new HelpController();
		$controller->index();
        break;
	}default :{
		$controller = new App\Controllers\Controller();
		$controller->render("error404.php");
		break;
	}
}
