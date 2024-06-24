<?php

require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of Admin sections
 *
 * Manage the View layer of Admin sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VAdmin extends View
{
    /**
     * Show Home section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showHome($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/home.html");
    }

    /**
     * Show ModCreationPgae section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showModCreationPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/modCreation.html");
    }

    /**
     * Show ModPage section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showModsPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "moderator");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("admin/modsPage.html");
    }

    /**
     * Show SQLPage section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showSQLPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("admin/SQLPage.html");
    }
}
