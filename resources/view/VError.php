<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/View.php");

class VError extends View
{
    public function show()
    {
        $this->smarty->display("404.html");
    }
}
