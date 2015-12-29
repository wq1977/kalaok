<?php
include_once("db.php");

function status($status){
    if ($status == 0) return "等待下载";
    if ($status == 3) return "正在下载";
    if ($status == 4) return "等待播放";
    if ($status == 1) return "正在播放";
    if ($status == 2) return "播放完毕";
}

$ret=mysql_query("select * from `orders`,`songs` where `orders`.`status` != 2 and `orders`.`which` = `songs`.id");
?>

<?php include("top.php"); ?>

<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">

<?php 
    while ($array = mysql_fetch_array($ret)) {         
        $status=status($array["status"]);
        echo ("<li><a href=\"#\" data-id=\"" .$array["which"]. "\"><img src=\"". $array["imageurl"] ."\"><h2>" .$array["name"]. "</h2><p>" . $array["artist"] . "</p><p class=\"ui-li-aside\"><strong>$array[who]</strong> $status</p></a></li> ");
    }
?> 

</ul>

<div id="PopupPH">
      <!-- placeholder for popup -->
</div>

<script>

    var currentId = 0;
    
    $('#page').on('pageinit', function(){
        $('#searchlist li a').click(function(e){
            e.preventDefault();
            currentId = $(this).attr("data-id");
            $("#PopupPH").load("./order.php?songid="+currentId);
        });
    });

    </script>

<?php include("bottom.php"); ?>
