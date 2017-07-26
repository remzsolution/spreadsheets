<?php
$configPath = stream_resolve_include_path(
    dirname(__FILE__)
    . DIRECTORY_SEPARATOR . ".."
    . DIRECTORY_SEPARATOR . "configs"
    . DIRECTORY_SEPARATOR . "config.ini");

define("CONFIG_FILE", ($configPath));
define("SPREADSHEET_TABLE_SIZE", 25);