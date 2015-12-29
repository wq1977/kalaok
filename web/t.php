<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popup - jQuery Mobile Demos</title>
    <link rel="stylesheet" href="./css/themes/default/jquery.mobile-1.4.5.min.css">
    <script src="./js/jquery.js"></script>
    <script src="./_assets/js/index.js"></script>
    <script src="./js/jquery.mobile-1.4.5.min.js"></script>
    <script src="./js.cookie.js"></script>
    </head>
<body>

<div data-role="page">
    <div data-role="header" data-position="fixed" data-theme="b">
        <h1>欢迎你<span id="submittername"><?php if(isset($_COOKIE["name"])) echo "：$_COOKIE[name]"; ?></span></h1>
    </div><!-- /header -->
    <div role="content">
