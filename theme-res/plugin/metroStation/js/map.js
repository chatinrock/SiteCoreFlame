/**
 * ����� ����� �� ���������
 * @type {*}
 */
var stationMap = (function () {
    // ���������� ����� �������
    var stationCenter = {1:[[358,617]],2:[[520,719],[498,719]],3:[[472,591],[472,569]],4:[[361,573],[376,558]],5:[[555,271],[533,271]],6:[[509,227],[494,242]],7:[[268,259],[286,271]],8:[[517,440],[495,440]],9:[[250,480],[232,494],[232,464]],10:[[65,399],[43,399]],11:[[564,811]],12:[[549,797]],13:[[535,779]],14:[[518,742]],15:[[518,763]],16:[[627,726]],17:[[469,719]],18:[[435,719]],19:[[517,694]],20:[[517,667]],21:[[517,643]],22:[[397,854]],23:[[432,818]],24:[[432,798]],25:[[433,778]],26:[[433,758]],27:[[414,739]],28:[[413,719]],29:[[413,699]],30:[[413,680]],31:[[439,656]],32:[[439,631]],33:[[439,601]],34:[[439,579]],35:[[426,529]],36:[[447,519],[427,506]],37:[[296,511],[278,523]],38:[[196,659]],39:[[210,644]],40:[[227,627]],41:[[257,596]],42:[[278,574]],43:[[292,684]],44:[[308,666]],45:[[324,650]],46:[[342,633]],47:[[276,700]],48:[[258,718]],49:[[259,735]],50:[[258,756]],51:[[273,772]],52:[[289,791]],53:[[195,718]],54:[[373,513]],55:[[318,491]],56:[[579,518]],57:[[558,507],[578,495]],58:[[588,425],[611,425]],59:[[599,445]],60:[[181,419]],61:[[234,359]],62:[[139,374]],63:[[594,126]],64:[[546,126]],65:[[502,126]],66:[[453,126]],67:[[363,126],[347,133]],68:[[408,124]],69:[[693,745]],70:[[692,694]],71:[[692,661]],72:[[627,749]],73:[[627,701]],74:[[627,679]],75:[[627,655]],76:[[627,633]],77:[[627,604]],78:[[627,566]],79:[[692,609]],80:[[658,574]],81:[[627,544]],82:[[626,517]],83:[[626,495]],84:[[677,487]],85:[[712,453]],86:[[713,434]],87:[[713,414]],88:[[634,404]],89:[[665,374]],90:[[691,349]],91:[[691,324]],92:[[690,296]],93:[[690,267]],94:[[690,240]],95:[[623,81]],96:[[623,50]],97:[[623,20]],98:[[581,248]],99:[[602,225]],100:[[626,201]],101:[[653,176]],102:[[653,145]],103:[[623,112]],104:[[593,142]],105:[[563,173]],106:[[513,293]],107:[[534,203]],108:[[438,208]],109:[[493,264]],110:[[439,287]],111:[[416,287]],112:[[364,229]],113:[[347,213]],114:[[438,188]],115:[[347,162]],116:[[347,186]],117:[[364,26]],118:[[364,80]],119:[[364,44]],120:[[364,61]],121:[[347,95]],122:[[250,238]],123:[[230,219]],124:[[212,202]],125:[[212,172]],126:[[212,132]],127:[[212,153]],128:[[161,205]],129:[[161,177]],130:[[161,238]],131:[[161,264]],132:[[161,289]],133:[[178,307]],134:[[204,332]],135:[[218,345]],136:[[331,318]],137:[[256,358]],138:[[349,363]],139:[[372,363]],140:[[361,343]],141:[[472,325]],142:[[491,313]],143:[[492,336]],144:[[445,364]],145:[[461,379]],146:[[441,429]],147:[[425,413]],148:[[410,398]],149:[[361,414]],150:[[285,412]],151:[[320,411]],152:[[346,429]],153:[[125,456]],154:[[147,506]],155:[[156,489]],156:[[141,473]],157:[[376,429]],158:[[361,445]],159:[[299,427]],160:[[68,429],[182,513]],161:[[96,430]],162:[[82,416]],163:[[43,345]],164:[[43,319]],165:[[43,290]],166:[[43,259]],167:[[43,221]],168:[[43,185]]};
    // ���������� �������
    var stationSel = [];

    /**
     *  ��������� ������ �� �������
     * @param pStationId ID �������
     * @return {Boolean} ������ false
     * @private
     */
    function _markerAdd(pStationId) {
        // �������� ���������� ������ ( ������ ����� ���� ����� �� ����� pStationId )
        var coors = stationCenter[pStationId];
        // ������ �� ����������� �������
        for (var i in coors) {
            // ��������� �������
            animPng.addMarker(pStationId, coors[i][0], coors[i][1]);
        } // for
        return false;
        // func. stationClick
    }

    /**
     * ���������� ����� �� �������. �������� �������
     * @param pEvent ������� �����
     * @return {Boolean} ������ false
     */
    function removeClick(pEvent) {
        // �������� DIV ��������� � �������
        var divObj = pEvent.currentTarget;
        // ������� ��������� � ���������
        _remove(divObj.stationId);
        return false;
        // func. pStationId
    }
	
	function selectStation(pStationId){
		// ��������� �� ��������
        if (_remove(pStationId)) {
            return false;
        }
        // ���� �� �� ��������, ������ ����� ���������
        _markerAdd(pStationId);
        // �������� pStationId, ��� ��� ��������
        stationSel.push(pStationId);
		// func. selectStation
	}

    /**
     * �������� ������� �, �� ��� �� ��� ������� �� �������
     * @param pStationId
     * @return {Boolean} false ���� ������ �� ��� �� �������, true ���� �� ��� �������
     * @private
     */
    function _remove(pStationId) {
        // ���� �� �� � ������� ������������ �������
        var pos = stationSel.indexOf(pStationId);
        // ���� ����. �� �������.
        if (pos == -1) {
            return false;
        }
        // ���� �� ����, ������� ��� �� �������
        stationSel.splice(pos, 1);
        // �������� ID ����� � ���������
        var marketBox = animPng.getOptions().markerBox;
        // ������� ���������
        $(marketBox + ' .st' + pStationId).remove();
        return true;
        // func. _remove
    }

    /**
     * ��������� ����� �� �����, �.� �� ���������� map � area
     * @param pEvent ������� �����
     * @return {Boolean} ������ false
     */
    function mapClick(pEvent) {
        // �������� href, ��� ��������� stationId
        var href = pEvent.originalEvent.target.href;
        var begin = href.lastIndexOf('#') + 1;
        var stationId = href.substr(begin);
        selectStation(stationId);
        return false;
        // func. mapClick
    }

    /**
     * �������������
     * @param pOptions
     */
    function init(pOptions) {
        $(pOptions.mapBox).click(mapClick);
        // func. init
    }

    // Public ������
    return {
        init:init,
        removeClick:removeClick,
		selectStation: selectStation
    }
    // class stationMap
})();




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

        // ���� �� ����� �� ��������� �����
        if (frameCurrent == pOptions.frameCount) {
            // ���� �� �� ������� �����, �� ����� ������� ���������:
            // ��� ��� ����� ����� �������, �� ��������� ����� area map ������ �������
            // ������ ��� ����� �������� � �������� ������ ��������, ��� ����� ����� ��������� ��������

            // ����������� ������� X ��� ������
            var xPos = (frameXCurrent - 1) * pOptions.frameWidth;
            // ����������� ������� Y ��� ������
            var yPos = frameYCurrent * pOptions.frameHeight;
            // �������� ��� �������
            var xOffset = (pOptions.frameWidth - pOptions.markerDia) / 2;
            var yOffset = (pOptions.frameHeight - pOptions.markerDia) / 2;
            xPos += xOffset;
            yPos += yOffset;

            // ����� style, ��� �� �������� ��������, �������� ������ ������ �������� ������
            var css = {
                'background-position':'-' + xPos + 'px -' + yPos + 'px',
                width:pOptions.markerDia + 'px', height:pOptions.markerDia + 'px',
                left:parseInt(divObj.style.left) + xOffset + 'px',
                top:parseInt(divObj.style.top) + yOffset + 'px'
            } // var css

            // ���������� style
            $(divObj).css(css);
            // ������ ��� ���� ��� ��, � ���� if �� �������
            ++frameCurrent;
            // ���������� false, ��� �� ������� ��� �������� �����������
            return false;
        } // if

        // ���� �� ��������� ��� ��������, ������ ������� �
        // ��������� false (��� �������� ����������� � ����� ������)
        if (frameCurrent > pOptions.frameCount) {
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
        markerBox:'#markerBox',
        // ������ ������ ������ � ��������
        frameWidth:100,
        // ������ ������ ������ � ��������
        frameHeight:100,
        // ������� ������ � �������
        markerDia:24,
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
		// func. clearAll
	}

    /**
     * ��������� ����� ������ �� �����
     * @param pStationId ID �������
     * @param pX ������� ������� �� X. ��. ������ stationMap.stationCenter
     * @param pY ������� ������� �� Y. ��. ������ stationMap.stationCenter
     */
    function addMarker(pStationId, pX, pY) {
        // ����������� ��������� x, � ����������� �� ������ ��������
        var x = pX - options.frameWidth / 2;
        // ����������� ��������� y, � ����������� �� ������ ��������
        var y = pY - options.frameHeight / 2;
        // ������ ���� DIV
        var divObj = document.createElement('div');
        // ������������� ��� class � �����, ��� �� ����� ����� ���� ����� ��� �������
        divObj.className = options.markerClass + ' st' + pStationId;
        // ���������� ����������
        divObj.style.left = x + 'px';
        divObj.style.top = y + 'px';
        // ������������� ID �������, ��� �� � �������� ���� ����� ��������� ��������
        divObj.stationId = pStationId;
        // ������ ������� �� �������� �������, ��� ����� �� ��
        divObj.onclick = stationMap.removeClick;
        // ��������� ������ �� �����
        $(markerBox).append(divObj);
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

$(document).ready(function(){
	stationMap.init({
		// ��� map � area
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
