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

        /**
         * Очистка выделенных слов
         */
        function clearSelected(){
            jQuery(options.htmlDataBox+' span.selected').removeClass('selected');
            // func. clearSelected
        }

        function showPartBox(pObjDom){
            var $trPart = jQuery(pObjDom).parents('tr.part:first');
            if ( $trPart.length == 0){
                if ( !jQuery(pObjDom).hasClass('part')){
                    return;
                }
                $trPart = jQuery(pObjDom);
            } // if

            var $partBtnBox = jQuery(options.partBtnBox);

            $htmlDataBox = jQuery(options.htmlDataBox);

            var marginLeft = parseInt(jQuery('#htmlDataBox').css('margin-left').replace('px', ''));
            var x = $htmlDataBox.position().left + marginLeft - $partBtnBox.outerWidth() + 20;
            var y = $trPart.position().top;
            jQuery(options.partBtnBox).css({left: 10+'px', top: y+'px'}).show();

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

            var $sentObj = jQuery(pObjDom).parents('span.sentence:first');
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

            showPartBox(pEvent.target);
            showSentBox(pEvent.target);

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
                    singlePlayerMvc.soundSeek(parseInt(paryMouseOn));
                    highlightPart(paryMouseOn);
                    break;
            }
            // func. partBtnBoxClick
        }

        function highlightPart(pTime){
            var $part = jQuery('#second' + pTime);
            if ( $part.length == 0 ){
                return;
            }
            jQuery('#second' + lastHighlightPartNum).removeClass('highlight');
            jQuery('#second' + pTime).addClass('highlight');
            lastHighlightPartNum = pTime;
            // func. highlightPart
        }

        function cbPlayComplete(){
            jQuery('#second' + lastHighlightPartNum).removeClass('highlight');
            // func. cbPlayComplete
        }

        function cbSoundSeekPlayer(pTime){
            var time = Math.round(parseFloat(pTime));
            for( var i = time; i >= 0; i-- ){
                var $part = jQuery('#second' + i);
                if ( $part.length == 0 ){
                    continue;
                }
                highlightPart(i);
                break;
            }
            // func. cbSoundSeekPlayer
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

        function cbInitPlayer(){
            //console.log('cbInitPlayer');
            singlePlayerMvc.setSoundUrl(paramOptions.resUrl);
            // func. cbInitPlayer
        }

        function init(pOptions){
            options = pOptions;
            // движение мышкой и клик по словам
            jQuery(options.htmlDataBox).mousemove(htmlDataBoxMouseMove).click(htmlDataBoxClick);
            jQuery(options.hintBox).click(hintBoxClick);
            jQuery(options.partBtnBox).click(partBtnBoxClick);
            jQuery(options.sentBtnBox).click(sentBtnBoxClick);

            if ( singlePlayerMvc ){
                singlePlayerMvc.cbSetTime = highlightPart ;
                singlePlayerMvc.cbSoundSeekPlayer = cbSoundSeekPlayer ;
                singlePlayerMvc.cbPlayComplete = cbPlayComplete ;
                singlePlayerMvc.cbInitPlayer = cbInitPlayer ;
            }

            //setInterval(button, 500);
            // func. init
        }

        return {
            init: init
        }
    })(); // engMvc