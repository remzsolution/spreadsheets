<?php
include "autoloader.php";
include "context.php";


$authController = new AuthenticationController();

if (post("login-submit")) {
    $authController->checkAuthent(post("username"), post("password"));
}

