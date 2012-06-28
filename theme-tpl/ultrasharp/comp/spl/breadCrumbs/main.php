<section id="breadcrumbs">
    <div class="breadcrumbs">
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
				.'<a itemprop="url" href="'.$url.'"><block itemprop="title">'.$breadcrumbs[$i]['caption'].'</block></a></block>';
        }
        if ( isset($breadcrumbs[$i]) ){
        ?>
        <strong><?=$breadcrumbs[$i]['caption']?></strong>
        <?}?>
    </div>
</section>

