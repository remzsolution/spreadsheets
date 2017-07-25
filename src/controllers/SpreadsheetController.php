<?php

/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 7/24/2017
 * Time: 15:16
 */
class SpreadsheetController
{

    private $shDAO;

    public function __construct()
    {
        $this->shDAO = new SpreadsheetDAO();
    }

    public function getSpreadSheetsTable()
    {
        $spreadsheets = $this->shDAO->getAll();
        $pages = ((count($spreadsheets) / SPREADHSEET_TABLE_SIZE)
            + (count($spreadsheets) % SPREADHSEET_TABLE_SIZE));
        echo $pages;
        require_once (__DIR__."/../templates/spreadsheet_table.php");
    }


}