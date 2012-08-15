<div class="post-widget">
    <h4>Последние посты</h4>
	<ul>
    <?
    $list = self::get('list');
    $iCount = count($list);
    for( $i = 0; $i < $iCount; $i++ ){
        $caption = $list[$i]['caption'];
        $url = $list[$i]['url'];
        $prevImgUrl = $list[$i]['prevImgUrl'];
        $dateAdd = $list[$i]['dateAdd'];
        ?>
		<li class="post">
            <div class="icon link">
				<img src="<?=$prevImgUrl?>"  title="<?=$caption?>" alt="<?=$caption?>" height="46" width="46"/>
			</div>
            <div class="content">
                <a  href="<?=$url?>" title="<?=$caption?>"><?=$caption?></a>
                <a class="date" href="<?=$url?>#comments" title="Комментировать: <?=$caption?>"><span>Комментировать</span></a>
            </div>
            <div class="clear"></div>
        </li>
		<?
    } // for
    ?>
	</ul>
</div>
