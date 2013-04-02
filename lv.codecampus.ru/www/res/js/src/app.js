var adminMvc = (function(){
	var playerObjId;

	var lightboxSafeClose = false;


	function onSwfSlideFullSizeOpen(pUrl){
		jQuery.lightbox(pUrl, {
			'onClose' : function() {
				if ( lightboxSafeClose ){
					lightboxSafeClose = false;
					return;
				}
				playerObjId.onFullsizeClose();
			},
			'onOpen':function(){
				if ( jQuery('#pointer').length == 0 ){
					jQuery('div.jquery-lightbox-background:first').append('<img id="pointer" src="http://lv.codecampus.ru/res/img/cursor.png"/>');
				}
			}
		});
		// func. onSwfSlideFullSizeOpen
	}

	function onSwfSlideFullSizeClose(){
		lightboxSafeClose = true;
		jQuery.LightBoxObject.close();
		// func. onSwfSlideFullSizeClose
	}

	function onSwfLoad(){
		playerObjId = document.getElementById('playerObjId');
		// func. onSwfLoad
	}

	function onSwfPointerPos(pPos){

		var $imgBox = jQuery('div.jquery-lightbox-background:first');

		var width = $imgBox.width();
		var height =  $imgBox.height();

		var hdRatio = 640/360;
		var offY = 0, offX = 0;
		var ratio = width / height;
		if ( ratio > hdRatio ){
			offY = ( width / hdRatio - height ) / 2;
			height = width / hdRatio;
		}else if( ratio < hdRatio ){
			offX = ( height * hdRatio  - width ) / 2;
			width = height * hdRatio;
		}

		var x = pPos.x / ( pPos.w / width ) - offX;
		var y = pPos.y / ( pPos.h / height ) - offY;

		x -= 8;
		y -= 8;

		if ( x < 0 || y < 0 || ( y > height - offY * 2) || (x > width - offX * 2) ){
			jQuery('#pointer').hide();
			return;
		}

		jQuery('#pointer').show().css({left:x, top:y});
		// func. onSwfPointerPos
	}

	function init(pRoomId){
		var roomId = pRoomId || window.location.search.match(/hash=(\w+)$/);
		if ( roomId == null || roomId.length==1){
			jQuery("#tabbed-nav").hide();
			jQuery('#flashContent').html('<img src="http://lv.codecampus.ru/res/img/404error.jpg" alt="404 error"/>');
			return false;
		}
		roomId = pRoomId || roomId[1];

		var flashvars = {
			roomId: roomId
		};
		var params = { menu: "false", wmode: "opaque", allowScriptAccess: 'always'};
		var attributes = {id: "playerObjId", name: "playerObjId"};

		swfobject.embedSWF("http://lv.codecampus.ru/res/swf/RtmpPlayer.swf?d=35", "flashContent", "640", "360", "9.0.0","expressInstall.swf", flashvars, params, attributes, onSwfLoad);

		jQuery('#commentBox').attr('src', 'http://lv.codecampus.ru/comment/?room='+roomId+'#'+roomId);
		// func. init
	}

	return {
		init: init,
		slideFullSizeClose: onSwfSlideFullSizeClose,
		slideFullSizeOpen: onSwfSlideFullSizeOpen,
		pointerPos: onSwfPointerPos
	}
})();

