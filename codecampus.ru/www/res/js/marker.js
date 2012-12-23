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
        // Если мы проиграли всю анимацию, просто выходим и
        // указываем false (мол анимация закончилась у этого фрейма)
        if (frameCurrent >= pOptions.frameCount) {
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
        markerBox:'body:first',
        // Ширина одного фрейма в пикселях
        frameWidth:68,
        // Высота одного фрейма в пикселях
        frameHeight:68,
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
		stationMap.clearSelect();
		// func. clearAll
	}

    /**
     * Добавляет новый маркер на карту
     * @param pX позиция станции по X. см. массив stationMap.stationCenter
     * @param pY позиция станции по Y. см. массив stationMap.stationCenter
     */
    function addMarker( pX, pY) {
        // Рисчитываем положение x, в зависимости от ширины картинки
        var x = pX - options.frameWidth / 2;
        // Рисчитываем положение y, в зависимости от высоты картинки
        var y = pY - options.frameHeight / 2;
        // Создаём блок DIV
        var divObj = document.createElement('div');
        // Устанавливаем ему class и класс, что бы потом можно было легко его удалить
        // Выставляем координаты
        divObj.style.left = x + 'px';
        divObj.style.top = y + 'px';
		divObj.className = options.markerClass;
        // Ставим событие на удаление маркера, при клике на нём
        //divObj.onclick = stationMap.removeClick;
        // Добавляем маркер на карту
        $(options.markerBox).append(divObj);
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

animPng.init({
	frameXCount:3,
	frameYCount:4
});
