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
);dbus::$comp['header'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '62',
);dbus::$comp['otziv'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '63',
);dbus::$comp['grafic'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '64',
);dbus::$comp['3block'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '65',
);dbus::$comp['abousus'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '66',
);dbus::$comp['stat'] = array (
  'tpl' => false,
  'isTplOut' => 0,
  'compId' => '2',
  'nsPath' => 'spl/html/',
  'contId' => '40',
);

?><head>

<title></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/reset.css">
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/skeleton.css">
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/master.css">
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/fonts.css">
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/lightbox.css">
<link rel="alternate stylesheet" type="text/css" href="http://theme.codecampus.ru/landing/xafira/css/black.css" title="black">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<!--<script src="http://theme.codecampus.ru/landing/xafira/js/link.js"></script>-->
<script src="http://theme.codecampus.ru/landing/xafira/js/jquery.lightbox.js"></script>
<script src="http://theme.codecampus.ru/landing/xafira/js/styleswitcher.js"></script>
<script src="http://theme.codecampus.ru/landing/xafira/js/html5.js"></script>

<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/estro/js/pe.kenburns/themes/default/skin.min.css" />

<!-- import plugin -->
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/estro/js/pe.kenburns/jquery.pixelentity.kenburnsSlider.min.js"></script>

 <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
  <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js"></script>

<style>
	.peKenBurns {
		width: 530px;
		height: 398px;
	}
</style>

<!-- activate plugin -->
<script>
	jQuery(function($){
		jQuery(".peKenBurns").peKenburnsSlider({api: true});
		jQuery('.lightbox').lightbox();
	});
	
	$(function() {
		// OPACITY OF BUTTON SET TO 0%
		$(".roll").css("opacity","0");
		 
		// ON MOUSE OVER
		$(".roll").hover(function () {
			// SET OPACITY TO 70%
			$(this).stop().animate({
			opacity: .7
			}, "slow");
		},
		// ON MOUSE OUT
		function () {
			// SET OPACITY BACK TO 50%
			$(this).stop().animate({
			opacity: 0
			}, "slow");
		});
	});
</script>

</head>
<body>


   	<header>

        <div class="top_header">
            <div class="container">
                <div class="twelve columns">
                    <div class="logo">
                        <a href="/"><img src="/res/images/landing/logo.png" alt="xENGLISHx"></a>
                    </div> <!-- end logo -->
                </div> <!-- eight_columns -->


                <div class="four columns">
                    <div class="nav">
                        <ul>
                            <!--<li><a href="/">На главную</a></li>-->
                            <!--<li>
                                <a href="#"> Авторизация
                                <img src="http://theme.codecampus.ru/landing/xafira/img/login_button.png" alt="">
                                </a>
                            </li> -->
                        </ul>
                    </div><!-- end nav -->
                </div> <!-- eight_columns -->

            <!-- --------------------------------------------------------------------- -->
                <?php \core\comp\spl\html\logic\html::renderAction('header'); ?>

            </div> <!-- end container -->
        </div> <!-- end top_header -->
       
    </header>

        
        <!--
		<div class="sponsors">
            <div class="container">
            <ul class="sponsors sixteen columns">
                <li><a href="#"><img src="http://theme.codecampus.ru/landing/xafira/img/sponsors/sponsor1.jpg" alt="" /></a></li>
                <li><a href="#"><img src="http://theme.codecampus.ru/landing/xafira/img/sponsors/sponsor2.jpg" alt="" /></a></li>
                <li><a href="#"><img src="http://theme.codecampus.ru/landing/xafira/img/sponsors/sponsor3.jpg" alt="" /></a></li>
                <li><a href="#"><img src="http://theme.codecampus.ru/landing/xafira/img/sponsors/sponsor4.jpg" alt="" /></a></li>
                <li><a href="#"><img src="http://theme.codecampus.ru/landing/xafira/img/sponsors/sponsor5.jpg" alt="" /></a></li>
            </ul>
            </div> 
        </div> -->
		
		<div class="container">
            <?php \core\comp\spl\html\logic\html::renderAction('otziv'); ?>
        </div>

        <div class="container"> 
			<?php \core\comp\spl\html\logic\html::renderAction('grafic'); ?>
        </div>
        <div class="divider"></div>

        <div class="container">
             <?php \core\comp\spl\html\logic\html::renderAction('3block'); ?>
        </div> 
        <div class="divider"></div>

       <!-- <div class="banner">
            <div class="container">
                <h3>Try xafira right now, <a href="#">its free ! </a> </h3>
            </div> 
        </div> 
        <div class="divider"></div>-->

        


            <!--<div class="banner">

                <div class="container">
                    <div class="sixteen columns">
                        <h3> Lorem ipsum ? <a href="#">  Sit ame interdum sed euismod, Cmon!</a> </h3>
                    </div>
                </div> 

            </div> 
			
            <div class="divider"></div>-->

            
            <footer>

                <div class="bline"></div>

                <div class="container">

                    <div class="one-third column">
                        <div class="about">
                            <h3>О нас</h3>
							<?php \core\comp\spl\html\logic\html::renderAction('abousus'); ?>
<?php \core\comp\spl\html\logic\html::renderAction('stat'); ?>
                        </div>
                    </div> <!-- end one-third -->

                    <div class="one-third column">
                        <!--<div class="how_works">
                            <h3>How it Works?</h3>
                            <a href="#"><p>+ More information, Aenean erat diam, interdum.</p></a>
                            <a href="#"><p>+ More specs, Aenean erat diam, interdum.</p></a>
                            <a href="#"><p>+ Fully Support, Aenean erat diam, interdum.</p></a>
                            <a href="#"><p>+ All Platform, Aenean erat diam, interdum.</p></a>
                            <a href="#"><p>+ Cutie App, Aenean erat diam, interdum.</p></a>
                        </div>-->
                    </div>  

                    <div class="one-third column">
                        <div class="contact">
                            <h3>Оставайтесь на связи!</h3>
                            <p>Наши контакты</p>
                            <p>E-mail: vladkapalov@xenglishx.ru </p>
                            <p>Мы в социальных сетях:</p>
                        </div>
                        <div class="social_icons">
                            <ul>
                                <li><a href="http://vk.com/xenglishx/" target="_blank" rel="nofollow"><img src="http://theme.codecampus.ru/landing/xafira/img/social_icons/social1.png" alt=""></a></li>
                                <li><a href="" target="_blank" rel="nofollow"><img src="http://theme.codecampus.ru/landing/xafira/img/social_icons/social3.png" alt=""></a></li>
                                <li><a href="" target="_blank" rel="nofollow"><img src="http://theme.codecampus.ru/landing/xafira/img/social_icons/social4.png" alt=""></a></li>

                            </ul>
                        </div> <!-- end social_icons -->
                    </div> <!-- end one-third -->
                </div> <!-- end container -->

                    <div class="container">
                        <div class="sixteen">
                            <div class="sub_footer">
                                <p>Copyright © 2011-2013 xENGLISHx </p>
                            </div> <!-- end sub_footer -->
                        </div> <!-- end sixteen -->
                    </div> <!-- end container -->
       
            </footer>

      <!-- Switch Panel
  ================================================== -->

  <!--<div class="switch_out">
  <div id="switch">
      
    <ul class="color">
      <li><a href="#" onClick="setActiveStyleSheet('master'); return false;"><img src="img/blue.png" alt=""></a></li>
      <li><a href="#" onClick="setActiveStyleSheet('black'); return false;"><img src="img/black.png" alt=""></a></li>
    </ul>
    <h4 id="hide">Hide Panel</h4>
  </div>
  
  <div id="show" style="display: none;">
    <h4>Show Panel</h4>
  </div>
  </div>
  
<script src="js/switch.js"></script>-->

                      
</body><? echo '<!-- '.(microtime(true) - $time).' -->'; ?>