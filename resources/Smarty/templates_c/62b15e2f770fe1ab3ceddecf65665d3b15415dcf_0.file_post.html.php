<?php
/* Smarty version 5.1.0, created on 2024-05-24 20:52:49
  from 'file:post.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6650e20189ffb6_26981763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62b15e2f770fe1ab3ceddecf65665d3b15415dcf' => 
    array (
      0 => 'post.html',
      1 => 1716576039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6650e20189ffb6_26981763 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="/resources/css/home.css">
        <link rel="stylesheet" href="/resources/css/post.css">
    
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
                                <a class="nav-link pMenuElement pActive" aria-current="page" href="VHome.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="/resources/Smarty/templates/poststandard.html">PostStandard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="postteam.html">postTeam</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pMenuElement" aria-current="page" href="postsell.html">postSell</a>
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
                        <?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
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
                        <?php } else { ?>
                            <div class="col pUpperLogin">
                                <button type="button" class="btn-lg pUpperLoginButton">Login</button>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row justify-content-center text-bg-dark flex-grow-1" id="main_body">
                        
                        <!-- DATA FOR JS -->
                        <!-- <div class="post_section" id="post-list"> -->
                        <div class="post-item" id=<?php echo $_smarty_tpl->getValue('postId');?>
>
                            <div class="post-username" ><?php echo $_smarty_tpl->getValue('user');?>
</div>
                            <div class="title-post-bar post-title"><?php echo $_smarty_tpl->getValue('posttitle');?>
</div>
                            <div class="description"><?php echo $_smarty_tpl->getValue('description');?>
</div>
                            <div class="datetime"><?php echo $_smarty_tpl->getValue('datetime');?>
</div>
                            
                        </div>
                        <hr class="solid">
                        <div class="commentSection">
                            
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
