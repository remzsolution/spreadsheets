<?php


class UserDAO extends dao\GenericDao
{

    protected function initOther()
    {
        // TODO: Implement initOther() method.
    }

    /**
     * @param $id
     * @param $fullFetch
     * @return mixed
     */
    public function getById($id, $fullFetch = false)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param $fullFetch
     * @return mixed
     */
    public function getAll($fullFetch = false)
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param $object
     * @return mixed
     */
    public function save($object)
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
     * @param $fullFetch
     * @return mixed
     */
    protected function buildOne($row, $fullFetch)
    {
        // TODO: Implement buildOne() method.
    }

    /**
     * @param $data
     * @param $pageSize
     * @param $fullFetch
     * @param $alike
     * @return mixed
     */
    public function getByCondition($data, $pageSize, $fullFetch, $alike)
    {
        // TODO: Implement getByCondition() method.
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
}