<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Post object
 *
 * Entity Class for Post object
 *
 * @package Playerpact\Entity
 */
class EPost implements FInterface
{

    private $id;
    private $userId;
    private $title;
    private $description;
    private $date;

    /**
     * Constructor for Chat object
     *
     * Create instance of a Chat object
     *
     * @param int $id The id of the object
     * @param int $userId The id of the user related
     * @param string $title The title of the post
     * @param string $description The description of the post
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct($id, $userId, $title, $description, $date)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
    }

    /**
     * Return id of Post object
     *
     * Return id of Post object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return UserId of Post object
     *
     * Return UserId of Post object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return title of Post object
     *
     * Return title of Post object
     * 
     * @return string
     * 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Return description of Post object
     *
     * Return description of Post object
     * 
     * @return string
     * 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return datetime of Post object
     *
     * Return datetime of Post object
     * 
     * @return string
     * 
     */
    public function getDateTime()
    {
        return $this->date;
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
            'userId' => $this->userId,
            "title" => $this->title,
            "description" => $this->description,
            "datetime" => $this->date
        );
        return $v;
    }
}
