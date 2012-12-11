var engMvc = (function(){
        var options = {};
        /**
         * ����� c����, �� ������� �������� �����, ��� ���. ������
         * @type {Number}
         */
        var wordRelMouseOn = null;

        var wordRelSelect = null;

        var wordOsnList = [];
        var wordSecondList = [];

        var mousePos = {x:0, y:0};
        //var mouseHintPos = {x:0, y:0};
        var wordObjMouseOn = null;

        /**
         * ������� ���������� ����
         */
        function clearSelected(){
            $(options.htmlDataBox+' span.selected').removeClass('selected');
            // func. clearSelected
        }

        function showRuleSentence(pObjDom){
            var $divPart = $(pObjDom).parents('div.part:first');
            if ( !$divPart){
                if ( !$(pObjDom).hasClass('part')){
                    return;
                }
                $divPart = $(pObjDom);
            } // if


            /*var pos = $divPart.position();
            var x = pos.left + $divPart.width();
            console.log($divPart.width());*/

            var $lastSent = $divPart.find('span.sentence:last');
            var x = $lastSent.position().left + $lastSent.width() + 10;
            var y = $divPart.position().top;
            $('#sentBtnBox').css({left: x+'px', top: y+'px'}).show();


            // func. showRuleSentence
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

            var list = engData.osnWord[pRel].link;
            wordOsnList = list;
            for( var i in list ){
                $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('osn');
            }
            var list = engData.osnWord[pRel].sec;
            wordSecondList = list;
            for( var i in list ){
                $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('sec');
            }
            // func. addWordClassRule
        }

        /**
         * ��������� ��������� ���� �� �����
         * @param pEvent
         */
        function htmlDataBoxMouseMove(pEvent){
            mousePos.x = pEvent.pageX;
            mousePos.y = pEvent.pageY;

            if ( $(pEvent.target).hasClass('word') ){
                wordObjMouseOn = pEvent.target;
                // �������� ID �����
                var rel = $(pEvent.target).attr('rel');
                // ���� �� ���������� ����� � �������
                if ( !engData.osnWord[rel]){
                    // ���� ���� � ������� ����� ��� ���� ������ �� ������ ID �����
                    if ( !engData.linkWord[rel]){
                        return;
                    }
                    rel = engData.linkWord[rel];
                } // if

                if (wordRelMouseOn == rel ){
                    return;
                }

                wordRelMouseOn = rel;

                $(pEvent.target).mouseout(wordMouseOut);
                addWordClassRule(rel);



                showRuleSentence(pEvent.target);

                // engartData.wordList
            }else
            if ( $(pEvent.target).hasClass('sentence') ){
                /*var sentId = pEvent.target.id.substr(4);

                if ( sentIdMouseOn == sentId ){
                    return;
                }
                sentIdMouseOn = sentId;
                if ( engartData.sentList[sentId]){
                    $(pEvent.target).addClass('select');
                    $(pEvent.target).mouseout(sentenceMouseOut);
                }*/

                //console.log($(pEvent.target).position().left + $(pEvent.target).width() )

            }
            // func. htmlDataBoxMouseMove
        }



        function htmlDataBoxClick(pEvent){
            wordRelSelect = wordRelMouseOn;
            hintShow();
            // func. htmlDataBoxClick
        }

        function hintShow(){
            if (!engData.osnWord[wordRelMouseOn]){
                return;
            }

            var $hintBox = $(options.hintBox).show();

            var text = '<span class="translt">'+engData.osnWord[wordRelMouseOn].translt+'</span>';
            text += '<span class="transkr"> ['+engData.osnWord[wordRelMouseOn].transkr +']</span>'
            $hintBox.find('span:first').html(text);

            var $divParty = $(wordObjMouseOn).parents('div.part:first');

            var y = $divParty.position().top - $hintBox.outerHeight();
            y = y <= 10 ? 10 : y;

            var x = mousePos.x - $hintBox.width() / 2
            x = x <= 10 ? 10 : x;

            $hintBox.css({left:x+'px', top: y+'px'});
            console.log('showHint');

            // func. hintInverval
        }

        function hintBoxButtonClick(pButtonRel){
            switch(pButtonRel){
                case 'rule':
                    console.log('word rule');
                    break;
                case 'viprule':
                    console.log('word vipRule');
                    break;
            }
            // func. hintBoxButtonClick
        }

        function hintBoxClick(pEvent){
            var rel = $(pEvent.target).attr('rel');
            if ( rel){
                hintBoxButtonClick(rel);
            }

            var $hintBox = $(pEvent.target).parents('div[id="hintBox"]:first');
            if ( !$hintBox ){
                if ( !$(pEvent.target).attr('id') == 'hintBox' ){
                    return;
                }
                $hintBox = $(pEvent.target);
            }
            $hintBox.hide();
            // func. hintBoxClick
        }

        function sentBtnBoxClick(pEvent){
            var rel = $(pEvent.target).attr('rel');
            switch( rel ){
                case 'play':
                    console.log('sent play');
                    break;
                case 'rule':
                    console.log('sent rule');
                    break;
                case 'viprule':
                    console.log('set viprule');
                    break;
            }
            // func. sentBtnBoxClick
        }

        function init(pOptions){
            options = pOptions;
            // �������� ������ � ���� �� ������
            $(options.htmlDataBox).mousemove(htmlDataBoxMouseMove).click(htmlDataBoxClick);
            $(options.hintBox).click(hintBoxClick);
            $(options.sentBtnBox).click(sentBtnBoxClick);

            //setInterval(button, 500);
            // func. init
        }

        return {
            init: init
        }
    })(); // engMvc

    $(document).ready(function(){
        engMvc.init({
            htmlDataBox: '#htmlDataBox',
            hintBox: '#hintBox',
            sentBtnBox: '#sentBtnBox'
        });
    }); // $(document).ready