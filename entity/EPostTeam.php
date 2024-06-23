<?php
include_once realpath(__DIR__."/../entity/EPost.php");

/**
 * Entity PostTeam for Chat object
 *
 * Entity PostTeam for Chat object that extends EPost
 *
 * @package Playerpact\Entity
 */
class EPostTeam extends EPost
{

    private $nMaxPlayers;
    private $nPlayers;
    private $time;

    /**
     * Constructor for PostSale object
     *
     * Create instance of a PostSale object
     *
     * @param int $id The id of the object
     * @param int $userId The id of the user related
     * @param string $title The title of the PostSale
     * @param string $description The description of the PostSale
     * @param string $date The date of the PostSale
     * @param float $price The price of the PostSale
     * @param int $nMaxPlayers The number of max Players of the PostSale
     * @param int $nPlayers The number of Players of the PostSale
     * @param string $time The time of the PostSale
     * 
     */
    public function __construct($id, $userId, $title, $description, $date, $nMaxPlayers, $nPlayers, $time)
    {
        parent::__construct($id, $userId, $title, $description, $date);
        $this->nMaxPlayers = $nMaxPlayers;
        $this->nPlayers = $nPlayers;
        $this->time = $time;
    }

    /**
     * Return nMaxPlayers of PostTeam object
     *
     * Return nMaxPlayers of PostTeam object
     * 
     * @return int
     * 
     */
    public function getnMaxPlayers()
    {
        return $this->nMaxPlayers;
    }

    /**
     * Return nPlayers of PostTeam object
     *
     * Return nPlayers of PostTeam object
     * 
     * @return int
     * 
     */
    public function getNPlayers()
    {
        return $this->nPlayers;
    }

    /**
     * Return time of PostTeam object
     *
     * Return time of PostTeam object
     * 
     * @return string
     * 
     */
    public function getTime()
    {
        return $this->time;
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
        $v = parent::getValues();
        $v["nMaxPlayers"] = $this->nMaxPlayers;
        $v["nPlayers"] = $this->nPlayers;
        $v["time"] = $this->time;
        return $v;
    }

}
