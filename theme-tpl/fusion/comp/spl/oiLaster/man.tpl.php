<div class="post-widget-2">
    <h3>Последние:</h3>
    <?
    $list = self::get('list');
    $iCount = count($list);
    for( $i = 0; $i < $iCount; $i++ ){
        $caption = $list[$i]['caption'];
        $url = $list[$i]['url'];
        $prevImgUrl = $list[$i]['prevImgUrl'];
        $dateAdd = $list[$i]['dateAdd'];
        ?><div class="post">
            <a href="<?=$url?>" title="<?=$caption?>" class="icon-format">
				<img src="<?=$prevImgUrl?>"  title="<?=$caption?>" alt="<?=$caption?>" height="82" width="82"/>
			</a>
            <h5><a href="<?=$url?>"><?=$caption?></a></h5>
            <div class="icons">
                <div class="iconWrap">
                    <div class="icon author tooltip text_replace">
                        <p class="hoveralls_text">Козленко В.Л.</p>
                        <a href="#" class="hoveralls_link"></a>
                    </div>
                </div>
                <div class="iconWrap">
                    <div class="icon tag tooltip text_replace">
                        <p class="hoveralls_text">Комментировать</p>
                        <a href="<?=$url?>#comments" class="hoveralls_link"></a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div><?
    } // for
    ?>
</div>
