<?php

function GET($param)
{
    return issetGET($param) ? $_GET[$param] : "";
}

function POST($param)
{
    return issetPOST($param) ? $_POST[$param] : "";
}

function redirect($pageName)
{
    header("Location: $pageName");
}

/**
 * Returns User object retrieved from session or null if none found.
 *
 * @return mixed
 */
function getLoggedInUser()
{
    if (isset($_SESSION["user"])) {
        return unserialize($_SESSION["user"]);
    } else {
        return null;
    }
}

/**
 * Saves User object in session as currently logged in.
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
    unset($_SESSION["last_request"]);
}

function issetGET($param)
{
    return isset($_GET[$param]);
}

function issetPOST($param)
{
    return isset($_POST[$param]);
}

function hasKey($value, $array) {
    return array_key_exists($value, $array);
}

function getRequestedPageName()
{
    return basename($_SERVER["PHP_SELF"]);
}

function registerUnauthorizedRequest($pageName)
{
    return $_SESSION["last_unauthorized_request"] = $pageName;
}

function getLastRequestedPage()
{
    return $_SESSION["last_unauthorized_request"];
}

function unsetLastRequestedPage()
{
    unset($_SESSION["last_unauthorized_request"]);
}

