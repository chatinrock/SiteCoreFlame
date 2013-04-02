<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs
   ================================================== -->
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/base.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/skeleton.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/layout.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
     ================================================== -->
    <link rel="shortcut icon" href="/res/img/favicon.ico">
    <link rel="apple-touch-icon" href="/res/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/res/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/res/img/apple-touch-icon-114x114.png">

    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>


    <style>
        #loginBox{
            margin-top: 200px;
        }

        #loginForm{
            width: 300px;
            margin: auto;
            display: block;
        }

        #loginForm input{
            margin-bottom: 3px;
        }


        #loginBtn{
            width: 220px;
        }
    </style>

</head>
<body>

<div id="loginBox" class="container" >
    <form id="loginForm" action="?action=auth" method="post">
        <tbody>
        <tr><td><?=self::get('status');?></td></tr>
        <tr><td>Логин</td></tr>
        <tr><td><input type="text" name="login" value="<?=self::get('login');?>"></td></tr>
        <tr><td>Пароль</td></tr>
        <tr><td><input type="password" name="pwd"></td></tr>
        <tr><td><input type="submit" value="Отправить" id="loginBtn"></td></tr>

        </tbody>
    </form>
</div>




</body>
</html>