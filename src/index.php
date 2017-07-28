<?php
require_once "context.php";

$authController = new AuthenticationController();
$spreadsheetsController = new SpreadsheetController();

if (issetPOST("login-submit")) {
    $authController->checkAuthent(POST("username"), POST("password"));
} else if (issetGET("logout")) {
    $authController->userLogOut();
} else if (issetGET("getdoc")) {
    $spreadsheetsController->getDocumentJSON(GET("getdoc"));
} else if (issetGET("sheetsTable")) {
    $spreadsheetsController->getSpreadSheetsTable();
} else if (issetPOST("autosave")) {
  $spreadsheetsController->saveChanges(POST("autosave"));
} else if (issetPOST("updatestructure")) {
    $spreadsheetsController->updateStructure(POST("updatestructure"));
} else {
    redirect("pages/login.php");
}
