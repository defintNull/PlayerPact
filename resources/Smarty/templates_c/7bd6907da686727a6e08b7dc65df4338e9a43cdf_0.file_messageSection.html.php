<?php
/* Smarty version 5.1.0, created on 2024-06-16 15:04:17
  from 'file:messageSection.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666ee2d1e97d08_07969855',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7bd6907da686727a6e08b7dc65df4338e9a43cdf' => 
    array (
      0 => 'messageSection.html',
      1 => 1718457319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666ee2d1e97d08_07969855 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="/resources/css/home.css">
    <link rel="stylesheet" href="/resources/css/post.css">
    <link rel="stylesheet" href="/resources/css/chat.css">
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
    <?php echo '<script'; ?>
 src="/resources/js/userButtonInteraction.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/resources/js/receiveChatMessages.js"><?php echo '</script'; ?>
>

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
                            <a class="nav-link menu-element active-element" aria-current="page"
                                href="/user/home">Home</a>
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
                            <a class="nav-link menu-element" aria-current="page" href="/user/privacy">Privacy
                                settings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col h-100 d-flex flex-column main-column">
                <div class="row justify-content-center fixed-top z-1 upper-bar">
                    <a><span class="username upper-bar-username"><?php echo $_smarty_tpl->getValue('username');?>
</span>'s profile page</a>
                </div>
                <div class="row justify-content-center flex-grow-1" id="main-body">

                    <div class="single-post-section">
                        <div class="row single-post" id="<?php echo $_smarty_tpl->getValue('chatId');?>
">
                            <div class="chat-user" id="chat-user"><?php echo $_smarty_tpl->getValue('user');?>
</div>
                            <div class="post-title" id="post-title"><?php echo $_smarty_tpl->getValue('title');?>
</div>
                            <div class="chat-datetime" id="chat-datetime" data-nmessages="<?php echo $_smarty_tpl->getValue('nMessages');?>
"><?php echo $_smarty_tpl->getValue('datetime');?>

                            </div>
                        </div>
                        <hr class="solid">
                        <div class="row commentBox">
                            <input name="message" type="text" class="form-control" id="message-box"
                                placeholder="Message...">
                            <button type="submit" id="send-message-button" data-id="<?php echo $_smarty_tpl->getValue('chatId');?>
"
                                class="btn-lg button button-send-text">Send</button>
                        </div>
                        <hr class="solid">
                        <div class=message-section id=message-list></div>
                    </div>



                </div>
                <div class="ajax-loader text-center">
                    Loading more posts...
                </div>
                <input type="hidden" name="totalcount" id="totalcount" value="0" />
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
