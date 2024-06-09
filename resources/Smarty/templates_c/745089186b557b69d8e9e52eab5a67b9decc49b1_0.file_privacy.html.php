<?php
/* Smarty version 5.1.0, created on 2024-06-09 14:47:17
  from 'file:privacy.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6665a45528d938_84574088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '745089186b557b69d8e9e52eab5a67b9decc49b1' => 
    array (
      0 => 'privacy.html',
      1 => 1717937064,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6665a45528d938_84574088 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="/resources/css/home.css">
        <link rel="stylesheet" href="/resources/css/profilePage.css">

        <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/privacy.js"><?php echo '</script'; ?>
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
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/profile">My posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/saved">Saved posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/participated">Teams</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/chats">Chats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/privacy">Privacy settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column pMainColumn">
                    <div class="row justify-content-center fixed-top z-1 pUpperBar">
                        <div class="upperBar">
                            <a class="upperBarUsername"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                            <a> profile page</a>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main_body">
                        <!-- AGGIUNGERE CAMBIO FOTO PROFILO -->
                        <div class="col privacy-page-body">
                            <div class="row">
                                <div class="col privacy-page-item">
                                    <a>Username: </a>
                                </div>
                                <div class="col privacy-page-item">
                                    <input id="username-textbox" class="form-control" type="text" value="<?php echo $_smarty_tpl->getValue('username');?>
" aria-label="readonly input example" readonly>
                                </div>
                                <div class="col privacy-page-item">
                                    <a type="button" id="change-username" class="btn">Change</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col privacy-page-item">
                                    <a>Password: </a>
                                </div>
                                <div class="col privacy-page-item">
                                    <input type="password" id="password-textbox" class="form-control" value="<?php echo $_smarty_tpl->getValue('censuredPassword');?>
" aria-label="readonly input example" readonly>
                                </div>
                                <div class="col privacy-page-item">
                                    <a type="button" id="change-password" class="btn">Change</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
