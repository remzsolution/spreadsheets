<?php
include "context.php";

var_dump($_SESSION);

if (GET("drop")) {
    session_destroy();
}
