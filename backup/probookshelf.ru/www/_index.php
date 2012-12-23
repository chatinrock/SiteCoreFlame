<?php $time = microtime(true);
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
include '/opt/www/SiteCoreFlame/probookshelf.ru/conf/DIR.php';
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
}

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="ru"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="ru"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="ru"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ru"> <!--<![endif]-->
<head>
	
	<!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8" />

    <meta name="author" content="EdusGroup" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

	<!-- buildsys\library\event\manager\action\eventModel::getHeadData() | No DATA --><script>var dbus={};var importResList={"js":[],"css":[]};</script>
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
	<!-- Google Web Fonts
  ================================================== -->
  
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic' rel='stylesheet' type='text/css'>

	<!-- CSS
  ================================================== -->
  
	<link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/base.css">
	<link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/skeleton.css">
	<link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/layout.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/buttons.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/jquery-ui-fusion.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/text.css">
    
    <!-- superfish -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/superfish.css">
    <!-- superfish END -->
    
    <!-- layerslider -->
	<link rel="stylesheet" href="http://theme.codecampus.ru/fusion/layerslider/layerslider/css/layerslider.css" type="text/css">
	<link rel="stylesheet" href="http://theme.codecampus.ru/fusion/layerslider/layerslider/css/style.css" type="text/css">
    <!-- layerslider END -->
    
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/application.css">
    
    <!-- button styles -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/button-color.css">
    <!-- button styles END -->
    
    <!-- use if light background -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/light-bg.css">
    <!-- use if light background END -->
    
    <!-- skin -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/skin/unitedNationsBlue.css">
    
    <!-- pattern bg -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/fusion/css/pattern-bg/white_pattern_01.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="http://theme.codecampus.ru/fusion/images/favicon.ico">
	<link rel="apple-touch-icon" href="http://theme.codecampus.ru/fusion/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="http://theme.codecampus.ru/fusion/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="http://theme.codecampus.ru/fusion/images/apple-touch-icon-114x114.png">
    

	<!-- JS
	================================================== -->
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
        google.load("jquery", "1.5.2");
        google.load("jqueryui", "1.8.15");
    </script>
    
    <!-- carouFredSel -->
    <script type="text/javascript" language="javascript" src="http://theme.codecampus.ru/fusion/js/carouFredSel/jquery.carouFredSel-5.5.0-packed.js"></script>
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/js/carouFredSel/jquery.carouFredSel-functions.js"></script>
    <!-- carouFredSel END-->
    
    <!-- footer icons hoverEffects() -->
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/js/jquery.animate-colors-min.js"></script>  
    <!-- for footer icons  hoverEffects() END-->
    
    <!-- seaofclouds-->
    <!--<script src="http://theme.codecampus.ru/fusion/js/seaofclouds/jquery.tweet.js"></script>
    <script src="http://theme.codecampus.ru/fusion/js/seaofclouds/twitter.function.js"></script>-->
    <!-- seaofclouds END -->
    
    <!-- layerslider -->
	<script src="http://theme.codecampus.ru/fusion/layerslider/layerslider/jQuery/jquery-easing-1.3.js" type="text/javascript"></script>
	<script src="http://theme.codecampus.ru/fusion/layerslider/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		/*$(document).ready(function(){
			$('#layerslider').layerSlider({
			    navPrevNext         : false,
				skinsPath : 'http://theme.codecampus.ru/fusion/layerslider/layerslider/skins/',
                skin : 'fusionskin',
			});
		});	*/	
	</script>
    <!-- layerslider END-->
        
    <!-- HoverAlls -->
    <link rel="stylesheet" type="text/css" media="screen" href="http://theme.codecampus.ru/fusion/css/fusionHoverAlls.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="http://theme.codecampus.ru/fusion/hoveralls/css/hoveralls.css"/>
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/hoveralls/js/jquery.easing.1.3.min.js"></script>
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/hoveralls/js/jquery.hoveralls.min.js"></script>
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/hoveralls/js/jquery.hoveralls-functions.js"></script>
    <!-- HoverAlls END-->
    
    <!-- superfish -->
	<script type="text/javascript" src="http://theme.codecampus.ru/fusion/js/superfish-1.4.8/hoverIntent.js"></script>
	<script type="text/javascript" src="http://theme.codecampus.ru/fusion/js/superfish-1.4.8/superfish.js"></script>
    <script type="text/javascript" src="http://theme.codecampus.ru/fusion/js/superfish-1.4.8/superfish.function.js"></script>
    <!-- superfish END--> 
    
    <!-- custom theme functions -->
    <script src="http://theme.codecampus.ru/fusion/js/navigation.function.js"></script>
    <script src="http://theme.codecampus.ru/fusion/js/functions.js"></script>
    <!-- custom theme functions END -->
    
</head>
<body>
    <div id="wrap">
        <div id="headerMeta">
            <div class="container">
                <!--<div class="meta-left">
                    <div class="meta">Twitter :&nbsp;</div>
                    <div class="meta-tweet"></div>
                    <div class="clear"></div>
                </div>-->
                <div class="meta-left">
                    <span class="telephone"></span>
                    <span class="email"><a href="mailto:?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо"></a></span>
                </div>
				<div class="social">
                    <p>Подписывайтесь</p>
                    <ul>
																														
						                        <!--<li><a class="text_replace linkedin" href="#">linkedin</a></li>-->
                    </ul>
                </div>
            </div>
        </div>        <div id="header">
            <div class="container">
                <div class="sixteen columns">
                    <div class="logo">
            			<h1><a href="/"><img src="/res/images/logo.png"/></a></h1>
            			<h5>  </h5>
                    </div>
                    <div class="navi">
                                            </div>
                    <div class="mobileNavi_wrap"></div>
        		</div>
            </div>
        </div>                        <div id="footer">
            <div class="container">
        		<div class="four columns">
                    <div class="contact-widget">
                        <h4>Контакты</h4>
                        <!--<p></p>-->
                        <ul>
                            <li><span>Телефон : </span></li>
                            <li><span>Email : </span><a href="mailto:?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо"></a></li>
                            <li><span>Адрес : </span></li>
                        </ul>
                    </div>
                </div>
        		<div class="four columns">
					                </div>
        		<!--<div class="four columns">
                    <div class="twitter-widget">
                        <h4>Из Twitter-а</h4>
                        <div class="tweet"></div>
                    </div>
                </div>-->
        		<div class="four columns">
                                    </div>
        	</div><!-- container -->
        </div>        <div id="socket">
    <div class="container">
        <div class="copyright">Все права защищены &copy; 2012 Козленко В.Л.</div>
    </div>
</div>     </div>
	            <script>
            function _importJs(src, func){
				var scriptElem = document.createElement('script');
                scriptElem.setAttribute('src',src);
                scriptElem.setAttribute('type','text/javascript');
				scriptElem.onload = function() {
				  if (!this.executed) {
					this.executed = true;
					func();
				  }
				};
				scriptElem.onreadystatechange = function() {
				  var self = this;
				  if (this.readyState == "complete" || this.readyState == "loaded") {
					setTimeout(function() { self.onload() }, 0);
				  }
				};
                document.getElementsByTagName('head')[0].appendChild(scriptElem);
				// func. _importJs
            }
			
			function _importCss(src){
				var scriptElem = document.createElement('link');
                scriptElem.setAttribute('href',src);
                scriptElem.setAttribute('rel','stylesheet');
				document.getElementsByTagName('head')[0].appendChild(scriptElem);
				// func. _importCss
			}

            setTimeout(function(){
                <?php
            $dbusHeadCount = count(dbus::$head['jsDyn']);
            for( $i = 0; $i < $dbusHeadCount; $i++ ){
                 echo '_import("'.dbus::$head['jsDyn'][$i].'");';
            } // if
?>			for( var i in importResList["js"] ){
				_importJs(importResList["js"][i].src, importResList["js"][i].func);
			}
			for( var i in importResList["css"] ){
				_importCss(importResList["css"][i]);
			}
        }, 700);</script>
</body>
</html><? echo '<!-- '.(microtime(true) - $time).' -->'; ?>