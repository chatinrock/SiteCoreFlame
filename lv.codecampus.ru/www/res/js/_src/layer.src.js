/*
* http://closure-compiler.appspot.com/home
*/
var layerMvc = (function(){
	var fileCodeCampusIframeObj = null;

	var layerList = {};

	var newResId = 0;
	var newLayerId = 0;

	var currentLayerId = null;
	var currentResId = null;
	
	var roomId;

	function dragStop(pEvent, Object){
		var resId = parseInt(pEvent.target.id.substr('4'));
		var curLayer = layerList[currentLayerId].list;
		curLayer[resId].x = Object.position.left;
		curLayer[resId].y = Object.position.top;
		// func. dragStop
	}

	function addResDiv(pResId, pType){
		return '<div class="res" style="width:24px; height: 24px;" id="box-'+pResId+'">'+
					'<img src="/res/img/loader.gif" id="img-'+pResId+'">'+
					'<div class="panel">'+
						'<img src="http://theme.codecampus.ru/plugin/icons/img/delete-16.png" type="rm">'+
					'</div>'+
				'</div>';
		// func. addResDiv
	}

	function loadResDivImage(list){
		setTimeout(function(){
			for(var num in list ){
				var image = new Image();
				var curLayer = layerList[currentLayerId].list;
				image.src = curLayer[list[num]].src;
				image.numTmp = list[num];
				image.onload = function(){
					var imgTmp = document.getElementById('img-'+this.numTmp);
					imgTmp.parentNode.replaceChild(this, imgTmp);
					jQuery(this).attr('type', curLayer[this.numTmp].type)

					var data = layerList[currentLayerId].list[this.numTmp];
					jQuery('#box-'+this.numTmp).css({
						width: this.width + 'px',
						height: this.height + 'px',
						top: data.y + 'px',
						left: data.x + 'px',
						position: 'absolute'
					});
				} // onload
			} // for
		}, 200);
		// func. loadResDivImage
	}

	function imageWindowCallback(e){
		addImages(e.data, 'img')
		// func. imageWindowCallback
	}

	function addImages(data, pType){
		var html = '';
		var list = [];
		var curLayer = layerList[currentLayerId].list;
		for( var imageId in data.list ){
			++newResId;
			list.push(newResId);
			var src = pType == 'img' ? data.list[imageId] : data.list[imageId] + 'preview.png';
			curLayer[newResId] = {x:0, y:0, type:pType, src: src, id: imageId};
			if ( pType == 'swf' ){
				curLayer[newResId].swf = data.list[imageId] + 'data.swf';
			}
			
			html += addResDiv(newResId, pType);
		} // for
		layerList[currentLayerId].newResId = newResId;
		currentResId = newResId;

		jQuery('#sliderShowBox').append(html);

		for( var num in list ){
			jQuery( '#box-'+list[num] ).draggable({ containment: "#sliderShowBox", scroll: false, stop: dragStop, cancel: ".panel" });

		} // for

		loadResDivImage(list);
		// func. addImages
	}

	function initIframeCallback(){
		// Create IE + others compatible event handler
		var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		var eventer = window[eventMethod];
		var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
		// Listen to message from child window
		eventer(messageEvent,imageWindowCallback, false);
		// func. initIframeCallback
	}

	function resImageBtnClick(){
		if ( currentLayerId == null ){
			alert('Выберите/создайте слой')
			return;
		}

		if ( fileCodeCampusIframeObj == null ){
			return;
		}
		fileCodeCampusIframeObj.contentWindow.postMessage({
			action:'show',
			group: roomId,
			subgroup: 'layer',
			profile: 'livevideo'
		}, "http://files.codecampus.ru/");
		return false;
		// func. slideSettingsBtnClick
	}

	function sliderShowBoxClick(pEvent){
		var type = jQuery(pEvent.target).attr('type');
		if ( !type){
			return;
		}
		var id = jQuery(pEvent.target).parents('.res:first').attr('id').substr(4);
		id = parseInt(id);
		switch(type){
			case 'rm':
				if (!confirm("Удалить?")) {
					return false;
				}
				delete layerList[currentLayerId].list[id];
				jQuery('#box-'+id).remove();
				break;
			case 'swf':
				if ( id == currentResId ){
					return;
				}

				var obj = layerList[currentLayerId].list[id];
				jQuery('#swfParamBox').html('').load('swf/'+obj.name+'.html', function() {
					pluginSwfMvc.init({isInit:false}, obj.swfData);
				});
				currentResId = id;
				break;
			case 'img':
				currentResId = id;
				jQuery('#swfParamBox').html('');
				break;
		}
		return false;
		// func. sliderShowBoxClick
	}

	function initFileCodecampusIframe(){
		fileCodeCampusIframeObj = document.createElement("IFRAME");
		fileCodeCampusIframeObj.setAttribute("src", "http://files.codecampus.ru/bridge/?host="+document.location.host+'&PHPSESSID=' + jQuery.cookie('PHPSESSID'));
		fileCodeCampusIframeObj.style.width = 1+"px";
		fileCodeCampusIframeObj.style.height = 1+"px";
		fileCodeCampusIframeObj.style.visibility = 'hidden';
		document.body.appendChild(fileCodeCampusIframeObj);
		// func. initFileCodecampusIframe
	}

	function layerAddBtnClick(){
		var val = document.getElementById('layerName').value.trim();
		if ( val == '' ){
			alert('Нельзя создать с пустым именем');
			return;
		}
		document.getElementById('layerName').value = '';
		val = $('<div/>').text(val).html();
		++newLayerId;
		layerList[newLayerId] = {name: val, list:{}, newResId:0};
		addLayerLine(newLayerId, val);

		return false;
		// func. layerAddBtnClick
	}

	function addLayerLine(pId, pName){
		jQuery('#layerList').append('<li class="item" id="lr-'+pId+'" type="view"><img src="http://theme.codecampus.ru/plugin/icons/img/delete-16.png" type="rm"/>'+pName+'</li>');
		// func. addLayerLine
	}

	function layerListClick(pEvent){
		var type = jQuery(pEvent.target).attr('type');
		if ( !type){
			return;
		}

		var id = jQuery(pEvent.target).attr('id');
		// Получили ли мы ID, если нет, то значит кликнули на кнопку удалить
		if ( !id ){
			id = jQuery(pEvent.target).parents('.item:first').attr('id');
		}
		id = parseInt(id.substr(3));

		if ( currentLayerId == id ){
			return;
		}
		switch(type){
			case 'rm':
				if (!confirm("Удалить?")) {
					return false;
				}
				currentLayerId = null;
				jQuery('#sliderShowBox .res').remove();
				jQuery('#lr-' + id).remove();
				delete layerList[id];
				jQuery('#swfParamBox').html('');
				break;
			default:
				//layerList[id] = layerList[id] ? layerList[id] : {list:{}, newResId:0};
				currentLayerId = id;
				jQuery('#layerList .select:first').removeClass('select');
				jQuery('#lr-'+id).addClass('select');

				jQuery('#sliderShowBox .res').remove();

				setLayerRes(layerList[id]);
				jQuery('#swfParamBox').html('');

				currentResId = null;

		} // switch

		return false;
		// func. layerListClick
	}

	function setLayerRes(pLayerData){
		var resList = pLayerData.list;
		var listNew = [];
		var html = '';
		for( var resId in resList ){
			html += addResDiv(resId, resList[resId].type);
			listNew.push(resId);
		}
		newResId = layerList[currentLayerId].newResId;
		jQuery('#sliderShowBox').append(html);

		for( var num in listNew ){
			console.log('#box-'+listNew[num]);
			jQuery('#box-'+listNew[num] ).draggable({ containment: "#sliderShowBox", scroll: false, stop: dragStop, cancel: ".panel" });
		} // for
		loadResDivImage(listNew);
		// func. setLayerRes
	}

	function swfListChange(pEvent){
		var val = pEvent.target.value;
		if ( val == 'none'){
			return;
		}
		pEvent.target.value = 'none';

		if ( currentLayerId == null ){
			alert('Выберите/создайте слой')
			return;
		}
		jQuery('#swfParamBox').load('/admin/layer/swf/'+val+'.html', function(){
			pluginSwfMvc.init({isInit:true});
		});
		// func. swfListChange
	}

	function initSwfPlugin(pData){
		addImages(pData, 'swf');
		layerList[currentLayerId].list[currentResId].name = pData.name;
		// func. initSwfPlugin
	}

	function setSwfPluginData(pData){
		var curLayer = layerList[currentLayerId].list;
		curLayer[currentResId].swfData = pData;
		// func. setSwfPluginData
	}

	function saveBtnClick(){
		if ( layerMvc.layerWinCallback == null ){
			return false;
		}
		layerMvc.layerWinCallback(layerList);
		window.close();
		return false;
		// func. saveBtnClick
	}

	function windowKeyPress(pEvent){
		// if key == ESC
		if ( pEvent.keyCode == 27 ){
			window.close();
		}
		// func. windowKeyPress
	}

	function setLayerList(pData){
		layerList = pData;
		for(var i in pData ){
			addLayerLine(i, pData[i].name);
		}
		// func. setLayerList
	}

	function init(){
	
		roomId = document.location.hash.substr(1);

		initFileCodecampusIframe();

		// Инициализация нового фрейма
		initIframeCallback();

		// Кнопка добавить изображение
		jQuery('#resImagBtn').click(resImageBtnClick);
		// Клик по SWF или изображению на рабочем столе
		jQuery('#sliderShowBox').mousedown(sliderShowBoxClick);
		// Кнопка добавить новый слой
		jQuery('#layerAddBtn').click(layerAddBtnClick);
		// Список всех слоёв
		jQuery('#layerList').click(layerListClick);
		// Select для добавления нового SWF на рабочий стол
		jQuery('#swfList').change(swfListChange);

		jQuery('#saveBtn').click(saveBtnClick);

		jQuery(window).keypress(windowKeyPress);
		
		
		// func. init
	}

	return{
		init: init,
		initSwfPlugin: initSwfPlugin,
		setSwfPluginData: setSwfPluginData,
		setLayerList: setLayerList,
		layerWinCallback: null
	}
})();

jQuery(document).ready(function(){
	layerMvc.init();
});

jQuery.fn.serializeObject = function()
{
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name] !== undefined ) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};