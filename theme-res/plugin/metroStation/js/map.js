/**
 * Класс карты со станциями
 * @type {*}
 */
var stationMap = (function () {
    // Координаты цетра станций
    var stationCenter = {1:[[358,617]],2:[[520,719],[498,719]],3:[[472,591],[472,569]],4:[[361,573],[376,558]],5:[[555,271],[533,271]],6:[[509,227],[494,242]],7:[[268,259],[286,271]],8:[[517,440],[495,440]],9:[[250,480],[232,494],[232,464]],10:[[65,399],[43,399]],11:[[564,811]],12:[[549,797]],13:[[535,779]],14:[[518,742]],15:[[518,763]],16:[[627,726]],17:[[469,719]],18:[[435,719]],19:[[517,694]],20:[[517,667]],21:[[517,643]],22:[[397,854]],23:[[432,818]],24:[[432,798]],25:[[433,778]],26:[[433,758]],27:[[414,739]],28:[[413,719]],29:[[413,699]],30:[[413,680]],31:[[439,656]],32:[[439,631]],33:[[439,601]],34:[[439,579]],35:[[426,529]],36:[[447,519],[427,506]],37:[[296,511],[278,523]],38:[[196,659]],39:[[210,644]],40:[[227,627]],41:[[257,596]],42:[[278,574]],43:[[292,684]],44:[[308,666]],45:[[324,650]],46:[[342,633]],47:[[276,700]],48:[[258,718]],49:[[259,735]],50:[[258,756]],51:[[273,772]],52:[[289,791]],53:[[195,718]],54:[[373,513]],55:[[318,491]],56:[[579,518]],57:[[558,507],[578,495]],58:[[588,425],[611,425]],59:[[599,445]],60:[[181,419]],61:[[234,359]],62:[[139,374]],63:[[594,126]],64:[[546,126]],65:[[502,126]],66:[[453,126]],67:[[363,126],[347,133]],68:[[408,124]],69:[[693,745]],70:[[692,694]],71:[[692,661]],72:[[627,749]],73:[[627,701]],74:[[627,679]],75:[[627,655]],76:[[627,633]],77:[[627,604]],78:[[627,566]],79:[[692,609]],80:[[658,574]],81:[[627,544]],82:[[626,517]],83:[[626,495]],84:[[677,487]],85:[[712,453]],86:[[713,434]],87:[[713,414]],88:[[634,404]],89:[[665,374]],90:[[691,349]],91:[[691,324]],92:[[690,296]],93:[[690,267]],94:[[690,240]],95:[[623,81]],96:[[623,50]],97:[[623,20]],98:[[581,248]],99:[[602,225]],100:[[626,201]],101:[[653,176]],102:[[653,145]],103:[[623,112]],104:[[593,142]],105:[[563,173]],106:[[513,293]],107:[[534,203]],108:[[438,208]],109:[[493,264]],110:[[439,287]],111:[[416,287]],112:[[364,229]],113:[[347,213]],114:[[438,188]],115:[[347,162]],116:[[347,186]],117:[[364,26]],118:[[364,80]],119:[[364,44]],120:[[364,61]],121:[[347,95]],122:[[250,238]],123:[[230,219]],124:[[212,202]],125:[[212,172]],126:[[212,132]],127:[[212,153]],128:[[161,205]],129:[[161,177]],130:[[161,238]],131:[[161,264]],132:[[161,289]],133:[[178,307]],134:[[204,332]],135:[[218,345]],136:[[331,318]],137:[[256,358]],138:[[349,363]],139:[[372,363]],140:[[361,343]],141:[[472,325]],142:[[491,313]],143:[[492,336]],144:[[445,364]],145:[[461,379]],146:[[441,429]],147:[[425,413]],148:[[410,398]],149:[[361,414]],150:[[285,412]],151:[[320,411]],152:[[346,429]],153:[[125,456]],154:[[147,506]],155:[[156,489]],156:[[141,473]],157:[[376,429]],158:[[361,445]],159:[[299,427]],160:[[68,429],[182,513]],161:[[96,430]],162:[[82,416]],163:[[43,345]],164:[[43,319]],165:[[43,290]],166:[[43,259]],167:[[43,221]],168:[[43,185]]};
    // Выделенные станции
    var stationSel = [];

    /**
     *  Добавляем маркер на станцию
     * @param pStationId ID станции
     * @return {Boolean} всегда false
     * @private
     */
    function _markerAdd(pStationId) {
        // Получаем координаты стациЙ ( стаций может быть много на одном pStationId )
        var coors = stationCenter[pStationId];
        // Бегаем по координатам станция
        for (var i in coors) {
            // Добавляем маркеры
            animPng.addMarker(pStationId, coors[i][0], coors[i][1]);
        } // for
        return false;
        // func. stationClick
    }

    /**
     * Обработчик клика по маркеру. Удаление маркера
     * @param pEvent Событие клика
     * @return {Boolean} всегда false
     */
    function removeClick(pEvent) {
        // Получаем DIV контейнер с фреймом
        var divObj = pEvent.currentTarget;
        // Удаляем параметры и контейнер
        _remove(divObj.stationId);
        return false;
        // func. pStationId
    }
	
	function selectStation(pStationId){
		// Проверяем на удаление
        if (_remove(pStationId)) {
            return false;
        }
        // Если он не удалился, значит можно добавлять
        _markerAdd(pStationId);
        // Помечаем pStationId, что она выделена
        stationSel.push(pStationId);
		// func. selectStation
	}

    /**
     * Удаление маркера и, то что он был помечен из буффера
     * @param pStationId
     * @return {Boolean} false если маркер не был на старции, true если мы его удалили
     * @private
     */
    function _remove(pStationId) {
        // Есть ли он в буффере выставленных станций
        var pos = stationSel.indexOf(pStationId);
        // Если нету. то выходим.
        if (pos == -1) {
            return false;
        }
        // Если он есть, убираем его из буффера
        stationSel.splice(pos, 1);
        // Получаем ID бокса с маркерами
        var marketBox = animPng.getOptions().markerBox;
        // Удаляем контейнер
        $(marketBox + ' .st' + pStationId).remove();
        return true;
        // func. _remove
    }

    /**
     * Обработка клика по карте, т.е по контейнеру map с area
     * @param pEvent событие клика
     * @return {Boolean} всегда false
     */
    function mapClick(pEvent) {
        // Получаем href, там находится stationId
        var href = pEvent.originalEvent.target.href;
        var begin = href.lastIndexOf('#') + 1;
        var stationId = href.substr(begin);
        selectStation(stationId);
        return false;
        // func. mapClick
    }

    /**
     * Инициализация
     * @param pOptions
     */
    function init(pOptions) {
        $(pOptions.mapBox).click(mapClick);
        // func. init
    }

    // Public методы
    return {
        init:init,
        removeClick:removeClick,
		selectStation: selectStation
    }
    // class stationMap
})();




/**
 * Класс анимации маркера
 * @param pDivObj
 */
function animFrame(pDivObj) {
    // Положение X на изображении фрейма
    var frameXCurrent = 0;
    // Положение Y на изображении фрейма
    var frameYCurrent = 0;
    // Номер текущего фрейма на изображении фрейма
    var frameCurrent = 0;
    // DIV контейнер с анимацией
    var divObj = pDivObj;

    /**
     * Установка следующего кадра(фрейма)
     * @param pOptions опции из animPng
     * @return {Boolean} если кадры впереди еще есть, то true, если анимация закончилась то false
     */
    this.nextFrame = function (pOptions) {

        // Если мы дошли до конечного кадра
        if (frameCurrent == pOptions.frameCount) {
            // Исли мы на конечно кадре, то нужно сделать следующее:
            // Так как фрейм очень большой, он закрывает часть area map других станций
            // значит его нужно обрезать и оставить только кружочек, для этого нужно расчитать смещения

            // Расчитываем позицию X для кружка
            var xPos = (frameXCurrent - 1) * pOptions.frameWidth;
            // Расчитываем позицию Y для кружка
            var yPos = frameYCurrent * pOptions.frameHeight;
            // Смещения для маркера
            var xOffset = (pOptions.frameWidth - pOptions.markerDia) / 2;
            var yOffset = (pOptions.frameHeight - pOptions.markerDia) / 2;
            xPos += xOffset;
            yPos += yOffset;

            // Новый style, где мы применим смещения, выставим высоту равную диаметру кружка
            var css = {
                'background-position':'-' + xPos + 'px -' + yPos + 'px',
                width:pOptions.markerDia + 'px', height:pOptions.markerDia + 'px',
                left:parseInt(divObj.style.left) + xOffset + 'px',
                top:parseInt(divObj.style.top) + yOffset + 'px'
            } // var css

            // Выставляем style
            $(divObj).css(css);
            // Делаем для того что бы, в этот if не попасть
            ++frameCurrent;
            // Возвращаем false, что бы указать что анимация закончилась
            return false;
        } // if

        // Если мы проиграли всю анимацию, просто выходим и
        // указываем false (мол анимация закончилась у этого фрейма)
        if (frameCurrent > pOptions.frameCount) {
            return false;
        }

        // Если мы пробежались по всей линейке X изображения, т.е. проиграли ряд фреймов
        if (frameXCurrent >= pOptions.frameXCount) {
            // То переходим на новый ряд
            frameXCurrent = 0;
            ++frameYCurrent;
        } // if

        // Расчитываем положения на картинке
        var xPos = frameXCurrent * pOptions.frameWidth;
        var yPos = frameYCurrent * pOptions.frameHeight;

        // Устанавливаем положения с помощью CSS
        $(divObj).css('background-position', '-' + xPos + 'px -' + yPos + 'px');
        // Смещаемся дальше по фреймам
        ++frameXCurrent;
        ++frameCurrent;
        // Возвращаем true, мол у нас анимация еще идёт
        return true;
        // func. nextFrame
    }
    // class animFrame
}

/**
 * Параметры:
 * animPng.init({
 *   frameXCount:1, // Количество фреймов по оси X на изображении.
 *   frameYCount:1, // Количество фреймов по оси Y на изображении.
 *   markerClass: 'marker', // Класс маркера при создании
 *   markerBox:'#markerBox', // ID элементра хранения маркеров
 *   frameWidth:100, // Ширина одного фрейма в пикселях
 *   frameHeight:100, // Высота одного фрейма в пикселях
 *   markerDia:24, // Диаметр кружка в маркере
 *   frameCount:null // Количество фреймов на картинке, если null будет высчитано автоматически, как frameXCount * frameYCount
 * });
 */
var animPng = (function () {
    // ID таймера. Запускается в методе play(), останавливаеся в методе nextFrame
    var intervalId;
    // Флаг. Стоит ли запускать вновь таймер
    var isStartPlay = true;
    // Список маркеров, которые анимаруются
    var markerList = [];

    // Опции
    var options = {
        // Количество фреймов по оси X на изображении.
        frameXCount:1,
        // Количество фреймов по оси Y на изображении.
        frameYCount:1,
        // Класс маркера при создании
        markerClass:'marker',
        // ID элементра хранения маркеров
        markerBox:'#markerBox',
        // Ширина одного фрейма в пикселях
        frameWidth:100,
        // Высота одного фрейма в пикселях
        frameHeight:100,
        // Диаметр кружка в маркере
        markerDia:24,
        // Количество фреймов на картинке, если null будет высчитано автоматически, как frameXCount * frameYCount
        frameCount:null

    } // var options

    /**
     * Получение параметров выставленных при init
     * @return {Object}
     */
    function getOptions() {
        return options;
        // func. getOptions
    }

    /**
     * Основная функция анимации
     */
    function nextFrame() {
        // Флаг старта таймера с интервалом
        isStartPlay = false;
        // Бегаем по маркерам
        for (var i in markerList) {
            // Если маркер проиграл свою анимацию, он вернёт false
            isStartPlay = markerList[i].nextFrame(options) || isStartPlay;
        } // for

        // Обращаем флаг. Для чего см. коммент. ниже
        isStartPlay = !isStartPlay;

        // Если все маркеры вернут false( для этого стоит операция "ИЛИ" ), то операция обратится и
        // мы остановим текущий таймер интервалов и обнулим список маркеров
        if (isStartPlay) {
            // Ощичаем список маркеров
            markerList = [];
            // Останавливаем таймер
            clearInterval(intervalId);
        } // if

        // func. nextFrame
    }

    function play() {
        if (isStartPlay) {
            intervalId = window.setInterval(nextFrame, 41)
            isStartPlay = false;
        } // if
        // func. play
    }
	
	function clearAll(){
		markerList = [];
        // Останавливаем таймер
        clearInterval(intervalId);
		$(options.markerBox+' .'+options.markerClass).remove();
		// func. clearAll
	}

    /**
     * Добавляет новый маркер на карту
     * @param pStationId ID станции
     * @param pX позиция станции по X. см. массив stationMap.stationCenter
     * @param pY позиция станции по Y. см. массив stationMap.stationCenter
     */
    function addMarker(pStationId, pX, pY) {
        // Рисчитываем положение x, в зависимости от ширины картинки
        var x = pX - options.frameWidth / 2;
        // Рисчитываем положение y, в зависимости от высоты картинки
        var y = pY - options.frameHeight / 2;
        // Создаём блок DIV
        var divObj = document.createElement('div');
        // Устанавливаем ему class и класс, что бы потом можно было легко его удалить
        divObj.className = options.markerClass + ' st' + pStationId;
        // Выставляем координаты
        divObj.style.left = x + 'px';
        divObj.style.top = y + 'px';
        // Устанавливаем ID станции, что бы в будующем было проще управлять маркером
        divObj.stationId = pStationId;
        // Ставим событие на удаление маркера, при клике на нём
        divObj.onclick = stationMap.removeClick;
        // Добавляем маркер на карту
        $(markerBox).append(divObj);
        // Добавляем маркер в список маркеров
        markerList.push(new animFrame(divObj));
        // Проигрываем анимацию маркера
        play();
        // func. addMarker
    }

    /**
     * Инициализация класса animPng
     * @param pOptions
     */
    function init(pOptions) {
        $.extend(options, pOptions);

        with (options) {
            // если количество фреймов не было задано явно, то расчитываем их
            if (!frameCount) {
                frameCount = frameXCount * frameYCount;
            } // if
        } // with options
        // fucn. init
    }

    // Выставляем public методы
    return {
        init:init,
        addMarker:addMarker,
        getOptions:getOptions,
		clearAll: clearAll
    }
    // class animPng
})();

$(document).ready(function(){
	stationMap.init({
		// тег map с area
		mapBox:'#stationCoor'
	});

	animPng.init({
		frameXCount:3,
		frameYCount:4
	});
});


var panel = {
	init: function() {
		this.start = new findBtn("#findDrop", function() {
			if ( this.selected ){
				var stationId = this.selected.id.substr(4);
				stationMap.selectStation(stationId);
			} // if

		});
		var that = this;
		$('#findIcon').click(function(event) {
			that.start.select();
			that.start.click();
		});
		
		$('#clearBtn').click(animPng.clearAll);
	},
	selectBtnClick: function() {
		console.log('panel.js selectBtnClick');
	},

};
