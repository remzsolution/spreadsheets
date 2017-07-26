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
        $pages = floor((count($spreadsheets) / SPREADSHEET_TABLE_SIZE)
            + (count($spreadsheets) % SPREADSHEET_TABLE_SIZE));
        require_once(__DIR__ . "/../templates/spreadsheet_table.php");
    }

    public function getDocument($id)
    {
        $spreadsheet = $this->shDAO->getById($id);
        if ($this->checkAuthorization($spreadsheet, getLoggedInUser()) === true) {
            require_once(__DIR__ . "/../templates/getdocument.php");
        } else {
            redirect("templates/401.php");
        }
    }

    /**
     * @param Spreadsheet $spreadsheet
     * @param User $user
     * @return bool
     */
    public function checkAuthorization($spreadsheet, $user)
    {
        foreach ($user->getAccessLevels() as $level) {
            if ($spreadsheet->getAccessLevel()->getId() === $level->getId()) {
                return true;
            }
        }

        return false;
    }

}