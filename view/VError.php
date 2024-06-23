<?php

require_once realpath(__DIR__."/../view/View.php");

class VError extends View
{
    public function show()
    {
        $this->smarty->display("error/404.html");
    }
}
