<?php
/* Smarty version 5.1.0, created on 2024-06-01 22:55:15
  from 'file:selectNewPost.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_665b8ab38e1884_51609038',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ab3d4f10e843f2014e22c051d7e9cbefa5d5955' => 
    array (
      0 => 'selectNewPost.html',
      1 => 1717275290,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_665b8ab38e1884_51609038 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
    
        <link rel="stylesheet" href="/resources/css/createPost.css">
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/resources/js/createPost.js"><?php echo '</script'; ?>
>
    </head>
    <body>
        <div id="createPostPage">
			<div class="dropdown">
				<button id="dropdown" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				 	Tipo di post
				</button>
				<ul class="dropdown-menu" id="postChoice">
					<li><a class="dropdown-item" type="button">Standard</a></li>
					<li><a class="dropdown-item" type="button">Vendita</a></li>
					<li><a class="dropdown-item" type="button">Team</a></li>
				</ul>
			</div>
        </div>
    </body>
</html><?php }
}
