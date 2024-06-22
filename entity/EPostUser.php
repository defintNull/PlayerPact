<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

/**
 * Entity Class for PostUser object
 *
 * Entity Class for PostUser object
 *
 * @package Playerpact\Entity
 */
class EPostUser implements FInterface
{

    private $id;
    private $postId;
    private $type;
    private $userId;

    /**
     * Constructor for PostUser object
     *
     * Create instance of a PostUser object
     *
     * @param int $id The id of the object
     * @param int $postId The id of the post related
     * @param string $postType The type of the post related
     * @param string $userId The id of the user related
     * 
     */
    public function __construct($id, $postId, $type, $userId)
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->type = $type;
        $this->userId = $userId;
    }

    /**
     * Return id of PostUser object
     *
     * Return id of PostUser object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return postId of PostUser object
     *
     * Return postId of PostUser object
     * 
     * @return int
     * 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Return type of PostUser object
     *
     * Return type of PostUser object
     * 
     * @return string
     * 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return userId of PostUser object
     *
     * Return userId of PostUser object
     * 
     * @return int
     * 
     */
    public function getUserId()
    {
        return $this->userId;
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
            "type" => $this->type,
            "userId" => $this->userId
        );
        return $v;
    }
}
