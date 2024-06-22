<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

/**
 * Entity Class for Report object
 *
 * Entity Class for Report object
 *
 * @package Playerpact\Entity
 */
class EReport implements FInterface
{

    private $id;
    private $userId;
    private $idToReport;
    private $type;
    private $description;
    private $datetime;
    private $status;

    /**
     * Constructor for Report object
     *
     * Create instance of a Report object
     *
     * @param int $id The id of the object
     * @param int $userId The id of the user related
     * @param int $idToReport The id of the post related
     * @param string $type The type of the post related
     * @param string $description The description of the object
     * @param string $datetime The date of creation of the object
     * @param string $status The status of the object
     * 
     */
    public function __construct(int $id, int $userId, int $idToReport, string $type, string $description, $datetime, string $status = "received")
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->type = $type;
        $this->idToReport = $idToReport;
        $this->description = $description;
        $this->datetime = $datetime;
        $this->status = $status;
    }

    /**
     * Return id of Report object
     *
     * Return id of Report object
     * 
     * @return int
     * 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Return userId of Report object
     *
     * Return userId of Report object
     * 
     * @return int
     * 
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Return idToReport of Report object
     *
     * Return idToReport of Report object
     * 
     * @return int
     * 
     */
    public function getIdToReport() {
        return $this->idToReport;
    }

    /**
     * Return type of Report object
     *
     * Return type of Report object
     * 
     * @return string
     * 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Return description of Report object
     *
     * Return description of Report object
     * 
     * @return string
     * 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Return datetime of Report object
     *
     * Return datetime of Report object
     * 
     * @return string
     * 
     */
    public function getDateTime() {
        return $this->datetime;
    }

    /**
     * Return status of Report object
     *
     * Return status of Report object
     * 
     * @return string
     * 
     */
    public function getStatus() {
        return $this->status;
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
            "idToReport" => $this->idToReport,
            "type" => $this->type,
            "description" => $this->description,
            "status" => $this->status,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
