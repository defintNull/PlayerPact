<?php

/**
 * Entity Class for BannedUser object
 *
 * Entity Class for BannedUser object
 *
 * @package Playerpact\Entity
 */
class EBannedUser
{

    private $id;
    private $moderationId;
    private $banDate;
    private $datetime;
    private $userId;

    /**
     * Constructor for BannedUser object
     *
     * Create instance of a BannedUser object
     *
     * @param int $id The id of the object
     * @param int $userId The id of the user related
     * @param int $moderationId The id of the moderation related
     * @param string $banDate The date of the ban
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $id, int $userId, int $moderationId, string $banDate, string $datetime) {
        $this->id = $id;
        $this->userId = $userId;
        $this->moderationId = $moderationId;
        $this->banDate = $banDate;
        $this->datetime = $datetime;
    }

    /**
     * Return id of BannedUser object
     *
     * Return id of BannedUser object
     * 
     * @return int
     * 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Return userId of BannedUser object
     *
     * Return userId of BannedUser object
     * 
     * @return int
     * 
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Return moderationId of BannedUser object
     *
     * Return moderationId of BannedUser object
     * 
     * @return int
     * 
     */
    public function getModerationId() {
        return $this->moderationId;
    }

    /**
     * Return banDate of BannedUser object
     *
     * Return banDate of BannedUser object
     * 
     * @return string
     * 
     */
    public function getBanDate() {
        return $this->banDate;
    }

    /**
     * Return datetite of BannedUser object
     *
     * Return datetite of BannedUser object
     * 
     * @return string
     * 
     */
    public function getDatetime() {
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
            "id"=> $this->id,
            "userId"=> $this->userId,
            "moderationId"=> $this->moderationId,
            "banDate"=> $this->banDate,
            "datetime"=> $this->datetime
        );
        return $v;
    }

}
