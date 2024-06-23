<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for ChatUser object
 *
 * Entity Class for ChatUser object
 *
 * @package Playerpact\Entity
 */
class EChatUser implements FInterface
{

    private $id;
    private $chatId;
    private $userId;
    private $datetime;

    /**
     * Constructor for ChatUser object
     *
     * Create instance of a ChatUser object
     *
     * @param int $chatId The id of the chat
     * @param int $userId The id of the user
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $chatId, int $userId, string $datetime)
    {
        $this->id = 0;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->datetime = $datetime;
    }

    /**
     * Return chatId of ChatUser object
     *
     * Return chatId of ChatUser object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return userId of ChatUser object
     *
     * Return userId of ChatUser object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return datetime of ChatUser object
     *
     * Return datetime of ChatUser object
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
            "datetime" => $this->datetime
        );
        return $v;
    }
}
