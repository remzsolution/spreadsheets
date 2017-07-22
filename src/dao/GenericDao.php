<?php


/**
 * Class GenericDao
 * @package dao
 */
abstract class GenericDao
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * GenericDao constructor.
     */
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPdo();
    }

    /**
     * Returns {className} object with given id or null if object not
     * found in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $id param has an empty or negative value.
     * @param $id
     * @return {className}|null
     */
    public abstract function getById($id);

    /**
     * Returns array containing all {className} objects found in the
     * database or empty if none found.
     *
     * @return {className}[]
     */
    public abstract function getAll();

    /**
     * Saves {className} object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param {className} $object
     * Object to be saved in the database.
     * @param bool $returnLastInsertId [optional]
     * Indicates return type of function. If set to true - function returns
     * ID of object just saved in the database. If set to false - function
     * returns boolean value, that states whether save operation was successful.
     * @return boolean|int
     * If returned boolean - value states whether save operation was successful.
     * If returned int - value indicates saved object's ID in the database.
     */
    public abstract function save($object, $returnLastInsertId = false);

    /**
     * Updates given object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param {className} $object
     * Object to be updated in the database.
     * @return boolean
     * Returns true on operation success, false otherwise.
     */
    public abstract function update($object);

    /**
     * Deletes {className} object from the database with given ID.
     *
     * @throws
     * Thrown if param $id value is empty or negative.
     * @param int $id
     * {className} object's ID to be removed from the database.
     * @return boolean
     * Returns true if operation succeeded, false otherwise.
     */
    public abstract function delete($id);

    /**
     * @param $row
     * @return {className}
     */
    protected abstract function buildObject($row);

    /**
     * @param $condition
     * @param int $offset
     * @param int $limit
     * @param string $order
     * @return string
     */
    protected abstract function createFetchQuery($condition, $offset = 0, $limit = 1000000, $order = "");

    /**
     * @param $query
     * @param null $data
     * @return mixed
     */
    protected function fetchSingle($query, $data = null)
    {
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->buildObject($row);
        } else {
            return null;
        }
    }

    /**
     * @param $query
     * @param null $data
     * @return array
     */
    protected function fetchMultiple($query, $data = null)
    {
        $objects = [];
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $objects[] = $this->buildObject($row);
        }

        return $objects;
    }

    /**
     * @param string $query
     * @param $returnLastInsertId
     * @param null $data
     * @return boolean|int
     * @internal param $getId
     */
    protected function executeQuery($query, $returnLastInsertId, $data = null)
    {
        $statement = $this->pdo->prepare($query);
        $success = ($data == null) ? $statement->execute() : $statement->execute($data);

        if ($success && $returnLastInsertId) {
            return $this->pdo->lastInsertId();
        } else {
            DatabaseConnection::rollBack();
            return $success;
        }
    }
}