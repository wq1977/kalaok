    
<?php include("global.php") ?>
</div>
<div data-role="footer" data-theme="b" data-position="fixed"><div data-role="navbar" data-iconpos="top"><ul>
<li><a href="index.php" <?php if (stripos($_SERVER["SCRIPT_NAME"],"index.php")!==FALSE) echo "class=\"ui-btn-active\""; ?> data-icon="grid" >正在播放</a></li>
<li><a href="ordermenu.php" <?php if (stripos($_SERVER["SCRIPT_NAME"],"ordermenu.php")!==FALSE) echo "class=\"ui-btn-active\""; ?> data-icon="star">在线点歌</a></li>
<li><a href="control.php" <?php if (stripos($_SERVER["SCRIPT_NAME"],"control.php")!==FALSE) echo "class=\"ui-btn-active\""; ?> data-icon="gear">控制面板</a></li></ul></div><!-- /navbar --></div><!-- footer -->

</div> <!-- page -->


</body>
</html>
