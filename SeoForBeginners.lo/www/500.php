<?php  $time = microtime(true);
header('Content-Type: text/html;charset=UTF-8');
// Core
use core\classes\request;
use core\classes\dbus;
use core\classes\DB\DB as DBCore;
// Conf 
use \site\conf\DIR;
// ORM
use ORM\tree\compContTree;

// Config DIR
include 'W:/hosting/public/www/SiteCoreFlame/SeoForBeginners.lo/conf/DIR.php';
include DIR::CORE.'site/function/autoload.php';
include DIR::CORE.'core/function/errorHandler.php';
include DIR::CORE.'core/classes/DB/adapter/mysql/adapter.php';
// Add DB conf param
DBCore::addParam('site', \site\conf\DB::$conf);

session_start();
dbus::$user = isset($_SESSION['userData']) ? $_SESSION['userData'] : null;
try{
}catch(Exception $ex){
    header('Status: 500 Internal Server Error');
    exit;
}try{}catch(Exception $ex){
    header('Status: 502 Internal Server Error');
    exit;
}

?><!DOCTYPE HTML>
<html lang="" dir="ltr">

<head>
    <title>500 - Ошибка на странице</title>
    <link rel="stylesheet" href="/res/css/base.css" />
    <link rel="stylesheet" href="/res/css/error.css" />
    <link rel="shortcut icon" href="/res/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="/res/favicon.png" />
    <!--[if IE 6]><style>body{height:100%;width:100%}.error,
                                                     .error
span{zoom:1}.error-browser
.error{font-size:20px;line-height:inherit}.error-browser .error
a{-pie-png-fix:true;behavior:url("/res/js/warp/css3pie.htc")}</style><![endif]-->
</head>

<body id="page" class="page">

<div class="center error-404">

    <h1 class="error">
        <span>500</span>
    </h1>
    <h2 class="title">Ошибка на странице</h2>
    <p class="message">
        На странице, которую вы просматривате, произошла ошибка
        <a href="javascript:history.go(-1)">Вернуться назад</a>
    </p>
</div>

</body>
</html><? echo microtime(true) - $time ?>