<?php
/* Smarty version 5.1.0, created on 2024-06-06 19:01:11
  from 'file:home.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6661eb576f13d2_79219840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3c3acada8406b485219b7e10fe04e3e27074997' => 
    array (
      0 => 'home.html',
      1 => 1717692708,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6661eb576f13d2_79219840 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
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
                                <a class="nav-link menu-element" aria-current="page" href="/post/standard">Forum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/post/team">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/post/sale">Sale</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills side-nav">
                            <li class="nav-item">
                                <a class="nav-link menu-element active-element" aria-current="page" href="/post/create">Nuovo post</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column main-column">
                    <div class="row justify-content-center fixed-top z-1 upper-bar">
                        <!-- <div class="col search-container">
                            <form class="d-flex search-bar" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Cerca</button>
                            </form>
                        </div> -->
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
                            <div class="col pImgCol">
                                <li class="dropdown-menu">
                                    <ul class="nav-link profile-image" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="/public/defaultPropic.png" alt="Avatar" id="upper-profile-image"> <!-- Inserire immagine profilo-->
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
                            <div class="upper-login">
                                <a href="/login" type="button" class="btn-lg upper-login-button">Login</a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main-body">
                        <div class="pBanner">
                            <img src="/public/banner.png">
                        </div>
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
                            <div class="welcome-text">
                                <a>Benvenuto</a>
                                <a class="welcome-text-username"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                            </div>
                        <?php } else { ?>
                            <div class="welcome-text">
                                <a>Benvenuto in PlayerPact</a>
                            </div>
                            <a>Qui potrai cercare nuovi amici con cui giocare online, comprare un nuovo videogioco o semplicemente esprimere un proprio pensiero sul mondo dei videogiochi!</a>
                            <div class="col">
                                <a href="/login/registration" type="button" class="btn-lg home-button">Registrati</a>
                            </div>
                            <div class="col">
                                <a href="/login" type="button" class="btn-lg home-button">Login</a>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
