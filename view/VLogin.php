<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/view/View.php");

class VLogin extends View
{
    public function show(string $check = "true", $date = "")
    {
        $this->smarty->assign("check", $check);
        $this->smarty->assign("banDate", $date);
        $this->smarty->display("login/login.html");
    }

    public function registration($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("login/registration.html");
    }
}
