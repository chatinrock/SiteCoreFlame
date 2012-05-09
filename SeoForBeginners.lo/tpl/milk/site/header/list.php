<!doctype html>  
<head>

    <title>Menu</title>
    <link rel="stylesheet" href="/res/menu/dark/css/style.css" />

</head>
<!doctype html>  
<head>

    <title>Menu</title>
    <link rel="stylesheet" href="/res/menu/dark/css/style.css" />

</head>

<body class="home blog layout-left-content gecko layout-left-content">


    <div id="wrapper">
        <header id="header">


            <nav id="main-nav">

                <? $this->block('test', 'Test'); ?>

                <div class="clear"></div>

            </nav><!--/main-nav-->

            <div class="clear"></div>

        </header><!-- /#header -->	
        <div id="two">
            <? $this->block('data', 'data'); ?>
        </div>
        <script>
            function getCookie(name){
                var cookieName = name + "=";
                var cookieLength = document.cookie.length;
                var cookieBegin = 0;
                while (cookieBegin < cookieLength){
                    var valueBegin = cookieBegin + cookieName.length;
                    if (document.cookie.substring(cookieBegin, valueBegin) == cookieName){
                        var valueEnd = document.cookie.indexOf (";", valueBegin);
                        if (valueEnd == -1){
                            valueEnd = cookieLength;
                        } // if valueEnd
                        return unescape(document.cookie.substring(valueBegin, valueEnd));
                    } // if document.cookie
                    cookieBegin = document.cookie.indexOf(" ", cookieBegin) + 1;
                    if (cookieBegin == 0){
                        break;
                    } // if cookieBdegin
                } // while
                return null;
                // func/ getCookie
            }
            
            var userMvc = (function(){
                function getData(){
                    var data = getCookie('userData');
                    return eval('(' + data + ')');
                }
                
                return {
                    getData: getData
                }
            })();
            
            console.log(userMvc.getData());
            //console.log(document.cookie);
        </script>

    </div><!-- /#wrapper -->
</body>
</html>