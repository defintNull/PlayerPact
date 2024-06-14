<?php
/* Smarty version 5.1.0, created on 2024-06-12 20:17:04
  from 'file:404.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6669e620082d26_18113255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cda0796c976c2eeebcb2b78ba611e2650b8464f0' => 
    array (
      0 => '404.html',
      1 => 1717767250,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6669e620082d26_18113255 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'E:\\Università\\III anno\\II semestre\\Programmazione per il web\\PlayerPact\\resources\\Smarty\\templates';
?><html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/resources/css/404.css">
    </head>
    <body>
        <div class="moon"></div>
        <div class="moon__crater moon__crater1"></div>
        <div class="moon__crater moon__crater2"></div>
        <div class="moon__crater moon__crater3"></div>

        <div class="star star1"></div>
        <div class="star star2"></div>
        <div class="star star3"></div>
        <div class="star star4"></div>
        <div class="star star5"></div>

        <div class="error">
            <div class="error__title">404</div>
            <div class="error__subtitle">Hmmm...</div>
            <div class="error__description">It looks like one of the developers fell asleep</div>
            <a class="error__button error__button--active" href="/login">LOGIN</a>
            <a class="error__button" href="/user/home">HOME</a>
        </div>

        <div class="astronaut">
        <div class="astronaut__backpack"></div>
        <div class="astronaut__body"></div>
        <div class="astronaut__body__chest"></div>
        <div class="astronaut__arm-left1"></div>
        <div class="astronaut__arm-left2"></div>
        <div class="astronaut__arm-right1"></div>
        <div class="astronaut__arm-right2"></div>
        <div class="astronaut__arm-thumb-left"></div>
        <div class="astronaut__arm-thumb-right"></div>
        <div class="astronaut__leg-left"></div>
        <div class="astronaut__leg-right"></div>
        <div class="astronaut__foot-left"></div>
        <div class="astronaut__foot-right"></div>
        <div class="astronaut__wrist-left"></div>
        <div class="astronaut__wrist-right"></div>

        <div class="astronaut__cord">
            <canvas id="cord" height="300px" width="300px"></canvas>
        </div>

        <div class="astronaut__head">
            <canvas id="visor" width="60px" height="60px"></canvas>
            <div class="astronaut__head-visor-flare1"></div>
            <div class="astronaut__head-visor-flare2"></div>
        </div>
        </div>
        <?php echo '<script'; ?>
 src="/resources/js/404.js"><?php echo '</script'; ?>
>
    </body>
</html><?php }
}