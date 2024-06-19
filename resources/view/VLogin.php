<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/View.php");

class VLogin extends View
{
    public function show(string $check = "true")
    {
        $this->smarty->assign("check", $check);
        $this->smarty->display("login/login.html");
    }

    public function registration($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("login/registration.html");
    }
}
