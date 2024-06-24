<?php

require_once realpath(__DIR__."/../utility/USession.php");
require_once realpath(__DIR__."/../foundation/FDB.php");
require_once realpath(__DIR__."/../controllers/CPost.php");
require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of Post sections
 *
 * Manage the View layer of Post sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VPost extends View
{
    /**
     * Show PostSection section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function show($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("date", date("Y/m/d")); // Date
        $this->smarty->assign("time", date("H:i:s")); // Time
        $this->smarty->display("everyone/postSection.html");
    }

    /**
     * Show Comment section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showComments($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "comment");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("everyone/post.html");
    }

    /**
     * Show PostCreation section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showSelectNewPost($info)
    {
        $this->smarty->assign("info", $info);
        $this->smarty->display("user/selectNewPost.html");
    }

    /**
     * Show Image section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showImage($imageURL)
    {
        $this->smarty->assign("image", $imageURL);
        $this->smarty->display("everyone/fullscreenImage.html");
    }

    /**
     * Show ReportPage section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showReportPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("user/reportPage.html");
    }
}