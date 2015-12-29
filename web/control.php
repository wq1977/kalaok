<?php include("t.php"); ?>

<div class="ui-body-a ui-body">
    <div data-role="navbar">
        <ul>
            <li><a href="operate.php?opt=cancel" data-rel="dialog" data-transition="pop"  data-icon="grid">切歌</a></li>
            <li><a href="operate.php?opt=mv" data-rel="dialog" data-transition="pop"  data-icon="star">原唱</a></li>
            <li><a href="operate.php?opt=mtv" data-rel="dialog" data-transition="pop"  data-icon="gear">伴唱</a></li>
        </ul>
    </div><!-- /navbar -->
</div><!-- /container -->

<p/>
<div class="ui-body-a ui-body">
<form><label for="slider-7">伴奏音量:</label><input type="range" name="slider-7" id="slider-7" min="0" max="100" value="50"></form>
</div>

<p/>
<div class="ui-body-a ui-body">
<form><label for="slider-7">麦克音量:</label><input type="range" name="slider-7" id="slider-7" min="0" max="100" value="50"></form>
</div>

<?php include("b.php"); ?>
