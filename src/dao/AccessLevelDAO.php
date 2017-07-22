<?php


class AccessLevelDAO extends GenericDao
{

    /**
     * Returns AccessLevel object with given id or null if object not
     * found in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $id param has an empty or negative value.
     * @param $id
     * ID of AccessLevel object to be fetched from the database.
     * @return AccessLevel|null
     */
    public function getById($id)
    {
        if (empty($id) || $id < 0) {
            throw new InvalidArgumentException("Param id has invalid value.");
        }

        $condition = "id = ?";
        return $this->fetchSingle($this->createFetchQuery($condition), [$id]);
    }

    /**
     * Returns AccessLevel object with given name.
     * 
     * @throws InvalidArgumentException 
     * Thrown if $name param has an empty value.
     * @param string $name
     * Name of AccessLevel object to be fetched from the database.
     * @return AccessLevel|null
     * Returns AccessLevel object or null if not found in the database.
     */
    public function getByName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException("Param name has an empty value");
        }

        $condition = "name = ?";
        return $this->fetchSingle($this->createFetchQuery($condition), [$name]);
    }

    /**
     * Returns array containing AccessLevel objects of User's object with given ID. 
     *
     * @throws InvalidArgumentException
     * Thrown if $userId param value is empty or negative.
     * @param int $userId
     * ID of User object.
     * @return AccessLevel[]
     */
    public function getByUserId($userId)
    {
        if (empty($userId) || $userId < 0) {
            throw new InvalidArgumentException("Param userId has invalid value.");
        }

        $query = "SELECT al.*
                FROM users u, access_levels al, users_access_levels ual
                WHERE ual.access_level_id = al.id
                AND ual.user_id = u.id
                AND u.id = ?";

        return $this->fetchMultiple($query, [$userId]);
    }

    /**
     * Returns array containing all AccessLevel objects stored in the database.
     * 
     * @return AccessLevel[]
     */
    public function getAll()
    {
        $condition = "TRUE";
        return $this->fetchMultiple($this->createFetchQuery($condition), []);
    }

    /**
     * Saves AccessLevel object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param AccessLevel $object
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
        if (empty($object)) {
            throw new InvalidArgumentException("Param object has an empty value");
        }

        $alInsertQuery = "INSERT INTO access_levels (name) VALUES (?)";

        $data = [$object->getName()];

        return $this->executeQuery($alInsertQuery, $returnLastInsertId, $data);
    }
    
    /**
     * Updates given object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param AccessLevel $object
     * Object to be updated in the database.
     * @return boolean
     * Returns true - on operation success, false - otherwise.
     */
    public function update($object)
    {
        $query = "UPDATE access_levels SET name = ? WHERE id = ?";
        $data = [
            $object->getName(),
            $object->getId()
        ];

        return $this->executeQuery($query, false, $data);
    }

    /**
     * Deletes AccessLevel object from the database with given ID.
     *
     * @throws
     * Thrown if param $id value is empty or negative.
     * @param int $id
     * AccessLevel object's ID to be removed from the database.
     * @return boolean
     * Returns true if operation succeeded, false otherwise.
     */
    public function delete($id)
    {
        $query = "DELETE FROM access_levels WHERE id = ?";
        $data = [$id];

        return $this->executeQuery($query, false, $data);
    }

    /**
     * @param $row
     * @return AccessLevel
     */
    protected function buildObject($row)
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

}