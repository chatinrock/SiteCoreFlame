var themeBridgeApi = (function(){
	var pluginThemeIframeObj;
	var fnCallback; 

	function initFileCodecampusIframe(){
		pluginThemeIframeObj = document.createElement("IFRAME");
		pluginThemeIframeObj.setAttribute("src", "http://theme.codecampus.ru/bridge/?host="+document.location.host);
		pluginThemeIframeObj.style.width = 1+"px";
		pluginThemeIframeObj.style.height = 1+"px";
		pluginThemeIframeObj.style.visibility = 'hidden';
		document.body.appendChild(pluginThemeIframeObj);
		// func. initFileCodecampusIframe
	}
	
	function setCallback(pfnCallback){
		fnCallback = pfnCallback;
		// func. setCallback
	}
	
	function showWindow(pData){
		if ( pluginThemeIframeObj == null ){
			return;
		}
		pluginThemeIframeObj.contentWindow.postMessage(pData, "http://theme.codecampus.ru/bridge/");
		return false;
		// func. showWindow
	}

	function initIframeCallback(){
		// Create IE + others compatible event handler
		var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
		var eventer = window[eventMethod];
		var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
		// Listen to message from child window
		eventer(messageEvent,function(pEvent){
			if ( pEvent.origin != "http://theme.codecampus.ru" ){
				return;
			}
			fnCallback.apply(null, arguments);
		}, false);
		// func. initIframeCallback
	}

	function init(){
		initFileCodecampusIframe();
		initIframeCallback();
		// func. init
	}
	return{
		init: init,
		showWindow: showWindow,
		setCallback : setCallback 
	}
})();
jQuery(document).ready(function(){
	themeBridgeApi.init();
});