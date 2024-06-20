<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/View.php");

class VUser extends View
{
    public function showHome($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("everyone/home.html");
    }

    public function showProfile($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "postUser");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    public function showSavedPosts($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "savedPosts");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    public function showTeams($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "participations");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("user/profilePage.html");
    }

    public function showPrivacyPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("user/privacy.html");
    }

    public function showChatSection($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "chat");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("user/chatSection.html");
    }

    public function showMessageSection($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->assign("type", "message");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));
        $this->smarty->display("user/messageSection.html");
    }
}
