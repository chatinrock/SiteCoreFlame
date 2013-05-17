var mvcFileApi = (function(){
	var fileCodeCampusIframeObj;
	var fnCallback;

	function initFileCodecampusIframe(){
		fileCodeCampusIframeObj = document.createElement("IFRAME");
		fileCodeCampusIframeObj.setAttribute("src", "http://files.codecampus.ru/bridge/?host="+document.location.host+'&PHPSESSID=' + jQuery.cookie('PHPSESSID'));
		fileCodeCampusIframeObj.style.width = 1+"px";
		fileCodeCampusIframeObj.style.height = 1+"px";
		fileCodeCampusIframeObj.style.visibility = 'hidden';
		document.body.appendChild(fileCodeCampusIframeObj);
		// func. initFileCodecampusIframe
	}
	
	function setCallback(pfnCallback){
		fnCallback = pfnCallback;
		// func. setCallback
	}
	
	function showWindow(group, subgroup, profile, pData, pParam){
		if ( fileCodeCampusIframeObj == null ){
			return;
		}
		fileCodeCampusIframeObj.contentWindow.postMessage({
			action:'show',
			group: group,
			subgroup: subgroup,
			profile: profile,
			list: pData,
            param: pParam
		}, "http://files.codecampus.ru/");
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
			if ( pEvent.origin != 'http://files.codecampus.ru' ){
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
	mvcFileApi.init();
});