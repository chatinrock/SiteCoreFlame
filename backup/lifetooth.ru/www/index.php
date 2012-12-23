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
include '/opt/www/SiteCoreFlame/lifetooth.ru/conf/DIR.php';
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
}dbus::$comp['rtmenu'] = array(
	'tpl' => 'topLine.php',
	'compId' => '5',
	'nsPath' => 'spl/menu/',
	'contId' => '12',
);
dbus::$comp['mmenu'] = array(
	'tpl' => 'mian.php',
	'compId' => '5',
	'nsPath' => 'spl/menu/',
	'contId' => '12',
);
dbus::$comp['oiList'] = array(
	'tpl' => 'blog.php',
	'compId' => '10',
	'nsPath' => 'spl/oiList/',
	'contId' => '7',
	'urlTpl' => [
		'pageNav'=>'/blog/page/%s/',
		'category'=>'/blog/%s/',
	]
);
dbus::$comp['pagin'] = array(
	'tpl' => 'pagination.php',
	'compId' => '10',
	'nsPath' => 'spl/oiList/',
	'contId' => '7',
);
dbus::$comp['bcrumbs'] = array(
	'tpl' => 'main.php',
	'compId' => '12',
	'nsPath' => 'spl/breadCrumbs/',
	'contId' => '18',
	'breadcrumbs' => [
	]
);
dbus::$comp['catlist'] = array(
	'tpl' => 'bigLink.php',
	'compId' => '14',
	'nsPath' => 'spl/catalogCont/',
	'contId' => '24',
);
dbus::$comp['last'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '15',
	'nsPath' => 'spl/oiLaster/',
	'contId' => '14',
);
dbus::$comp['popular'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '16',
	'nsPath' => 'spl/oiPopular/',
	'contId' => '16',
);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
	<head>
        <meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- buildsys\library\event\manager\action\eventModel::getHeadData() | No DATA --><script>var dbus={};</script>        <meta name="viewport" content="width=device-width" />
		
		<link rel="shortcut icon" href="/res/icons/favicon.ico" />
		<link href="res/icons/icon128.png" rel="icon"/>
		<link href="res/icons/icon128.png" rel="apple-touch-icon-precomposed"/>
		
        <link rel="alternate" type="application/rss+xml" title="Rss лента" href="/res/main.rss" />
		<meta name="generator" content="Flame 2.4" />

        <link rel="stylesheet" type="text/css" media="all" href="http://theme.codecampus.ru/ultrasharp/css/style.css" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/colors/blue.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/shortcodes.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/fixed.css" media="screen" />  
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
		<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/js/scripts.js?ver=3.4'></script>
		<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/ddpanel/shortcodes/js/shortcodes.js?ver=3.4'></script>
<style type="text/css">
.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}

</style>
<style type="text/css">
    	h1, h2, h3, h4, h5, h6 { color: #505050 !important; }
		.page-title { color: #111111 !important; }
		
    	.page-slogan { color: #999999 !important; }
		
		h1, .page-title { font-size: 32px; line-height: 36px; }
		h2 { font-size: 26px; line-height: 30px; }
		h3 { font-size: 22px; line-height: 26px; }
		h4 { font-size: 16px; line-height: 20px; }
		h5 { font-size: 14px; line-height: 18px; }
		h6 { font-size: 11px; line-height: 15px; }
    
    	#footer h1, #footer h2, #footer h3, 
		#footer h4, #footer h5, #footer h6 { color: #ffffff !important; }
 </style>
<style type="text/css">
    	h1, h2, h3, h4, h5, h6 { font-family: Helvetica, Arial, sans-serif !important; font-style: normal !important; font-weight: bold !important; }
		
    	.page-slogan { font-family: Georgia, "Times New Roman", serif !important; font-style: italic !important; font-weight: normal !important; }
		
		h1 { font-size: 32px; line-height: 36px; }
		h2 { font-size: 26px; line-height: 30px; }
		h3 { font-size: 22px; line-height: 26px; }
		h4 { font-size: 16px; line-height: 20px; }
		h5 { font-size: 14px; line-height: 18px; }
		h6 { font-size: 11px; line-height: 15px; }
		.page-title { font-size: 40px; line-height: 44px; }
		
		a { color: #2d8fd2; }
		a:hover { color: #156ca8; }
</style>   
<script type="text/javascript">
			jQuery(document).ready(function() {
				//TOP BAR MENU DROPDOWN
				$('#top-bar ul').ddDropDown(true);
				
				//SEARCH BOX
				//$('#search-box').searchBox();
				//$('#search-box').ajaxSearch('#/themes/ultrasharp');				
				//gallery
				//$('.ddGallery').each(function() { jQuery(this).ddGallery(); });
				
				//replaces our select, radios and checkbox
				$('select:not(#select-preview-color)').each(function() { $(this).ddReplaceSelect(); });
				$('input[type="radio"]').each(function() { $(this).ddReplaceRadio(); });
				$('input[type="checkbox"]').each(function() { $(this).ddReplaceCheckbox(); });
				
			});
			
			$(window).load(function() {
				//fades out slightly on hover
				//jQuery('.ddFromTheBlog a img, .ddGallery li img, .flickr-widget img').ddFadeOnHover(.7);
				//jQuery('.post-thumb img, #related-posts img, #portfolio-slider-thumbs li img').ddFadeOnHover(.8);
				
				//animates our menu
				jQuery('#main-bar').mainBar('227dbd');
			});
</script> 
</head>
<body class="home blog fixed-page">
<div id="header">

    <div class="wrapper">
        <div id="top-info">
            <div class="left">
                <span class="telephone">+80254100215</span>
                <!--<span class="fax">+0 (000) 000 000</span>-->
                <span class="address">Москва ул. Славяская дом 3</span>
                <span class="email">test [at] test.ru</span>
            </div>
        </div>
        <div id="top-bar">
            <div class="left">
                <div class="menu-left-top-bar-container">
                                    </div>

            </div>
            <div class="right">

                <div class="top-bar-menu">
                    <?php core\comp\spl\menu\logic\menu::renderAction('rtmenu'); ?>
                </div>
                <!--<span id="search-box">
        
                <div class="pop-up">
                <div class="pop-up-wrapper">
                
                    <form action="#ultrasharp" method="get">
                    
                        <input type="text" name="s" id="s-input" value="Keywords..." onFocus="if(jQuery(this).val() == 'Keywords...') { jQuery(this).val(''); }" autocomplete="off" />
                        <input type="submit" id="s-submit" value="Search" class="button-color" />
                        
                        <div id="ajax-search"></div>
                        
                    
                    </form>

                </div>
                
                </div>
    
            </span>-->
            </div>

        </div>

        <div id="main-bar" class="full">
            <!-- /LOGO STARTS/ -->
            <!-- /LOGO ENDS/ -->
            <?php core\comp\spl\menu\logic\menu::renderAction('mmenu'); ?>

            <!-- /LOGO STARTS/ -->
            <div id="logo"><a href="http://themes.ddwebstudios.net/wordpress/ultrasharp/"><img
                    src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/logo-17.png"
                    alt="UltraSharp"/></a></div>
            <!-- /LOGO ENDS/ -->
        </div>
    </div>
</div>
<div class="padding-20"></div><div id="content">
    <div class="wrapper">
			
        <div id="content-wrapper">
            <div class="block main-content" id="sidebar-right">
                <div id="sidebar">
                    <?php core\comp\spl\catalogCont\logic\catalogCont::renderAction('catlist'); ?>
<?php core\comp\spl\oiLaster\logic\main::renderAction('last'); ?>
<?php core\comp\spl\oiPopular\logic\main::renderAction('popular'); ?>
                </div>
                <div id="main-content">
                    <?php core\comp\spl\breadCrumbs\logic\breadCrumbs::renderAction('bcrumbs'); ?>
                    <?php core\comp\spl\oiList\logic\main::renderByOneAction('oiList'); ?>
																				                </div>
                <div class="clear"></div>
                <?php core\comp\spl\oiList\logic\main::paginationDataAction('pagin'); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content-bottom-bg"></div>
        <div id="content-bottom-bg2"></div>
        <div class="clear"></div>
    </div>
</div><div id="footer" class="block-shadow">
	<div class="wrapper">
		        
		        
		        
		        
		        
	</div>
</div><div id="copyright">
    <div class="wrapper">
        <div class="left">LifeTooth.ru © 2012-2013</div>
        <div class="right">Все права защищены</div>
    </div>
</div>        <script>
            function $import(src){
                var scriptElem = document.createElement('script');
                scriptElem.setAttribute('src',src);
                scriptElem.setAttribute('type','text/javascript');
                document.getElementsByTagName('head')[0].appendChild(scriptElem);
            }

            setTimeout(function(){
                //$import('/res/js/template.js');
                <?php
            $dbusHeadCount = count(dbus::$head['jsDyn']);
            for( $i = 0; $i < $dbusHeadCount; $i++ ){
                 echo '$import("'.dbus::$head['jsDyn'][$i].'");';
            } // if
?>
        }, 700);</script>
</body>
</html><? echo '<!-- '.(microtime(true) - $time).' -->'; ?>