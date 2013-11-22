<?
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=($this->siteName)?>Datuna</title>
    <meta charset="UTF-8"> 
    <meta property="og:site_name" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="<?= URL; ?>favicon.ico" Content-type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minium-scale=1.0,user-scalable=yes"/>
    <link rel="stylesheet" href="<?= URL; ?>public/css/style.css" />
    <link rel="stylesheet" href="<?= URL; ?>public/css/mobile.css" />
    <link rel="stylesheet" href="<?= URL; ?>public/css/shadowbox.css">
    <?
    if (isset($this->css))
        foreach ($this->css as $css)
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'"/>';
    ?>
</head>
    
    