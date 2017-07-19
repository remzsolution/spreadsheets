<?php

class UserDAO extends GenericDao
{

    private $accessLevelDAO;

    /**
     * UserDAO constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->accessLevelDAO = new AccessLevelDAO();
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getById($id)
    {
        $condition = "id = ?";
        return $this->fetchOne($this->createFetchQuery($condition), [$id]);
    }

    /**
     * @param $username string
     * @return string
     */
    public function getByUsername($username)
    {
        $condition = "username = ?";
        return $this->fetchOne($this->createFetchQuery($condition), [$username]);
    }

    /**
     * @param $fullName
     * @return User[]
     */
    public function getByFullName($fullName)
    {
        $condition = "username LIKE ?";
        return $this->fetchAll($this->createFetchQuery($condition), [$fullName]);
    }

    /**
     * @return User[]
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @param $object
     * @param bool $returnLastInsertId
     * @return boolean|int
     */
    public function save($object, $returnLastInsertId = false)
    {
        // TODO: Implement save() method.
    }

    /**
     *
     *
     * @param $object
     * @return boolean
     */
    public function update($object)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $row
     * @return User
     */
    protected function buildOne($row)
    {
        $user = new User();

        $user->setId($row["id"]);
        $user->setUsername($row["username"]);
        $user->setPassword($row["password"]);
        $user->setAccessLevels($this->accessLevelDAO->getByUserId($row["id"]));

        return $user;
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
        return "SELECT * FROM users
                WHERE {$condition}
                {$order}
                LIMIT {$offset}, {$limit}
                ";
    }

    /**
     * @param int $id
     * @return boolean
     */
    protected function deleteOne($id)
    {
        // TODO: Implement deleteOne() method.
    }
}