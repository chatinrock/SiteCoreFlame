var searchAnketMvc  = (function () {
    var stationList = [];
    var options;
    // Flag init slider
    var isFlagInit;

    function setMetroText(pCount){
        var text = pCount == 0 ? 'Учитываются все' : 'Выбрано: ' + pCount;
        $('#metroText').html(text);
        // func. setMetroText
    }

    function cbSliderChange(pValue){
        var name = '#'+this.inputNode[0].id;
        var val = $.cookie(name);
        if ( !isFlagInit ){
            $.cookie(name, pValue);
        }
        // func. cbSliderChange
    }

    function searchClearBtnClick(){
        $(options.slider.priceInp).slider('value', 0, 3000);
        $(options.slider.extInp).slider('value', 0, 40);
        $(options.slider.ageInp).slider('value', 18, 80);
        $(options.slider.ratingInp).slider('value', 0, 5);
        cbMetroStationSelect([]);

        return false;
        // func. searchClearBtnClick
    }

    function initSliders(){
        isFlagInit = true;
        var sliderOpt = {
            from: 0,
            to: 3000,
            step: 100,
            round: 1,
            dimension: '&nbsp;руб.',
            skin: 'plastic',
            onstatechange: cbSliderChange
        };
        $(options.slider.priceInp).slider(sliderOpt);

        sliderOpt.from = 0;
        sliderOpt.to = 40;
        sliderOpt.dimension = '&nbsp;лет.';
        sliderOpt.step = 1;
        $(options.slider.extInp).slider(sliderOpt);

        sliderOpt.from = 18;
        sliderOpt.to = 80;
        $(options.slider.ageInp).slider(sliderOpt);

        sliderOpt.from = 0;
        sliderOpt.to = 5;
        sliderOpt.dimension = '&nbsp;&#9734;';
        $(options.slider.ratingInp).slider(sliderOpt);


        for( var key in options.slider ){
            var val = $.cookie(options.slider[key]);
            if ( val ){
                val = val.split(';');
                $(options.slider[key]).slider('value', val[0], val[1]);
            } // if
        } // ofr

        isFlagInit = false;
        // func. initSliders
    }

    function cbMetroStationSelect(pStatList){
        setMetroText(pStatList.length);
        $(options.metroClearBtn).toggle(pStatList.length != 0);
        $.cookie('stationList', pStatList, {expires: 60*60*24*7});
        stationList = pStatList;
        // func. cbMetroStationSelect
    }

    function metroClearBtnClick(){
        stationList = [];
        $.cookie('stationList', stationList, {expires: 60*60*24*7});
        setMetroText(0);
        $(options.metroClearBtn).hide();
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

    function initSelectData(){
        stationList = $.cookie('stationList');
        if ( stationList && stationList != '' ){
            cbMetroStationSelect(stationList.split(','));
        }else{
			cbMetroStationSelect([]);
		}
        // func. initSelectData
    }

    function init(pOptions){
        options = pOptions;

        initSliders();
        initSelectData();

        $(options.metroClearBtn).click(metroClearBtnClick);
        $(options.searchClearBtn).click(searchClearBtnClick);
        $('#metroBtn').click(metroBtnClick);
        // func. init
    }

    return {
        init:init
    }
})();

$(document).ready(function () {
    searchAnketMvc.init({
        slider: {
            priceInp: "#priceInp",
            extInp: "#extInp",
            ageInp: "#ageInp",
            ratingInp: "#ratingInp"
        },
        metroClearBtn: '#metroClearBtn',
        searchClearBtn: '#searchClearBtn'
    });
}); // $(document).ready