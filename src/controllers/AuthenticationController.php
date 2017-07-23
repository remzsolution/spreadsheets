<?php

/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 7/18/2017
 * Time: 9:31 PM
 */
class AuthenticationController
{

    /**
     * @var UserDAO
     */
    private $userDAO;

    /**
     * @var AccessLevelDAO
     */
    private $accessLevelDAO;


    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->accessLevelDAO = new AccessLevelDAO();
    }

    public function checkAuthent($username, $pass)
    {

        $user = $this->userDAO->getByUsername($username);

        if ($user != null) {
            $pass_ = hash("sha256", $pass);
            $password = $user->getPassword();
            if (hash_equals($password, $pass_)) {      // redirect to main page

                logInUser($user);
                redirectAndExit("main.php");
            } else {
               redirectAndExit("login.php?errors"); // redirect back with errors
            }


        } else {
            redirectAndExit("login.php?errors");  // redirect back with errors
        }


    }

    public function registerUser($login, $password, $conf_pass, $full_name)
    {
        $errors = [];
        if (isset($login) && isset($password) && isset($full_name)) {
            if ($password == $conf_pass) {
                $check_login = $this->userDAO->getByUsername($login);
                if ($check_login == null) {

                    $user_r = new User();
                    $user_r->setUsername($login);
                    $user_r->setPassword(hash("sha256", $password)); //TODO: Use SHA256 hashing algorithm instead of raw password
                    $user_r->setFullName($full_name);
                    $level = $this->accessLevelDAO->getById(1);
                    $user_r->setAccessLevels([$level]);
                    $this->userDAO->save($user_r);

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


}

?>