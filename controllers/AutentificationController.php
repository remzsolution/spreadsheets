<?php
include "../autoloader.php";
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 7/18/2017
 * Time: 9:31 PM
 */
class AuthentificationController
{


    /**
     * @var UserDAO
     */
    private $userDAO;

    /**
     * @var User
     */


    /**
     * @var AccessLevelDAO
     */
    private $accessLevelDAO;

    public function checkAuthent($username, $pass)
    {
         $userDAO = new UserDAO();
        $user = $userDAO->getByUsername($username);

        if ($user != null) {

            if ($user->getPassword() == $pass) {
                //Log
                echo("True Log-In");
                return true;
            } else {
                echo("False Log-In");
                return false;
            }


        } else {
            echo("False Log-In");
            return false;
        }


    }

    public function registerUser($login, $password, $conf_pass, $full_name)
    {
        $errors = [];
        if (isset($login) && isset($password) && isset($full_name)) {
            echo('Allright');
            if ($password == $conf_pass) {
                $userDAO = new UserDAO();
                $accessLevelDAO = new AccessLevelDAO();
                $check_login = $userDAO->getByUsername($login);
                if ($check_login == null) {

                    $user_r = new User();
                    $user_r->setUsername($login);
                    $user_r->setPassword($password);
                    $user_r->setFullName($full_name);
                    $level = $accessLevelDAO->getById(1);
                    $user_r->setAccessLevels([$level]);
                    $userDAO->save($user_r);

                    //Register


                } else {
                    $errors['username'] = "This Username is Already Taken";
                    //Found  login
                }

            } else {
                $errors['password'] = "Passwords don`t match!";
                //Pass do not match
            }


        } else {
            if (!isset($login)) {
                $errors['username'] = "Login field can`t be empty!";
            }
            if (!isset($password)) {
                $errors['password'] = "Password field can`t be empty!";
            }
            if (!isset($conf_pass)) {
                $errors['conf_password'] = " Password Confirmation  field can`t be empty!";
            }

            // Empty textbox
        }


            return $errors;


    }

    function editUser($full_name, $login, $password, $id)
    {


    }

}

$test = new AuthentificationController();
var_dump($test->registerUser( "gkg","asd", "asd", "a"));
var_dump($test->checkAuthent( "kg","as2d"));
var_dump($test->checkAuthent( "gkg","asd"));
?>