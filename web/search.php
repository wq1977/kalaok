<?php

include_once("db.php");

$GLOBAL_TYPE_PARAM = "d7bd83313b5b444";
$GLOBAL_TIANLAI_KEY = "6ae993829ca5410e888f5e97b73ee4a810bb242149fd46ada5777edf587b4225";    
$request = base64_encode("{\"firstSize\":0,\"type\":2,\"common\":{\"clientversion\":\"3.3.9\",\"model\":\"sdk\",\"imei\":\"000000000000000\",\"userid\":0,\"resolution\":\"1196X720\",\"apiversion\":\"3.2.0\",\"product\":\"KALAOK\",\"clienttype\":\"Android\",\"nettype\":\"epc.tmobile.com\",\"updatechannel\":\"37\",\"login\":0,\"language\":1,\"imsi\":\"89014103211118510720\",\"systemversion\":\"17\",\"channel\":\"YYH\"},\"maxSize\":300,\"keyWord\":\"" . $_GET["artist"] . "\"}");
$sign=md5($request . $GLOBAL_TIANLAI_KEY);
$url="http://sns.audiocn.org/tlcysns/content/search.action?request=" . $request . "&sign=" . $sign ."&type=". $GLOBAL_TYPE_PARAM;
$html = file_get_contents($url); 

?>

<?php include("top.php"); ?>

<ul data-role="listview" data-split-icon="gear" id="searchlist" data-split-theme="a" data-inset="true">

<?php 
    $ret=json_decode($html, true); 
    
    foreach ($ret["songs"] as $idx => $song) {  
        mysql_query("INSERT IGNORE INTO `songs` SET `id` = $song[id],`name` = \"$song[name]\",`artist`=\"$song[artist]\",`imageurl`=\"$song[singer_image]\";");
        echo ("<li><a href=\"#\" data-id=\"" .$song["id"]. "\"><img src=\"". $song["singer_image"] ."\"><h2>" .$song["name"]. "</h2><p>" . $song["artist"] . "</p></a></li> ");
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
