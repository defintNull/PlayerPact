<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EText implements FInterface
{

    private $id;
    private $postStandardId;
    private $userId;
    private $description;
    private $datetime;

    public function __construct(int $id, int $postStandardId, int $userId, string $description, string $datetime)
    {
        $this->id = $id;
        $this->postStandardId = $postStandardId;
        $this->userId = $userId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getpostStandardId()
    {
        return $this->postStandardId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateTime()
    {
        return $this->datetime;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "postStandardId" => $this->postStandardId,
            "userId" => $this->userId,
            "description" => $this->description,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
