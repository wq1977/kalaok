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
    $(document).on("pagehide", "div[data-role=page]", function(event){
        $(event.target).remove();
    });
</script>
