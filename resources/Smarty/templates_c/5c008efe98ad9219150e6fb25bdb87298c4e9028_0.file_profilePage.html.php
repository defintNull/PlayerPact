<?php
/* Smarty version 5.1.0, created on 2024-06-17 01:11:20
  from 'file:profilePage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666f71185fef11_01311378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c008efe98ad9219150e6fb25bdb87298c4e9028' => 
    array (
      0 => 'profilePage.html',
      1 => 1718579456,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666f71185fef11_01311378 (\Smarty\Template $_smarty_tpl) {
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

		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/resources/js/addMyPostRows.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/resources/js/autoscrollProfilePage.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/resources/js/userButtonInteraction.js"><?php echo '</script'; ?>
>

		<link rel="stylesheet" href="/resources/css/home.css" />
		<link rel="stylesheet" href="/resources/css/post.css" />
		<link rel="stylesheet" href="/resources/css/profilePage.css" />
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
						<div class="col upper-bar-title">
							<a><span class="username upper-bar-username"><?php echo $_smarty_tpl->getValue('username');?>
</span>'s profile page</a>
						</div>
						<div class="col">
							<li class="dropdown-profile-image">
								<ul class="nav-link profile-image" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="<?php echo $_smarty_tpl->getValue('profilePicture');?>
" alt="Avatar" id="upper-profile-image" />
								</ul>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item usermenu-username"><?php echo $_smarty_tpl->getValue('username');?>
</a></li>
									<li><a class="dropdown-item" href="/user/profile">Profile</a></li>
									<li><a class="dropdown-item" href="/login/logout">Logout</a></li>
								</ul>
							</li>
						</div>
					</div>
					
					<div class="row justify-content-center flex-grow-1" id="main-body">
						<!-- DATA FOR JS -->
						<div class="post_section" id="post-list">
							<input type="hidden" name="totalcount" id="totalcount" value="0" />
							<input type="hidden" name="offset" id="offset" value="0" />
							<input type="hidden" name="type" id="type" value="<?php echo $_smarty_tpl->getValue('type');?>
" />
							<input type="hidden" name="date" id="date" value="<?php echo $_smarty_tpl->getValue('date');?>
" />
							<input type="hidden" name="dtime" id="time" value="<?php echo $_smarty_tpl->getValue('time');?>
" />
						</div>
						<div class="ajax-loader text-center">Loading more posts...</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }
}
