<?php include("t.php"); ?>
<?php if (isset($_GET["artist"])) $value=$_GET["artist"]; else $value=""  ?>
<!-- put you content here and should not be heavely depend JS -->
<form><div style="padding:0px 20px;"><input type="search" name="artist" id="search" value="<?php echo $value; ?>" placeholder="周杰伦"></div></form>

<?php
include_once("db.php");
function create_uuid($prefix = ""){    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));   
    $uuid  = substr($str,0,8) . '-';   
    $uuid .= substr($str,8,4) . '-';   
    $uuid .= substr($str,12,4) . '-';   
    $uuid .= substr($str,16,4) . '-';   
    $uuid .= substr($str,20,12);   
    return $prefix . $uuid;
}
if (isset($_GET["artist"]) && strlen($_GET["artist"])>0){
$value=trim($value);
$GLOBAL_TYPE_PARAM = "d7bd83313b5b444";
$GLOBAL_TIANLAI_KEY = "6ae993829ca5410e888f5e97b73ee4a810bb242149fd46ada5777edf587b4225";
$rawr='{"common":{"talkdeviceid":"3e3fb9ac4463b26204698da6c2e737b36","uuid":"","reqkey":"'. create_uuid() .'","updatechannel":"2","apiversion":"3.2.0","devicetype":"Android","userid":0,"imei":"1eb4acb9813301ef","systemversion":"21","login":0,"clientversion":"3.3.9","nettype":"wifi","resolution":"720X1280","language":1,"clienttype":"Android","channel":"TLKG01","imsi":null,"model":"AppRuntimeforChromeDev","product":"KALAOK"},"maxSize":100,"firstSize":0,"type":2,"keyWord":"'.$value.'"}';
$request = base64_encode($rawr);
$sign=md5($request . $GLOBAL_TIANLAI_KEY);
$url="http://sns.audiocn.org/tlcysns/content/search.action?request=" . $request . "&sign=" . $sign ."&type=". $GLOBAL_TYPE_PARAM;
$html = file_get_contents($url);
?>

<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">

<?php
    $ret=json_decode($html, true);

    if (isset($ret["songs"])){
        foreach ($ret["songs"] as $idx => $song) {
            mysql_query("INSERT IGNORE INTO `songs` SET `id` = $song[id],`name` = \"$song[name]\",`artist`=\"$song[artist]\",`imageurl`=\"$song[singer_image]\";");
            echo ("<li><a href=\"order.php?songid=" .$song["id"]. "\" data-rel=\"dialog\" data-transition=\"pop\"><img src=\"". $song["singer_image"] ."\"><h2>" .$song["name"]. "</h2><p>" . $song["artist"] . "</p></a></li> ");
        }
    }
?>

</ul>

<?php

}
else{
    $sql="select * from songs,(select distinct (which) from orders where `status`=2 order by `when` desc limit 30) as t1 where songs.id=t1.`which`";
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
