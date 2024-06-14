<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EPost implements FInterface
{

    private $id;
    private $userId;
    private $title;
    private $description;
    private $date;

    public function __construct($id, $userId, $title, $description, $date)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateTime()
    {
        return $this->date;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            'userId' => $this->userId,
            "title" => $this->title,
            "description" => $this->description,
            "datetime" => $this->date
        );
        return $v;
    }
}
?>