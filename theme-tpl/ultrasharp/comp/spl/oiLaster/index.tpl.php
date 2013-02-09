<div class="block block-dashed" style="background-color: #f1f1f1;">
	<h2 class="fancy2" style="text-align: left;">Последнии статьи блога</h2>
	<div class="padding" style="height: 1px;"></div>
	<ul class="blog-widget">
<?$list = self::get('list');
                $iCount = count($list);
                for( $i = 0; $i < $iCount; $i++ ){
					$caption = $list[$i]['caption'];
					$url = $list[$i]['url'];
					$prevImgUrl = $list[$i]['prevImgUrl'];
					$dateAdd = $list[$i]['dateAdd'];
                    ?>
	<li id="blog-widget-1961" class="blog-widget-post" style="width: 202px;">
		<a href="<?=$url?>" class="blog-widget-thumbnail" title="<?=$caption?>">
			<?if ($prevImgUrl){?><img src="<?=$prevImgUrl?>" title="<?=$caption?>" alt="<?=$caption?>" /><?}?>
		</a>
		<div class="blog-widget-info">
			<span class="date"><?=$dateAdd?></span>
		</div>
		<h5>
			<a href="<?=$url?>">
				<?=$caption?>
			</a>
		</h5>
		<p>
			<a href="<?=$url?>" class="button white readnext" title='Нажмите, чтобы прочитать "<?=$caption?>"'><?=$caption?></a>
		</p>
	</li>
<?
   } // for
?>
</ul>

	<div class="clear"></div>
	<div class="padding" style="height: 10px;"></div>
</div>
<script type="text/javascript">
    jQuery('a.readnext').html('Читать далее');
</script>
