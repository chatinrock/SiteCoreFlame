<div class="breadcrumbs">
	<a class="breadcrumbs-begin" rel="home" href="/" itemprop="url" title="Вернуться на главную">
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
			<span class="breadcrumbs-separator">&nbsp;>&nbsp;</span>
			<a href="<?=$url?>" title="Перейти к <?=$caption?>" itemprop="url">
				<block itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<block itemprop="title"><?=$caption?></block>
				</block>
			</a>
        <?}
		if ( isset($breadcrumbs[$i]) ){?>
			&nbsp;>&nbsp;
			<strong itemprop="url">
				<block itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
					<block itemprop="title"><?=$breadcrumbs[$i]['caption']?></block>
				</block>
			</strong>
        <?} ?>
</div>
<div class="spacer spacer10"></div>