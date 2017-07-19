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
        $this->pdo = DatabaseConnection::$pdo;
        echo $this->pdo == null . " Constructor";
    }


    /**
     * @param $id
     * @return mixed
     */
    public abstract function getById($id);

    /**
     * @return mixed
     */
    public abstract function getAll();


    /**
     * @param $object
     * @param bool $returnLastInsertId
     * @return mixed
     */
    public abstract function save($object, $returnLastInsertId = false);


    /**
     * @param $object
     * @return mixed
     */
    public abstract function update($object);


    /**
     * @param $row
     * @return mixed
     */
    protected abstract function buildOne($row);

    /**
     * @param $condition
     * @param int $offset
     * @param int $limit
     * @param string $order
     * @return mixed
     */
    protected abstract function createFetchQuery($condition, $offset = 0, $limit = 1000000, $order = "");


    /**
     * @param $query
     * @param null $data
     * @return mixed
     */
    protected function fetchOne($query, $data = null)
    {
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->buildOne($row);
        } else {
            return null;
        }
    }


    /**
     * @param $query
     * @param null $data
     * @return array
     */
    protected function fetchAll($query, $data = null)
    {
        $objects = [];
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $objects[] = $this->buildOne($row);
        }

        return $objects;
    }


    /**
     * @param string $query
     * @param $getId
     * @param null $data
     * @return mixed
     * @internal param $getId
     */
    protected function executeOne($query, $getId, $data = null)
    {
        $statement = $this->pdo->prepare($query);
        $status = ($data == null) ? $statement->execute() : $statement->execute($data);

        if ($status) {
            if ($getId) {
                return $this->pdo->lastInsertId();

            } else {
                return $status;
            }
        } else {
            DatabaseConnection::rollBack();
            return false;
        }
    }
}