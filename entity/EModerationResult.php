<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

/**
 * Entity Class for ModerationResult object
 *
 * Entity Class for ModerationResult object
 *
 * @package Playerpact\Entity
 */
class EModerationResult implements FInterface
{
    private $id;
    private $reportId;
    private $modId;
    private $description;
    private $datetime;

    /**
     * Constructor for ModerationResult object
     *
     * Create instance of a ModerationResult object
     *
     * @param int $id The id of the object
     * @param int $reportId The id of the report related
     * @param int $modId The id of the mod related
     * @param string $description The description of the moderationResult
     * @param string $datetime The date of creation of the object
     * 
     */
    public function __construct(int $id, int $reportId, int $modId, string $description, $datetime) {
        $this->id = $id;
        $this->reportId = $reportId;
        $this->modId = $modId;
        $this->description = $description;
        $this->datetime = $datetime;
    }

    /**
     * Return id of ModerationResult object
     *
     * Return id of ModerationResult object
     * 
     * @return int
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return reportId of ModerationResult object
     *
     * Return reportId of ModerationResult object
     * 
     * @return int
     * 
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Return modId of ModerationResult object
     *
     * Return modId of ModerationResult object
     * 
     * @return int
     * 
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * Return description of ModerationResult object
     *
     * Return description of ModerationResult object
     * 
     * @return string
     * 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Return datetime of ModerationResult object
     *
     * Return datetime of ModerationResult object
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
            "reportId" => $this->reportId,
            "modId" => $this->modId,
            "description" => $this->description,
            "datetime" => $this->datetime
        );
        return $v;
    }
}
