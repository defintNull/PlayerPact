<?php
/* Smarty version 5.1.0, created on 2024-06-01 23:55:47
  from 'file:home.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_665b98e3c3e142_22911335',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '218e52a632b74eaaed5ba9f9791f9f5591661b1e' => 
    array (
      0 => 'home.html',
      1 => 1717278947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_665b98e3c3e142_22911335 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="/resources/css/home.css">
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
                                <a class="nav-link pMenuElement pActive" aria-current="page" href="<?php echo $_smarty_tpl->getValue('createPostLink');?>
">Nuovo post</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column pMainColumn">
                    <div class="row justify-content-center fixed-top z-1 pUpperBar">
                        <!-- <div class="col pSearchContainer">
                            <form class="d-flex pSearch" role="search">
                                <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Cerca</button>
                            </form>
                        </div> -->
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
                            <div class="col pImgCol">
                                <li class="pDropdown">
                                    <ul class="nav-link pProfileImage" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/public/4.png" alt="Avatar" id="profileImage"> <!-- Inserire immagine profilo-->
                                    </ul>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profilo</a></li>
                                        <li><a class="dropdown-item" href="/login/logout">Logout</a></li>
                                    </ul>
                                </li>
                            </div>
                        <?php } else { ?>
                            <div class="pUpperLogin">
                                <a href="/login" type="button" class="btn-lg pUpperLoginButton">Login</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main_body">
                        <div class="pBanner">
                            <img src="/public/banner.png">
                        </div>
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
                            <div class="pWelcome">
                                <a>Benvenuto</a>
                                <a class="pUsername"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                            </div>
                        <?php } else { ?>
                            <div class="pWelcome">
                                <a>Benvenuto in PlayerPact</a>
                            </div>
                            <a>Qui potrai cercare nuovi amici con cui giocare online, comprare un nuovo videogioco o semplicemente esprimere un proprio pensiero sul mondo dei videogiochi!</a>
                            <div class="col">
                                <a href="/login/registration" type="button" class="btn-lg pHomeButton">Registrati</a>
                            </div>
                            <div class="col">
                                <a href="/login" type="button" class="btn-lg pHomeButton">Login</a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
