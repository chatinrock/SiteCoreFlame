<?$oiListData=self::get('oiListData');?>

<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jcookie/js/jcookie.js"></script>

<script type="text/javascript" charset="utf-8" src="/res/comp/spl/oiList/anketList/js/mvc.js"></script>
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/star/css/star20.css" type="text/css">
<link rel="stylesheet" href="/res/comp/spl/oiList/anketList/css/main.css" type="text/css">

<div class="sixteen columns _portfolio function">
    <div id="portfolio" class="portfolio-3">
        <ul class="portfolio-list">
            <?

            $previewCount = count($oiListData);
            for ($i = 0; $i < $previewCount; $i++) {
                $class = $i == 0 ? 'alpha' : 'omega';
                $caption = $oiListData[$i]['caption'];
                $id = $oiListData[$i]['id'];
                $url = $oiListData[$i]['url'];
                $expr = $oiListData[$i]['experience'];
                $age = $oiListData[$i]['age'];
                $price = $oiListData[$i]['price'];
                $rating = $oiListData[$i]['rating'];
                ?>
                <li class="one-third column item all webdesign <?=$class?>">
                    <div class="img">
                        <a href="<?=$url?>" title="Просмотреть <?=$caption?>">
                            <img class="portfolio-overlay-item" src="<?=$oiListData[$i]['photoUrl']?>" alt="Смотреть"/>
                        </a>
                        <img src="/res/images/anket/selectAnket32.png" class="selAnket"/>
                    </div>
                    <div class="info">
                        <h4><a href="<?=$url?>" title="Просмотреть <?=$caption?>"><?=$caption?></a></h4>
                        <p>
                            <span class="bold">Возраст:</span> <?=$age?> |
                            <span class="bold">Стаж:</span> <?=$expr?> |
                            <span class="bold">Цена:</span> <?=$price?> руб.
                        </p>
                        <p class="rating">
                            <span class="bold">Рейтинг:</span>
                        </p>
                        <div class="star star<?=$rating?>"><div></div><div></div></div>
                        <div class="clear"></div>
                        <div class="photoAction">
                            <div>
                                <a href="<?=$url?>" title="Просмотреть <?=$caption?>">&raquo; Полное описание</a>
                            </div>
                            <div class="right">
                               <a id="anket<?=$id?>" href="#" class="selAnketBtn">&raquo; Пометить анкету</a>
                            </div>
                        </div>
                    </div>
                </li>
                <? }?>
        </ul>
        <div class="clear"></div>
    </div>

    <?
        $pagList = self::get('paginationList');
        if ( $pagList ){
    ?>
    <div class="pagination">
        <!--<span class="pages">Страница 1 из 11</span>-->
        <?

        $pageNum = self::get('pageNum');
        $pageNavTpl = self::get('pageNavTpl');
        $pagUrlParam = self::get('pagUrlParam');

        // Показывать ли prev
        if ( $pagList['prev'] ){
            $pagUrlParam[-1] = 1;
            $href = vsprintf($pageNavTpl, $pagUrlParam);
            echo '<a href="' . $href . '" title="В начало">В начало</a>';
            $pagUrlParam[-1] = $pageNum-1;
            $href = vsprintf($pageNavTpl, $pagUrlParam);
            echo '<a href="' . $href . '" title="На страницу назад" class="prevlink">«</a>';
        } // if

        // Показываем числа
        for ($i = $pagList['firstNum']; $i <= $pagList['lastNum']; $i++) {
            if ($i != $pageNum) {
                $pagUrlParam[-1] = $i;
                $href = vsprintf($pageNavTpl, $pagUrlParam);
                echo '<a href="' . $href . '" title="Страница '.$i.'">' . $i . '</a></li>';
            } else {
                echo '<span class="current">' . $i . '</span>';
            }
        } // for

        if ( $pagList['next']){
            $pagUrlParam[-1] = $pageNum+1;
            $href = vsprintf($pageNavTpl, $pagUrlParam);
            echo '<a href="' . $href . '" title="Следующая страница" class="nextlink">»</a>';

            $pagUrlParam[-1] = $pagList['count'];
            $href = vsprintf($pageNavTpl, $pagUrlParam);
            echo '<a href="' . $href . '" title="В конец">В конец</a>';
        } // if


        ?>
        <div class="clear"></div>
    </div>
        <?}?>
</div>
<script type="text/javascript">
    anketMvc.setTypeRmMark('<?=self::get('typeRmMark')?>');
</script>