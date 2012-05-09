<?
$categoryUrlTpl = self::get('categoryUrlTpl');
$infoData = self::get('infoData');
?>
<header>
    <h1 class="title"><?= $infoData['caption'] ?><span class="article-dash"></span></h1>
    <p class="meta clearfix">
        <time datetime="<?=$infoData['date_add']?>" pubdate><?=$infoData['date_add']?></time>
        <? if ( $infoData ) {?>
        Категория: <a href="<?= vsprintf($categoryUrlTpl, $infoData['seoName']) ?>"><?= $infoData['category'] ?></a>
        <?}?>
        <span class="comment-link"><a href="#comments" id="headerCommentCount" title="Комментировать">Нет коментариев</a></span>
    </p>
</header>

<? if ( $infoData['prevImgUrl'] ){?>
<div class="post-thumbnail">
    <img width="960" height="300" src="<?=$infoData['prevImgUrl']?>" class="attachment-post-thumbnail wp-post-image" alt="<?= $infoData['caption'] ?>" title="<?= $infoData['caption'] ?>" />		
</div>
<?}?>

<div class="content clearfix">
<? if ( $infoData['isCloaking'] ){
    self::loadFile(self::get('dir') . 'cloak.txt');
}else{
    self::loadFile(self::get('dir') . 'kat.txt');
    self::loadFile(self::get('dir') . 'data.txt');
}?>
</div>
