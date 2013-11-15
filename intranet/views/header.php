<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Alma Branding | Intranet</title>
        <meta charset="UTF-8"> 
        <meta property="og:site_name" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />

        <link rel="shortcut icon" href="<?php echo URL; ?>favicon.png" Content-type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/zebra_form.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery.Jcrop.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/HTML5Upload.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/file-upload.css" />
        <!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.Jcrop.js"></script>

    </head>
    <body>
        <?php Session::init();
         $strNoCache = "?nocache=".time(); ?>
            <header>
                <div class="header_logo">
                    <div class="wrapper">
                    <a href="<?php echo URL . LANG; ?>/"><div id="logo"></div></a>
                    <div class="header_login"><a onClick="location.href = '<?php echo URL . LANG . '/users/editCreateUser/' . Session::get('userid'); ?>'">My account</a> <a onClick="location.href = '<?php echo URL . 'login/out'; ?>'">Logout</a></div>
                    <div class="header_admin_title">Administration panel</div>
                    </div>
                </div> 
                <nav class="header_menu" id="sidebarnav">
                    <div class="wrapper">
                    <ul id="menuNav">
                        <? if (Session::get('role') == 1 || Session::get('role') == 6 || Session::get('role') == 2) { ?><li><a href="<?php echo URL . LANG; ?>/home/lista">home</a></li><? } ?>
                        <li><a href="<?php echo URL . LANG; ?>/projects/lista">projects</a></li>
                        <li><a href="<?php echo URL . LANG; ?>/pages/lista">pages</a></li>
<!--                        <li><a href="<?php echo URL . LANG; ?>/packages/lista">packages</a></li>
                        <li><a href="<?php echo URL . LANG; ?>/contacts/lista">contacts</a></li>-->
                        <? if (Session::get('role') == 1 || Session::get('role') == 6 || Session::get('role') == 2) { ?><li><a href="<?php echo URL . LANG; ?>/agencies/lista">agencies</a></li> <? } ?>
                        <? if (Session::get('role') == 1 || Session::get('role') == 6 || Session::get('role') == 2) { ?><li><a href="<?php echo URL . LANG; ?>/users/lista">users</a></li><? } ?>
                        <? if (Session::get('role') == 1 || Session::get('role') == 6 || Session::get('role') == 2) { ?><li><a href="<?php echo URL . LANG; ?>/log/lista">log</a></li><? } ?>
                    </ul>
                    <ul id="langNav">
                        <li><a href="<?=WEB?>" target="_blank">Alma Branding Homepage</a></li>
              
                    </ul>
                    </div>
                </nav>
                <div class="header_shadow"></div>
            
            </header>
        <div id="wrapper">
            
            <div id="mainarea">
                <div class="white_full hide" id="white_full" onclick="$('.hide').css('display', 'none')"></div>
                <div id="container">

