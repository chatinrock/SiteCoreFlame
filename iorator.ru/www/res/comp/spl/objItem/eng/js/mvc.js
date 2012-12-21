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
            $(options.htmlDataBox+' span.selected').removeClass('selected');
            // func. clearSelected
        }

        function showPartBox(pObjDom){
            var $trPart = $(pObjDom).parents('tr.part:first');
            if ( $trPart.length == 0){
                if ( !$(pObjDom).hasClass('part')){
                    return;
                }
                $trPart = $(pObjDom);
            } // if

            var $partBtnBox = $(options.partBtnBox);

            $htmlDataBox = $(options.htmlDataBox);

            var marginLeft = parseInt($('#htmlDataBox').css('margin-left').replace('px', ''));
            var x = $htmlDataBox.position().left + marginLeft - $partBtnBox.outerWidth() + 20;
            var y = $trPart.position().top;

            $(options.partBtnBox).css({left: x+'px', top: y+'px'}).show();

            paryMouseOn = $trPart.attr('id').substr(6);
            // func. showPartBox
        }

        function wordMouseOut(pEvent){
            $(pEvent.target).unbind('mouseout');
            removeWordClassRule(wordRelMouseOn);
            wordRelMouseOn = null;
            wordObjMouseOn = null;
            // func. wordMouseOut
        }

        function removeWordClassRule(pRel){
            $(options.htmlDataBox+' span[rel="'+pRel+'"]').removeClass('osn');

            for( var i in wordOsnList ){
                $(options.htmlDataBox+' span[rel="'+wordOsnList[i]+'"]').removeClass('osn');
            }

            for( var i in wordSecondList ){
                $(options.htmlDataBox+' span[rel="'+wordSecondList[i]+'"]').removeClass('sec');
            }
            // func. removeWordClassRule
        }

        function addWordClassRule(pRel){
            $(options.htmlDataBox+' span[rel="'+pRel+'"]').addClass('osn');

            var list = engWord.osnWord[pRel].link;
            wordOsnList = list;
            for( var i in list ){
                $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('osn');
            }
            var list = engWord.osnWord[pRel].sec;
            wordSecondList = list;
            for( var i in list ){
                $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('sec');
            }
            // func. addWordClassRule
        }

        function showSentBox(pObjDom){

            var $sentObj = $(pObjDom).parents('span.sentence:first');
            if ( $sentObj.length == 0){
                if ( !$(pObjDom).hasClass('sentence')){
                    return;
                }
                $sentObj = $(pObjDom);
            } // if

            var sentId = $sentObj.attr('id').substr(4);
            var pos = $sentObj.position();
            var  $sentBtnBox = $(options.sentBtnBox);
            var x = pos.left + $sentObj.outerWidth() - $sentBtnBox.outerWidth();
            var y = pos.top;
            $sentBtnBox.css({left: x+'px', top: y + 'px'}).show();

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

            if ( $(pEvent.target).hasClass('word') ){
                wordObjMouseOn = pEvent.target;
                // Получаем ID слова
                var rel = $(pEvent.target).attr('rel');
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

                $(pEvent.target).mouseout(wordMouseOut);
                addWordClassRule(rel);

                // engartData.wordList
            }
            // func. htmlDataBoxMouseMove
        }



        function htmlDataBoxClick(pEvent){
            if ( isHintShow && wordRelSelect == wordRelMouseOn ){
                isHintShow = false;
                $(options.hintBox).hide();
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

            var $hintBox = $(options.hintBox).show();

            var text = '<span class="translt">'+engWord.osnWord[wordRelMouseOn].translt+'</span>';
            text += '<span class="transkr"> ['+engWord.osnWord[wordRelMouseOn].transkr +']</span>'
            $hintBox.find('span:first').html(text);

            var $trParty = $(wordObjMouseOn).parents('tr.part:first');

            var y = $trParty.position().top - $hintBox.outerHeight();
            y = y <= 10 ? 10 : y;

            var x = mousePos.x - $hintBox.width() / 2
            x = x <= 10 ? 10 : x;

            $hintBox.css({left:x+'px', top: y+'px'});

            isHintShow = true;
            //console.log('showHint');

            // func. hintInverval
        }

        function hintBoxButtonClick(pButtonRel){
            switch(pButtonRel){
                case 'rule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=word&path='+engWord.path + '&id='+wordRelSelect;
                    url += '&lightbox[width]=600&lightbox[height]=400'
                    break;
                case 'viprule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=vip&path='+engWord.osnWord[wordRelSelect].vipId;
                    url += '&lightbox[width]=800&lightbox[height]=600'
                    break;
            }
            $.lightbox(url);
            // func. hintBoxButtonClick
        }

        function hintBoxClick(pEvent){
            var rel = $(pEvent.target).attr('rel');
            if ( rel){
                hintBoxButtonClick(rel);
            }

            var $hintBox = $(pEvent.target).parents('div[id="hintBox"]:first');
            if ( $hintBox.length == 0 ){
                if ( !$(pEvent.target).attr('id') == 'hintBox' ){
                    return;
                }
                $hintBox = $(pEvent.target);
            }
            $hintBox.hide();
            isHintShow = false;
            // func. hintBoxClick
        }

        function partBtnBoxClick(pEvent){
            var rel = $(pEvent.target).attr('rel');
            switch( rel ){
                case 'play':
                    singlePlayerMvc.soundSeek(parseInt(paryMouseOn));
                    highlightPart(paryMouseOn);
                    break;
            }
            // func. partBtnBoxClick
        }

        function highlightPart(pTime){
            var $part = $('#second' + pTime);
            if ( $part.length == 0 ){
                return;
            }
            $('#second' + lastHighlightPartNum).removeClass('highlight');
            $('#second' + pTime).addClass('highlight');
            lastHighlightPartNum = pTime;
            // func. highlightPart
        }

        function cbPlayComplete(){
            $('#second' + lastHighlightPartNum).removeClass('highlight');
            // func. cbPlayComplete
        }

        function cbSoundSeekPlayer(pTime){
            var time = Math.round(parseFloat(pTime));
            for( var i = time; i >= 0; i-- ){
                var $part = $('#second' + i);
                if ( $part.length == 0 ){
                    continue;
                }
                highlightPart(i);
                break;
            }
            // func. cbSoundSeekPlayer
        }

        function sentBtnBoxClick(pEvent){
            var rel = $(pEvent.target).attr('rel');
            switch( rel ){
                case 'rule':
                    var url = '/webcore/func/utils/ajax/?name=eng&type=sent&path='+engWord.path + '&id='+sentMouseOn
                    url += '&lightbox[width]=600&lightbox[height]=400'
                    break;
                case 'viprule':
                    if ( !engSent[sentMouseOn] ){
                        break;
                    }
                    var url = '/webcore/func/utils/ajax/?name=eng&type=vip&path='+engSent[sentMouseOn].vipId;
                    url += '&lightbox[width]=800&lightbox[height]=600'
                    break;
            }
            $.lightbox(url);
            // func. sentBtnBoxClick
        }

        function cbInitPlayer(){
            console.log('cbInitPlayer');
            singlePlayerMvc.setSoundUrl(paramOptions.resUrl);
            // func. cbInitPlayer
        }

        function init(pOptions){
            options = pOptions;
            // движение мышкой и клик по словам
            $(options.htmlDataBox).mousemove(htmlDataBoxMouseMove).click(htmlDataBoxClick);
            $(options.hintBox).click(hintBoxClick);
            $(options.partBtnBox).click(partBtnBoxClick);
            $(options.sentBtnBox).click(sentBtnBoxClick);

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