<?php
/* Smarty version 5.1.0, created on 2024-06-17 00:44:21
  from 'file:home.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666f6ac5da9d21_42019128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b5be2460b5396e6fa62bd263195951ae7da4c6b' => 
    array (
      0 => 'home.html',
      1 => 1718577859,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666f6ac5da9d21_42019128 (\Smarty\Template $_smarty_tpl) {
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
								<a class="nav-link menu-element" aria-current="page" href="/post/standard">Forum</a>
							</li>
							<li class="nav-item">
								<a class="nav-link menu-element" aria-current="page" href="/post/team">Team posts</a>
							</li>
							<li class="nav-item">
								<a class="nav-link menu-element" aria-current="page" href="/post/sale">Sale posts</a>
							</li>
						</ul>
					</div>
					<div class="row justify-content-center text-bg-dark flex-grow-1">
						<ul class="nav nav-pills side-nav">
							<li class="nav-item">
								<a class="nav-link menu-element active-element" aria-current="page" href="/post/create">New post</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col h-100 d-flex flex-column main-column">
					<div class="row justify-content-center fixed-top z-1 upper-bar">
						<?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
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
						<?php } else { ?>
						<div class="upper-login">
							<a href="/login" type="button" class="btn-lg upper-login-button">Login</a>
						</div>
						<?php }?>
					</div>
					<div class="row justify-content-center flex-grow-1" id="main-body">
						<div class="home-banner-container">
							<img class="home-banner" src="/public/banner.png" />
						</div>
						<?php if ($_smarty_tpl->getValue('authenticated') == true) {?>
						<div class="welcome-text">
							<a>Welcome</a>
							<a class="welcome-text-username"><?php echo $_smarty_tpl->getValue('username');?>
</a>
							<a>!</a>
						</div>
						<?php } else { ?>
						<div class="welcome-text">
							<a>Welcome to PlayerPact</a>
						</div>
						<a
							>Here you can look for new friends to play online with, buy a new videogame or simply express your thoughts on the world
							of videogames!</a
						>
						<div class="col">
							<a href="/login/registration" type="button" class="btn-lg home-button">Sign up</a>
						</div>
						<div class="col">
							<a href="/login" type="button" class="btn-lg home-button">Login</a>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }
}
