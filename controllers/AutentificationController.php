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



     public function checkAutent($username, $pass){

         $user = $this->userDAO->getByUsername($username);

         if($user != null){

             if($user->getPassword()== $pass){
                 //Log
                 return true;
             }else{
                 return false;
             }


         }else{
             return false;
         }


     }

     public function registerUser($login, $password, $conf_pass, $full_name){

        if(isset($login) && isset($password) && isset($full_name)){

            if ($password == $conf_pass) {
                //Reg
            } else {
                //Pass do not match
            }


        }else{
        }
     }


     }