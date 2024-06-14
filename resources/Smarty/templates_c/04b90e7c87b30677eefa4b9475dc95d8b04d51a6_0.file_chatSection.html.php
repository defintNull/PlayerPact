<?php
/* Smarty version 5.1.0, created on 2024-06-14 20:24:40
  from 'file:chatSection.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666c8ae8d425c5_28967218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04b90e7c87b30677eefa4b9475dc95d8b04d51a6' => 
    array (
      0 => 'chatSection.html',
      1 => 1718389309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666c8ae8d425c5_28967218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'E:\\Università\\III anno\\II semestre\\Programmazione per il web\\PlayerPact\\resources\\Smarty\\templates';
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
		<link rel="stylesheet" href="/resources/css/home.css" />
		<link rel="stylesheet" href="/resources/css/chat.css" />
		<link rel="stylesheet" href="/resources/css/profilePage.css" />

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
				<div class="col-2 h-100 d-flex flex-column fixed-top side-bar">
					<div class="row h-auto side-logo">
						<div class="application-logo">
							<img src="/public/Logo.png" id="logo" />
						</div>
					</div>
					<div class="row justify-content-center text-bg-dark flex-grow-1">
						<ul class="nav nav-pills side-nav">
							<li class="nav-item">
								<a class="nav-link menu-element active-element" aria-current="page" href="/user/home">Home</a>
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
								<a class="nav-link menu-element" aria-current="page" href="/user/privacy">Privacy settings</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col h-100 d-flex flex-column main-column">
					<div class="row justify-content-center fixed-top z-1 upper-bar">
						<a><span class="username upper-bar-username"><?php echo $_smarty_tpl->getValue('username');?>
</span> profile page</a>
					</div>
					<div class="row justify-content-center flex-grow-1" id="main-body">
						<div class="chat-section" id="chat-list">
							<div class="ajax-loader text-center">Loading more posts...</div>

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
		</div>
	</body>
</html>
<?php }
}
