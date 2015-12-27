<?php
include_once("db.php");
$sql=mysql_query("select * from `songs` where id=$_GET[songid] LIMIT 1;");
$array=mysql_fetch_array($sql);
mysql_query("insert into `orders` values(DEFAULT,\"$_COOKIE[name]\",Now(),$_GET[songid],DEFAULT); ");
?>

<div data-role="popup">
  <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
  <h1> 点歌成功 </h1>
  <h2> <?php echo "$array[name] $array[artist]"; ?>  已添加到播放列表！</h2>
  <!-- contents -->
  <script>
    $("[data-role=popup]").enhanceWithin().popup({
        afterclose: function () {
            $(this).remove();
        }
    }).popup("open");
  </script>
</div>
