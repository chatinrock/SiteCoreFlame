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
		engMvc.findHighLightPart(posMilis/1000);
		clearInterval(timeInterval);
		timeInterval = setInterval(intervalAction, 1000);
		if ( changeProgress ){
			jQuery.swfPlayerApi.setSliderPosition(posMilis/1000);
		}
	}
	
	function intervalAction(){
		var posSec = playerObj.getPosition() / 1000;
		
		jQuery.swfPlayerApi.setSliderPosition(posSec);
		engMvc.highlightPart(posSec);
		// intervalAction
	}
	
	function play(){
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
		console.log(pVersion);
		// func. cbfInit
	}

	function init(pOptions){
		options = pOptions;
		playerObj = document.getElementById( pOptions.playerObjId );
		// func. init
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

		play: play,
		load: load,
		init: init
	}
})();
/** ============================================================================================ **/
/** @see https://developers.google.com/youtube/js_api_reference */
var playerVideoMvc = (function(){
	var ytplayer;
	
	var playInterval;
	var playerTime;
	
	function intervalAction(){
		var time = ytplayer.getCurrentTime() - 0.5;
		if ( playerTime == time ){
			return;
		}
		playerTime = time;
		var $obj = engMvc.highlightPart(time);
		scrollGoto($obj);

		//console.log('inteval: ' + time);
		// func. intervalAction
	}
	
	function scrollGoto($obj){
		if ( $obj != null ){
			var htmlDataBoxTop = jQuery('#htmlDataBox').offset().top;
			var scrollOffset = ($obj.offset().top - htmlDataBoxTop);
			
			scrollOffset -= getMaskHeight() / 2  - $obj.outerHeight();
			
			//jQuery('#sourceBox').scrollbar.goto({v:scrollOffset});	
			//console.log(scrollOffset);			
			jQuery('#sourceBox').scrollTo( {top:scrollOffset+ 'px', left: '0px'}, 300);
		}
		// func. scrollGoto
	}
	
	function onStateChange(newState){
		//console.log(newState);
		
		/*-1 (unstarted)
		0 (ended)
		1 (playing)
		2 (paused)
		3 (buffering)
		5 (video cued)*/
		switch(newState){
			case 0: 
				console.log('end movie');
				// break специально не стоит
			case 5:
				console.log('stop download');
				engMvc.removeHighlight();
				stop();
				break;
			case 2:
				// Получаем текущее время видео
				var posSec = ytplayer.getCurrentTime() - 0.5;
				// Выделяем предложение
				var $obj = engMvc.findHighLightPart(posSec);
				// Проматываем до выделенного предложения
				scrollGoto($obj);
				// Останавливаем видео
				stop();
				console.log('stop: ');
				break;
			case 1:
				playInterval = setInterval(intervalAction, 800);
				console.log('play');
				break;
			
		}
		
	}
	
	function stop(){
		if ( playInterval == null){
			return;
		}
		clearInterval(playInterval);
		// func. stop
	}
	
	function setPosition(posMilis){
		var posSec = posMilis/1000
		ytplayer.seekTo(posSec);
		//
	}
	
	function getMaskHeight(){
		return 300;
	}
	
	function init(){
		ytplayer = document.getElementById("playerObjId");
		ytplayer.addEventListener("onStateChange", 'playerVideoMvc.onStateChange');
		// func. init
	}

	return {
		onStateChange: onStateChange,
		getMaskHeight: getMaskHeight,
		setPosition: setPosition,
		
		init: init
	}
})();

function onYouTubePlayerReady(playerId) {
	playerVideoMvc.init();
	// func. onYouTubePlayerReady
}

/** ============================================================================================ **/

var engMvc = (function(){
        var options = {};
        /**
         * Номер cлова, на которое наведена мышка, для сущ. правил
         * @type {Number}
         */
        var wordRelMouseOn = null;

        var wordRelSelect = null;

        var wordOsnList = [];
        var wordSecondList = [];

        var mousePos = {x:0, y:0};
        //var mouseHintPos = {x:0, y:0};
        var wordObjMouseOn = null;

        var paryMouseOn = 0;
        var sentMouseOn = null;

        var lastHighlightPartNum = 0;

        var isHintShow = false;
		
		var playerMvc = null;
		
		var lastSentTr = null, lastPartBox = null;
		var partBtnBoxLastPos = {top: 0, left: 0};

        /**
         * Очистка выделенных слов
         */
        function clearSelected(){
            jQuery(options.htmlDataBox+' span.selected').removeClass('selected');
            // func. clearSelected
        }
		
		

        function showPartBox(pObjDom){
		
			if ( lastPartBox == pObjDom ){
				return;
			}
			lastPartBox = pObjDom;
		
            var $trPart = jQuery(pObjDom).parents('tr.part:first');
            if ( $trPart.length == 0){
                if ( !jQuery(pObjDom).hasClass('part')){
                    return;
                }
                $trPart = jQuery(pObjDom);
            } // if

            var $partBtnBox = jQuery(options.partBtnBox);
	

			var topOffset = $trPart.position().top + ($trPart.height() - $partBtnBox.height() ) / 2;
			if ( partBtnBoxLastPos.top != topOffset ){
				jQuery(options.partBtnBox).css({top: topOffset+'px'}).show();
				partBtnBoxLastPos.top = topOffset;
				//console.log(topOffset, pObjDom);
			}
			//var leftOffset = $trPart.position().left;// - $trPart.width() - 4;
			
			
			/*, left: leftOffset + 'px'*/
			
			

            /*var marginLeft = parseInt(jQuery('#htmlDataBox').css('margin-left').replace('px', ''));
            var x = $htmlDataBox.position().left + marginLeft - $partBtnBox.outerWidth() + 20;
            var y = $trPart.position().top;
            jQuery(options.partBtnBox).css({left: 10+'px', top: y+'px'}).show();*/

            paryMouseOn = $trPart.attr('id').substr(6);
            // func. showPartBox
        }

        function wordMouseOut(pEvent){
            jQuery(pEvent.target).unbind('mouseout');
            removeWordClassRule(wordRelMouseOn);
            wordRelMouseOn = null;
            wordObjMouseOn = null;
            // func. wordMouseOut
        }

        function removeWordClassRule(pRel){
            jQuery(options.htmlDataBox+' span[rel="'+pRel+'"]').removeClass('osn');

            for( var i in wordOsnList ){
                jQuery(options.htmlDataBox+' span[rel="'+wordOsnList[i]+'"]').removeClass('osn');
            }

            for( var i in wordSecondList ){
                jQuery(options.htmlDataBox+' span[rel="'+wordSecondList[i]+'"]').removeClass('sec');
            }
            // func. removeWordClassRule
        }

        function addWordClassRule(pRel){
            jQuery(options.htmlDataBox+' span[rel="'+pRel+'"]').addClass('osn');

            var list = engWord.osnWord[pRel].link;
            wordOsnList = list;
            for( var i in list ){
                jQuery(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('osn');
            }
            var list = engWord.osnWord[pRel].sec;
            wordSecondList = list;
            for( var i in list ){
                jQuery(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('sec');
            }
            // func. addWordClassRule
        }
		
		

        function showSentBox(pObjDom){
			if ( lastSentTr == pObjDom ){
				return;
			}
			lastSentTr = pObjDom;
			
			
            var $sentObj = jQuery(pObjDom).parents('span.sentence:first');
			console.log($sentObj.length);
            if ( $sentObj.length == 0){
                if ( !jQuery(pObjDom).hasClass('sentence')){
                    return;
                }
                $sentObj = jQuery(pObjDom);
            } // if

            var sentId = $sentObj.attr('id').substr(4);
            var pos = $sentObj.position();
            var  $sentBtnBox = jQuery(options.sentBtnBox);
            var x = pos.left + $sentObj.outerWidth() - $sentBtnBox.outerWidth();
            var y = pos.top;
            $sentBtnBox.css({left: x+'px', top: y + 'px'}).show();
			
			$sentBtnBox.find('img[rel="rule"]:first').attr('title', $sentObj.attr('stitle'));
			
			if ( !engSent[sentId] ){
				$sentBtnBox.find('img[rel="viprule"]').hide();
			}else{
				$sentBtnBox.find('img[rel="viprule"]').show();
			}

            /*if ( sentMouseOn == sentId ){
                //$sentBtnBox.css({left: x+'px'})
                return;
            }*/

            sentMouseOn = sentId;

            // func. showSentBox
        }

        /**
         * Обработка наведения мыши на слово
         * @param pEvent
         */
        function htmlDataBoxMouseMove(pEvent){
            mousePos.x = pEvent.pageX;
            mousePos.y = pEvent.pageY;

			showSentBox(pEvent.target);
            //showPartBox(pEvent.target);
            

            if ( jQuery(pEvent.target).hasClass('word') ){
                wordObjMouseOn = pEvent.target;
                // Получаем ID слова
                var rel = jQuery(pEvent.target).attr('rel');
                // есть ли определине слова в словаре
                if ( !engWord.osnWord[rel]){
                    // Если нету в словаре может это быть ссылка на другой ID слова
                    if ( !engWord.linkWord[rel]){
                        return;
                    }
                    rel = engWord.linkWord[rel];
                } // if

                if (wordRelMouseOn == rel ){
                    return;
                }

                wordRelMouseOn = rel;

                jQuery(pEvent.target).mouseout(wordMouseOut);
                addWordClassRule(rel);

                // engartData.wordList
            }
            // func. htmlDataBoxMouseMove
        }



        function htmlDataBoxClick(pEvent){
            if ( isHintShow && wordRelSelect == wordRelMouseOn ){
                isHintShow = false;
                jQuery(options.hintBox).hide();
                return;
            }
            wordRelSelect = wordRelMouseOn;
            hintShow();
            // func. htmlDataBoxClick
        }

        function hintShow(){
            if (!engWord.osnWord[wordRelMouseOn]){
                return;
            }
			
			
			if ( engWord.osnWord[wordRelMouseOn].vipId){
				jQuery('#hintBox img[rel="viprule"]').show();
			}else{
				jQuery('#hintBox img[rel="viprule"]').hide();
			}

            var $hintBox = jQuery(options.hintBox).show();

            var text = '<span class="translt">'+engWord.osnWord[wordRelMouseOn].translt+'</span>';
            text += '<span class="transkr"> ['+engWord.osnWord[wordRelMouseOn].transkr +']</span>'
            $hintBox.find('span:first').html(text);

            var $trParty = jQuery(wordObjMouseOn).parents('tr.part:first');

            var y = $trParty.position().top - $hintBox.outerHeight();
            y = y <= 10 ? 10 : y;

            var x = mousePos.x - $trParty.offset().left - $hintBox.width() / 2;
            x = x <= 10 ? 10 : x;
			//console.log(mousePos.x - $trParty.offset().left);
            $hintBox.css({left:x+'px', top: y+'px'});

            isHintShow = true;
            //console.log('showHint');

            // func. hintInverval
        }

        function hintBoxButtonClick(pButtonRel){
            switch(pButtonRel){
                case 'rule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=word&path='+paramOptions.path + '&id='+wordRelSelect;
                    url += '&lightbox[width]=600&lightbox[height]=400'
                    break;
                case 'viprule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=vip&objid='+paramOptions.objId+'&obj=word&id='+wordRelSelect+'&path='+paramOptions.path;
                    url += '&lightbox[width]=800&lightbox[height]=600'
                    break;
            }
            jQuery.lightbox(url);
            // func. hintBoxButtonClick
        }

        function hintBoxClick(pEvent){
            var rel = jQuery(pEvent.target).attr('rel');
            if ( rel){
                hintBoxButtonClick(rel);
            }

            var $hintBox = jQuery(pEvent.target).parents('div[id="hintBox"]:first');
            if ( $hintBox.length == 0 ){
                if ( !jQuery(pEvent.target).attr('id') == 'hintBox' ){
                    return;
                }
                $hintBox = jQuery(pEvent.target);
            }
            $hintBox.hide();
            isHintShow = false;
            // func. hintBoxClick
        }

        function partBtnBoxClick(pEvent){
            var rel = jQuery(pEvent.target).attr('rel');
            switch( rel ){
                case 'play':
                    playerMvc.setPosition(parseInt(paryMouseOn) * 1000, true);
                    highlightPart(paryMouseOn);
                    break;
            }
            // func. partBtnBoxClick
        }

        function highlightPart(pTime){
			var time = Math.round(pTime);
            var $part = jQuery('#second' + time);
            if ( $part.length == 0 ){
                return null;
            }
            jQuery('#second' + lastHighlightPartNum).removeClass('highlight');
			var $obj = jQuery('#second' + time);
            $obj.addClass('highlight');
            lastHighlightPartNum = time;
			return $obj;
            // func. highlightPart
        }

        function removeHighlight(){
            jQuery('#second' + lastHighlightPartNum).removeClass('highlight');
            // func. cbPlayComplete
        }

        function findHighLightPart(pTime){

            var time = Math.round(pTime);
            for( var i = time; i >= 0; i-- ){
                var $part = jQuery('#second' + i);
                if ( $part.length == 0 ){
                    continue;
                }
                highlightPart(i);
                return $part;
            }
			return null;
            // func. findHighLightPart
        }

        function sentBtnBoxClick(pEvent){
            var rel = jQuery(pEvent.target).attr('rel');
            switch( rel ){
                case 'rule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=sent&path='+paramOptions.path + '&id='+sentMouseOn
                    url += '&lightbox[width]=600&lightbox[height]=400'
                    break;
                case 'viprule':
                    if ( !engSent[sentMouseOn] ){
                        break;
                    }
                    var url = '/webcore/func/utils/ajax/?name=eng&type=vip&objid='+paramOptions.objId+'&id='+sentMouseOn+'&obj=sent&path='+paramOptions.path;;
                    url += '&lightbox[width]=800&lightbox[height]=600'
                    break;
            }
            jQuery.lightbox(url);
            // func. sentBtnBoxClick
        }
		
		function flashSoundPlayerLoad(pEvent){
			if ( !pEvent.success ){
				alert('Ошибка: Не удалось загрузить плееер');
				return;
			}
			
			playerMvc.init({playerObjId:'playerObjId'});
			// func. flashSoundPlayerLoad			
		}
		
		function initSound(){
			playerMvc = playerAudioMvc;
			playerMvc.cbfInit = function(pVersion){
				playerMvc.load(paramOptions.resUrl);
				//playerMvc.play();
			};
			
			yepnope({
				test: window.swfobject,
				nope: pluginResConf.swfobject,
				complete:function(){
					swfobject.embedSWF("/res/plugin/swfPlayerApi/player.swf",
						"flashBox", 100, 20, "9.0.124", null,  {},
						{ menu: "false", wmode: "opaque", allowScriptAccess: 'always'},
						{id: "playerObjId", name: "playerObjId"}, flashSoundPlayerLoad
					);
				} // func. complete
			});
			
			yepnope({
				load:'http://theme.codecampus.ru/plugin/swfPlayerApi/main.js',
				complete: playerMvc.initSwfPlayerApi
			});

			// func. initSound
		}

		function initVideo(){
			
			playerMvc = playerVideoMvc;
			yepnope({
				load: pluginResConf.scrollTo
			});

			jQuery('#sourceBox').scroll(function(){
				jQuery('#hintBox').hide();
				isHintShow = false;
			});

			
			/*yepnope({
				load: [
					pluginResConf.mousewheel, pluginResConf.jQueryResizePlugin, pluginResConf.easyScrollJs, pluginResConf.easyScrollCss
				],
				complete: function(){
					jQuery("#sourceBox").scrollbar({	
									type: "scrollbar",			// ->scrollbar || mousePosition || dragAndDrop
															//+++++++++++++MAIN PROPERTIES++++++++++++++//
									height:playerMvc.getMaskHeight(), 				// Height of the content's mask block
									width: 640,				// Width fixed number or auto of the content
									scrollerEase:7, 			// Scroll ease
									dragVertical:true,			// Drag Verticaly or not
									dragHorizontal:false,		// Drag Horizontaly or not
															//++++++++SCROLL BAR TYPE PROPERTIES++++++++//
									barWidth:10, 				// Width of the scroller bars
									draggerVerticalSize:"auto",	// Height of the dragger, can be fixed or auto
									draggerHorizontalSize:"auto",
									roundCorners:5,			// Bars round corners amplitude
									distanceFromBar: 5,			// Distance between the bars and the content
									mouseWheel: true,			// Wheter to use or not mouse wheel detection
									mouseWheelOrientation: "vertical",	// Wheter to use or not mouse wheel detection
									mouseWheelSpeed: 13,		// Mouse wheel scroll speed
									draggerColor: "#111111",		// Dragger color
									draggerOverColor: "#a1dc13",	// Dragger color on over
									barColor: "#E6E6E6",		// Back bar color
									barOverColor: "#CCCCCC"		// Back bar color on over
								});
								
				} // func. complete
			});*/
			
			yepnope({
				test: window.swfobject,
				nope: pluginResConf.swfobject,
				complete:function(){
					swfobject.embedSWF("http://www.youtube.com/v/qINwCRM8acM?enablejsapi=1&playerapiid=ytplayer",
						"playerBox", "640", "333", "8", null, null, { allowScriptAccess: "always" }, 
						{ id: "playerObjId",  name: "playerObjId" });
				} // func. complete
			});
			// func. initVideo
		}

        function init(pOptions){
            options = pOptions;
            // движение мышкой и клик по словам
            jQuery(options.htmlDataBox).mousemove(htmlDataBoxMouseMove).click(htmlDataBoxClick);
            jQuery(options.hintBox).click(hintBoxClick);
            jQuery(options.partBtnBox).click(partBtnBoxClick);
            jQuery(options.sentBtnBox).click(sentBtnBoxClick);
			
			jQuery('#sourceBox').addClass(paramOptions.type);
			jQuery('#playerObjId').addClass(paramOptions.type);

			if ( paramOptions.type == 'sound'){
				initSound();
			}else{
				initVideo();
			} // if ( paramOptions.type == 'sound ')
            // func. init
        }

        return {
            init: init,
			highlightPart: highlightPart,
			findHighLightPart: findHighLightPart,
			removeHighlight: removeHighlight
        }
    })(); // engMvc