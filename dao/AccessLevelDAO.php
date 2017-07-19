<?php


class AccessLevelDAO extends GenericDao
{

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param $object
     * @param bool $returnLastInsertId
     * @return mixed
     */
    public function save($object, $returnLastInsertId = false)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $object
     * @return mixed
     */
    public function update($object)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $row
     * @return mixed
     */
    protected function buildOne($row)
    {
        // TODO: Implement buildOne() method.
    }

    /**
     * @param $condition
     * @param int $offset
     * @param int $limit
     * @param string $order
     * @return mixed
     */
    protected function createFetchQuery($condition, $offset = 0, $limit = 1000000, $order = "")
    {
        // TODO: Implement createFetchQuery() method.
    }

    private function createGetByUserIdQuery($userId) {
        return "";
    }
}