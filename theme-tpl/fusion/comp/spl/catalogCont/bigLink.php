<div class="catogories-widget">
    <h3>Категории:</h3>
	<ul class="subpages"><?
        $list = self::get('list');
        $iCount = count($list);
        for( $i = 0; $i < $iCount; $i++ ){
            ?><li>
				<a href="<?=$list[$i]['url']?>" title="Перейти в категорию: <?=$list[$i]['name']?>">
					<?=$list[$i]['name']?>
				</a>
			</li><?
        } // for
  ?></ul>
</div>