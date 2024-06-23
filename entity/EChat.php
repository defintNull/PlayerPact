<?php
include_once realpath(__DIR__."/../foundation/FInterface.php");

/**
 * Entity Class for Chat object
 *
 * Entity Class for Chat object
 *
 * @package Playerpact\Entity
 */
class EChat implements FInterface
{

    private $id;
    private $postId;
    private $postType;
    private $datetime;

    /**
     * Constructor for Chat object
     *
     * Create instance of a Chat object
     *
     * @param int $id The id of the object
     * @param int $postId The id of the post related
     * @param string $postType The type of the post related
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $id = 0, int $postId, string $postType, string $datetime)
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->postType = $postType;
        $this->datetime = $datetime;
    }

    /**
     * Return id of Chat object
     *
     * Return id of Chat object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return postId of Chat object
     *
     * Return postId of Chat object
     * 
     * @return int
     * 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Return postType of Chat object
     *
     * Return postType of Chat object
     * 
     * @return string
     * 
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Return datetime of Chat object
     *
     * Return datetime of Chat object
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
            "postId" => $this->postId,
            "postType" => $this->postType,
            "datetime" => $this->datetime
        );
        return $v;
    }

}
