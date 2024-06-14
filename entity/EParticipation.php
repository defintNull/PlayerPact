<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EParticipation implements FInterface
{
    private $id;
    private $userId;
    private $postTeamId;

    public function __construct($userId, $postTeamId)
    {
        $this->id = 0;
        $this->userId = $userId;
        $this->postTeamId = $postTeamId;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "userId" => $this->userId,
            "postTeamId" => $this->postTeamId
        );
        return $v;
    }

}
?>