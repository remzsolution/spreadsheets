<?php
session_start();
require_once "autoloader.php";
require_once "constants.php";
require_once "utilities.php";


$securityFilter = new SecurityFilter();

$authorized = $securityFilter->isAccessGranted(getLoggedInUser(), getRequestedPageName());
if (!$authorized) {
    registerUnauthorizedRequest(getRequestedPageName());
    redirect("login.php");
}