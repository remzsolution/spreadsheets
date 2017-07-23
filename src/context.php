<?php
session_start();

function GET($param)
{
    return $_GET[$param];
}

function POST($param)
{
    return $_POST[$param];
}

function redirectAndExit($pageName)
{
    header("Location: pages/$pageName");
    exit;
}

/**
 * Returns User object retrieved from session.
 *
 * @return mixed
 */
function getLoggedInUser()
{
    return unserialize($_SESSION["user"]);
}

/**
 * Saves currently authenticated User object in session.
 *
 * @param User $user
 */
function logInUser($user)
{
    $_SESSION["user"] = serialize($user);
}

function logOutUser()
{
    unset($_SESSION["user"]);
}

function issetGET($param)
{
    return isset($_GET[$param]);
}

function issetPOST($param)
{
    return isset($_POST[$param]);
}