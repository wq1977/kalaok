<?php
    include_once("db.php");
    $music=50;
    if (isset($_POST["submit"])){
        $music=$_POST["music"];
        $opt=$_POST["submit"];
        if ($opt == "volume"){
            $opt = "$opt|$_POST[music]";
        }
        mysql_query("insert into `operations` values(DEFAULT,\"$opt\",\"$_COOKIE[name]\",Now(),0); ");
    }
    else{
        $ret=mysql_query("select operation from operations where operation like 'volume%' order by `when` desc");
        if ($array = mysql_fetch_array($ret)){
            $latestvalue = $array["operation"];
            $values=explode("|",$latestvalue);
            $music = 0+$values[1]; 
        }
    }
?>

<?php include("t.php"); ?>

<form action="control.php" method="post">
<div class="ui-body-a ui-body">
    <div data-role="navbar">
        <ul>
            <li><button type="submit" name="submit" value="cancel" data-theme="a" data-icon="grid">切歌</button></li>
            <li><button type="submit" name="submit" value="mv" data-theme="a" data-icon="grid">原唱</button></li>
            <li><button type="submit" name="submit" value="mtv" data-theme="a" data-icon="grid">伴唱</button></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /container -->

<p/>
<div class="ui-body-a ui-body">
<label for="music">伴奏音量:</label><input type="range" name="music" id="music" min="0" max="100" value="<?php echo $music; ?>">
<p/>
<button type="submit" name="submit" value="volume" data-theme="a">更改音量</button>
</form>
</div>

<?php include("b.php"); ?>
