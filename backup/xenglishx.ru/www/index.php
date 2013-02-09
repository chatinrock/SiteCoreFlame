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
include '/opt/www/SiteCoreFlame/xenglishx.ru/conf/DIR.php';
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
}dbus::$comp['mainmenu'] = array (
  'tpl' => 'mainTree.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '9',
);dbus::$comp['leftmenu'] = array (
  'tpl' => 'topLine.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '8',
);dbus::$comp['3block'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '68',
);dbus::$comp['metodic'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '69',
);dbus::$comp['lastblog'] = array (
  'tpl' => 'index.tpl.php',
  'isTplOut' => 0,
  'compId' => '15',
  'nsPath' => 'spl/oiLaster/',
  'contId' => '74',
);dbus::$comp['slider'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '77',
);

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
	<head>
        <meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name='yandex-verification' content="61a869df029befbf" />
		<meta name='google-site-verification' content="ch1Bbax2v1R_-jolr7gRA87dl2H2V3VITnhWx0g4uZ8" />
		
		<meta name="author" content="EdusGroup" />
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<??><script>var dbus={};var importResList={"js":[],"css":[]};</script>        <meta name="viewport" content="width=device-width" />
		
		<link rel="shortcut icon" href="/res/icons/favicon.ico" />
		<link href="res/icons/icon128.png" rel="icon"/>
		<link href="res/icons/icon128.png" rel="apple-touch-icon-precomposed"/>
		
		
		<script src="http://theme.codecampus.ru/plugin/conf.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/yepnope/1.5.4/yepnope.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			if ( typeof(yepnope) == 'undefined'){
				document.write('<script src="'+pluginResConf.yepnope+'" type="text/javascript"><\/script>');
			}
		</script>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        <script src="//yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
		
        <link rel="alternate" type="application/rss+xml" title="Rss лента" href="/res/main.rss" />
		<meta name="generator" content="Flame 2.4" />

        <link rel="stylesheet" type="text/css" media="all" href="http://theme.codecampus.ru/ultrasharp/css/style.css" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/colors/blue.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/shortcodes.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/fixed.css" media="screen" />  
		

		<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>-->
		<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/js/scripts.js?ver=3.4'></script>
		<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/js/base.js?ver=3.4'></script>
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

</head>
<body class="home blog fixed-page">
<div id="header">

    <div class="wrapper">
        <div id="top-info">
            <div class="left">
                <span class="telephone"></span>
                <!--<span class="fax">+0 (000) 000 000</span>-->
                <span class="address"></span>
                <span class="email">vladkapalov@xenglishx.ru</span>
            </div>
        </div>
        <div id="top-bar">
            <div class="left">
                <div class="menu-left-top-bar-container">
                    <?php \core\comp\spl\menu\logic\menu::renderAction('leftmenu'); ?>
                </div>
            </div>
            <div class="right">

                <div class="top-bar-menu">
                                    </div>

                <div id="mySocialBtn">
                    <a href="http://vk.com/xenglishx/" target="_blank" rel="nofollow">
						<img title="Наша страница Twitter" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/twitter23.png" alt="Twitter">
					</a>
                    <a href="" target="_blank" rel="nofollow">
						<img title="Наша страница Facebook" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/facebook23.png" alt="Facebook">
					</a>
                    <a href="" target="_blank" rel="nofollow">
						<img title="Наша страница Вконтакте" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/vkontakte23.png" alt="Вконтакте">
					</a>
                </div>

                <span id="search-box">
					<div class="pop-up">
						<div class="pop-up-wrapper">
							<form action="#ultrasharp" method="get">
								<input type="text" name="s" id="s-input" value="Keywords..." onFocus="if(jQuery(this).val() == 'Keywords...') { jQuery(this).val(''); }" autocomplete="off" />
								<input type="submit" id="s-submit" value="Search" class="button-color" />
								<div id="ajax-search"></div>
							</form>
						</div>
					</div>
				</span>
            </div>
        </div>

        <div id="main-bar" class="full">
            <?php \core\comp\spl\menu\logic\menu::renderAction('mainmenu'); ?>

        </div>
    </div>
</div>
<div class="padding-40"></div>
<?php // \core\comp\spl\html\logic\html::renderAction('slider'); ?>















        
<!-- SLIDER HEIGHT -->
<style type="text/css" media="screen">
	
	#slider { margin: -80px 0 0; }    #layerslider, #layerslider-wrapper { height: -80px; }
    #layerslider { height: px; }
	
	
</style>
<!-- SLIDER HEIGHT -->
        
<!-- JQUERY ACTIVATORS -->
<script type="text/javascript">
    
    jQuery(window).load(function() {
        
        //opens up our menu
        //jQuery('#slider').ddUltraSharpSlider(5000);
		jQuery('.ls-nav-prev, .ls-nav-next, .ls-nav-start, .ls-nav-stop').css({ opacity: 0, display: 'block' });
		jQuery('#slider').hover(function() {
			
			jQuery('.ls-nav-prev, .ls-nav-next').stop().animate({ opacity: .5 }, 200);
			jQuery('.ls-nav-start, .ls-nav-stop').stop().animate({ opacity: 1 }, 200);
			
		}, function() {
			
			jQuery('.ls-nav-prev, .ls-nav-next').stop().animate({ opacity: 0 }, 200);
			jQuery('.ls-nav-start, .ls-nav-stop').stop().animate({ opacity: 0 }, 200);
			
		});
		jQuery('.ls-nav-prev, .ls-nav-next').hover(function() {
			
			jQuery(this).stop().animate({ opacity: 1 }, 100);
			
		}, function() {
			
			jQuery(this).stop().animate({ opacity: .5 }, 100);
			
		});
        
    });

</script>


<script type='text/javascript' src='http://yandex.st/jquery/easing/1.3/jquery.easing.min.js'></script>
<link rel='stylesheet' id='layerslider_css-css'  href='http://theme.codecampus.ru/ultrasharp/css/layerslider.css?ver=1.8.0' type='text/css' media='all' />
<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/js/layerslider.kreaturamedia.jquery.js'></script>


<div id="slider">
        
	<div class="wrapper">
<!-- /SLIDER MARKUP STARTS/ -->
<div id="layerslider-wrapper">

	<div class="wrapper">
    
        <div id="layerslider_1" style="margin: 0px auto; width: 980px; height: 400px; ">
			<div class="ls-layer" style="background-image: url(http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/slide1bg1.jpg);slidedirection: bottom; slidedelay: 4000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 1000;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/yourcompany1.png" alt="sublayer" style="position: absolute; top: 128px; left: 118px; slidedirection : top; slideoutdirection : top; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 200; delayout : 0;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/deserves1.png" alt="sublayer" style="position: absolute; top: 171px; left: 213px; slidedirection : top; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 100; delayout : 250;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/lines2.png" alt="sublayer" style="position: absolute; top: 191px; left: 361px; slidedirection : right; slideoutdirection : right; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 300; delayout : 300;">
				<img class="ls-s2" src="/res/images/index/slider/slidewoman1.png" alt="sublayer" style="position: absolute; top: 0px; left: 541px; slidedirection : fade; slideoutdirection : fade; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 100; delayout : 0;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/lines3.png" alt="sublayer" style="position: absolute; top: 191px; left: 40px; slidedirection : left; slideoutdirection : left; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 300; delayout : 300;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/thebest1.png" alt="sublayer" style="position: absolute; top: 227px; left: 135px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 400; delayout : 150;">
				<span class="ls-s2" style="position: absolute; top:320px; left: 112px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 500; delayout : 0; "> <a href="#" class="button blue" target="_blank">Purchase it now! ></a> </span>
				<span class="ls-s2" style="position: absolute; top:320px; left: 295px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 500; delayout : 0; "> <a href="http://themes.ddwebstudios.net/wordpress/ultrasharp/shortcodes/" class="button white">View theme's features</a> </span>
			</div>
			
			<!--<div class="ls-layer" style="background-image: url(http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/slide21.jpg);slidedirection: bottom; slidedelay: 4000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 1200;">
				<img class="ls-s4" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/panel31.png" alt="sublayer" style="position: absolute; top: 114px; left: 0px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 500; delayout : 100;">
				<img class="ls-s4" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/panel23.png" alt="sublayer" style="position: absolute; top: 106px; left: 194px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 300; delayout : 200;">
				<img class="ls-s4" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/panel110.png" alt="sublayer" style="position: absolute; top: 78px; left: 100px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 100; delayout : 300;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/amp1.png" alt="sublayer" style="position: absolute; top: 166px; left: 610px; slidedirection : top; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 700; delayout : 0;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/beautiful1.png" alt="sublayer" style="position: absolute; top: 127px; left: 644px; slidedirection : top; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuart; delayin : 500; delayout : 300;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/interactive1.png" alt="sublayer" style="position: absolute; top: 193px; left: 675px; slidedirection : right; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 800; delayout : 200;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/backend1.png" alt="sublayer" style="position: absolute; top: 244px; left: 643px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 900; delayout : 100;">
				<span class="ls-s2" style="position: absolute; top:319px; left: 644px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 1000; delayout : 0; "> 
				
				<a href="http://themes.ddwebstudios.net/wordpress/ultrasharp/custom-admin-panel/" class="button white medium">View Backend</a> </span>
			</div>
			
			<div class="ls-layer" style="background-image: url(http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/slide31.png);slidedirection: bottom; slidedelay: 4000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 1200;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/wordpress-logo2.png" alt="sublayer" style="position: absolute; top: 126px; left: 386px; slidedirection : bottom; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 200; delayout : 100;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/ultra2.png" alt="sublayer" style="position: absolute; top: 209px; left: 299px; slidedirection : top; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 700; delayout : 400;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/sharp1.png" alt="sublayer" style="position: absolute; top: 208px; left: 457px; slidedirection : top; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 700; delayout : 400;">
				<img class="ls-s2" src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/wordpress1.png" alt="sublayer" style="position: absolute; top: 282px; left: 428px; slidedirection : fade; slideoutdirection : bottom; parallaxin : .45; parallaxout : .45; durationin : 1500; durationout : 1500; easingin : easeInOutQuint; easingout : easeInOutQuint; delayin : 1100; delayout : 270;">
			</div> -->
		</div>    
    </div> 
    <!-- /.wrapper/ -->
    
</div>
<!-- /#layerslider-wrapper/ -->        
        <ul id="slider-selector"></ul>
		<div id="slider-arrow-left"></div>
		<div id="slider-arrow-right"></div>		
    </div>
    <!-- /SLIDER WRAPPER ENDS/ -->
    
</div>

<script type="text/javascript">
    
    jQuery(document).ready(function(){
    	
    	    	jQuery("#layerslider_1").layerSlider({    		
   			autoStart			: true,
   			pauseOnHover		: true,
			firstLayer			: 1,
			animateFirstLayer	: false,
			twoWaySlideshow		: true,
    		keybNav				: true,
    		imgPreload			: true,
    		navPrevNext			: true,
    		navStartStop		: true,
    		navButtons			: true,
    		skin				: 'noskin',
    		skinsPath			: 'http://theme.codecampus.ru/plugin/LayerSlide/layerslider/skins/',
    		globalBGColor		: '#EAEBEB',
    		yourLogo			: false,
    		yourLogoStyle		: 'position: absolute; left: 10px; top: 10px; z-index: 99;',
    		yourLogoLink		: false,
    		yourLogoTarget		: '_self',
    		
    		cbInit				: function() { },
    		cbStart				: function() { },
    		cbStop				: function() { },
    		cbPause				: function() { },
    		cbAnimStart			: function() { },
    		cbAnimStop			: function() { },
    		cbPrev				: function() { },
    		cbNext				: function() { }    	});
    	    });
    
    </script>
	

















<div id="content">
    <div class="wrapper">
        <div id="content-wrapper">
			<?php \core\comp\spl\html\logic\html::renderAction('3block'); ?>
<?php \core\comp\spl\html\logic\html::renderAction('metodic'); ?>
<?php \core\comp\spl\oiLaster\logic\main::renderAction('lastblog'); ?>
        </div>
        <div id="content-bottom-bg"></div>
        <div id="content-bottom-bg2"></div>
        <div class="clear"></div>
    </div>
</div>
<div id="footer" class="block-shadow">
	<div class="wrapper">
		        
		        
		        
		        
		        
	</div>
</div><div id="copyright">
    <div class="wrapper">
        <div class="left"> © 2012-2013</div>
        <div class="right"></div>
    </div>
</div>        <script>
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
                 echo '_importJs("'.dbus::$head['jsDyn'][$i].'");';
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