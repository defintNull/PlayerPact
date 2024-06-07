<?php
/* Smarty version 5.1.0, created on 2024-06-03 11:41:56
  from 'file:registration.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_665d8fe4238749_48868393',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75dfdabff5f7bb53d031823bf4529a019080300a' => 
    array (
      0 => 'registration.html',
      1 => 1717407642,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_665d8fe4238749_48868393 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
    
		<link rel="stylesheet" href="/resources/css/registration.css">
	</head>
    <body>
        <form action="/login/register" method="post" enctype="multipart/form-data" accept="image/*">
            <section>
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                      	<div class="col-xl-9">
							<?php if ($_smarty_tpl->getValue('info') != "ok") {?>
								<h1 class="registration-text mb-4">Registrazione - Errore</h1>
							<?php } else { ?>
								<h1 class="registration-text mb-4">Registrazione</h1>
							<?php }?>
                        	
							<div class="card" style="border-radius: 15px;">
								<div class="card-body">
									<div class="row align-items-center pt-4 pb-3">
										<div class="col-md-3 ps-5">
											<h6 class="mb-0">Nome</h6>
											<?php if ($_smarty_tpl->getValue('name') == "missing") {?>
												<div class="missing"><a>Campo richiesto!</a></div>
											<?php }?>
										</div>
										<div class="col-md-9 pe-5">
											<input type="text" name="name" class="form-control form-control-lg" />
										</div>
									</div>
									<hr class="mx-n3">
									<div class="row align-items-center pt-4 pb-3">
										<div class="col-md-3 ps-5">
											<h6 class="mb-0">Cognome</h6>
											<?php if ($_smarty_tpl->getValue('surname') == "missing") {?>
												<div class="missing"><a>Campo richiesto!</a></div>
											<?php }?>
										</div>
										<div class="col-md-9 pe-5">
											<input type="text" name="surname" class="form-control form-control-lg" />                              
										</div>
									</div>
									<hr class="mx-n3">
									<div class="row align-items-center pt-4 pb-3">
										<div class="col-md-3 ps-5">
											<h6 class="mb-0">Data di nascita</h6>
											<?php if ($_smarty_tpl->getValue('birthdate') == "missing") {?>
												<div class="missing"><a>Campo richiesto!</a></div>
											<?php }?>
										</div>
										<div class="col-md-9 pe-5">
											<input type="date" id="birthdate" name="birthdate">
										</div>
									</div>
								</div>
								<hr class="mx-n3">
								<div class="row align-items-center py-3">
									<div class="col-md-3 ps-5">
										<h6 class="mb-0">Indirizzo email</h6>
										<?php if ($_smarty_tpl->getValue('email') == "missing") {?>
											<div class="missing"><a>Campo richiesto!</a></div>
										<?php } elseif ($_smarty_tpl->getValue('email') == "existing") {?>
											<div class="existing"><a>Hai inserito un indirizzo già utilizzato!</a></div>
										<?php }?>
									</div>
									<div class="col-md-9 pe-5">
										<input type="email" name="email" class="form-control form-control-lg" placeholder="example@example.com" />
									</div>
								</div>
								<hr class="mx-n3">
								<div class="row align-items-center pt-4 pb-3">
									<div class="col-md-3 ps-5">              
										<h6 class="mb-0">Username</h6>
										<?php if ($_smarty_tpl->getValue('username') == "missing") {?>
											<div class="missing"><a>Campo richiesto!</a></div>
										<?php } elseif ($_smarty_tpl->getValue('email') == "existing") {?>
											<div class="existing"><a>Hai inserito uno username già utilizzato!</a></div>
										<?php }?>
									</div>
									<div class="col-md-9 pe-5">
										<input type="text" name="username" class="form-control form-control-lg" />											
									</div>
								</div>
								<hr class="mx-n3">
								<div class="row align-items-center pt-4 pb-3">
									<div class="col-md-3 ps-5">	
										<h6 class="mb-0">Password</h6>
										<?php if ($_smarty_tpl->getValue('password') == "missing") {?>
											<div class="missing"><a>Campo richiesto!</a></div>
										<?php }?>										
									</div>
									<div class="col-md-9 pe-5">              
										<input type="password" name="password" class="form-control form-control-lg" />              
									</div>
								</div>								
								<hr class="mx-n3">								
								<div class="row align-items-center py-3">
									<div class="col-md-3 ps-5">              
										<h6 class="mb-0">Immagine profilo</h6>										
									</div>
									<div class="col-md-9 pe-5">              
										<input class="form-control form-control-lg" id="formFileLg" name="profilepicture" type="file" />
										<div class="small text-muted mt-2">Upload your profile picture. Max file size 50 MB</div>
									</div>
								</div>
								<hr class="mx-n3">              
								<div class="px-5 py-4">
									<button type="submit" data-mdb-button-init data-mdb-ripple-init class="send btn-lg">Registrati</button>
								</div>              
							</div>
                      	</div>
                    </div>
            	</div>
            </section>
        </form>
    </body>
</html><?php }
}
