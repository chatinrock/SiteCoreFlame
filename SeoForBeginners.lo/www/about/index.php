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
}dbus::$comp['popular'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '16',
	'nsPath' => 'spl/artPopular/',
	'contId' => '330',
);
dbus::$comp['last'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '15',
	'nsPath' => 'spl/artLast/',
	'contId' => '332',
);
dbus::$comp['catalog'] = array(
	'tpl' => 'main.php',
	'compId' => '14',
	'nsPath' => 'spl/catalogCont/',
	'contId' => '334',
);
dbus::$comp['breadcrumbs'] = array(
	'tpl' => 'main.php',
	'compId' => '12',
	'nsPath' => 'spl/breadCrumbs/',
	'contId' => '337',
	'breadcrumbs' => [
		['caption' => 'Обо мне','name' => 'about'],
	]
);
try{}catch(Exception $ex){
    header('Status: 502 Internal Server Error');
    exit;
}

?><!DOCTYPE HTML>
<html lang="" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?
        echo '<title></title>'.PHP_EOL;
        echo '<meta name="description" content="" />'.PHP_EOL;
        echo '<meta name="keywords" content="" />'.PHP_EOL;
        ?><script>var dbus={};</script>        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="/res/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="/res/favicon.png" />
        <!--<link rel="alternate" type="application/rss+xml" title="RSS description" href="#!link to RSS" />-->
        <meta name="generator" content="Flame 0.9.1" />
        <style>
            body { min-width: 960px; }
            .wrapper { width: 960px; }
            #sidebar-a { width: 320px; }
            #maininner { width: 640px; }
            #menu .dropdown { width: 230px; }
            #menu .columns2 { width: 460px; }
            #menu .columns3 { width: 690px; }
            #menu .columns4 { width: 920px; }
        </style>
        <link rel="stylesheet" href="/res/css/base.css" />
        <link rel="stylesheet" href="/res/css/layout.css" />
        <link rel="stylesheet" href="/res/css/menus.css" />
        <link rel="stylesheet" href="/res/css/modules.css" />
        <link rel="stylesheet" href="/res/css/tools.css" />
        <link rel="stylesheet" href="/res/css/system.css" />
        <link rel="stylesheet" href="/res/css/extensions.css" />
        <link rel="stylesheet" href="/res/css/custom.css" />
        
        <link rel="stylesheet" href="/res/css/font2/cambria.css" />
        <link rel="stylesheet" href="/res/css/font3/cambria.css" />
        
        <link rel="stylesheet" href="/res/css/color1/green.css" />
        <link rel="stylesheet" href="/res/css/styles/green/css/style.css" />
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>

    </head>
    
    <body id="page" class="page sidebar-a-right sidebar-b-right isblog wp-single" data-config='{"twitter":0,"plusone":0,"facebook":0}'>
                <div class="wrapper grid-block">
          <header id="header">

    <div id="toolbar" class="grid-block">
        <div class="float-left"></div>
    </div>

    <div id="headerbar" class="grid-block">

        <a id="logo" href="/"><img src="/res/images/logo.png" width="220" height="100" alt="logo"/></a>

        <div class="left">
            <div class="module   deepest">

                <div class="follow-social">
                    <a class="facebook" title="Follow us on Facebook" href="#"></a>
                    <a class="twitter" title="Follow us on Twitter" href="#"></a>
                    <a class="google" title="Follow us on Google +" href="#"></a>
                    <a class="vimeo" title="Follow us on Vimeo" href="#"></a>
                    <a class="youtube" title="Follow us on YouTube" href="#"></a>
                    <a class="delicious" title="Save to Delicious" href="#"></a>
                    <a class="rss" title="Subscribe to RSS" href="#"></a>
                </div>
            </div>
        </div>

    </div>

    <div id="menubar" class="grid-block">

        <nav id="menu">
                    </nav>

        <div id="search">
            <!--<form id="searchbox" action="#search" method="get" role="search">
                <input type="text" value="" name="s" placeholder="search..." />
                <button type="reset" value="Reset"></button>
            </form>-->


            <!--<script>
                jQuery(function($) {
                    $('#searchbox input[name=s]').search({'url': '#', 'param': 's', 'msgResultsHeader': 'Search Results', 'msgMoreResults': 'More Results', 'msgNoResults': 'No results found'}).placeholder();
                });
            </script>-->
        </div>

    </div>

</header>


<div id="main" class="grid-block">

    <div id="maininner" class="grid-box">
    <?php site\core\comp\spl\breadCrumbs\logic\breadCrumbs::renderAction('breadcrumbs'); ?>
    </div>
<aside id="sidebar-a" class="grid-box" style="min-height: 2442px;">
    <?php site\core\comp\spl\artPopular\logic\main::renderAction('popular'); ?>
<?php site\core\comp\spl\artLast\logic\main::renderAction('last'); ?>
<?php site\core\comp\spl\catalogCont\logic\catalogCont::renderAction('catalog'); ?>
</aside>

</div>
<!-- main end -->


<footer id="footer" class="grid-block">

    <a id="totop-scroller" href="#page"></a>

    <div class="module   deepest">
        Copyright © 2011-2012 <a href="http://seofrombeginners.ru">SeoForBeginners</a>. Все права
        защищены<br/>
    </div>
</footer>
        </div>

        <script src="/res/js/warp/warp.js"></script>
        <!-- Для выпадающего меню -->
        <!-- <script src="/res/js/warp/accordionmenu.js"></script>-->
        <!-- Для выпадающего меню -->
        <!--<script src="/res/js/warp/dropdownmenu.js"></script>-->
        <!--<script src="/res/js/warp/search.js"></script>-->

                        <script>
            function $import(src){
                var scriptElem = document.createElement('script');
                scriptElem.setAttribute('src',src);
                scriptElem.setAttribute('type','text/javascript');
                document.getElementsByTagName('head')[0].appendChild(scriptElem);
            }

            setTimeout(function(){
                $import('/res/js/template.js');
                <?php
            $dbusHeadCount = count(dbus::$head['jsDyn']);
            for( $i = 0; $i < $dbusHeadCount; $i++ ){
                 echo '$import("'.dbus::$head['jsDyn'][$i].'");';
            } // if
?>
        }, 700);</script>

    </body>
</html><? echo microtime(true) - $time ?>