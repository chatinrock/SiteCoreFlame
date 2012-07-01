<section id="breadcrumbs">
		<block itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a href="/" itemprop="url">
				<block itemprop="title">Главная</block>
			</a>
		</block>
        <?
        $breadcrumbs = self::get('breadcrumbs');
        $iCount = count($breadcrumbs);
        for( $i = 0; $i < $iCount-1; $i++ ){
            $url = str_repeat('../', $iCount-$i-1);
            echo '<block itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'
				.'<span class="breadarrow">&nbsp;/&nbsp; </span><a itemprop="url" href="'.$url.'"><block itemprop="title">'.$breadcrumbs[$i]['caption'].'</block></a></block>';
        }
        if ( isset($breadcrumbs[$i]) ){
        ?>
        <span class="breadarrow">&nbsp;/&nbsp; </span><strong><?=$breadcrumbs[$i]['caption']?></strong>
        <?}?>
</section>