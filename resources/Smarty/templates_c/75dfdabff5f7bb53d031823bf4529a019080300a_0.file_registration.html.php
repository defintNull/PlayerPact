<?php
/* Smarty version 5.1.0, created on 2024-05-28 20:45:52
  from 'file:registration.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_66562660bba066_52478163',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75dfdabff5f7bb53d031823bf4529a019080300a' => 
    array (
      0 => 'registration.html',
      1 => 1716921924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66562660bba066_52478163 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
    </head>
    <body>
        <form action="/login/register" method="post" enctype="multipart/form-data" accept="image/*">
            <section class="vh-100" style="background-color: #2779e2;">
                <div class="container h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-9">
              
                      <h1 class="text-white mb-4">Registration</h1>
              
                      <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
              
                          <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Name</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input type="text" name="name" class="form-control form-control-lg" />
              
                            </div>
                          </div>
              
                          <hr class="mx-n3">

                          <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Surname</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input type="text" name="surname" class="form-control form-control-lg" />
              
                            </div>
                          </div>

                          <hr class="mx-n3">

                          <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Birthdate</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                                <label class="active" for="dateStandard">Datepicker</label>
                                <input type="date" id="birthdate" name="bitthdate">

                            </div>
                            
                            </div>
                          </div>

                          <hr class="mx-n3">
              
                          <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Email address</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input type="email" name="email" class="form-control form-control-lg" placeholder="example@example.com" />
              
                            </div>
                          </div>
              
                          <hr class="mx-n3">

                          <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Username</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input type="text" name="username" class="form-control form-control-lg" />
              
                            </div>
                          </div>
              
                          <hr class="mx-n3">

                          <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Password</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input type="password" name="password" class="form-control form-control-lg" />
              
                            </div>
                          </div>
              
                          <hr class="mx-n3">
              
                          <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">
              
                              <h6 class="mb-0">Profile Picture</h6>
              
                            </div>
                            <div class="col-md-9 pe-5">
              
                              <input class="form-control form-control-lg" id="formFileLg" name="profilepicture" type="file" />
                              <div class="small text-muted mt-2">Upload your profile picture. Max file
                                size 50 MB</div>
              
                            </div>
                          </div>
              
                          <hr class="mx-n3">
              
                          <div class="px-5 py-4">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                          </div>
              
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