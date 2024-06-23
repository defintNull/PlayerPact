<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for InterestList object
 *
 * Entity Class for InterestList object
 *
 * @package Playerpact\Entity
 */
class EInterestList implements FInterface
{

    private $id;
    private $userId;
    private $postSaleId;

    /**
     * Constructor for InterestList object
     *
     * Create instance of a InterestList object
     *
     * @param int $userId The id of the user related
     * @param int $postId The id of the salepost related
     * 
     */
    public function __construct($userId, $postSaleId)
    {
        $this->id = 0;
        $this->userId = $userId;
        $this->postSaleId = $postSaleId;
    }

    /**
     * Return userId of InterestList object
     *
     * Return userId of InterestList object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Return postSaleId of InterestList object
     *
     * Return postSaleId of InterestList object
     * 
     * @return int
     * 
     */
    public function getPostSaleId()
    {
        return $this->postSaleId;
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
            "postSaleId" => $this->postSaleId
        );
        return $v;
    }

}
