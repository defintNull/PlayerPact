<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/View.php");

class VAdmin extends View
{
    public function showHome($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/adminHome.html");
    }

    public function showModsPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/modsPage.html");
    }

    public function showSQLPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/SQLPage.html");
    }
}
