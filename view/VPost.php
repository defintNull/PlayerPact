<?php

require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/smartyloader.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FDB.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/controllers/CPost.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/view/View.php");

class VPost extends View
{
    public function show($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("date", date("Y/m/d")); // Date
        $this->smarty->assign("time", date("H:i:s")); // Time
        $this->smarty->display("everyone/postSection.html");
    }

    public function showComments($params)
    {
        $this->assignSmartyParams($params);

        $this->smarty->assign("type", "comment");
        $this->smarty->assign("date", date("Y/m/d"));
        $this->smarty->assign("time", date("H:i:s"));

        $this->smarty->display("everyone/post.html");
    }

    public function showSelectNewPost($info)
    {
        $this->smarty->assign("info", $info);
        $this->smarty->display("user/selectNewPost.html");
    }

    public function showImage($imageURL)
    {
        $this->smarty->assign("image", $imageURL);
        $this->smarty->display("everyone/fullscreenImage.html");
    }

    public function showReportPage($params)
    {
        $this->assignSmartyParams($params);
        $this->smarty->display("user/reportPage.html");
    }
}