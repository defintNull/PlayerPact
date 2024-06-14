<?php
/* Smarty version 5.1.0, created on 2024-06-09 01:15:15
  from 'file:profilePage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6664e603437351_12121066',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01a45d43f07dc911577661b6eeaf9dfb263e2f07' => 
    array (
      0 => 'profilePage.html',
      1 => 1717888347,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6664e603437351_12121066 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="/resources/css/home.css">
        <link rel="stylesheet" href="/resources/css/profilePage.css">
    </head>
    <body>
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100">
                <div class="col-2 h-100 d-flex flex-column fixed-top side-bar">
                    <div class="row h-auto side-logo">
                        <div class="application-logo">
                            <img src="/public/Logo.png" id="logo">
                        </div>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills side-nav">
                            <li class="nav-item">
                                <a class="nav-link menu-element active-element" aria-current="page" href="/user/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/profile">My posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/saved">Saved posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/participated">Teams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/chats">Chats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/privacy">Privacy settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column main-column">
                    <div class="row justify-content-center fixed-top z-1 upper-bar">
                        <div class="upperBar">
                            <a class="upper-bar-username"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                            <a> profile page</a>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
