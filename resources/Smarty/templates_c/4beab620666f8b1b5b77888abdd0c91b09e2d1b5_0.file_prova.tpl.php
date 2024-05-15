<?php
/* Smarty version 5.1.0, created on 2024-05-15 17:13:21
  from 'file:prova.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6644d11186aa57_97190667',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4beab620666f8b1b5b77888abdd0c91b09e2d1b5' => 
    array (
      0 => 'prova.tpl',
      1 => 1715785984,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6644d11186aa57_97190667 (\Smarty\Template $_smarty_tpl) {
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
                <div class="col-2 h-100 d-flex flex-column fixed-top sideBar">
                    <div class="row h-auto pSideLogo">
                        <div class="pLogo">
                            <img src="../../public/Logo.png" id="logo">
                        </div>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1">
                        <ul class="nav nav-pills pSideNav">
                            <li class="nav-item">
                                <a class="nav-link pMenuElement pActive" aria-current="page" href="prova.html">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="postStandard.html">PostStandard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="postTeam.html">postTeam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="postSell.html">postSell</a>
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
                        <div class="col pImgCol">
                            <li class="pDropdown">
                                <ul class="nav-link pProfileImage" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../../public/4.png" alt="Avatar" id="profileImage">
                                </ul>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profilo</a></li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </li>
                        </div>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1" id="main_body">
                        <div class="pBanner">
                            <img src="../../public/banner.png">
                        </div>
                        <div class="pWelcome">
                            <a>Benvenuto</a>
                            <a class="pUsername"><?php echo $_smarty_tpl->getValue('name');?>
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php }
}
