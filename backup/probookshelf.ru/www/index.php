<?session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <style>
            /*#divBox{
           width: 768px;
           height: 10px;
           background-color: blue;
       }*/

        .divBox{
            border: 1px red solid;
            margin: 30px 30px 30px;
            padding: 10px 10px 10px 10px;
        }


    </style>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
        google.load("jquery", "1.5.2");
        google.load("jqueryui", "1.8.15");
    </script>
    <script src="http://iorator.ru:6875/socket.io/socket.io.js"></script>
</head>
<body>
<div class="divBox"> 1
    <div class="divBox">2
        <div class="divBox">3
        </div>
    </div>
</div>


<div id="debug"></div>


<script>
    var spyAgent = (function(){
        var options;
        var socket;

        function onWindowResize(){

            var browserWindow = $(window);
            var width = browserWindow.width();
            var height = browserWindow.height();

            socket.emit('winResize', width, height);

            // func. windowResize
        }

        function onMouseMove(e){
            socket.emit('mousemove', e.pageX, e.pageY);
            $('#debug').html('x='+e.pageX + ' y='+ e.pageY);
            // func. onMouseMove
        }

        function init(pOptions){
            options = pOptions;

            socket = io.connect('iorator.ru/user', {port: 6875});

            socket.on('connect', function () { // TIP: you can avoid listening on `connect` and listen on events directly too!
                //socket.emit('private message', {from:1, msg:'3423'}, 23423);
                console.log(socket.socket.sessionid);
                //console.log(socket);
            });

            socket.on('disconnect', function () { // TIP: you can avoid listening on `connect` and listen on events directly too!
                console.log('disconect');
            });

            //$(window).resize(onWindowResize);

            //$(window).mousemove(onMouseMove);
            // func. init
        }
        return {
            init: init
        }
    })();

    if ( window.location.search.indexOf('debug') != 1 ){
        spyAgent.init({
        });
    }


</script>
</body>
</html>