<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FInterface.php");

class EInterestList implements FInterface
{

    private $id;
    private $userId;
    private $postSaleId;

    public function __construct($userId, $postSaleId)
    {
        $this->id = 0;
        $this->userId = $userId;
        $this->postSaleId = $postSaleId;
    }

    public function getValues()
    {
        $v = array(
            "id" => $this->id,
            "userId" => $this->userId,
            "postSaleId" => $this->postSaleId
        );
        return $v;
    }

}
?>