<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EReport implements FInterface
{

    private $id;
    private $userId;
    private $idToReport;
    private $type;
    private $description;
    private $date;

    public function __construct(int $id, int $userId, int $idToReport, string $type, string $description, $date)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->idToReport = $idToReport;
        $this->description = $description;
        $this->date = $date;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "userId" => $this->userId,
            "idToReport" => $this->idToReport,
            "type" => $this->type,
            "description" => $this->description,
            "datetime" => $this->date,
        );
        return $v;
    }
}
