<?php

function get($param)
{
    return $_GET[$param];
}

function post($param)
{
    return $_POST[$param];
}

function redirectAndExit($pageName)
{
    header("Location: pages/$pageName.php");
    exit;
}

function getAuthenticatedUser()
{
    return unserialize($_SESSION["user"]);
}

function saveAuthenticatedUser($user)
{
    $_SESSION["user"] = serialize($user);
}