<?php
require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of Moderator sections
 *
 * Manage the View layer of Moderator sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VModerator extends View
{
    /**
     * Show ModeratorHome section
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
        $this->smarty->display("moderator/home.html");
    }

    /**
     * Show Report section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showReports($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "report");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("moderator/reportsPage.html");
    }

    /**
     * Show Users section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showUsers($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "user");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("moderator/usersPage.html");
    }

    /**
     * Show ReportDetail section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showReportDetail($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("moderator/reportDetail.html");
    }

    /**
     * Show OldReport section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showOldReports($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "oldreport");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("moderator/oldReports.html");
    }

    /**
     * Show OldReportDetail section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showOldReportDetail($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("moderator/oldreportDetail.html");
    }
}
