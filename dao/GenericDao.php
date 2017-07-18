<?php
namespace dao;

use PDO;

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
        $this->initOther();
    }


    protected abstract function initOther();

    /**
     * @param $id
     * @param $fullFetch
     * @return mixed
     */
    public abstract function getById($id, $fullFetch = false);

    /**
     * @param $fullFetch
     * @return mixed
     */
    public abstract function getAll($fullFetch = false);

    /**
     * @param $object
     * @return mixed
     */
    public abstract function save($object);


    /**
     * @param $object
     * @return mixed
     */
    public abstract function update($object);

    /**
     * @param $row
     * @param $fullFetch
     * @return mixed
     */
    protected abstract function buildOne($row, $fullFetch);

    /**
     * @param $data
     * @param $pageSize
     * @param $fullFetch
     * @param $alike
     * @return mixed
     */
    protected abstract function getByCondition($data, $pageSize, $fullFetch, $alike);

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
     * @param $fullFetch
     * @return mixed
     */
    protected function fetchOne($query, $data = null, $fullFetch)
    {
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->buildOne($row, $fullFetch);
        } else {
            return null;
        }
    }

    /**
     * @param $query
     * @param null $data
     * @param boolean $fullFetch
     * @return array
     */
    protected function fetchAll($query, $data = null, $fullFetch)
    {
        $objects = [];
        $statement = $this->pdo->prepare($query);
        if ($data == null) {
            $statement->execute();
        } else {
            $statement->execute($data);
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $objects[] = $this->buildOne($row, $fullFetch);
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