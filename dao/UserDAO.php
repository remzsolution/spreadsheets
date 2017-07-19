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
        return $this->fetchAll($this->createFetchQuery($condition), ["%$fullName%"]);
    }

    /**
     * @return User[]
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
        $condition = "TRUE";
        return $this->fetchAll($this->createFetchQuery($condition), []);
    }

    /**
     * @param User $object
     * @param bool $returnLastInsertId
     * @return boolean|int
     */
    public function save($object, $returnLastInsertId = false)
    {
        $status = true;
        $insertUserQuery = "INSERT INTO users (username, password, full_name) VALUES (?, ?, ?)";

        $data = [
            $object->getUsername(),
            $object->getPassword(),
            $object->getFullName()
        ];

        $id = $this->executeOne($insertUserQuery, true, $data);

        $insertAlQuery = "INSERT INTO users_access_levels 
                              (user_id, access_level_id) VALUES (?, ?)";
        if (count($object->getAccessLevels())) {
            foreach ($object->getAccessLevels() as $accessLevel) {
                $status = $status && $this->executeOne(
                        $insertAlQuery, false, [$id, $accessLevel->getId()]);
            }
        }

        return ($status == true) ? $id : $status;
    }

    /**
     *
     *
     * @param User $object
     * @return boolean
     */
    public function update($object)
    {
        // TODO: Implement update() method.
        $outcome = true;
        $query = "UPDATE users SET password = ?, full_name = ?
                  WHERE id = ?";

        $data = [
            $object->getPassword(),
            $object->getFullName(),
            $object->getId()
        ];

        $updateSuccess = $this->executeOne($query, false, $data);

        unset($data);
        $data[] = $object->getId();

        $query = "DELETE FROM users_access_levels WHERE user_id = ?";
        $deleteSuccess = $this->executeOne($query, false, $data);

        if ($updateSuccess && $deleteSuccess) {
            $query = "INSERT INTO users_access_levels (user_id, access_level_id) VALUES (?, ?)";
            foreach ($object->getAccessLevels() as $level) {
                $outcome = $outcome && $this->executeOne($query, false,
                        [$object->getId(), $level->getId()]);
            }
        }


        return $outcome && $updateSuccess && $deleteSuccess;
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
        $user->setFullName("".$row["full_name"]);
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