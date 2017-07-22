<?php


class AccessLevelDAO extends GenericDao
{

    /**
     * @param $id
     * @return AccessLevel
     */
    public function getById($id)
    {
        $condition = "id = ?";
        return $this->fetchOne($this->createFetchQuery($condition), [$id]);
    }

    /**
     * @param string $name
     * @return AccessLevel
     */
    public function getByName($name)
    {
        $condition = "name = ?";
        return $this->fetchOne($this->createFetchQuery($condition), [$name]);
    }

    /**
     * @param int $userId
     * @return AccessLevel[]
     */
    public function getByUserId($userId)
    {
        $query = "SELECT al.*
                FROM users u, access_levels al, users_access_levels ual
                WHERE ual.access_level_id = al.id
                AND ual.user_id = u.id
                AND u.id = ?";

        return $this->fetchAll($query, [$userId]);
    }

    /**
     * @return AccessLevel[]
     */
    public function getAll()
    {
        $condition = "TRUE";
        return $this->fetchAll($this->createFetchQuery($condition), []);
    }

    /**
     * @param AccessLevel $object
     * @param bool $returnLastInsertId
     * @return boolean|int
     */
    public function save($object, $returnLastInsertId = false)
    {
        $alInsertQuery = "INSERT INTO access_levels (name) VALUES (?)";

        $data =
            [
                $object->getName()
            ];

        return $this->executeOne($alInsertQuery, $returnLastInsertId, $data);
    }

    /**
     * @param AccessLevel $object
     * @return boolean
     */
    public function update($object)
    {
        $query = "UPDATE access_levels SET name = ? WHERE id = ?";
        $data = [
            $object->getName(),
            $object->getId()
        ];

        return $this->executeOne($query, false, $data);
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function deleteOne($id)
    {
        $query = "DELETE FROM access_levels WHERE id = ?";
        $data = [$id];

        return $this->executeOne($query, false, $data);
    }

    /**
     * @param $row
     * @return AccessLevel
     */
    protected function buildOne($row)
    {
        $level = new AccessLevel();

        $level->setId($row["id"]);
        $level->setName($row["name"]);

        return $level;
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
        return "SELECT * FROM access_levels
                WHERE {$condition}
                {$order}
                LIMIT {$offset}, {$limit}";
    }

    /**
     * @param int $id
     * @return boolean
     */

}