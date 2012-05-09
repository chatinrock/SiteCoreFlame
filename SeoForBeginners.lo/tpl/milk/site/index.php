<!DOCTYPE HTML>
<html lang="" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?= $this->block('head') ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        <?// $this->block('bodyBegin') ?>
        <div class="wrapper grid-block">
          <?= $this->block('body') ?>
        </div>

        <script src="/res/js/warp/warp.js"></script>
        <!-- Для выпадающего меню -->
        <!-- <script src="/res/js/warp/accordionmenu.js"></script>-->
        <!-- Для выпадающего меню -->
        <!--<script src="/res/js/warp/dropdownmenu.js"></script>-->
        <!--<script src="/res/js/warp/search.js"></script>-->

        <? $this->block('scriptStatic') ?>
        <? $this->block('scriptDyn') ?>

    </body>
</html>