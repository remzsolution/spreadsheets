<?php
require_once "context.php";

$authController = new AuthenticationController();
$spreadsheetsController = new SpreadsheetController();

if (issetPOST("login-submit")) {
    $authController->checkAuthent(POST("username"), POST("password"));
} else if (issetGET("logout")) {
    $authController->userLogOut();
} else if (issetGET("openDoc")) {
//    $spreadsheetsController->openDocument();
} else if (issetGET("sheetsTable")) {
    $spreadsheetsController->getSpreadSheetsTable();
} else {
    redirect("pages/login.php");
}
