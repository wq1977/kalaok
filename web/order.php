<?php
include_once("db.php");
$sql=mysql_query("select * from `songs` where id=$_GET[songid] LIMIT 1;");
$array=mysql_fetch_array($sql);
mysql_query("insert into `orders` values(DEFAULT,\"$_COOKIE[name]\",Now(),$_GET[songid],DEFAULT); ");
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
            <h1>点歌成功</h1>
        </div><!-- /header -->

        <div class="ui-content" role="main">
            <p><?php echo "$array[name] $array[artist]"; ?>  已添加到播放列表！</p>
        </div>

        <a href="/" class="ui-btn ui-corner-all ui-shadow ui-btn-b" data-rel="back">返回</a>

    </div><!-- dialog-->

</body>
</html>
