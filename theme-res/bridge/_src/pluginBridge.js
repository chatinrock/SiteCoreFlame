var pluginBridge = (function(){

	var callerHost;
	var win;
 
	function showWindow(data){
		var params = "width=980,height=830,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no"
		win = window.open(data.url, "Explorer", params);
		win.onload=function(){
			win.explorerMvc.initData(data);
			win.explorerMvc.onCallback = function(pData){
				parent.postMessage(pData, 'http://'+callerHost+'/');
			}
		}
		// func. showWindow
	}

	function onMessage(pEvent){
		var data = pEvent.data;
		switch( data.action ){
			case 'show':
				showWindow(data);
				break;
		}
		// func. onMessage
	}

	function getQueryVariable(variable) {
		var query = window.location.search.substring(1);
		var vars = query.split('&');
		for (var i = 0; i < vars.length; i++) {
			var pair = vars[i].split('=');
			if (decodeURIComponent(pair[0]) == variable) {
				return decodeURIComponent(pair[1]);
			}
		}
		//console.log('Query variable %s not found', variable);
		return null;
	}

	function initListen(){
		var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		var eventer = window[eventMethod];
		var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
		// Listen to message from child window
		eventer(messageEvent,onMessage, false);
		// func. initListen
	}

	function init(){
		initListen();

		callerHost = getQueryVariable('host');
		document.cookie = 'PHPSESSID=' + getQueryVariable('PHPSESSID') + ';expires=Thu, 01 Jan 2030 00:00:00 GMT; path=/';
		// func. init
	}

	return{
		init: init
	}
})().init();