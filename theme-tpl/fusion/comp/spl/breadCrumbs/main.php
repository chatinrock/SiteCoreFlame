<span class="wrap">
	<a href="/" itemprop="url">
		<block itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
			<block itemprop="title">Главная</block>
		</block>
	</a>
        <?
        $breadcrumbs = self::get('breadcrumbs');
        $iCount = count($breadcrumbs);
        for( $i = 0; $i < $iCount-1; $i++ ){
            $url = str_repeat('../', $iCount-$i-1);
			$caption = $breadcrumbs[$i]['caption'];
            ?>
			&nbsp;→&nbsp;
			<a href="<?=$url?>" title="<?=$caption?>" itemprop="url">
				<block itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'
					<block itemprop="title"><?=$caption?></block>
				</block>
			</a>
        <?}
		if ( isset($breadcrumbs[$i]) ){?>
			&nbsp;→&nbsp;
			<a href="#" itemprop="url">
				<block itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
					<block itemprop="title"><?=$breadcrumbs[$i]['caption']?></block>
				</block>
			</a>
        <?} ?>
</span>