<?php
include_once realpath(__DIR__."/../entity/EText.php");
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Message object
 *
 * Entity Class for Message object that extends EText
 *
 * @package Playerpact\Entity
 */
class EMessage extends EText implements FInterface
{
    private $id;
    private $chatId;
    private $userId;
    private $description;
    private $datetime;

    /**
     * Constructor for Message object
     *
     * Create instance of a Message object
     *
     * @param int $id The id of the object
     * @param int $chatId The id of the chat related
     * @param int $userId The id of the user related
     * @param string $description The description of the message
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $id, int $chatId, int $userId, string $description, string $datetime)
    {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    /**
     * Return id of Message object
     *
     * Return id of Message object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return chatId of Message object
     *
     * Return chatId of Message object
     * 
     * @return int
     * 
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * Return userId of Message object
     *
     * Return userId of Message object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return description of Message object
     *
     * Return description of Message object
     * 
     * @return string
     * 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return datetime of Message object
     *
     * Return datetime of Message object
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
            "chatId" => $this->chatId,
            "userId" => $this->userId,
            "description" => $this->description,
            "datetime" => $this->datetime

        );
        return $v;
    }
}
