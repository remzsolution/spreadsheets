<?php

/**
 * Class UserDAO
 */
class UserDAO extends GenericDao
{

    /**
     * @var AccessLevelDAO
     */
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
     * Returns User object with given id or null if object not
     * found in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $id param has an empty or negative value.
     * @param $id
     * @return User|null
     */
    public function getById($id)
    {
        if (empty($id) || $id < 0) {
            throw new InvalidArgumentException("Param id has an empty or negative value");
        }

        $condition = "id = ?";
        return $this->fetchSingle($this->createFetchQuery($condition), [$id]);
    }

    /**
     * Returns User object with given username.
     *
     * @throws InvalidArgumentException
     * Thrown if param $username has empty value.
     * @param $username string
     * Username of User object to be retrieved from the database.
     * @return User|null
     * Returns User object with given username or null if object is not
     * present in the database.
     */
    public function getByUsername($username)
    {
        if (empty($username)) {
            throw new InvalidArgumentException("Param username has an empty value");
        }

        $condition = "username = ?";
        return $this->fetchSingle($this->createFetchQuery($condition), [$username]);
    }

    /**
     * Returns array containing User objects whose name properties contains
     * $fullName param.
     *
     * @param $fullName
     * Character sequence that should be present in name property of User objects.
     * @return User[]
     */
    public function getByFullName($fullName)
    {
        if (empty($fullName)) {
            throw new InvalidArgumentException("Param fullName has an empty value");
        }

        $condition = "username LIKE ?";
        return $this->fetchMultiple($this->createFetchQuery($condition), ["%$fullName%"]);
    }

    /**
     * Returns array containing all User objects found in the
     * database or empty if none found.
     *
     * @return User[]
     */
    public function getAll()
    {
        $condition = "TRUE";
        return $this->fetchMultiple($this->createFetchQuery($condition), []);
    }

    /**
     * Saves User object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param User $object
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

        $status = true;
        $insertUserQuery = "INSERT INTO users (username, password, full_name) VALUES (?, ?, ?)";

        $data = [
            $object->getUsername(),
            $object->getPassword(),
            $object->getFullName()
        ];

        $id = $this->executeQuery($insertUserQuery, true, $data);

        $insertAlQuery = "INSERT INTO users_access_levels 
                              (user_id, access_level_id) VALUES (?, ?)";
        if (count($object->getAccessLevels())) {
            foreach ($object->getAccessLevels() as $accessLevel) {
                $status = $status && $this->executeQuery(
                        $insertAlQuery, false, [$id, $accessLevel->getId()]);
            }
        }

        return ($status == true) ? $id : $status;
    }

    /**
     * Updates given object in the database.
     *
     * @throws InvalidArgumentException
     * Thrown if $object param has an empty value.
     * @param User $object
     * Object to be updated in the database.
     * @return boolean
     * Returns true on operation success, false otherwise.
     */
    public function update($object)
    {
        if (empty($object)) {
            throw new InvalidArgumentException("Param object has an empty value");
        }

        $outcome = true;
        $query = "UPDATE users SET password = ?, full_name = ?
                  WHERE id = ?";

        $data = [
            $object->getPassword(),
            $object->getFullName(),
            $object->getId()
        ];

        $updateSuccess = $this->executeQuery($query, false, $data);

        unset($data);
        $data[] = $object->getId();

        $query = "DELETE FROM users_access_levels WHERE user_id = ?";
        $deleteSuccess = $this->executeQuery($query, false, $data);

        if ($updateSuccess && $deleteSuccess) {
            $query = "INSERT INTO users_access_levels (user_id, access_level_id) VALUES (?, ?)";
            foreach ($object->getAccessLevels() as $level) {
                $outcome = $outcome && $this->executeQuery($query, false,
                        [$object->getId(), $level->getId()]);
            }
        }


        return $outcome && $updateSuccess && $deleteSuccess;
    }

    /**
     * Deletes User object from the database with given ID.
     *
     * @throws
     * Thrown if param $id value is empty or negative.
     * @param int $id
     * User object's ID to be removed from the database.
     * @return boolean
     * Returns true if operation succeeded, false otherwise.
     */
    public function delete($id)
    {
        // TODO: Implement deleteOne() method.
        return null;
    }

    /**
     * @param $row
     * @return User
     */
    protected function buildObject($row)
    {
        $user = new User();

        $user->setId($row["id"]);
        $user->setUsername($row["username"] || "");
        $user->setPassword($row["password"] || "");
        $user->setFullName($row["full_name"] || "");
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
                LIMIT {$offset}, {$limit}";
    }
}