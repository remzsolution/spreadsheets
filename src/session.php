<?php
include "context.php";

var_dump($_SESSION);

if (issetGET("drop")) {
    session_unset();
    session_destroy();
}
