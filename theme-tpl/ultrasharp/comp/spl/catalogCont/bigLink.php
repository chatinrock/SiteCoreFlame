<div class="sidebar-item">
	<h5>Категории:</h5>
	<ul class="subpages"><?
        $list = self::get('list');
        $iCount = count($list);
        for( $i = 0; $i < $iCount; $i++ ){
            ?><li><a href="<?=$list[$i]['url']?>" title="Перейти в категорию: <?=$list[$i]['name']?>"><?=$list[$i]['name']?></a></li><?
        } // for
  ?></ul>
</div>