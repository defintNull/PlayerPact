<?php
/* Smarty version 5.1.0, created on 2024-06-03 23:26:04
  from 'file:postReportPage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_665e34ec827d37_27771914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd068ba7b86d889ddc611528ee661387fe86a4ea5' => 
    array (
      0 => 'postReportPage.html',
      1 => 1717449960,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_665e34ec827d37_27771914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\Università\\Programmazione web\\Github\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
    
      <link rel="stylesheet" href="/resources/css/report.css">
    </head>
    <body>
        <div class="title-report-section">
            <a>Invio segnalazioni</a>
        </div>
        <form class="form-body" action="/post/confirmPostReport" method="post">
            <div class="reportDescription">
                <div class="input-group mb-3">
                    <input type="text" name="description" class="form-control" placeholder="Spiegaci il motivo..." aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <input type="hidden" name="postId" value="<?php echo $_smarty_tpl->getValue('postId');?>
" class="form-control" aria-describedby="inputGroup-sizing-default">
            <div>
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn confirmReportButton">Segnala</button>
            </div>
        </form>
    </body>
</html><?php }
}
