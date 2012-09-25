<?$oiListData=self::get('oiListData');?>
<style>
    #portfolio img.portfolio-overlay-item {
        margin: 0px 0px;
        width: 300px;
        height: 200px
    }
    div.info span.bold{
        font-weight: bold;
    }

    div.star{
        float: left;
        display: inline-block;
        margin-left: 8px;
    }

    p.rating{
        float: left;
        display: inline;
    }
    /* =========================================*/
    div.searchBox{
        /*width: 700px;
        float: left;*/
    }

    div.searchBox span.caption{
        font-weight: bold;
        /*width: 50px;
        display: inline-block;*/
    }

    div.photoAction div{
        width: 50%;
        float: left;
    }

    div.photoAction div.right{
        float: right;
        text-align: right;
    }

    div.photoAction div.right a{
        color: #076100
    }

    div.photoAction div.right a:hover{
        color: #2a9122;
    }

    div.photoAction div.right a.red{
        color: #bb0000
    }

    div.photoAction div.right a.red:hover{
        color: #df0000;
    }

    div.searchBox div.line{
        height: 40px;;
    }

    div.searchBox div.line>div{
        float: left;
        width: 33%;
    }

    span.sliderBox{
        display: inline-block;
        width: 200px;
        padding: 0 5px;
        margin-right: 20px;
    }

    input[type="button"].greenBtn {
        border: 1px solid #0d9602 !important;
        background: #0ecc00 !important;
        background: -moz-linear-gradient(top,  #0ecc00 0%, #0d9602 100%) !important; /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#0ecc00), color-stop(100%,#0d9602)) !important; /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #0ecc00 0%,#0d9602 100%) !important; /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #0ecc00 0%,#0d9602 100%) !important; /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #0ecc00 0%,#0d9602 100%) !important; /* IE10+ */
        background: linear-gradient(top,  #0ecc00 0%,#0d9602 100%) !important; /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0ecc00', endColorstr='#0d9602',GradientType=0 ) !important; /* IE6-9 */
        text-shadow: #076100 0 1px 0;
    }
    input[type="button"].greenBtn:hover {
        border: 1px solid #0d9602 !important;
        background: #1fe710 !important;
        background: -moz-linear-gradient(top,  #1fe710 0%, #12b704 100%) !important; /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1fe710), color-stop(100%,#12b704)) !important; /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #1fe710 0%,#12b704 100%) !important; /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #1fe710 0%,#12b704 100%) !important; /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #1fe710 0%,#12b704 100%) !important; /* IE10+ */
        background: linear-gradient(top,  #1fe710 0%,#12b704 100%) !important; /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1fe710', endColorstr='#12b704',GradientType=0 ) !important; /* IE6-9 */
    }

    li.selAnket div.img{
        position: relative;
    }

    #portfolio li img.selAnket{
        display: none;
    }

    #portfolio li.selAnket img.selAnket{
        position: absolute;
        z-index: 3;
        left: 265px;
        top: 165px;
        display: block;
    }

    /*div.sortBox{
        float: left;
    }*/
</style>
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/star/css/star20.css">

<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.css" type="text/css">
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.js"></script>
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jcookie/js/jcookie.js"></script>

<div class="sixteen columns _portfolio function">
    <div class="searchBox">
        <h5>Поиск</h5>
        <div>

            <div class="line">
                <div>
                    <span class="caption">Цена:</span>
                    <span class="sliderBox">
                        <input id="priceInp" type="slider" name="price" value="0;3000" />
                    </span>
                </div>

                <div>
                    <span class="caption">Стаж:</span>
                    <span class="sliderBox">
                        <input id="extInp" type="slider" name="ext" value="0;40" />
                    </span>
                </div>

                <div>
                    <span class="caption">Возраст:</span>
                    <span class="sliderBox">
                        <input id="ageInp" type="slider" name="age" value="18;80" />
                    </span>
                </div>
            </div>

            <div class="line">

                <div>
                    <span class="caption">Рейтинг:</span>
                    <span class="sliderBox ">
                        <input id="ratingInp" type="slider" name="rating" value="0;5" />
                    </span>
                </div>

                <div>
                    <span class="caption">Метро:</span>
                    <input type="button" value="Карта метро" id="metroBtn"/>
                    <span id="metroText"></span>
                    <a href="#" id="metroClearBtn" title="Очистить выбор"><img src="/res/images/metro/metroClearBtn.png" alt="Очистить выбор" width="16px" height="16px"/></a>
                </div>

                <div>
                    <input type="button" value="Сбросить" id="searchClearBtn"/>
                    <input type="button" class="greenBtn" value="Начать поиск" id="searchStartBtn"/>
                </div>
            </div>

        </div>
    </div>

    <!--<div class="sortBox">
        <h5>Сортировка</h5>
        <div>
            <select>
                <option value="rating">Рейтинг</option>
                <option value="cost">Цена</option>
                <option value="exp">Стаж</option>
            </select>
        </div>
    </div>-->
    <div class="clear"></div>

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

    <div class="pagination">
        <!--<span class="pages">Страница 1 из 11</span>-->
        <?
        $pagList = self::get('paginationList');
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

</div>

<script type="text/javascript" charset="utf-8">
    var sliderOpt = {
        from: 0,
        to: 3000,
        step: 100,
        round: 1,
        dimension: '&nbsp;руб.',
        skin: 'plastic'
    };
    $("#priceInp").slider(sliderOpt);

    sliderOpt.from = 0;
    sliderOpt.to = 40;
    sliderOpt.dimension = '&nbsp;лет.';
    sliderOpt.step = 1;
    $("#extInp").slider(sliderOpt);

    sliderOpt.from = 18;
    sliderOpt.to = 80;
    $("#ageInp").slider(sliderOpt);

    sliderOpt.from = 0;
    sliderOpt.to = 5;
    sliderOpt.dimension = '&nbsp;&#9734;';
    $("#ratingInp").slider(sliderOpt);

    var stationList = [];

    function cbMetroStationSelect(pStatList){
        setMetroText(pStatList.length);
        $('#metroClearBtn').toggle(pStatList.length != 0);
        $.cookie('stationList', pStatList);
        stationList = pStatList;
        // func. cbMetroStationSelect
    }

    function metroClearBtnClick(){
        stationList = [];
        $.cookie('stationList', stationList);
        setMetroText(0);
        $('#metroClearBtn').hide();
        return false;
        // func. metroClearBtnClick
    }

    function metroBtnClick(){
        var urlWindow = '/res/plugin/metroStation/win.html';
        var win = window.open( urlWindow, 'Выберите станции',
                'width=810,height=874,scrollbars=yes,resizable=yes,'
                        +'location=no,status=no,menubar=no');
        win.onload = function() {
            win.panel.cbReturnMetroSelect = cbMetroStationSelect;
            win.stationMap.setStationSelect(stationList);
        };

        return false;
        // func. metroBtnClick
    }


    function selAnketBtnClick(pEvent){
        var anketList = $.cookie('anketList');
        anketList = anketList ? anketList : '';

        var $obj = $(pEvent.target);
        var anketId = $obj.attr('id').substr(5);

        if ( $obj.hasClass('red')){
            $obj.removeClass('red')
                    .html('&raquo; Пометить анкету')
                    .parents('li:first')
                    .removeClass('selAnket');
            anketList = anketList.replace('|' + anketId, '');
            $.cookie('anketList', anketList);
        }else{
            $obj.addClass('red')
                    .html('&raquo; Убрать метку')
                    .parents('li:first')
                    .addClass('selAnket');
            anketList = '|' + anketId + anketList;
            $.cookie('anketList', anketList);
        } // if

        return false;
        // func. selAnketBtnClick
    }

    function initSelectData(){
        var anketList = $.cookie('anketList');
        if ( anketList ){
            var list = anketList.substr(1).split('|');
            for( var i in list ){
                var id = list[i];
                $('#anket'+id).addClass('red')
                        .html('&raquo; Убрать метку')
                        .parents('li:first')
                        .addClass('selAnket');
            } // for
        } // if


        stationList = $.cookie('stationList');
        stationList = stationList.length > 0 ? stationList.split(',') : [];
        $('#metroClearBtn').toggle(stationList.length != 0);
        setMetroText(stationList.length);
        // func. initSelectData
    }

    function setMetroText(pCount){
        var text = pCount == 0 ? 'Учитываются все' : 'Выбрано: ' + pCount;
        $('#metroText').html(text);
        // func. setMetroText
    }

    initSelectData();

    $('#metroClearBtn').click(metroClearBtnClick);
    $('#metroBtn').click(metroBtnClick);
    $('#portfolio div.photoAction a.selAnketBtn').click(selAnketBtnClick);

</script>