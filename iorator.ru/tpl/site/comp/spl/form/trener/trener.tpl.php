<!-- Search -->
<link rel="stylesheet" href="/res/comp/spl/form/search/css/trener.css" type="text/css">
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.css" type="text/css">
<script type="text/javascript" src="/res/comp/spl/form/search/js/trener.js"></script>
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.js" ></script>

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
                    <input type="button" value="Сбросить поиск" id="searchClearBtn"/>
                    <input type="button" class="greenBtn" value="Начать поиск" id="searchStartBtn"/>
                </div>
            </div>

        </div>
    </div>
    <div class="clear"></div>
</div>