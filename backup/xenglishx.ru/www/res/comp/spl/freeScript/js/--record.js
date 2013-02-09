var recordMvc = (function(){
	function recordBtnClick(){

		jQuery.lightbox('#remoteControlBoxTmp',{
			width: 400,
			height: 320,
			'modal': true,
			onOpen:function(){
				jQuery(this).parent().find('div[id="remoteControlBoxTmp"]:first')
						.attr('id','remoteControlBox')
						.append('<div id="swfObjBox"></div>');
				recordPlayerMvc.init({
					userId: jQuery.cookie('userId'),
					serverUrl: 'rtmp://xenglishx.ru/Timer/'
				});

			}
		});
		return false;
		// func. recordBtnClick
	}

	function init(pOptions){
		jQuery('#recordBtn').click(recordBtnClick);
		//recordPlayerMvc.initSWF(1);
		//console.log(swfobject.getFlashPlayerVersion());
		// func. init
	}

	return{
		init: init
	}
})();

recordMvc.init({});