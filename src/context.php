<?php

function get($param)
{
    return $_GET[$param];
}

function post($param)
{
    return $_POST[$param];
}

function redirectAndExit($url)
{
    header("Location: $url");
    exit;
}