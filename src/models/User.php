<?php


class User
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var AccessLevel[]
     */
    private $accessLevels;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return AccessLevel[]
     */
    public function getAccessLevels(): array
    {
        return $this->accessLevels;
    }

    /**
     * @param AccessLevel[] $accessLevels
     */
    public function setAccessLevels(array $accessLevels)
    {
        $this->accessLevels = $accessLevels;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName."";
    }

    /**
     * @param $fullName
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }


    function __toString()
    {
        return var_dump($this)."";
    }

}