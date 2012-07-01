<header id="header">
    <?=$this->varible('fa', 'Факс') ?><?=$this->varible('fa', 'Факс') ?>
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
            <?= $this->block('menu', 'Меню') ?>
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

<?= $this->block('prebody', 'Pre Body') ?>

<div id="main" class="grid-block">

    <?= $this->block('body', 'Body') ?>


</div>
<!-- main end -->

<?= $this->block('afterbody', 'After Body') ?>

<footer id="footer" class="grid-block">

    <a id="totop-scroller" href="#page"></a>

    <div class="module   deepest">
        Copyright © 2011-<?=date('Y')?> <a href="http://seofrombeginners.ru">SeoForBeginners</a>. Все права
        защищены<br/>
    </div>
</footer>
