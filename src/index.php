<?php
require_once "context.php";

$authController = new AuthenticationController();

if (issetPOST("login-submit")) {
    $authController->checkAuthent(POST("username"), POST("password"));
} else if (issetGET("logout")) {
    $authController->userLogOut();
}
