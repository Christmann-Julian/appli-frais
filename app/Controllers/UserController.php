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

use App\Forms\FormValidation;
use App\Models\UserModel;

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

        $userModel = new UserModel();
        $user = $userModel->getById($_SESSION['id']);
        $errors = [];

        if(isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['city'])){
            $lastname = htmlspecialchars($_POST['lastName']);
            $firstname = htmlspecialchars($_POST['firstName']);
            $city = htmlspecialchars($_POST['city']);

            $formValidation = new FormValidation();

            if(!$formValidation->lengthValidation($lastname, 2, 50)){
                $errors['lastname'] = "Votre nom doit être compris entre 2 et 50 caractères.";
            }

            if(!$formValidation->lengthValidation($firstname, 2, 50)){
                $errors['firstname'] = "Votre prénom doit être compris entre 2 et 50 caractères.";
            }

            if(!$formValidation->lengthValidation($city, 2, 50)){
                $errors['city'] = "Votre ville doit être compris entre 2 et 50 caractères.";
            }

            if(empty($errors)){
                $userModel->updateProfile($_SESSION['id'], $lastname, $firstname, $city);
                $_SESSION['nom'] = $lastname;
                $_SESSION['prenom'] = $firstname;
                header("Location: ".$this->linkTo("user", "success=Votre profil a été modifié"));
                exit;
            }
        }

        if(isset($_POST['login'])){
            $login = htmlspecialchars($_POST['login']);

            $formValidation = new FormValidation();

            if(!$formValidation->lengthValidation($login, 2, 50)){
                $errors['login'] = "Votre identifiant doit être compris entre 2 et 50 caractères.";
            }

            if($_POST['password'] != ''){
                
                $password=htmlspecialchars($_POST['password']);
                $confirmPassword= htmlspecialchars($_POST['confirm-password']);
    
                if(!$formValidation->lengthValidation($password, 8, 50)){
                    $errors['password'] = "Votre mot de passe doit être compris entre 8 et 50 caractères.";
                }
    
                if($password != $confirmPassword){
                    $errors['confirm-password'] = "Vos mots de passe ne sont pas identiques.";
                }
    
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
                
            }else{
                $password = $user['mdp'];
            }

            if(empty($errors)){
                $userModel->updateCon($user['id'], $login, $password);
                header("Location: ".$this->linkTo("user", "success=Vos informations de connexion ont été modifiés"));
                exit;
            }
        }

        $this->render('user/index.php',[
            "user" => $user,
            "errors" => $errors
        ]);
        return $this;
    }

}