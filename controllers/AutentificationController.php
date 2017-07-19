<?php

/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 7/18/2017
 * Time: 9:31 PM
 */
class AutentificationController
{

    /**
     * @var UserDAO
     */
    private $userDAO;

    /**
     * @var User
     */
    private $user_r;

    /**
     * @var AccessLevel
     */
    private $accessLevelDAO;

    /**
     * AutentificationController constructor.
     */
    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }


    public function checkAutent($username, $pass)
    {

        $user = $this->userDAO->getByUsername($username);

        if ($user != null) {

            if ($user->getPassword() == $pass) {
                //Log
                return true;
            } else {
                return false;
            }


        } else {
            return false;
        }


    }

    public function registerUser($login, $password, $conf_pass, $full_name)
    {
        $errors = [];
        if (isset($login) && isset($password) && isset($full_name)) {
            echo('Allright');
            if ($password == $conf_pass) {
                $check_login = $this->userDAO->getByUsername($login);
                if (isset($check_login)) {
                    $this->user_r->setUsername($login);
                    $this->user_r->setPassword($password);
                    $level = $this->accessLevelDAO->getById(1);
                    $this->user_r->setAccessLevels([$level]);
                    $user_save = $this->userDAO->save($this->user_r);
                    echo("$user_save");
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
        if (count($errors) > 0) {

            return $errors;
        }

    }

    function editUser($full_name, $login, $password, $id)
    {


    }

}

$test = new AutentificationController();
$test->registerUser( "ggg","asd", "asd", "a");
?>