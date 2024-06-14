<?php
/* Smarty version 5.1.0, created on 2024-06-06 19:18:33
  from 'file:privacy.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6661ef69545a98_22134741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa426692a2cf9c884e7e60b874eba34765cbc230' => 
    array (
      0 => 'privacy.html',
      1 => 1717692708,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6661ef69545a98_22134741 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
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
                                <a class="nav-link menu-element" aria-current="page" href="/user/profile">Miei post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/saved">Post salvati</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/participated">Partecipazioni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/chats">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-element" aria-current="page" href="/user/privacy">Privacy e sicurezza</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column main-column">
                    <div class="row justify-content-center fixed-top z-1 upper-bar">
                        <div class="upperBar">
                            <a>Pagina profilo di </a>
                            <a class="upper-bar-username"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main-body">
                        <!-- AGGIUNGERE CAMBIO FOTO PROFILO -->
                        <div class="col privacy-page-body">
                            <div class="row">
                                <div class="col privacy-page-item">
                                    <a>Username: </a>
                                </div>
                                <div class="col privacy-page-item">
                                    <a class="username"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                                </div>
                                <div class="col privacy-page-item">
                                    <a type="button" class="btn">Modifica</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col privacy-page-item">
                                    <a>Password: </a>
                                </div>
                                <div class="col privacy-page-item">
                                    <a class="password"><?php echo $_smarty_tpl->getValue('censuredPassword');?>
</a>
                                </div>
                                <div class="col privacy-page-item">
                                    <a type="button" class="btn">Modifica</a>
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
