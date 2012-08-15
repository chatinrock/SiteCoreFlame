$(document).ready(function(){
    $('#layerslider').layerSlider({
        skinsPath : 'http://theme.codecampus.ru/fusion/layerslider/layerslider/skins/',
        skin : 'darkfusion',
        globalBGColor : '#333',
        yourLogo			: '/res/images/layerssliderLogo.png',
        yourLogoStyle		: 'position: absolute; z-index: 1001; left: -35px; top: -35px; width: 100px;',
        autoStart : false,
        navButtons: false,
        navStartStop: false,
        cbPrev: function(){
            var lsdata = $('#layerslider').layerSlider('data');
            // —чЄт в jQuery:eq начинаетс€ с 0, а слайды с 1, по этому -2
            var sliderNum = lsdata.g.curLayerIndex-2;
            sliderNum = sliderNum < 0 ? lsdata.g.layersNum-1 : sliderNum;
            $('#sliderMenu a.on:first').removeClass('on');
            $('#sliderMenu a:eq('+sliderNum+')').removeClass('off').addClass('on');
        },
        cbNext: function(){
            var lsdata = $('#layerslider').layerSlider('data');
            var sliderNum = lsdata.g.curLayerIndex;
            sliderNum = sliderNum == lsdata.g.layersNum ? 0 : sliderNum;
            console.log(sliderNum);
            $('#sliderMenu a.on:first').removeClass('on');
            $('#sliderMenu a:eq('+sliderNum+')').removeClass('off').addClass('on');
        }
    });

    $('#sliderMenu a').each(function(i){
        $(this).attr('sliderNum', i+1).click(function(){
            var lsdata = $('#layerslider').layerSlider('data');
            if ( !lsdata.g.isAnimating ){
                var sliderNum = parseInt($(this).attr('sliderNum'));
                $('#layerslider').layerSlider(sliderNum);
                $(this).parents('ul:first').find('a.on:first').removeClass('on');
                $(this).removeClass('off').addClass('on');
            } // if lsdata.g.isAnimating
            return false;
        }); // click
    }); // each

});	
