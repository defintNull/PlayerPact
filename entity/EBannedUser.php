<?php

class EBannedUser
{

    private $id;
    private $moderationId;
    private $banDate;
    private $datetime;
    private $userId;

    public function __construct($id, $userId, $moderationId, $banDate, $datetime) {
        $this->id = $id;
        $this->userId = $userId;
        $this->moderationId = $moderationId;
        $this->banDate = $banDate;
        $this->datetime = $datetime;
    }

    public function getValues()
    {
        $v = array(
            "id"=> $this->id,
            "userId"=> $this->userId,
            "moderationId"=> $this->moderationId,
            "banDate"=> $this->banDate,
            "datetime"=> $this->datetime
        );
        return $v;
    }

}
