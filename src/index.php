<?php
require_once "context.php";

$authController = new AuthenticationController();
$spreadsheetsController = new SpreadsheetController();

if (issetPOST("login-submit")) {
    $authController->checkAuthent(POST("username"), POST("password"));
} else if (issetGET("logout")) {
    $authController->userLogOut();
} else if (issetGET("opendoc")) {
    $spreadsheetsController->getDocument(GET('opendoc'));
} else if (issetGET("sheetsTable")) {
    $spreadsheetsController->getSpreadSheetsTable();
} else if (issetGET("editDoc")) {
    $spreadsheetsController->openEditor(GET('editDoc'));
} else {
    redirect("pages/login.php");
}
