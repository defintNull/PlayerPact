<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/view/View.php");

class VError extends View
{
    public function show()
    {
        $this->smarty->display("error/404.html");
    }
}
