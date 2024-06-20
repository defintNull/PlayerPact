<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EModerationResult implements FInterface
{
    private $id;
    private $reportId;
    private $modId;
    private $description;
    private $datetime;

    public function __construct(int $id, int $reportId, int $modId, string $description, $datetime) {
        $this->id = $id;
        $this->reportId = $reportId;
        $this->modId = $modId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "reportId" => $this->reportId,
            "modId" => $this->modId,
            "description" => $this->description,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
