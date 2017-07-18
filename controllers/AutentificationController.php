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

             if($user->$password == $pass){
                 //Log
                 return true;
             }

         }else{
             return false;
         }


     }




}