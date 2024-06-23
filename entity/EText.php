<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Text object
 *
 * Entity Class for Text object
 *
 * @package Playerpact\Entity
 */
class EText implements FInterface
{

    private $id;
    private $postStandardId;
    private $userId;
    private $description;
    private $datetime;

    /**
     * Constructor for Text object
     *
     * Create instance of a Text object
     *
     * @param int $id The id of the object
     * @param int $postStandardId The id of the StandardPost related
     * @param int $userId The id of the user related
     * @param string $description The description of the object
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $id, int $postStandardId, int $userId, string $description, string $datetime)
    {
        $this->id = $id;
        $this->postStandardId = $postStandardId;
        $this->userId = $userId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    /**
     * Return id of Text object
     *
     * Return id of Text object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return postStandardId of Text object
     *
     * Return postStandardId of Text object
     * 
     * @return int
     * 
     */
    public function getpostStandardId()
    {
        return $this->postStandardId;
    }

    /**
     * Return userId of Text object
     *
     * Return userId of Text object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return description of Text object
     *
     * Return description of Text object
     * 
     * @return string
     * 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return datetime of Text object
     *
     * Return datetime of Text object
     * 
     * @return string
     * 
     */
    public function getDateTime()
    {
        return $this->datetime;
    }

    /**
     * Serialize object into array
     *
     * Serialize object into array with key=>value
     * 
     * @return array
     * 
     */
    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "postStandardId" => $this->postStandardId,
            "userId" => $this->userId,
            "description" => $this->description,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
