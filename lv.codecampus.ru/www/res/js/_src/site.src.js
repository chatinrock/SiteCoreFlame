var lvBoxMvc = (function(){
	function init(roomId, param){
		var load = [];
		if ( !window.jQuery ){
			load.push('http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
		}
		if ( !window.swfobject){
			load.push('http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js');
		}
		load.push('http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js');
		load.push('http://lv.codecampus.ru/res/js/app.min.js');
		load.push('http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css');
		load.push('http://lv.codecampus.ru/res/css/site.min.css');
		//load.push('ie6!http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css');

		yepnope([{
			load: load,
			complete: function(){
				jQuery(document).ready(function(){
					jQuery('#lvBox').html('<div id="lv-parent" style="width:'+param.width+'px"><div id="lv-child"><div id="flashContent"></div><iframe src="" id="commentBox"></iframe></div></div>')
					adminMvc.init(roomId);
				});
			}
		}])

		// func. init
	}

	return{
		init: init
	}
})();