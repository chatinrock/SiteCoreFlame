var singlePlayerMvc = (function(){
	var options = {};
	var playerObj;

    function empty(){
        //console.log('empty');
    }

	function soundSeek(pTimeSec){
		playerObj.soundSeek(pTimeSec);
		// func. soundSeek
	}
	
	function setSoundUrl(url){
		playerObj.setSoundUrl(url);
		// func. setSoundUrl
	}

	function init(pOptions){
		options = pOptions;
		playerObj = document.getElementById( pOptions.playerObjId );
		// func. init
	}
	
	return {
        // Вызываеся из плеера, по таймеру, когда проигрывается файл
		cbSetTime: empty,
        // Вызов В плеер, установка позиции, с которой нужно проигрывать файл (перемотка)
		soundSeek: soundSeek,
        // Вызываеся из плеера, когда пользователь перемотал файл, с помощью прогресс-бара
        cbSoundSeekPlayer: empty,
        // Вызываеся из плеера, когда плеер готов к работе
        cbInitPlayer:empty,
        // Вызываемся из плеера, когда файл польностью проигрался
        cbPlayComplete: empty,
        setSoundUrl: setSoundUrl,
		init: init
	}
})();