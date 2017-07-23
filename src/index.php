<?php
include "autoloader.php";
include "context.php";

$authController = new AuthenticationController();

if (POST("login-submit")) {
    $authController->checkAuthent(POST("username"), POST("password"));
}

