<?php include("t.php"); ?>

<!-- put you content here and should not be heavely depend JS -->
<?php
include_once("db.php");

function status($status){
    if ($status == 0) return "等待下载";
    if ($status == 3) return "正在下载";
    if ($status == 4) return "等待播放";
    if ($status == 1) return "正在播放";
    if ($status == 2) return "播放完毕";
}
$ret=mysql_query("select `orders`.id as id, `orders`.status, `orders`.who,songs.imageurl,songs.name,songs.artist from `orders`,`songs` where `orders`.`status` != 2 and `orders`.`status` != 10 and `orders`.`which` = `songs`.id order by orders.when");
?>

<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">

<?php
    while ($array = mysql_fetch_array($ret)) {
        $status=status($array["status"]);
        echo ("<li><a href=\"raise.php?orderid=$array[id]\" data-rel=\"dialog\" data-transition=\"pop\"><img src=\"". $array["imageurl"] ."\"><h2>" .$array["name"]. "</h2><p>" . $array["artist"] . " <strong>$array[who]</strong> $status</p></a><a href=\"cancel.php?orderid=$array[id]\" data-rel=\"dialog\" data-transition=\"pop\">取消</a></li> ");
    }
?>

</ul>

<?php include("b.php"); ?>
