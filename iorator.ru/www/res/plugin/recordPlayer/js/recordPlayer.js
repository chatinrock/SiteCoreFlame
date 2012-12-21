var recordPlayerMvc = (function(){

    var playerObj;
    var actionType = 'none';
    var recordInterval;
    var recordTimeCount;
    var recordTimeCurrent;
    var playTimeCurrent;
    var playInterval;
    var $progress;
    var options;
    /**
     * Получен ли доступ к микрофону
     * @type {Boolean} true - в случае если получен, false в ином
     */
    var accessMic = false;
    /**
     * Была ли активность в микрофоне, во время записи
     * @type {Boolean} true - была, false небыло
     */
    var micActivity = false;

    function cbfMicStatus(pMicStatus){
        if ( pMicStatus ){
            recordInterval = setInterval(recordTime, 1000);
            $('#swfObjBox').css({visibility:'hidden'});
            accessMic = true;
        }else{
            //$('#remoteControlBox .status:first').html('Неправильный выбор.<br/>Попробуйте снова');
            //$('#swfObjBox').hide();
            initSWF(Math.random());
        }
        // func. micStatus
    }

    function cbfMicNotFound(){
        alert('Микроф не найден');
        // func. micNotFound
    }

    /**
     * @see http://livedocs.adobe.com/flex/3/html/help.html?content=Working_with_Sound_19.html
     * @see http://help.adobe.com/ru_RU/ActionScript/3.0_ProgrammingAS3/WS5b3ccc516d4fbf351e63e3d118a9b90204-7d0c.html
     * @param event
     */
    function cbfMicActivity(event){
        micActivity = micActivity || event.activating;
        // func. cbfMicActivity
    }

    function cbfNetConnRecordStatus(info){
        // func. cbfNetConnRecordStatus
    }

    function initSWF(cache){
        $('#swfObjBox').html('<div id="playerBox"></div><img src="/res/comp/spl/objItem/eng/img/allowPanel.png">');
        $('#swfObjBox>img:first').mousemove(swfObjBoxImgMouseMove);

        var flashvars = {};

        var params = {
            bgcolor : "#ffffff",
            allowfullscreen : "true",
            menu: "false",
            wmode: "opaque"
        };

        var attributes = {
            id: "playerObjId",
            name: "playerObjId"
        };
        swfobject.embedSWF(
            "/res/plugin/recordPlayer/swf/recordPlayer.swf?cache="+cache,
            "playerBox",
            215,
            138,
            "9.0.124",
            "js/expressInstall.swf",
            flashvars,
            params,
            attributes,
            function(pEvent){
                if ( !pEvent.success ){
                    alert('Ошибка: Не удалось загрузить плееер');
                    return;
                }

            }
        );
        // func. initSWF
    }

    function cbfNetConnRecordSuccess(){
        // func. cbfNetConnRecordSuccess
    }

    function cbfNetConRecordClosed(){
        stopRecord();
        // func. cbfNetConRecordClosed
    }

    function cbfNetStreamPublishStatus(info){
    }


    function playAction(pEvent){
        if ( !micActivity ){
            return;
        }
        if ( actionType == 'none' ||  actionType == 'stop'){
            playerObj.loadAndPlay('/records/'+options.userId+'.flv');
            actionType = 'play';
            setProgress(0);
        }else
        if ( actionType == 'play' ){
            actionType = 'pause';
            playerObj.playerPause();
        }else
        if ( actionType == 'pause' ){
            playerObj.playerResume();
            actionType = 'play';
        }
        // func. playAction
    }

    function recordTime(){
        setProgress(recordTimeCurrent/recordTimeCount);
        if ( recordTimeCurrent == recordTimeCount){
            stopRecord();
            //console.log('End timer');
            $('#remoteControlBox .status:first').html('');
        }
        ++recordTimeCurrent;
        // func. recordTime
    }

    /**
     * Запускает плеер на запись звука и соединение с сервером
     */
    function startRecord(){
        // Указываем что актиновсти нет
        micActivity = false;
        // Активируем кнопку записи
        $('#remoteControlBox .record:first').addClass('on');
        //$('#remoteControlBox .play:first').addClass('off');
        // Указываем статус
        $('#remoteControlBox .status:first').html('Идёт запись');
        // Меняем прогресс бар на режим записи
        $progress.addClass('record');
        // Устанавливаем текущее время записи в 0, т.е. запись только начинается
        recordTimeCurrent = 0;
        // Указываем плееру соеденится
        playerObj.startRecord('rtmp://127.0.0.1/Timer/', options.userId);
        // Если доступа к мирофону нет, т.е. это первая запись, то нужно показать флеш контейнер
        if ( !accessMic ){
            $('#swfObjBox').css({visibility:'visible'})
        }
        // Устанавливаем стутас - запись
        actionType = 'record';
        // func. startRecord
    }

    /**
     * Выключает запись, дисконнект от сервера
     */
    function stopRecord(){
        // Устанавливаем стутас - пусто
        actionType = 'none';
        // Убираем активный статус у кноки
        $('#remoteControlBox .record:first').removeClass('on');
        // Если была активность по микрофону, убивараем блокировку с кнопки
        if ( micActivity ){
            $('#remoteControlBox .play:first').removeClass('off');
        }
        // убераем режим отображения "запись" с прогресс бара
        $progress.removeClass('record');
        // Останавливаем таймер
        clearInterval(recordInterval);
        // Устаналиваем прогресс бар в нулевое положение
        setProgress(0);
        // Дисконнектим плеер от сервера
        playerObj.stopRecord();
        // Убераем статус
        $('#remoteControlBox .status:first').html('');
        // func. stopRecord
    }

    function playerStop(){
        clearInterval(playInterval);
        playerObj.playerStop();
        setProgress(1);
        actionType = 'stop';
        // func. playerStop
    }

    function recordAction(){
        if (actionType == 'play' || actionType == 'pause' || actionType == 'stop'){
            playerStop();
            actionType = 'none';
        }

        if ( actionType == 'none'){
            startRecord();
        }else{
            stopRecord();
        }
        // func. playAction
    }

    function setProgress(value){
        $progress.children('.line:first').width($progress.width() * value);
        // func. setProgress
    }

    function playerSoundVolumeClick(pEvent, $obj){
        var parentOffset = $obj.offset();
        var size = pEvent.pageX - parentOffset.left;
        $obj.children('.line:first').width(size);

        var volume = (size)/$obj.width();
        volume = volume > 1 ? 1 : volume;
        volume = volume < 0 ? 0 : volume;

        playerObj.playVolume(volume);
        // func. playerSoundVolumeClick
    }

    function playerProgressClick(pEvent, $obj){
        if ( actionType != 'play' && actionType != 'stop' ){
            return;
        }
        var parentOffset = $obj.offset();
        var size = pEvent.pageX - parentOffset.left;
        $obj.children('.line:first').width(size);

        var progress = (size)/$obj.width();
        progress = progress > 1 ? 1 : progress;
        progress = progress < 0 ? 0 : progress;

        playTimeCurrent = progress * recordTimeCurrent;
        playerObj.playSeek(progress * recordTimeCurrent);
        //console.log(progress);
        // func. playerProgressClick
    }

    function sendRecord(){
        if ( !micActivity ){
            $('#remoteControlBox .status:first').html('Сначала сделайте запись');
            return;
        }
        var url = '/webcore/func/utils/ajax/?name=sendRecord';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                time: recordTimeCurrent,
                userId: options.userId,
                text: $('#remoteControlBox textarea[name="comment"]').val()
            }
        }).done(function( pData ) {
             var text = 'Данные успешно отправлены';
             if ( pData && pData['error'] ){
                 text = pData['msg'];
             }
             $('#remoteControlBox').html(text);
        });
        // func. sendRecord
    }

    function remoteControlBoxClick(pEvent){
        var $obj = $(pEvent.target);
        var rel = $obj.attr('rel');
        if ( !rel ){
            var $obj = $(pEvent.target).parents('*[rel]:first');
            rel = $obj.attr('rel');
            if ( !rel){
                return;
            }
        }

        switch( rel ){
            case 'record':
                recordAction();
                break;
            case 'play':
                playAction(pEvent);
                break;
            case 'sound':
                playerSoundVolumeClick(pEvent, $obj);
                break;
            case 'progress':
                playerProgressClick(pEvent, $obj);
                break;
            case 'send':
                sendRecord();
                break;
        }
        // func. remoteControlBoxClick
    }

    function swfObjBoxImgMouseMove(pEvent){
        var parentOffset = $(this).offset();
        var relX = pEvent.pageX - parentOffset.left;
        var relY = pEvent.pageY - parentOffset.top;
        if ( relX >= 51 && relY >= 111 && relX <= 130  && relY <= 130 ){
            $(this).hide();
        }
        // func. swfObjBoxImgMouseMove
    }


    function cbfInit(){
        console.log('Flash player init');
        playerObj = document.getElementById( 'playerObjId' );

        // func. cbfInit
    }


    function playTime(){
        if ( actionType != 'play' ){
            return;
        }
        playTimeCurrent++;
        var proc = playTimeCurrent / recordTimeCurrent;
        if ( proc > 1){
            proc = 1;
        }
        setProgress(proc);
        // func. playTime
    }

    function cbfPlayMvcNetStatus(code){
        switch (code) {
            case "NetStream.Play.Start":
                playTimeCurrent = 0;
                playInterval = setInterval(playTime, 1000);
                break;
            case "NetStream.Play.Stop":
                playerStop();
                break;
            case "NetStream.Play.StreamNotFound":
                alert('StreamNotFound');
                break;
        }
        // func. cbfPlayMvcNetStatus
    }

    function cbfPlayMvcAsyncError(event){
     // func. cbfPlayMvcAsyncError
     }

     function cbfPlayMvcIOError(event){
     // func. cbfPlayMvcIOError
     }

    function init(pOptions){
        options = pOptions;
        // Панель управления кнопками
        $('#remoteControlBox').click(remoteControlBoxClick);
        // Время записи звука
        recordTimeCount = 7 * 60;
        // Объект прогресс бара для позиции проигрывания
        $progress = $('#remoteControlBox div.progress:first');
        // Инициализация флеша
        initSWF(1);
    }



    return{
        cbfMicStatus: cbfMicStatus,
        cbfMicNotFound: cbfMicNotFound,
        cbfNetConnRecordStatus: cbfNetConnRecordStatus,
        cbfNetConnRecordSuccess: cbfNetConnRecordSuccess,
        cbfNetStreamPublishStatus: cbfNetStreamPublishStatus,
        cbfNetConRecordClosed: cbfNetConRecordClosed,
        init: init,
        cbfInit: cbfInit,
        cbfMicActivity: cbfMicActivity,
        cbfPlayMvcAsyncError: cbfPlayMvcAsyncError,
        cbfPlayMvcIOError: cbfPlayMvcIOError,
        cbfPlayMvcNetStatus: cbfPlayMvcNetStatus
    }
})();