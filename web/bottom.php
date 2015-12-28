            <div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all" data-history="false" data-dismissible="false">
                <form>
                    <div style="padding:10px 20px;">
                        <h3>请输入一个名字让别人知道你是谁：</h3>
                        <label for="un" class="ui-hidden-accessible">Username:</label>
                        <input type="text" name="user" id="un" value="" placeholder="K歌之王" data-theme="a">
                        <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" onclick="var text = $('#popupLogin').find('input[name=user]').val(); if (text.length>0){$('#popupLogin').popup('close');Cookies.set('name',text,{ expires:365 }); } return false;">提交</button>
                    </div>
                </form>
            </div>
            <script type="text/javascript" language="JavaScript">
                $(":jqmData(role='page'):last").on("pageshow", function(event) {
                    if (typeof Cookies.get("name") !== 'undefined'){
                        $("#submittername").text("："+Cookies.get("name"));
                    }
                    else{
                        $("#popupLogin", $(this)).popup("open");
                    }
                });
            </script>

            <div data-role="popup" id="popupOrder" data-theme="a" class="ui-corner-all" data-history="false">
                <form action="search.php">
                    <div style="padding:10px 20px;">
                        <h3>请输入歌曲或者歌手的名字：</h3>
                        <label for="un" class="ui-hidden-accessible">Username:</label>
                        <input type="text" name="artist" id="artist" value="" placeholder="K歌之王" data-theme="a">
                        <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">提交</button>
                    </div>
                </form>
            </div>

    </div>
    
<div data-role="footer" data-theme="b" data-position="fixed" style="overflow:hidden;"><div data-role="navbar" data-iconpos="top"><ul>
<li><a href="index.php" <?php if (stripos($_SERVER["SCRIPT_NAME"],"index.php")!==FALSE) echo "class=\"ui-btn-active\""; ?> data-icon="grid" >正在播放</a></li>
<li><a href="#popupOrder" <?php if (stripos($_SERVER["SCRIPT_NAME"],"search.php")!==FALSE) echo "class=\"ui-btn-active\""; ?>data-rel="popup" data-position-to="window" data-transition="pop" data-icon="star">在线点歌</a></li>
<li><a href="recently.php" <?php if (stripos($_SERVER["SCRIPT_NAME"],"recently.php")!==FALSE) echo "class=\"ui-btn-active\""; ?> data-icon="gear">最近演唱</a></li></ul></div><!-- /navbar --></div>

</div><!-- /page -->

</body>
</html>

