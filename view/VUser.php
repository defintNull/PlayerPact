<?php
require_once realpath(__DIR__."/../view/View.php");

/**
 * Manage View layer of User sections
 *
 * Manage the View layer of User sections configuring Smarty
 * and passing parameters for the html template
 *
 * @package Playerpact\View
 */
class VUser extends View
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
        $this->smarty->display("everyone/home.html");
    }

    /**
     * Show Profile section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showProfile($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "postUser");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    /**
     * Show SavedPosts section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showSavedPosts($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "savedPosts");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    /**
     * Show TeamPost section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showTeams($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "participations");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    /**
     * Show PrivacyPage section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showPrivacyPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("user/privacy.html");
    }

    /**
     * Show Chat section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showChatSection($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "chat");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("user/chatSection.html");
    }

    /**
     * Show Message section
     *
     * Pass template's parameters and show the html
     *
     * @param $param The array key=>value with the parameters for the template
     *
     * @return void
     * 
     */
    public function showMessageSection($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "message");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("user/messageSection.html");
    }
}
