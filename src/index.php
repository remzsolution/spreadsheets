<?php
include "autoloader.php";
include "context.php";


$authController = new AuthenticationController();

if (get("login-submit")) {
    $authController->checkAuthent(post("username"), post("password"));
}

