<section id="content" class="grid-block"><div id="system">
        <article class="item" data-permalink="">
            <?
$categoryUrlTpl = self::get('categoryUrlTpl');
$infoData = self::get('infoData');
?>
<header>
    <h1 class="title"><?= $infoData['caption'] ?><span class="article-dash"></span></h1>
</header>

<div class="content clearfix">
<?
   self::loadFile(self::get('dir') . 'data.txt');
?>
</div>
 </article>
    </div>
</section>