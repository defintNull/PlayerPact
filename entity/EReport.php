<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EReport implements FInterface
{

    private $id;
    private $userId;
    private $idToReport;
    private $type;
    private $description;
    private $datetime;

    public function __construct(int $id, int $userId, int $idToReport, string $type, string $description, $datetime)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->idToReport = $idToReport;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getIdToReport() {
        return $this->idToReport;
    }

    public function getType() {
        return $this->type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateTime() {
        return $this->datetime;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "userId" => $this->userId,
            "idToReport" => $this->idToReport,
            "type" => $this->type,
            "description" => $this->description,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
