<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>树莓派点唱系统</title>
    <link rel="stylesheet" href="./css/themes/default/jquery.mobile-1.4.5.min.css">
    <script src="./js/jquery.js"></script>
    <script src="./_assets/js/index.js"></script>
    <script src="./js/jquery.mobile-1.4.5.min.js"></script>
    <script src="./js.cookie.js"></script>
    </head>
<body>

<?php $df = round(disk_free_space("/")/1024/1024,2); $dfdesc="${df}M free"; ?>

<div data-role="page">
    <div data-role="header" data-position="fixed" data-theme="b">
        <h1>欢迎你<span id="submittername"><?php if(isset($_COOKIE["name"])) echo "：$_COOKIE[name]"; ?></span> <?php echo "<small>($dfdesc)</small>"; ?></h1>
    </div><!-- /header -->
    <div role="content">
