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
include '/home/www/SiteCoreFlame/seoforbeginners.ru/conf/DIR.php';
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
dbus::$vars[$name] = $compContTree->selectFirst('id, name as caption, seoname', array(
    'seoname'=>dbus::$vars[$name.'Name']
    ,'tree_id' => 4
)
);
if ( !dbus::$vars[$name] ){
    //echo 'ERROR: 404 '.$name;
    header('Status: 404 Not Found');
    exit;
}
// ====== Varible COMP(name)
$name = 'name';
dbus::$vars[$name] = \site\core\comp\spl\article\vars\db\table::getIdByName(request::get($name), 'category','4','3');
if ( !dbus::$vars[$name] ){
    header('Status: 404 Not Found');
    exit;
}
}catch(Exception $ex){
    header('Status: 500 Internal Server Error');
    exit;
}dbus::$comp['mainmenu'] = array(
	'tpl' => 'main.php',
	'compId' => '5',
	'nsPath' => 'spl/menu/',
	'contId' => '7',
);
dbus::$comp['breadcrumbs'] = array(
	'tpl' => 'main.php',
	'compId' => '12',
	'nsPath' => 'spl/breadCrumbs/',
	'contId' => '10',
	'breadcrumbs' => [
		['caption' => '%s','name' => 'category'],
	]
);
dbus::$comp['article'] = array(
	'tpl' => 'main.php',
	'compId' => '3',
	'nsPath' => 'spl/article/',
	'varName' => 'category',
	'contId' => '',
	// Component has onlyFolder, varTableName - name vars of category
	'varTableName' => 'name',
	'urlTpl' => [
		'category'=>'/blog/%s/',
	]
);
dbus::$comp['artcom'] = array(
	'tpl' => 'main.php',
	'compId' => '11',
	'nsPath' => 'spl/artCom/',
	'contId' => '16',
	'varible' => 'name',
	'blockItemId' => '14',
	'type' => 'article'
);
dbus::$comp['category'] = array(
	'tpl' => 'main.php',
	'compId' => '14',
	'nsPath' => 'spl/catalogCont/',
	'contId' => '14',
);
dbus::$comp['artpopular'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '16',
	'nsPath' => 'spl/artPopular/',
	'contId' => '18',
);
dbus::$comp['last'] = array(
	'tpl' => 'man.tpl.php',
	'compId' => '15',
	'nsPath' => 'spl/artLast/',
	'contId' => '20',
);
try{site\core\comp\spl\article\logic\article::init('article');;
site\core\comp\spl\artCom\logic\simple::init('artcom');;
}catch(Exception $ex){
    header('Status: 502 Internal Server Error');
    exit;
}

?><!DOCTYPE HTML>
<html lang="" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?
        echo '<title>'.dbus::$vars['name']['caption'].'</title>'.PHP_EOL;
        echo '<meta name="description" content="'.dbus::$comp['article']['data']['seoDescr'].'" />'.PHP_EOL;
        echo '<meta name="keywords" content="'.dbus::$comp['article']['data']['seoKeywords'].'" />'.PHP_EOL;
        site\core\comp\spl\article\logic\article::setDataSeo('article', ['linkNextTitle'=>'%s','linkNextUrl'=>'/blog/%s/%s/']);
?><script>var dbus={};</script>        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="/res/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="/res/favicon.png" />
        <link rel="alternate" type="application/rss+xml" title="Сео для начинающих" href="/res/main.rss" />
        <meta name="generator" content="Flame 0.9.1" />
		<meta name='yandex-verification' content='5c04a07639a97105' />
		<meta name="google-site-verification" content="SHmEYMurUyBJnmE2drBqqigVph0tKMcdDwtXDy1QvtE" />
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
                    <a class="rss" title="Подписаться на RSS" href="/res/main.rss"></a>
                </div>
            </div>
        </div>

    </div>

    <div id="menubar" class="grid-block">

        <nav id="menu">
            <?php site\core\comp\spl\menu\logic\menu::renderAction('mainmenu'); ?>
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
    <section id="content" class="grid-block"><div id="system">
        <article class="item" data-permalink="">
            <?php site\core\comp\spl\article\logic\article::renderAction('article'); ?>

            <div class="meta-bottom clearfix">

                <div class="addthis">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END -->
                </div>

                <!--<span class="trackback"><a href="#wp-trackback.php?p=1">Trackback</a> from your site.</span>-->
				<div id="vk_share"></div>
            </div>
            
            <!--<div class="meta-tags clearfix">
               <p class="taxonomy">
                    Теги:
                    <a href="#?tag=adobe" rel="tag">Adobe</a>
                    <a href="#?tag=war-framework" rel="tag">War Framework</a>
                    <a href="#?tag=widgetkit" rel="tag">Widgetkit</a>
               </p>
            </div>-->

            <?php site\core\comp\spl\artCom\logic\simple::renderAction('artcom'); ?>
        </article>
    </div>
</section>

<script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>
<script type="text/javascript">
window.onload = function () {
 document.getElementById('vk_share').innerHTML = VK.Share.button(
	{title: 'Советую к прочтению: ' + document.title, noparse: false}, 
	{type: "button", text: "Добавить на стенy"});

}
</script>
</div>

<aside id="sidebar-a" class="grid-box" style="min-height: 2442px;">
    <?php site\core\comp\spl\catalogCont\logic\catalogCont::renderAction('category'); ?>
<?php site\core\comp\spl\artPopular\logic\main::renderAction('artpopular'); ?>
<?php site\core\comp\spl\artLast\logic\main::renderAction('last'); ?>
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
		<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter14469958 = new Ya.Metrika({id:14469958, enableAll: true, webvisor:true}); } catch(e) {} }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/14469958" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-31640327-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>

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
</html><? echo '<!-- '.(microtime(true) - $time).' -->'; ?>