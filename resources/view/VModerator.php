<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/View.php");

class VModerator extends View
{
    public function showHome($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("moderator/home.html");
    }

    public function showReports($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("moderator/reportsPage.html");
    }

    public function showUsers($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("moderator/usersPage.html");
    }
}
