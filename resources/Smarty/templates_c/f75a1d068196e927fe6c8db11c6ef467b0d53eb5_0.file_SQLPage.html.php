<?php
/* Smarty version 5.1.0, created on 2024-06-17 02:17:53
  from 'file:admin/SQLPage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_666f80b1ce6706_84035016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f75a1d068196e927fe6c8db11c6ef467b0d53eb5' => 
    array (
      0 => 'admin/SQLPage.html',
      1 => 1718583392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666f80b1ce6706_84035016 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'E:\\Università\\III anno\\II semestre\\Programmazione per il web\\PlayerPact\\resources\\Smarty\\templates\\admin';
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
								<a class="nav-link menu-element active-element" aria-current="page" href="/admin/home">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link menu-element" aria-current="page" href="/admin/manageMods">Mods</a>
							</li>
							<li class="nav-item">
								<a class="nav-link menu-element" aria-current="page" href="/admin/sql">SQL</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col h-100 d-flex flex-column main-column">
					<div class="row justify-content-center fixed-top z-1 upper-bar">
						<div class="col">
							<li class="dropdown-profile-image">
								<ul class="nav-link profile-image" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="<?php echo $_smarty_tpl->getValue('profilePicture');?>
" alt="Avatar" id="upper-profile-image" />
								</ul>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item usermenu-username"><?php echo $_smarty_tpl->getValue('username');?>
</a></li>
									<li><a class="dropdown-item" href="/login/logout">Logout</a></li>
								</ul>
							</li>
						</div>
					</div>
					<div class="row justify-content-center flex-grow-1" id="main-body">
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }
}
