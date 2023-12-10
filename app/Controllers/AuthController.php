<?php

/**
 * AuthController
 * 
 * AuthController is an authentication controller
 * 
 * @author Julian CHRISTMANN
 * @package jtg/appli-frais
 */

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{
    /**
     * Return the view associate with the route login
     *
     * @return self|void
     */
    public function login()
    {
        session_set_cookie_params([
            'httponly' => true,
            'samesite' => 'Strict',
        ]);
        session_start();

        $loginError = null;

        if (isset($_POST['Login']) && isset($_POST['Password'])) {

            $login = htmlspecialchars($_POST['Login']);
            $password = htmlspecialchars($_POST['Password']);
            $userModel = new UserModel();
            $user = $userModel->getByLogin($login);
        
            if ($user){
                if (password_verify($password, $user['mdp'])) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: ".$this->linkTo("expense"));
                    exit;
                }else{
                    $loginError = 'Identifiant ou mot de passe incorrect !';
                }
            }else{
                $loginError = 'Identifiant ou mot de passe incorrect !';
            }
            
        }

        $this->render('auth/login.php', [
            'loginError' => $loginError
        ]);
        return $this;
    }

    /**
     * Return the view associate with the route logout
     *
     * @return void
     */
    public function logout()
    {
        session_start();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header("Location: ".$this->linkTo("login"));
        exit;
    }
}