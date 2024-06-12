<?php
/* Smarty version 5.1.0, created on 2024-06-07 20:38:59
  from 'file:chatSection.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666353c3417594_76142574',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd84ed502780fb4a64f25a9942273d4205fd44086' => 
    array (
      0 => 'chatSection.html',
      1 => 1717785508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666353c3417594_76142574 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
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
 src="/resources/js/chatautoscroll.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/addchatrows.js"><?php echo '</script'; ?>
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
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/profile">Miei post</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/saved">Post salvati</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/participated">Partecipazioni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/chats">Chat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/user/privacy">Privacy e sicurezza</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col h-100 d-flex flex-column pMainColumn">
                    <div class="row justify-content-center fixed-top z-1 pUpperBar">
                        <div class="upperBar">
                            <a>Pagina profilo di </a>
                            <a class="upperBarUsername"><?php echo $_smarty_tpl->getValue('username');?>
</a>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-grow-1" id="main_body">
                        <div class=chat_section id=chat-list>

                            <div class="ajax-loader text-center">
                                Loading more posts... 
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
        </div>
    </body>
</html><?php }
}