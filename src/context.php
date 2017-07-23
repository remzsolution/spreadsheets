<?php
session_start();

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
    header("Location: pages/$pageName");
    exit;
}

/**
 * Returns User object retrieved from session.
 *
 * @return mixed
 */
function getAuthenticatedUser()
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