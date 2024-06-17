<?php
/* Smarty version 5.1.0, created on 2024-06-17 16:37:22
  from 'file:login.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_66704a2295b456_31945237',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '363499bccc4ad5f77a6f2411095417aa37b8336a' => 
    array (
      0 => 'login.html',
      1 => 1718632697,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66704a2295b456_31945237 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
    
      <link rel="stylesheet" href="/resources/css/login.css">
    </head>
    <body>
        <div class="login">
          	<?php if ($_smarty_tpl->getValue('check') == "false") {?>
            	<div>Wrong credentials</div>
          	<?php }?>
          	<form action="/login/loginRedirect" method="post">
            	<div data-mdb-input-init class="form-outline mb-4">
                	<input type="username" id="form2Example1" name="username" class="form-control" placeholder="Username..."/>
            	</div>
            	<div data-mdb-input-init class="form-outline mb-4">
	              	<input type="password" id="form2Example2" name="password" class="form-control" placeholder="Password..."/>
            	</div>
					<input type="submit" data-mdb-button-init data-mdb-ripple-init class="btn pButton" value="Login"></input>
            	</div>
          	</form>
		  	<div class="pRegistration">
		  		<a>Not registered? </a>
		  		<a href="/login/registration" class="pCreateAccount">Create an account</a>
			</div>
        </div>
    </body>
</html><?php }
}
