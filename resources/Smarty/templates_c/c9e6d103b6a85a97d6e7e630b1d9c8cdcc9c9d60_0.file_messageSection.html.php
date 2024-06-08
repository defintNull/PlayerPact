<?php
/* Smarty version 5.1.0, created on 2024-06-07 22:07:05
  from 'file:messageSection.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_66636869eb1f28_55007157',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9e6d103b6a85a97d6e7e630b1d9c8cdcc9c9d60' => 
    array (
      0 => 'messageSection.html',
      1 => 1717790708,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66636869eb1f28_55007157 (\Smarty\Template $_smarty_tpl) {
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
 src="/resources/js/autoscrollid.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/addmessagerows.js"><?php echo '</script'; ?>
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
                        
                        <div class="single-post-section">
                            <div class="row single-post" id="<?php echo $_smarty_tpl->getValue('chatId');?>
">
                                <div class="post-title" id="post-title"><?php echo $_smarty_tpl->getValue('title');?>
</div>
                                <div class="chat-datetime" id="chat-datetime"><?php echo $_smarty_tpl->getValue('datetime');?>
</div>
                                <div class="chat-user" id="chat-user"><?php echo $_smarty_tpl->getValue('user');?>
</div>
                            </div>
                            <hr class="solid">
                            <div class="row commentBox">
                                <form action="/user/sendmessage" method="post">
                                    <div class="form-group">
                                        <input name="message" type="text" class="form-control" id="message" placeholder="Message">
                                        <input type="hidden" name="postId" id="<?php echo $_smarty_tpl->getValue('postId');?>
" value="<?php echo $_smarty_tpl->getValue('postId');?>
">
                                        <button type="submit" class="btn-lg commentButton">Send</button>
                                    </div>
                                </form>
                            </div>
                            <div class="comment-section-title">
                                <a>Commenti:</a>
                            </div>
                            <hr class="solid">
                            <div class="commentSection" id="commentSection"></div>
                        </div>
                        
                        <div class=message_section id=message-list>
                                
                        </div>
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
    </body>
</html><?php }
}
