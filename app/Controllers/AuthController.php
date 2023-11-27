<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends Controller
{
    /**
     * Return the view associate with the route auth.login
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

        if (isset($_GET['Login']) && isset($_GET['Password'])) {

            //var_dump($_GET);

            $login = htmlspecialchars($_GET['Login']);
            $password = htmlspecialchars($_GET['Password']);
            $userModel = new UserModel();
            $user = $userModel->getByLogin($login);
        
            if ($user){
                if (password_verify($password, $user['password'])) {
                    $_SESSION['id'] = $user['id'];
                    header("Location: ".$this->linkTo("home"));
                    exit;
                }
            }
            
        }

        $this->render('auth/login.php');
        return $this;
    }

    /**
     * Return the view associate with the route auth.logout
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
        header("Location: ".$this->linkTo("auth.login"));
        exit;
    }
}