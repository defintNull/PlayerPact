<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/view/VError.php");

class CError
{
    public function e404()
    {
        $view = new VError();
        $view->show();
    }
}
