<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
// use Model\Managers\CategoryManager;
// use Model\Managers\PostManager;
// use Model\Managers\TopicManager;
use Model\Managers\UserManager;



class SecurityController extends AbstractController implements ControllerInterface{

public function inscription() {
$user = new UserManager();

    if (isset($_POST['submitSignup'])) {
        $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
        $nickname= filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword= filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Si les filtres passent//
        if ($email && $nickname && $password) {
            $userManager = new UserManager();

            // Si le mail n'existe pas //
            if (!$userManager->findOneByEmail($email)) {
                //Si le pseudo n'existe pas //
                if (!$userManager->findOneByUser($nickname)) {
                    //Si les 2 mots de passe concordent et que le mot de passe à un longueur
                    if (($password ==$confirmPassword) and strlen($password) >= 8) {
                    }
                }
            }
        }
    }
}
public function connexion (){
    $userManager = new UserManager();
    if (isset($_POST['submitLogin'])) {
        $email= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
        $password= filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Si les filtres passent //
        if ($email &&$password) {
            //retrouver le mot de passe de l'utilisateur correspondant au mail
            $dbPass=$userManager->retrievePassword($email);
            //si le mot de passe est retrouvé

            if ($dbPass) {
                // recuperation du mot de passe
                $hash=$dbPass->getPassword();
                //retrouver l'utilisateur par son email
                $user=$userManager->findOneByEmail($email);

                //comparaison du hash de la base de données et le mot de passe renseigné
                if (password_verify($password, $hash)) {
                    // Si l'utilisateur n'est pas banni

                    if ($user->getStatus()) {
                        //placer l'utilisateur en Session
                        Session::setUser($user);
                        //initialisation d'un token pour toute la session user
                    }
                }
            }
        }
    }
}

}

