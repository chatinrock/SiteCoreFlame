/**
	Упрощённая версия плеера для VIP комментариев
*/
var playerAudioMvc = (function(){
	// Длина трека
	var soundLength = 0;
	// Текущий позиция звучания
	var timeInterval;

	function cbfId3Handler(pEvent, id3){
		if ( pEvent.target.length > soundLength ){
			soundLength = pEvent.target.length;
			jQuery.swfPlayerApi.setDuration(soundLength);
		}
		// func. cbfId3Handler
	}
	
	function cbfErrorHandler(pEvent){
		// func. cbfErrorHandler
	}
	
	function cbfSoundFinishPlay(pEvent){
		jQuery.swfPlayerApi.soundComplete(0);
		engMvc.removeHighlight();
		clearInterval(timeInterval);
		// func. cbfSoundFinishPlay
	}
	
	function cbfProgressHandler(pEvent, loadTime, LoadPercent){
		jQuery.swfPlayerApi.setLoading(pEvent);
		// func. cbfProgressHandler
	}
	
	function cbfOpenHandler(pEvent){
		// func. cbfOpenHandler
	}
	
	function cbfSoundLoaded(pEvent, lenght){
		// func. cbfSoundLoaded
	}
	
	var options = {};
	var playerObj;

	function load(url){
		playerObj.loadSound(url);
		// func. load
	}
	
	function setPosition(posMilis, changeProgress){
		playerObj.setPosition(posMilis);
		clearInterval(timeInterval);
		timeInterval = setInterval(intervalAction, 1000);
		if ( changeProgress ){
			jQuery.swfPlayerApi.setSliderPosition(posMilis/1000);
		}
	}
	
	function intervalAction(){
		var posSec = playerObj.getPosition() / 1000;
		jQuery.swfPlayerApi.setSliderPosition(posSec);
		// intervalAction
	}
	
	function play(){
        intervalAction();
		timeInterval = setInterval(intervalAction, 900);
		playerObj.playSound();
	}
	
	function stop(){
		clearInterval(timeInterval);
		playerObj.stopSound();
	}
	
	function setVolume(volume){
		playerObj.setVolume(volume)
	}
	
	function cbfInit(pVersion){
		//console.log(pVersion);
		// func. cbfInit
	}

	function init(pOptions){
		options = pOptions;
		playerObj = document.getElementById( pOptions.playerObjId );
		// func. init
	}
	 
	function toggle(){
		jQuery.swfPlayerApi.toogle();
		// func. toggle
	}
	
	function initSwfPlayerApi(){
		jQuery('#playerBox').swfPlayerApi({
			onPlay: play,
			onPause: stop,
			onSetPosition: setPosition,
			onVolume: setVolume
		});
		// func. initSwfPlayerApi
	}
	
	return {
		cbfId3Handler: cbfId3Handler,
		cbfErrorHandler: cbfErrorHandler,
		cbfSoundFinishPlay: cbfSoundFinishPlay,
		cbfProgressHandler: cbfProgressHandler,
		cbfOpenHandler: cbfOpenHandler,
		cbfSoundLoaded: cbfSoundLoaded,
		cbfInit: cbfInit,
		
		initSwfPlayerApi: initSwfPlayerApi,
		
		setPosition: setPosition,
		
		toggle: toggle,

		play: play,
		load: load,
		init: init
	}
})();

function flashSoundPlayerLoad(pEvent){
	if ( !pEvent.success ){
		alert('Ошибка: Не удалось загрузить плееер');
		return;
	}

	playerAudioMvc.initSwfPlayerApi();
	playerMvc.init({playerObjId:'playerObjId'});
	// func. flashSoundPlayerLoad
}

playerMvc = playerAudioMvc;
playerMvc.cbfInit = function(pVersion){
	playerMvc.load(vipVoiceUrl);
	//playerMvc.play();
};


swfobject.embedSWF("/res/plugin/swfPlayerApi/player.swf",
	"flashBox", 100, 20, "9.0.124", null,  {},
	{ menu: "false", wmode: "opaque", allowScriptAccess: 'always'},
	{id: "playerObjId", name: "playerObjId"}, flashSoundPlayerLoad
);