<?
$categoryUrlTpl = self::get('categoryUrlTpl');
$infoData = self::get('infoData');
?>
<header>
    <h1 class="title"><?= $infoData['caption'] ?><span class="article-dash"></span></h1>
    <p class="meta clearfix">
		<a href="https://plus.google.com/104683887358159731484?prsrc=3" rel="author">Виталий Козленко</a>
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
<div class="meta-bottom clearfix">



			
	<span class="hreview">
					<span class="item reviewer vcard">
						<strong class="item"><span class="fn">Козленко Виталий </span> </strong>
					</span>
					<span><span class="rating">5</span> из 5</span>
					<span class="description">-</span>
					<a class="permalink" href="<?='http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]?>"></a>
					<span class="dtreviewed"><?=$infoData['dateISO8601']?></span>
					<span class="type"><span class="value-title" title="url"></span>
				</span>
				</span>
				
    <span id="vk_share"></span>
 </div>