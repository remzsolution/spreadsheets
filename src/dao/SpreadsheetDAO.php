<?php

class SpreadsheetDAO extends GenericDao
{

    /**
     * Returns Spreadsheet object with given id or null if object not
     * found in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $id param has an empty or negative value.
     * @param $id
     * @return Spreadsheet|null
     */
    public function getById($id)
    {
        $condition = "s.id = ?";
        return $this->fetchSingle($this->createFetchQuery($condition), [$id]);
    }

    /**
     * Returns array containing all Spreadsheet objects found in the
     * database or empty if none found.
     *
     * @return Spreadsheet[]
     */
    public function getAll()
    {
        $condition = "TRUE";
        return $this->fetchMultiple($this->createFetchQuery($condition), []);
    }

    /**
     * Saves Spreadsheet object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param Spreadsheet $object
     * Object to be saved in the database.
     * @param bool $returnLastInsertId [optional]
     * Indicates return type of function. If set to true - function returns
     * ID of object just saved in the database. If set to false - function
     * returns boolean value, that states whether save operation was successful.
     * @return boolean|int
     * If returned boolean - value states whether save operation was successful.
     * If returned int - value indicates saved object's ID in the database.
     */
    public function save($object, $returnLastInsertId = false)
    {
        $spreadsheetSaveQuery = "INSERT INTO spreadsheets
                                 (NAME, content, user_access_level, date_created, date_modified, archived)
                                 VALUES (?, ?, ?, ?, ?, ?)";

        $timestamp = date("Y-m-d H:i:s");

        $data = [
            $object->getName(),
            $object->getContent(),
            $object->getAccessLevel()->getId(),
            $timestamp,
            $timestamp,
            $object->isArchived() ? 1 : 0
        ];

        return $this->executeQuery($spreadsheetSaveQuery, $returnLastInsertId, $data);
    }

    /**
     * Updates given object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param Spreadsheet $object
     * Object to be updated in the database.
     * @return boolean
     * Returns true on operation success, false otherwise.
     */
    public function update($object)
    {
        $updateQuery = "UPDATE spreadsheets
                        SET
                          name         = ?, content = ?, user_access_level = ?,
                          date_modified = ?, archived = ?
                        WHERE id = ?";

        $data = [
            $object->getName(),
            $object->getContent(),
            $object->getAccessLevel()->getId(),
            date("Y-m-d H:i:s"),
            $object->isArchived() ? 1 : 0,
            $object->getId()
        ];

        return $this->executeQuery($updateQuery, false, [$data]);
    }

    /**
     * Deletes Spreadsheet object from the database with given ID.
     *
     * @throws
     * Thrown if param $id value is empty or negative.
     * @param int $id
     * Spreadsheet object's ID to be removed from the database.
     * @return boolean
     * Returns true if operation succeeded, false otherwise.
     */
    public function delete($id)
    {
        $query = "DELETE FROM spreadsheets WHERE id = ?";
        return $this->executeQuery($query, false, [$id]);
    }

    /**
     * @param $row
     * @return Spreadsheet
     */
    protected function buildObject($row)
    {
        $spreadsheet = new Spreadsheet();
        $accessLevel = new AccessLevel();

        $spreadsheet->setId($row["s.id"]);
        $spreadsheet->setName($row["s.name"]);
        $spreadsheet->setContent($row["s.content"]);
        $spreadsheet->setArchived($row["s.archived"]);
        $spreadsheet->setAccessLevel($accessLevel);
        $spreadsheet->setDateCreated($row["s.date_created"]);
        $spreadsheet->setDateModified($row["s.date_modified"]);
        $spreadsheet->setArchived($row["s.archived"] ? true : false);

        $accessLevel->setId($row["al.id"]);
        $accessLevel->setName($row["al.name"]);

        return $spreadsheet;
    }

    /**
     * @param $condition
     * @param int $offset
     * @param int $limit
     * @param string $order
     * @return string
     */
    protected function createFetchQuery($condition, $offset = 0, $limit = 1000000, $order = "")
    {
        return "SELECT
                  s.id   AS 's.id',
                  s.name AS 's.name',
                  s.content AS 's.content',
                  al.id AS 'al.id',
                  al.name AS 'al.name',
                  s.date_created AS 's.date_created',
                  s.date_modified AS 's.date_modified',
                  s.archived AS 's.archived'
                FROM spreadsheets s, access_levels al 
                WHERE al.id = s.user_access_level 
                AND {$condition} {$order} 
                LIMIT {$offset}, {$limit}";
    }
}