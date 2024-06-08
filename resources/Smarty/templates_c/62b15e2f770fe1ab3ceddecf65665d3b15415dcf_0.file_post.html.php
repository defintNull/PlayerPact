<?php
/* Smarty version 5.1.0, created on 2024-06-08 15:51:18
  from 'file:post.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666461d64e9d19_79109699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62b15e2f770fe1ab3ceddecf65665d3b15415dcf' => 
    array (
      0 => 'post.html',
      1 => 1717854662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666461d64e9d19_79109699 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="/resources/css/home.css">
        <link rel="stylesheet" href="/resources/css/post.css">

        <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/addcommentrows.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/autoscrollid.js"><?php echo '</script'; ?>
>
    
    </head>
    <body>
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100">
                <div class="col-2 h-100 d-flex flex-column fixed-top sideBar">
                    <div class="row h-auto pSideLogo">
                        <div class="pLogo">
                            <img src="/public/Logo.png" id="logo">
                        </div>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills pSideNav">
                            <li class="nav-item">
                                <a class="nav-link pMenuElement pActive" aria-current="page" href="/user/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/post/standard">Forum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/post/team">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/post/sell">Sell</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills pSideNav">
                            <li class="nav-item">
                                <a class="nav-link pMenuElement pActive" aria-current="page" href="/post/create">Nuovo post</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column pMainColumn">
                    <div class="row justify-content-center fixed-top z-1 pUpperBar">
                        <div class="col pSearchContainer">
                            <form class="d-flex pSearch" role="search">
                                <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Cerca</button>
                            </form>
                        </div>
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
                            <div class="col pImgCol">
                                <li class="pDropdown">
                                    <ul class="nav-link pProfileImage" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/public/4.png" alt="Avatar" id="profileImage">
                                    </ul>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item usermenu-username"><?php echo $_smarty_tpl->getValue('username');?>
</a></li>
                                        <li><a class="dropdown-item" href="/user/profile">Profilo</a></li>
                                        <li><a class="dropdown-item" href="/login/logout">Logout</a></li>
                                    </ul>
                                </li>
                            </div>
                        <?php } else { ?>
                            <div class="col pUpperLogin">
                                <a href="/login" type="button" class="btn-lg pUpperLoginButton">Login</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main_body">
                        
                        <!-- DATA FOR JS -->
                        <div class="single-post-section">
                            <div class="post-section">
                                <div class="row single-post" id=<?php echo $_smarty_tpl->getValue('postId');?>
>
                                    <div class="post-username"><?php echo $_smarty_tpl->getValue('postUsername');?>
</div>
                                    <div class="post-title"><?php echo $_smarty_tpl->getValue('postTitle');?>
</div>
                                    <div class="post-description"><?php echo $_smarty_tpl->getValue('postDescription');?>
</div>
                                    <div class="row">
                                        <div class="col reportPost text-end float-end">
                                            <form action="/post/report" method="post">
                                                <input type="hidden" id="post-report" name="objToReportId" value="<?php echo $_smarty_tpl->getValue('postId');?>
">
                                                <input type="hidden" id="post-report-type" name="objToReportType" value="standard">
                                                <input type="image" id="report-image" src="/public/report.png">
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <div class="post-datetime" id="post-datetime"><?php echo $_smarty_tpl->getValue('postDatetime');?>
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="solid">
                            <div class="row commentBox">
                                <form action="/post/addcomment" method="post">
                                    <div class="form-group">
                                        <input name="comment" type="text" class="form-control" id="formGroupExampleInput" placeholder="Commenta">
                                        <input type="hidden" name="postId" id="<?php echo $_smarty_tpl->getValue('postId');?>
" value="<?php echo $_smarty_tpl->getValue('postId');?>
">
                                        <button type="submit" class="btn-lg commentButton">Commenta</button>
                                    </div>
                                </form>
                            </div>
                            <div class="comment-section-title">
                                <a>Commenti:</a>
                            </div>
                            <hr class="solid">
                            <div class="commentSection" id="commentSection"></div>
                        </div>
                        
                        <input type="hidden" name="totalcount" id="totalcount" value="0"/>
                        <input type="hidden" name="offset" id="offset" value="0" />
                        <input type="hidden" name="type" id="type" value="<?php echo $_smarty_tpl->getValue('type');?>
" />
                        <input type="hidden" name="date" id="date" value="<?php echo $_smarty_tpl->getValue('date');?>
" />
                        <input type="hidden" name="dtime" id="time" value="<?php echo $_smarty_tpl->getValue('time');?>
" />

                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
