<?php
include_once("db.php");
mysql_query("delete from `orders` where `id`=$_GET[orderid];");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transitions - jQuery Mobile Demos</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="../_assets/css/jqm-demos.css">
    <script src="../js/jquery.js"></script>
    <script src="../_assets/js/index.js"></script>
    <script src="../js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

    <div data-role="page" id="dialog-success" data-dom-cache="true"><!-- dialog-->

        <div data-role="header" data-theme="b">
            <h1>歌曲已取消</h1>
        </div><!-- /header -->

        <a href="/" class="ui-btn ui-corner-all ui-shadow ui-btn-b" data-rel="back">返回</a>

    </div><!-- dialog-->

</body>
</html>
