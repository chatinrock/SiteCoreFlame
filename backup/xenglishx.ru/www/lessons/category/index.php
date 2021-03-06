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
$compContTree = new compContTree();
    
// ====== Varible TREE(category)
$name = 'category';
dbus::$vars[$name.'Name'] = request::get($name);
dbus::$vars[$name] = $compContTree->selectFirst('id, name as caption, seoname, tree_id as treeId', [
    'seoname'=>dbus::$vars[$name.'Name']
    ,'tree_id' => 4
]
);
if ( !dbus::$vars[$name] ){
    //echo 'ERROR: 404 '.$name;
    header('Status: 404 Not Found');
    exit;
}
}catch(Exception $ex){
    header('Status: 500 Internal Server Error');
    exit;
}dbus::$comp['mainmenu'] = array (
  'tpl' => 'mainTree.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '9',
);dbus::$comp['arglist'] = array (
  'tpl' => 'blog.php',
  'isTplOut' => 0,
  'compId' => '10',
  'nsPath' => 'spl/oiList/',
  'varName' => 'category',
  'contId' => '16',
  'urlTpl' => 
  array (
    'pageNav' => '/lessons/%s/page/%s/',
    'category' => '/lessons/%s/',
  ),
);dbus::$comp['leftmenu'] = array (
  'tpl' => 'topLine.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '8',
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
		<!-- buildsys\library\event\manager\action\eventModel::getHeadData() | No DATA --><script>var dbus={};var importResList={"js":[],"css":[]};</script>        <meta name="viewport" content="width=device-width" />
		
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
<div id="content">
    <div class="wrapper">
                <div id="content-wrapper">
            <div class="block main-content" id="sidebar-right">
                <div id="sidebar">
                                    </div>
                <div id="main-content">
                    <?php \core\comp\spl\oiList\logic\blog::renderByCategoryAction('arglist'); ?>
                </div>
                <div class="clear"></div>
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