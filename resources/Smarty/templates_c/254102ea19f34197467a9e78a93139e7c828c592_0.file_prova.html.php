<?php
/* Smarty version 5.1.0, created on 2024-05-15 20:09:35
  from 'file:prova.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6644fa5f61ef19_35275945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '254102ea19f34197467a9e78a93139e7c828c592' => 
    array (
      0 => 'prova.html',
      1 => 1715796128,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6644fa5f61ef19_35275945 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="../css/prova.css">
    </head>
    <body>
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100">
                <div class="col-2 h-100 d-flex flex-column fixed-top side-bar">
                    <div class="row h-auto side-logo">
                        <div class="application-logo">
                            <img src="../../public/Logo.png" id="logo">
                        </div>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills side-nav">
                            <li class="nav-item">
                                <a class="nav-link menu-element active-element" aria-current="page" href="VHome.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="postStandard.html">PostStandard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="postTeam.html">postTeam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="postSale.html">postSale</a>
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
                                        <img src="../../public/defaultPropic.png" alt="Avatar" id="upper-profile-image">
                                    </ul>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profilo</a></li>
                                        <li><a class="dropdown-item" href="#">Logout</a></li>
                                    </ul>
                                </li>
                            </div>
                        <?php } else { ?>
                            <div class="upper-login">
                                <button type="button" class="btn-lg upper-login-button">Login</button>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1" id="main-body">
                        <div class="pBanner">
                            <img src="../../public/banner.png">
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
                                <button type="button" class="btn-lg home-button">Registrati</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn-lg home-button">Login</button>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
