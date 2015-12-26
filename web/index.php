
<!DOCTYPE html> 
<html> 
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popup - jQuery Mobile Demos</title>
    <link rel="stylesheet" href="./css/themes/default/jquery.mobile-1.4.5.min.css">
    <script src="./js/jquery.js"></script>
    <script src="./_assets/js/index.js"></script>
    <script src="./js/jquery.mobile-1.4.5.min.js"></script>
    <script src="./js.cookie.js"></script>
    </head>
<body> 

<div data-role="page">

    <div role="content">

            <div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all" data-history="false">
                <form>
                    <div style="padding:10px 20px;">
                        <h3>Please sign in</h3>
                        <label for="un" class="ui-hidden-accessible">Username:</label>
                        <input type="text" name="user" id="un" value="" placeholder="username" data-theme="a">
                        <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Sign in</button>
                    </div>
                </form>
            </div>
            <script type="text/javascript" language="JavaScript">
                $(":jqmData(role='page'):last").on("pageshow", function(event) {
                    if (typeof Cookies.get("name") !== 'undefined'){
                    }
                    else{
                        $("#popupLogin", $(this)).popup("open");
                    }
                });
            </script>
    </div>
</div><!-- /page -->

</body>
</html>

