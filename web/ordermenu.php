<?php include("t.php"); ?>
<?php if (isset($_GET["artist"])) $value=$_GET["artist"]; else $value=""  ?>
<!-- put you content here and should not be heavely depend JS -->
<form><div style="padding:0px 20px;"><input type="search" name="artist" id="search" value="<?php echo $value; ?>" placeholder="周杰伦"></div></form>

<?php
include_once("db.php");
if (isset($_GET["artist"]) && strlen($_GET["artist"])>0){

$GLOBAL_TYPE_PARAM = "d7bd83313b5b444";
$GLOBAL_TIANLAI_KEY = "6ae993829ca5410e888f5e97b73ee4a810bb242149fd46ada5777edf587b4225";
$request = base64_encode("{\"firstSize\":0,\"type\":2,\"common\":{\"clientversion\":\"3.3.9\",\"model\":\"sdk\",\"imei\":\"000000000000000\",\"userid\":0,\"resolution\":\"1196X720\",\"apiversion\":\"3.2.0\",\"product\":\"KALAOK\",\"clienttype\":\"Android\",\"nettype\":\"epc.tmobile.com\",\"updatechannel\":\"37\",\"login\":0,\"language\":1,\"imsi\":\"89014103211118510720\",\"systemversion\":\"17\",\"channel\":\"YYH\"},\"maxSize\":300,\"keyWord\":\"" . $_GET["artist"] . "\"}");
$sign=md5($request . $GLOBAL_TIANLAI_KEY);
$url="http://sns.audiocn.org/tlcysns/content/search.action?request=" . $request . "&sign=" . $sign ."&type=". $GLOBAL_TYPE_PARAM;
$html = file_get_contents($url);
?>

<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">

<?php
    $ret=json_decode($html, true);

    foreach ($ret["songs"] as $idx => $song) {
        mysql_query("INSERT IGNORE INTO `songs` SET `id` = $song[id],`name` = \"$song[name]\",`artist`=\"$song[artist]\",`imageurl`=\"$song[singer_image]\";");
        echo ("<li><a href=\"order.php?songid=" .$song["id"]. "\" data-rel=\"dialog\" data-transition=\"pop\"><img src=\"". $song["singer_image"] ."\"><h2>" .$song["name"]. "</h2><p>" . $song["artist"] . "</p></a></li> ");
    }
?>

</ul>

<?php

}
else{
    $sql="select * from songs,(select distinct (which) from orders order by `when` desc limit 10) as t1 where songs.id=t1.`which`";
    $ret=mysql_query($sql);
?>
<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">
<?php
    while ($array = mysql_fetch_array($ret)) {
        echo ("<li><a href=\"order.php?songid=" .$array["id"]. "\" data-rel=\"dialog\" data-transition=\"pop\"><img src=\"". $array["imageurl"] ."\"><h2>" .$array["name"]. "</h2><p>" . $array["artist"] . "</p></a></li> ");
    }            
?>
</ul>
<?php
}
?>

<?php include("b.php"); ?>
