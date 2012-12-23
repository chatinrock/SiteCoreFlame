/**
 * ����� �������� �������
 * @param pDivObj
 */
function animFrame(pDivObj) {
    // ��������� X �� ����������� ������
    var frameXCurrent = 0;
    // ��������� Y �� ����������� ������
    var frameYCurrent = 0;
    // ����� �������� ������ �� ����������� ������
    var frameCurrent = 0;
    // DIV ��������� � ���������
    var divObj = pDivObj;

    /**
     * ��������� ���������� �����(������)
     * @param pOptions ����� �� animPng
     * @return {Boolean} ���� ����� ������� ��� ����, �� true, ���� �������� ����������� �� false
     */
    this.nextFrame = function (pOptions) {
        // ���� �� ��������� ��� ��������, ������ ������� �
        // ��������� false (��� �������� ����������� � ����� ������)
        if (frameCurrent >= pOptions.frameCount) {
            return false;
        }

        // ���� �� ����������� �� ���� ������� X �����������, �.�. ��������� ��� �������
        if (frameXCurrent >= pOptions.frameXCount) {
            // �� ��������� �� ����� ���
            frameXCurrent = 0;
            ++frameYCurrent;
        } // if

        // ����������� ��������� �� ��������
        var xPos = frameXCurrent * pOptions.frameWidth;
        var yPos = frameYCurrent * pOptions.frameHeight;

        // ������������� ��������� � ������� CSS
        $(divObj).css('background-position', '-' + xPos + 'px -' + yPos + 'px');
        // ��������� ������ �� �������
        ++frameXCurrent;
        ++frameCurrent;
        // ���������� true, ��� � ��� �������� ��� ���
        return true;
        // func. nextFrame
    }
    // class animFrame
}

/**
 * ���������:
 * animPng.init({
 *   frameXCount:1, // ���������� ������� �� ��� X �� �����������.
 *   frameYCount:1, // ���������� ������� �� ��� Y �� �����������.
 *   markerClass: 'marker', // ����� ������� ��� ��������
 *   markerBox:'#markerBox', // ID ��������� �������� ��������
 *   frameWidth:100, // ������ ������ ������ � ��������
 *   frameHeight:100, // ������ ������ ������ � ��������
 *   markerDia:24, // ������� ������ � �������
 *   frameCount:null // ���������� ������� �� ��������, ���� null ����� ��������� �������������, ��� frameXCount * frameYCount
 * });
 */
var animPng = (function () {
    // ID �������. ����������� � ������ play(), �������������� � ������ nextFrame
    var intervalId;
    // ����. ����� �� ��������� ����� ������
    var isStartPlay = true;
    // ������ ��������, ������� �����������
    var markerList = [];

    // �����
    var options = {
        // ���������� ������� �� ��� X �� �����������.
        frameXCount:1,
        // ���������� ������� �� ��� Y �� �����������.
        frameYCount:1,
        // ����� ������� ��� ��������
        markerClass:'marker',
        // ID ��������� �������� ��������
        markerBox:'body:first',
        // ������ ������ ������ � ��������
        frameWidth:68,
        // ������ ������ ������ � ��������
        frameHeight:68,
        // ���������� ������� �� ��������, ���� null ����� ��������� �������������, ��� frameXCount * frameYCount
        frameCount:null

    } // var options

    /**
     * ��������� ���������� ������������ ��� init
     * @return {Object}
     */
    function getOptions() {
        return options;
        // func. getOptions
    }

    /**
     * �������� ������� ��������
     */
    function nextFrame() {
        // ���� ������ ������� � ����������
        isStartPlay = false;
        // ������ �� ��������
        for (var i in markerList) {
            // ���� ������ �������� ���� ��������, �� ����� false
            isStartPlay = markerList[i].nextFrame(options) || isStartPlay;
        } // for

        // �������� ����. ��� ���� ��. �������. ����
        isStartPlay = !isStartPlay;

        // ���� ��� ������� ������ false( ��� ����� ����� �������� "���" ), �� �������� ��������� �
        // �� ��������� ������� ������ ���������� � ������� ������ ��������
        if (isStartPlay) {
            // ������� ������ ��������
            markerList = [];
            // ������������� ������
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
        // ������������� ������
        clearInterval(intervalId);
		$(options.markerBox+' .'+options.markerClass).remove();
		stationMap.clearSelect();
		// func. clearAll
	}

    /**
     * ��������� ����� ������ �� �����
     * @param pX ������� ������� �� X. ��. ������ stationMap.stationCenter
     * @param pY ������� ������� �� Y. ��. ������ stationMap.stationCenter
     */
    function addMarker( pX, pY) {
        // ����������� ��������� x, � ����������� �� ������ ��������
        var x = pX - options.frameWidth / 2;
        // ����������� ��������� y, � ����������� �� ������ ��������
        var y = pY - options.frameHeight / 2;
        // ������ ���� DIV
        var divObj = document.createElement('div');
        // ������������� ��� class � �����, ��� �� ����� ����� ���� ����� ��� �������
        // ���������� ����������
        divObj.style.left = x + 'px';
        divObj.style.top = y + 'px';
		divObj.className = options.markerClass;
        // ������ ������� �� �������� �������, ��� ����� �� ��
        //divObj.onclick = stationMap.removeClick;
        // ��������� ������ �� �����
        $(options.markerBox).append(divObj);
        // ��������� ������ � ������ ��������
        markerList.push(new animFrame(divObj));
        // ����������� �������� �������
        play();
        // func. addMarker
    }

    /**
     * ������������� ������ animPng
     * @param pOptions
     */
    function init(pOptions) {
        $.extend(options, pOptions);

        with (options) {
            // ���� ���������� ������� �� ���� ������ ����, �� ����������� ��
            if (!frameCount) {
                frameCount = frameXCount * frameYCount;
            } // if
        } // with options
        // fucn. init
    }

    // ���������� public ������
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
