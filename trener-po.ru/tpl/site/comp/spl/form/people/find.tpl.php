<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.css" type="text/css">
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jslider/bin/jquery.slider.min.js" ></script>
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/metroStation/js/min/list.js" ></script>

<script src="http://theme.codecampus.ru/bridge/min/themeBridgeApi.js" type="text/javascript"></script>

<style>
div.searchBox span.caption{
  font-weight: bold;
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

#searchBox .one{
    margin-bottom: 10px;
}

#searchPeopleBtn{
    float: right;
}

#metroText{
    width: 380px;
    line-height: 28px;
    vertical-align: middle;
}

#metroSelBtn, #clearMetroBtn, #metroText{
    float: left;
}

.ellipsis
{
    overflow: hidden;
    white-space: nowrap;
    /*line-height: 1.2em;
    height: 1.2em;*/
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    width: 100%;
    -moz-binding: url(moz_fix.xml#ellipsis);
}

.moz-ellipsis > DIV:first-child
{
    float: left;
}
.moz-ellipsis > DIV + DIV
{
    float: right;
    margin-top: -1.2em;
}
.moz-ellipsis > DIV + DIV::after
{
    background-color: white;
    content: '...';
}
</style>


<div id="searchBox">
	<div class="one-half">
		<h6>Цена:<h6>
		<input id="priceInp" type="slider" name="find[price]" value="0;5000" />
	</div>
	<div class="one-half last">
		<h6>Рейтинг:<h6>
		<select id="rating">
			<option value="-1">не важно</option>
			<option value="0">больше 0</option>
			<option value="1">больше 1</option>
			<option value="2">больше 2</option>
			<option value="3">больше 3</option>
			<option value="4">больше 4</option>
		</select>
	</div>
	<div class="one">
		<a class="button white" title="Выбрать метро" id="metroSelBtn">Метро</a>
		<a class="button white" title="Очистить список метро" id="clearMetroBtn">Очистить</a>
        <div id="metroText" class="ellipsis">Все станции</div>
        <a type="button" class="button blue" title="Начать поиск" id="searchPeopleBtn">Поиск &raquo;</a>
	</div>
    <div class="clear"></div>
</div>

<script>
var searchAnketMvc  = (function () {

    var options;
    var isSliderInit = false;

    // Цены, выбранные с помощью слайдера
    var prices = '0;5000';
    // ID станций метро, выбранные в окне плагина Метро
    var stationList = [];


    function cbSliderChange(pValue){
        if ( !isSliderInit ){
            return;
        }
        prices = pValue;
        // func. cbSliderChange
    }

    function initSliders(){
        var sliderOpt = {
            from: 0,
            to: 5000,
            step: 100,
            round: 1,
            dimension: '&nbsp;руб.',
            skin: 'plastic',
            onstatechange: cbSliderChange
        };
        $('#priceInp').slider(sliderOpt);
        isSliderInit = true;
        // func. initSliders
    }

    function paginationClick(pEvent){
        if ( !pEvent.target.href ){
            return;
        }
        var pageNum = pEvent.target.href.match('#(.*)$');
        pageNum = pageNum && pageNum.length == 2 ? pageNum[1] : 1;
        searchPeople(pageNum);

        return false
        // func. paginationClick
    }

    function metroSelBtnClick(){
        themeBridgeApi.setCallback(function(pEvent){
            stationList = pEvent.data;
            var text = '';
            for( var i = 0; i < stationList.length; i++ ){
                var index = parseInt(stationList[i]);
                text += ',' + metroStationList[index];

            }
            text = text.substr(1);
            jQuery('#metroText').html(text);
        });
        themeBridgeApi.showWindow({
            url: 'http://theme.codecampus.ru/plugin/metroStation/',
            action: 'show',
            list: stationList
        });
        return false;
        // func. metroSelBtnClick
    }

    function clearMetroBtnClick(){
        jQuery('#metroText').html('Все станции');
        stationList = [];
        return false;
        // func. clearMetroBtnClick
    }

    function cbSearchResult(pData){
        jQuery('#imgPeopleList').html(pData['file']);
        jQuery('#pagination').replaceWith(pData['pagination']);
        jQuery('#pagination').click(paginationClick);
        // func. cbSearchResult
    }

    function searchPeople(pPageNum){
        var data = 'prices='+prices;
        data += '&metro='+stationList.join(',');
        data += '&rating='+jQuery('#rating').val();
        data += '&categoryId=' + categoryId;
        data += '&pageNum=' + pPageNum;

        jQuery.ajax({
            url: "/webcore/func/comp/spl/form/?form[action]=search&form[type]=out",
            data: data,//jQuery('#authForm').serialize(),
            type: 'POST'
        }).done(cbSearchResult);
        // func. searchPeople

    }

    function searchPeopleBtnClick(){
        searchPeople(1);
        return false;
        // func. searchPeopleBtnClick
    }

    function init(pOptions){
        options = pOptions;

        initSliders();

        jQuery('#metroSelBtn').click(metroSelBtnClick);
        jQuery('#clearMetroBtn').click(clearMetroBtnClick);
        jQuery('#searchPeopleBtn').click(searchPeopleBtnClick);

        // func. init
    }

    return {
        init:init
    }
})();

$(document).ready(function () {
    searchAnketMvc.init({
    });
}); // $(document).ready
</script>