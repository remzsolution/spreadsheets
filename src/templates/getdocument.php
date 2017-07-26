<?php

require_once(__DIR__."/../context.php");

if (empty($spreadsheet)) {
    exit;
}

/** @var Spreadsheet $spreadsheet */
$document = [
    "id" => $spreadsheet->getId(),
    "name" => $spreadsheet->getName(),
    "content" => $spreadsheet->getContent(),
    "created" => date("d.m.Y H:i:s", $spreadsheet->getDateCreated()),
    "modified" => date("d.m.Y H:i:s", $spreadsheet->getDateModified())
];

echo json_encode($document);
exit;