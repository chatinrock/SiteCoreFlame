<?$oiListData=self::get('oiListData')?>
<div class="sixteen columns _portfolio function">

    <div id="portfolio" class="portfolio-3">
        <ul class="portfolio-list">
            <?
            $previewCount = count($oiListData);
            for ($i = 0; $i < $previewCount; $i++) {
                $class = $i == 0 ? 'alpha' : 'omega';
                ?>
                <li class="one-third column item all webdesign <?=$class?>">
                    <div class="img" style="background-image: url('<?=$oiListData[$i]['prevImgUrl']?>')">
                        <a rel="prettyPhoto" href="<?=$oiListData[$i]['videoUrl']?>">
                            <img class="portfolio-overlay-item" src="http://theme.codecampus.ru/fusion/images/review/play-mask.png" alt="Смотреть" rel="#"/>
                        </a>
                    </div>
                    <div class="info">
                        <h4><?=$oiListData[$i]['caption']?></h4>
                        <p><?=$oiListData[$i]['text']?></p>
                    </div>
                </li>
                <? }?>
        </ul>
        <div class="clear"></div>
    </div>
    
</div>
<script type="text/javascript">
	function initReview(){
		$("#portfolio a[rel='prettyPhoto']").prettyPhoto({
			theme: 'facebook',
			show_title: false,
			default_width: 800,
			default_height: 600
		});
	}

	if ( typeof $.prettyPhoto == undefined ){
		initReview();
	}else{
		importResList["css"].push('http://theme.codecampus.ru/fusion/prettyPhoto/prettyPhoto.css');
		
		var src = 'http://theme.codecampus.ru/fusion/prettyPhoto/jquery.prettyPhoto.js';
		importResList["js"].push({src: src, func: initReview});
	}
</script>