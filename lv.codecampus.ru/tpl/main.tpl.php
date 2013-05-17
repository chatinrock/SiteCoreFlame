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
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>

    <script src="http://files.codecampus.ru/res/js/min/mvc-api.js" type="text/javascript"></script>

    <link rel="stylesheet" href="/res/css/admin.css">

    <style>
        #commentBox{
            border: 0px;
            width: 640px;
            overflow-x: hidden;
            height: 800px;
            /*border: 1px solid black;*/
        }
    </style>
</head>
<body>

<div class="container">
    <!---------------------------------------------------->
    <div class="sixteen columns" id="statusPanel">
        <div class="three columns">
            Коннект: <span id="connStatusText">Соединение</span>
        </div>
        <div class="three columns">
            Посетителей: <span id="viewCountText">0</span>
        </div>
        <div class="two columns">
            <a href="#imgSlide" id="slideSettingsBtn">Слайды</a>
        </div>
        <div class="two columns">
            <a href="#layerList" id="layerSettingBtn">Слои</a>
        </div>
        <div class="five columns">
            <a href="#begin" id="rtmpPlayBtn">Начать трансляцию</a>
        </div>
    </div>
    <!---------------------------------------------------->
    <div class="three columns" id="sliderListBox">
        <ul></ul>
    </div>
    <div class="twelve columns">
        <div class="sliderSettingsPanel">
            <div class="four columns alpha">
                <select id="layerListBox"></select>
            </div>
            <div class="eight columns omega alpha text-right">полный размер <input type="checkbox" id="fullSizeCb"/></div>
        </div>
        <div id="sliderShowBox">
            <img src="" id="sliderShowImg"/>
        </div>
        <div class="four columns alpha">
            <input type="button" id="prevSlideBtn" value="&laquo; Пред"/>
        </div>
        <div class="four columns alpha text-center">
            <input type="button" value="в режим &ldquo;Презентация&rdquo;" id="switchModeBtn"/>
        </div>
        <div class="four columns omega text-right">
            <input type="button" id="nextSlideBtn" value="След &raquo;"/>
        </div>
    </div>
    <!---------------------------------------------------->
    <!--<div id="footerBox" class="twelve columns"></div>-->
</div> <!--container-->

<div class="container">
    <div class="three columns">&nbsp;</div>
    <div class="twelve columns">
        <iframe id="commentBox"></iframe>
    </div>
</div>

<div id="controllerSwfBox"></div>

<script type="text/javascript">
var adminData = {
    slideList:<?=self::get('slideList')?>,
    layerList:<?=self::get('layerList')?>,
    userData:<?=self::get('userData');?>
}
</script>
<script src="/res/js/_src/adminMvc.js" type="text/javascript"></script>

</body>
</html>