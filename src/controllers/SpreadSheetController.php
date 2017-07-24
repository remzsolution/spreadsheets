<?php

/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 7/24/2017
 * Time: 15:16
 */
class SpreadSheetController
{
    public function __construct()
    {
        $this->shDAO = new SpreadsheetDAO();

    }

    public function getSpreadSheets()
    {

        $sprsheets = $this->shDAO->getAll();
        include "../templates/spreadsheet_table.php";



    }


}