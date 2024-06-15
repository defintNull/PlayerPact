<?php
/* Smarty version 5.1.0, created on 2024-06-15 16:22:45
  from 'file:fullscreenImage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666da3b5a21980_93811197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6866121d20fd945f46ff4add01918e0fc5adcf89' => 
    array (
      0 => 'fullscreenImage.html',
      1 => 1718389326,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666da3b5a21980_93811197 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'E:\\Università\\III anno\\II semestre\\Programmazione per il web\\PlayerPact\\resources\\Smarty\\templates';
?><html>
	<head>
		<link rel="stylesheet" href="/resources/css/fullScreenImage.css" />
	</head>
	<body>
		<img src="<?php echo $_smarty_tpl->getValue('image');?>
" />
	</body>
</html>
<?php }
}
