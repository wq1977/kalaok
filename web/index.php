<?php include("top.php"); ?>

<ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">
    <li><a href="#"><img src="../_assets/img/album-bb.jpg"><h2>Broken Bells</h2><p>Broken Bells</p></a><a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a></li>
    <li><a href="#"><img src="../_assets/img/album-hc.jpg"><h2>Warning</h2><p>Hot Chip</p></a><a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a></li>
    <li><a href="#"><img src="../_assets/img/album-p.jpg"><h2>Wolfgang Amadeus Phoenix</h2><p>Phoenix</p></a><a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop">Purchase album</a></li>
</ul>
<div data-role="popup" id="purchase" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
    <h3>Purchase Album?</h3>
<p>Your download will begin immediately on your mobile device when you purchase.</p>
    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini">Buy: $10.99</a>
    <a href="index.html" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-inline ui-mini">Cancel</a>
</div>

<?php include("bottom.php"); ?>
