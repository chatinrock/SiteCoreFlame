<div class="widget widget_wb_recent_posts">
	<div class="widgetColumnTitle">
		<div class="widgetTitle">
			<h3>Статьи блога</h3>	
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="widgetColumnContent">
	<?
    $list = self::get('list');
    $iCount = count($list);
    for( $i = 0; $i < $iCount; $i++ ){
        $caption = $list[$i]['caption'];
        $url = $list[$i]['url'];
        $prevImgUrl = $list[$i]['prevImgUrl'];
        $dateAdd = $list[$i]['dateAdd'];?>
		<div class="widgetRecentPost">
			<div class="innerOneThird">
				<span class="imageWrap img-left">
					<span class="imageHolder smallBorder">
						<a href="<?=$url?>" title="<?=$caption?>"><img src="<?=$prevImgUrl?>" alt="<?=$caption?>" title="<?=$caption?>" /></a>
					</span>
				</span>
				</div>
				<div class="innerTwoThirds last">
					<div class="noBottomMargin postWidgetText">
						<a class="smallTitle" href="<?=$url?>"><?=$caption?></a><br />
						<p class="noBottomMargin"><?=$list[$i]['miniDesck']?></p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div><?
    } // for
    ?>
	</div>
</div>