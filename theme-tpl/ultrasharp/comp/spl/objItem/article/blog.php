<?
$categoryUrlTpl = self::get('categoryUrlTpl');
$infoData = self::get('infoData');
?>
<script type="text/javascript">
	var article = {
		caption: '<?= $infoData['caption'] ?>',
		imgUrl: '<?= $infoData['prevImgUrl'] ?>'
	}
</script>
<h1 class="single-title"><?= $infoData['caption'] ?></h1>
	<div class="post-info">
        <span class="date">
			<time datetime="<?=$infoData['date_add']?>" pubdate>
				<?=$infoData['date_add']?>
			</time>
		</span>
		<? if ( $infoData ) {?>
			<span class="categories">
				<a href="<?= vsprintf($categoryUrlTpl, $infoData['seoName']) ?>" title="Все посты в <?= $infoData['category'] ?>" rel="category tag">
					<?= $infoData['category'] ?>
				</a>
			</span>
		<?}?>
		<span class="comments">
			<a href="#comments" id="headerCommentCount" title="Комментировать">
				Нет коментариев
			</a>
		</span>
                 
    </div>
	<div class="post-thumb">
         <img style="width: 630px; height: 272px;" title="<?= $infoData['caption'] ?>" src="<?= $infoData['prevImgUrl'] ?>">
	</div>
    <div class="socialBtnBox"></div>
	
<article>	
<? if ( $infoData['isCloaking'] ){
    self::loadFile(self::get('dir') . 'cloak.txt');
}else{
    self::loadFile(self::get('dir') . 'kat.txt');
    self::loadFile(self::get('dir') . 'data.txt');
}?>
</article>
<script type="text/javascript">
$(window).load(function() {
	//$('.imagePreload').each( function() { $(this).ddImagePreload(); });
});
</script>
<div class="clear"></div>
<div class="socialBtnBox"></div>
<div class="post-border-bottom"></div>                     