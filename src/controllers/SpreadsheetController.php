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
        if ($this->checkAuthorization($spreadsheet, getLoggedInUser()) !== true) {
            redirect("templates/401.php");
        }

        return $spreadsheet;
    }

    public function getDocumentJSON($id)
    {
        $spreadsheet = $this->shDAO->getById($id);
        if ($this->checkAuthorization($spreadsheet, getLoggedInUser()) !== true) {
            redirect("templates/401.php");
        }

        $document = [
            "id" => $spreadsheet->getId(),
            "name" => $spreadsheet->getName(),
            "content" => json_decode($spreadsheet->getContent()),
            "created" => date("d.m.Y H:i:s", $spreadsheet->getDateCreated()),
            "modified" => date("d.m.Y H:i:s", $spreadsheet->getDateModified())
        ];

        echo json_encode($document);
//
//        $sheetData = json_decode($spreadsheet->getContent());
//        var_dump($sheetData);
//        $sheetData = $this->removeCol($sheetData->data, 4);
//        var_dump($sheetData);

        exit;
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

    public function saveChanges($changes)
    {
        $changes = json_decode($changes);
        $spreadsheet = $this->shDAO->getById($changes->id);
        if ($this->checkAuthorization($spreadsheet, getLoggedInUser()) !== true) {
            redirect("templates/401.php");
        }

        $sheetData = json_decode($spreadsheet->getContent());

        for ($i = 0; $i < count($changes->data); $i++) {
            $posX = $changes->data[$i][0];
            $posY = $changes->data[$i][1];
            $newValue = $changes->data[$i][3];
            $sheetData->data[$posX][$posY] = $newValue;
        }

        $spreadsheet->setContent(json_encode($sheetData));
        $outcome = $this->shDAO->update($spreadsheet);

        echo $outcome;
    }

    public function updateStructure($json)
    {
        $json = json_decode($json);

        $id = $json->id;
        $event = $json->event;
        $change = $json->change;

        $spreadsheet = $this->shDAO->getById($id);
        if ($this->checkAuthorization($spreadsheet, getLoggedInUser()) !== true) {
            redirect("templates/401.php");
        }

        $sheetData = json_decode($spreadsheet->getContent());
        $encodedData = json_encode($this->$event($sheetData->data, $change));

        $spreadsheet->setContent("{\"data\" : $encodedData}");

        $outcome = $this->shDAO->update($spreadsheet);
        echo $outcome;
    }


    /*-----------------------------------------UPDATE STRUCTURE FUNCTIONS----------------------------------------------*/

    private function createCol($sheetData, $targetIndex)
    {
        for ($i = 0; $i < count($sheetData); $i++) {
            $localRes = [];
            for ($j = 0, $k = 0; $j < count($sheetData[$i]) + 1; $j++) {
                if ($j == $targetIndex) {
                    $localRes[$targetIndex] = "";
                } else {
                    $localRes[$j] = $sheetData[$i][$k++];
                }
            }

            $sheetData[$i] = $localRes;
        }

        return $sheetData;
    }

    private function removeCol($sheetData, $targetIndex)
    {
        for ($i = 0; $i < count($sheetData); $i++) {
            unset($sheetData[$i][$targetIndex]);

            $sheetData[$i] = array_values($sheetData[$i]);
        }

        return $sheetData;
    }

    private function createRow($sheetData, $targetIndex)
    {
        $res = [];
        for ($i = 0, $j = 0; $i < count($sheetData) + 1; $i++) {
            if ($i == $targetIndex) {
                $res[$i] = [];
            } else {
                $res[$i] = $sheetData[$j++];
            }
        }

        return $res;
    }

    private function removeRow($sheetData, $targetIndex)
    {
        unset($sheetData[$targetIndex]);
        return array_values($sheetData);
    }
}