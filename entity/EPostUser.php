<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");
class EPostUser implements FInterface
{

    private $id;
    private $postId;
    private $type;
    private $userId;

    public function __construct($id, $postId, $type, $userId)
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->type = $type;
        $this->userId = $userId;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPostId()
    {
        return $this->postId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getUserId()
    {
        return $this->userId;
    }

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
