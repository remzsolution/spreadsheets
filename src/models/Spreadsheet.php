<?php


/**
 * Class Spreadsheet
 */
class Spreadsheet
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $content;

    /**
     * @var AccessLevel
     */
    private $accessLevel;

    /**
     * @var boolean
     */
    private $archived;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateModified;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return AccessLevel
     */
    public function getAccessLevel(): AccessLevel
    {
        return $this->accessLevel;
    }

    /**
     * @param AccessLevel $accessLevel
     */
    public function setAccessLevel(AccessLevel $accessLevel)
    {
        $this->accessLevel = $accessLevel;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived)
    {
        $this->archived = $archived;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     */
    public function setDateCreated(string $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return string
     */
    public function getDateModified(): string
    {
        return $this->dateModified;
    }

    /**
     * @param string $dateModified
     */
    public function setDateModified(string $dateModified)
    {
        $this->dateModified = $dateModified;
    }



    public function __toString()
    {
        return var_dump($this)."";
    }
}