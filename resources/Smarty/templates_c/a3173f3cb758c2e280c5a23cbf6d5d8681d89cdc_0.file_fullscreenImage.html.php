<?php
/* Smarty version 5.1.0, created on 2024-06-06 00:42:34
  from 'file:fullscreenImage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6660e9daecc2b8_86083408',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3173f3cb758c2e280c5a23cbf6d5d8681d89cdc' => 
    array (
      0 => 'fullscreenImage.html',
      1 => 1717627328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6660e9daecc2b8_86083408 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link rel="stylesheet" href="/resources/css/fullScreenImage.css">
    </head>
    <body>
        <img src="<?php echo $_smarty_tpl->getValue('image');?>
">
    </body>
</html><?php }
}
