<?php
/* Smarty version 5.1.0, created on 2024-06-17 17:04:31
  from 'file:selectNewPost.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6670507f2c4975_79909852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f274d3c9d89558a42f783321df70e2cb7aa8a38' => 
    array (
      0 => 'selectNewPost.html',
      1 => 1718632697,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6670507f2c4975_79909852 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
?><html>
	<head>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous"
		/>
		<?php echo '<script'; ?>

			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
			crossorigin="anonymous"
		><?php echo '</script'; ?>
>

		<link rel="stylesheet" href="/resources/css/createPost.css" />
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/resources/js/createPost.js"><?php echo '</script'; ?>
>
	</head>
	<body>
		<div class="backHome">
			<a class="btn postButton" href="/user/home">Home</a>
		</div>
		<div id="createPostPage">
			<div class="dropup">
				<a>Tipo: </a>
				<button id="dropdown" class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Standard</button>
				<ul class="dropdown-menu" id="postChoice">
					<li><a class="dropdown-item" type="button">Standard</a></li>
					<li><a class="dropdown-item" type="button">Sale</a></li>
					<li><a class="dropdown-item" type="button">Team</a></li>
				</ul>
			</div>
			<div id="postMenu"></div>
			<?php if ($_smarty_tpl->getValue('info') != "ok") {?>
			<div class="error">
				<a>You have not filled in all the fields correctly!</a>
			</div>
			<?php }?>
		</div>
	</body>
</html>
<?php }
}
