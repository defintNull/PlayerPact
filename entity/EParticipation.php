<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Participation object
 *
 * Entity Class for Participation object
 *
 * @package Playerpact\Entity
 */
class EParticipation implements FInterface
{
    private $id;
    private $userId;
    private $postTeamId;

    /**
     * Constructor for Participation object
     *
     * Create instance of a Participation object
     *
     * @param int $userId The id of the user related
     * @param int $postTeamId The id of the teamPost related
     * 
     */
    public function __construct($userId, $postTeamId)
    {
        $this->id = 0;
        $this->userId = $userId;
        $this->postTeamId = $postTeamId;
    }

    /**
     * Return userId of Participation object
     *
     * Return userId of Participation object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return postTeamId of Participation object
     *
     * Return id of Participation object
     * 
     * @return int
     * 
     */
    public function getPostTeamId()
    {
        return $this->postTeamId;
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
            "userId" => $this->userId,
            "postTeamId" => $this->postTeamId
        );
        return $v;
    }

}
