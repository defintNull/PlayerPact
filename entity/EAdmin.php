<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EPerson.php");

class EAdmin extends EPerson
{

    public function __construct($id, $username, $password, $name, $surname, $birthDate, $email, $image)
    {
        parent::__construct($id, $username, $password, $name, $surname, $birthDate, $email, $image);
    }

}
?>