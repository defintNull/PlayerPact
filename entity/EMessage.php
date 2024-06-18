<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EText.php");
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EMessage extends EText implements FInterface
{
    private $id;
    private $chatId;
    private $userId;
    private $description;
    private $datetime;

    public function __construct(int $id, int $chatId, int $userId, string $description, string $datetime)
    {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChatId()
    {
        return $this->chatId;
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
            "chatId" => $this->chatId,
            "userId" => $this->userId,
            "description" => $this->description,
            "datetime" => $this->datetime

        );
        return $v;
    }
}
