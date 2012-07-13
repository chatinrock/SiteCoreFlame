<?
$infoData = self::get('infoData');
?>
<?if($infoData['prevImgUrl']){?>
<div class="frame"><img src="<?=$infoData['prevImgUrl']?>" alt="<?= $infoData['caption'] ?>"/></div>
<?}?>
	<div class="twelve columns alpha omega">
		<h1><?= $infoData['caption'] ?></h1>
		<article>	
			<? if ( $infoData['isCloaking'] ){
				self::loadFile(self::get('dir') . 'cloak.txt');
			}else{
				self::loadFile(self::get('dir') . 'kat.txt');
				self::loadFile(self::get('dir') . 'data.txt');
			}?>
		</article>
	</div>
