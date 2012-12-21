<script src="res/plugin/classes/utils.js" type="text/javascript" xmlns="http://www.w3.org/1999/html"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen" />


<link   href="res/plugin/dhtmlxTree/codebase/dhtmlxtree.css" rel="stylesheet" type="text/css"/>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxcommon.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxtree.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/ext/dhtmlxtree_json.js"></script>

<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jqui/custom/css/smoothness/jquery-ui-1.8.22.custom.css">
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jqui/custom/js/jquery-ui-1.8.22.custom.min.js"></script>

<script src="res/plugin/classes/utils.js" type="text/javascript"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

<style>
    div .dt{font-weight: bold}
    div .dd{ padding-left: 25px}

    #cloakingBox{width: 800px}
</style>

<style>
    #ruleBtnPanel{
        width: 200px;
        height: 40px;
        border: 1px solid black;
        position: fixed ;
        bottom: 0px;
        background-color: blue;
        left: 20%;
        z-index: 1150;
}
    .hidden{display: none}

    .childLeft>div{
        float: left;
    }

    .clear{
        float: none;
    }

    #rulesArtBox{
        width: 300px;
        /*height: 300px;*/
        background-color: #d5d6d6;
        padding: 5px 5px 5px 5px;
        margin-right: 10px;
    }

    .ruleArtSelect{
        background-color: #bfecfd;
    }

    /*#rulesArtBox>div{
        margin-top: 5px;
        line-height: 16px;
        height: 18px;

    }*/

    #artRuleTreeBox{
        width: 200px;
        height: 300px;
    }

    .panel{
        margin-bottom: 10px;
    }

</style>

<style>
    span.word:hover {
        cursor: pointer;
    }

    span.word:hover {
        color: red;
    }

    span.word.selected{
        font-weight: bold;
        color: red;
    }

    span.word.ruleOsn{
         color: green;
         font-weight: bold;
    }

    span.word.ruleSecond{
        color: gray;
        font-weight: bold;
    }

    span.sentence{
        display:inline-block;
        padding-right:17px
    }

    span.sentence:hover{
        background: url('/res/img/objItem/eng/edit_16.png?v=1') no-repeat right center;
        cursor: pointer;
    }

    span.sentence.select{
        background-color: #dcdcdc;
    }

    span.sentence:hover{
        text-decoration: underline;
        /*background-position: right center;
          background-image: url(/res/images/info.png);
          background-repeat: no-repeat;
          padding-right: 18px;
          margin-right: 18px;*/
    }
</style>

<div class="column">
    <div class="panel corners">

        <div class="title corners_top">
            <div class="title_element">
                <span id="history"><?=self::get('caption')?></span>
            </div>
        </div>
        <div class="panel"><?=self::get('saveData')?></div>

        <div class="boxmenu corners">
            <ul class="menu-items">
                <li>
                    <a href="#back" id="backBtn" title="Назад">
                        <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                    </a>
                </li>
                <li>
                    <a href="#publishArtBtn" id="publishArtBtn" title="Опубликовать">
                        <img src="<?= self::res('images/save_32.png') ?>" alt="Опубликовать" /><span>Опубл.</span>
                    </a>
                </li>
             </ul>
        </div>


        <div class="content">


            <!--<div id="ytapiplayer">
                You need Flash player 8+ and JavaScript enabled to view this video.
            </div>

            <script type="text/javascript">

                var ytplayer;
                var playInterval = null;
                var playerTime = -1;

                var params = { allowScriptAccess: "always" };
                var atts = { id: "myytplayer" };
                swfobject.embedSWF("http://www.youtube.com/v/Bm_KqeN5d4k?enablejsapi=1&playerapiid=ytplayer",
                        "ytapiplayer", "800", "333", "8", null, null, params, atts);

                function onYouTubePlayerReady(playerId) {
                    ytplayer = document.getElementById("myytplayer");
                    ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
                    //
                }

                function onytplayerStateChange(newState){
                    console.log(newState);
                    if ( newState == 0 || newState == 2 ){
                        console.log('stop');
                        if ( playInterval == null){
                            return;
                        }
                        clearInterval(intervalID)
                        playInterval = null;

                    }else
                    if ( newState == 1 ){
                        playInterval = setInterval(updateytplayerInfo, 600);
                        console.log('play');
                    }
                }

                function updateytplayerInfo(newState) {
                    var time = Math.round(ytplayer.getCurrentTime() - 0.5);
                    if ( playerTime == time ){
                        return;
                    }
                    playerTime = time;
                    $('#second'+time).css('background-color', 'blue');
                    console.log(time);
                }

            </script>-->

            <? if (self::get('isNew')){?>
                <div class="panel">
                    <form id="paramArt" method="POST">
                        <div><input type="radio" name="type" value="sound"/> Звук</div>
                        <div><input type="radio" name="type" value="video"/> Видео</div>
                        <div>Text Link: <input type="text" name="textfile"/></div>
                        <div>Res URL: <input type="text" name="resurl"/></div>
                        <div><input type="submit" value="Отправить"/></div>

                    </form>
                </div>
            <? }else{
                echo self::get('engartText');

            }?>


        </div>
    </div>
</div>

<div id="ruleBtnPanel">
    <input type="button" value="Clear Sel" id="clearSelectedBtn"/>
    <input type="button" value="Set Rule" id="setRuleBtn"/>
</div>

<!-- Расширенные настройка для Предложения -->
<div id="sentenceAdvBox" class="hidden">
    В разработке
</div>

<!-- Расширенные настройка для Местоимения -->
<div id="pronounAdvBox" class="hidden">
    В разработке
</div>

<!-- Расширенные настройка для Глагола -->
<div id="verbAdvBox" class="hidden">
    <table>
        <tbody>
            <tr>
                <td>Время</td>
                <td>
                    <select name="tense">
                        <option value="prsim">Present Simple</option>
                        <option value="prct">Present Continuous</option>
                        <option value="prper">Present Perfect</option>
                        <option value="prperpr">Present Perfect Progressive</option>
                        <option value="pastsim">Past Simple</option>
                        <option value="pastct">Past continuous</option>
                        <option value="pastper">Past Perfect</option>
                        <option value="pastperpr">Past Perfect Progressive</option>
                        <option value="futsim">Future Simple</option>
                        <option value="futct">Future Continuous</option>
                        <option value="futper">Future Perfect</option>
                        <option value="futperpr">Future Perfect Progressive</option>
                    </select>
                </td>
            </tr>
        <tr>
            <td>Passive</td>
            <td><input type="checkbox" name="passive" value="1"/></td>
        </tr>
        <tr>
            <td>Фраз. глагол</td>
            <td><input type="checkbox" name="phraze" value="1"/></td>
        </tr>


        </tbody>
    </table>
</div>

<form id="ruleDlg" class="hidden">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-type">Типы Слов</a></li>
            <li><a href="#tabs-settings">Осн. настр.</a></li>
            <li><a href="#tabs-dynamic">Расширен. настр</a></li>
            <li><a href="#tabs-rule">Правила</a></li>
        </ul>

        <div id="tabs-type">
            <table>
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Основ.</th>
                        <th>Второст.</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div id="tabs-settings">
            <span></span>
            <table>
                <tr>
                    <td>Часть речи</td>
                    <td>
                        <select id="classWord" name="classWord">
                            <option value="none">{Выбрать}</option>
                            <option value="phrasa">Фраза</option>

                            <option value="noun">Существительное</option>
                            <option value="verb">Глагол</option>
                            <option value="particle">Частица</option>
                            <option value="idiom">Идиома</option>
                            <option value="infinitiv">Инфинитив</option>
                            <option value="conjunction">Союз</option>
                            <option value="pronoun">Местоимение</option>
                            <option value="adjective">Прилогательное</option>
                            <option value="preposition">Предлог</option>
                            <option value="adverb">Наречие</option>
                            <option value="gerund">Герундий</option>
                            <option value="participle">Причастие</option>
                            <option value="determine">Определитель</option>
                            <option value="interjection">Междометье</option>
                            <option value="numeral">Чистительное</option>
                            <option value="sentence">Предложение</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Слово</td>
                    <td><input type="text" name="word"/></td>
                </tr>
                <tr>
                    <td>Транскрип.</td>
                    <td><input type="text" name="transcr"/></td>
                </tr>
                <tr>
                    <td>Перевод.</td>
                    <td><input type="text" name="translate"/></td>
                </tr>
            </table>

            <div>Комментарий.</div>
            <div><textarea name="comment" style="width: 100%"></textarea></div>

        </div> <!-- <div id="tabs-settings"> -->

        <div id="tabs-dynamic"></div>
        <div id="tabs-rule">
            <div><input type="button" value="Add rule" id="addArtRuleBtn"/></div>
            <div class="childLeft">
                <div>
                    <table id="rulesArtBox"><tbody></tbody></table>
                </div>
                <div id="artRuleTreeBox" class="hidden"></div>
                <br class="clear"/>
            </div>
        </div>
    </div><!-- <div id="tabs"> -->
    <div>
        <input type="button" value="Сохранить" id="saveFormRuleBtn"/>
        <input type="button" value="Удалить" id="rmRuleBtn"/>
        <input type="button" value="Отмена" id="cancelRuleBtn"/>
    </div>
</form>

<script type="text/javascript">
    var engartData = {
        contid: <?= self::get('contId') ?>,
        objItemId: <?= self::get('objItemId') ?>,
        // Список ранее сохранённых правил
        wordList: <?= self::get('saveWordData', '{}') ?>,
        sentList: <?= self::get('saveSentData', '{}') ?>,
        artRuleTreeJson: <?= self::get('artRuleTreeJson', '{}') ?>,
        objItemNameListJson: <?= self::get('objItemNameListJson', '{}') ?>,
        resUrl: '<?= self::res('images/') ?>'
    };

    var contrName = engartData.contid;
    var callType = 'comp';
    utils.setType(callType);
    utils.setContr(contrName);
    HAjax.setContr(contrName);

    var engartMvc = (function(){
        var options = {};
        /**
         * Содержит связть вторичного слова к основному слова
         * @type {Object}
         */
        var wordListLink = {};
        /**
         * Буффер для номеров выделенных слов
         * @type {Array}
         */
        var selectedBuff = [];
        /**
         * Номер cлова, на которое наведена мышка, для сущ. правил
          * @type {Number}
         */
        var wordRelMouseOn = null;

        var wordRelSelect = null;


        var sentIdMouseOn = null;
        /**
         * Список опорных слов для правил, т.е. это входных слова для получения правила.
         * Заполняется в момент наведения мыши на слово
         * @type {Array}
         */
        var wordOsnList = [];
        /**
         * Список второстепенных слова для правил,
         * т.е. это слова по которым можно найти основные слова.
         * Заполняется в момент наведения мыши на слово
         * @type {Array}
         */
        var wordSecondList = [];

        // Новый ID, при добавлении нового правила на форме правил
        var ruleArtNumNew = 0;
        // Дерево со статьями для правил
        var artRuleTree = null;
        // Текущее выделенное правило во вкладке правил
        var ruleArtCurrentId = null;

        // Какой объект правил сохряняем: слова или предложения
        var saveRuleObj;

        var chooseMode = 'none';

        /**
         * Обработка клика по кноке очистке выделенных слов
         */
        function clearSelectedBtnClick(){
            clearSelected();
            // func. clearSelectedBtnClick
        }

        /**
         * Очистка выделенных слов
         */
        function clearSelected(){
            selectedBuff = [];
            $(options.htmlDataBox+' span.selected').removeClass('selected');
            chooseMode = 'none';
            // func. clearSelected
        }

        function wordMouseOut(pEvent){
            $(pEvent.target).unbind('mouseout');
            removeWordClassRule(wordRelMouseOn);
            wordRelMouseOn = null;
            selectedBuff = [];
            // func. wordMouseOut
        }

        /**
         * Обработка наведения мыши на слово
         * @param pEvent
         */
        function htmlDataBoxMouseMove(pEvent){
            if ( $(pEvent.target).hasClass('word') && chooseMode != 'newword' ){
                var rel = $(pEvent.target).attr('rel');
                if ( !engartData.wordList[rel]){
                    if ( !wordListLink[rel]){
                        return;
                    }
                    rel = wordListLink[rel];
                }

                if (wordRelMouseOn == rel ){
                    return;
                }

                wordRelMouseOn = rel;

                $(pEvent.target).mouseout(wordMouseOut);
                addWordClassRule(rel);

                // engartData.wordList
            }else
            if ( $(pEvent.target).hasClass('sentence') ){
                var sentId = pEvent.target.id.substr(4);

                if ( sentIdMouseOn == sentId ){
                    return;
                }
                sentIdMouseOn = sentId;
                if ( engartData.sentList[sentId]){
                    $(pEvent.target).addClass('select');
                    $(pEvent.target).mouseout(sentenceMouseOut);
                }

                //console.log($(pEvent.target).position().left + $(pEvent.target).width() )

            }
            // func. htmlDataBoxMouseMove
        }

        function sentenceMouseOut(pEvent){
            sentIdMouseOn = null;
            $(pEvent.target).unbind('mouseout');
            $(pEvent.target).removeClass('select');

            // func.
        }

        function addWordClassRule(pRel){
            $(options.htmlDataBox+' span[rel="'+pRel+'"]').addClass('ruleOsn');

            var list = engartData.wordList[pRel].osnWordId;
            wordOsnList = [];
            if ( list.length != 0 ){
                list = list.split(',');
                wordOsnList = list;
                for( var i in list ){
                    $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('ruleOsn');
                }
            } // if

            var list = engartData.wordList[pRel].secondWordId;
            wordSecondList = [];
            if ( list.length != 0 ){
                list = list.split(',');
                wordSecondList = list;
                for( var i in list ){
                    $(options.htmlDataBox+' span[rel="'+list[i]+'"]').addClass('ruleSecond');
                }
            } // if
            // func. addWordClassRule
        }

        function removeWordClassRule(pRel){
            $(options.htmlDataBox+' span[rel="'+pRel+'"]').removeClass('ruleOsn');
            //var osnList = engartData.wordList[pRel];

            for( var i in wordOsnList ){
                $(options.htmlDataBox+' span[rel="'+wordOsnList[i]+'"]').removeClass('ruleOsn');
            }

            for( var i in wordSecondList ){
                $(options.htmlDataBox+' span[rel="'+wordSecondList[i]+'"]').removeClass('ruleSecond');
            }
            // func. removeWordClassRule
        }

        /**
         * Очистка полей формы
         */
        function clearFormValue(idForm){
            $(idForm + ' input[type="checkbox"],input[type="radio"]').removeAttr('checked');
            $(idForm + ' select,input[type="text"],input[type="password"],input[type="hidden"],textarea').val('');
            // func. clearFormValue
        }

        /*
        $('input[type="checkbox"],input[type="radio"]', element).removeAttr('checked');
			$('select,input[type="text"],input[type="password"],input[type="hidden"],textarea', element).val('');
         */

        /**
         * Заполнение формы, ранее сохранёнными правилами.
         */
        function setRuleField(){
            var rel = wordRelSelect;
            $('#ruleDlg input[name="w'+rel+'"]').filter('[value="osn"]').attr('checked', true);
            for( var i in wordOsnList ){
                $('#ruleDlg input[name="w'+wordOsnList[i]+'"]').filter('[value="osn"]').attr('checked', true);
            }
            for( var i in wordSecondList ){
                $('#ruleDlg input[name="w'+wordSecondList[i]+'"]').filter('[value="scn"]').attr('checked', true);
            }

            var ruleData = JSON.parse(engartData.wordList[rel].data);

            // Установка формы динамичного контента
            $('#tabs-dynamic').html($('#'+ruleData.classWord+'AdvBox').html());

            unserializeRule(ruleData);

            // func. setRuleField
        }

        function unserializeRule(ruleData){
            for( var key in ruleData ){
                var num = key.match(/ruleart\[(\d+)\]/);
                if ( num == null ){
                    continue;
                }
                addArtRuleLine(num[1]);
                var text = engartData.objItemNameListJson[ruleData[key]];
                $('#rart'+num[1]+' td[rel="set"]').html(text);
            } // for



            unserializeForm(options.tabsBox, ruleData)
            // func. unserializeRule
        }

        /**
         * Заполнение объектов формы значениями из pData
         * @param pData {Object} содержит название поля в ключе и значение поля в результате.
         */
        function unserializeForm(idForm, pData){
            for( var key in pData){
                var value = pData[key];
                $(idForm + ' input[type="checkbox"][name="'+ key +'"][value="'+ value +'"],input[type="radio"][name="'+ key +'"][value="'+ value +'"]').attr('checked', 'checked');
                $(idForm + ' select[name="'+ key +'"],input[type="text"][name="'+ key +'"],input[type="password"][name="'+ key +'"],input[type="hidden"][name="'+ key +'"],textarea[name="'+ key +'"]').val(value);
            }
            // func. unserializeForm
        }

        function clearDisableTab(){
            $( options.tabsBox ).tabs('enable', 0);
            // func. clearDisableTab
        }

        function htmlDataBoxClick(pEvent){
            wordRelSelect = wordRelMouseOn;
            saveRuleObj = {type:'word'};
            // Слово имеет уже правило, нужно показать окно
            if ( $(pEvent.target).hasClass('ruleOsn') && chooseMode != 'newword' ){
                $( options.tabsBox ).tabs('select', 1);
                $(options.rulesArtBox + ' tbody:first').html('');
                // Очищаем выделнные
                clearSelected();
                selectedBuff = [wordRelSelect];
                selectedBuff = selectedBuff.concat(wordOsnList, wordSecondList);

                ruleArtNumNew = engartData.wordList[wordRelSelect]['ruleMaxId'];

                // Отображение формы Установка правил
                setRuleBtnClick();
                // Установка ранее выбранных правил в элементы формы
                setRuleField();
                clearDisableTab();
            }else
            // Выделение слова
            if ( $(pEvent.target).hasClass('word') ){
                chooseMode = 'newword';
                $(options.rulesArtBox + ' tbody:first').html('');
                ruleArtNumNew = 0;

                clearFormValue(options.tabsBox);
                $( options.tabsBox ).tabs('select', 0);
                wordClick(pEvent.target);
                clearDisableTab();
                if ( selectedBuff.length == 0 ){
                    chooseMode = 'none';
                }
            }else
            // Выделение предложения
            if ( $(pEvent.target).hasClass('sentence') ){
                saveRuleObj = {type:'sentence'};
                saveRuleObj.id = $(pEvent.target).attr('id').substr(4);

                $( options.tabsBox ).tabs('select', 1);
                $( options.tabsBox ).tabs({disabled: [0]});

                // Установка формы динамичного контента
                $('#tabs-dynamic').html($('#sentenceAdvBox').html());

                $(options.rulesArtBox + ' tbody:first').html('');
                if ( engartData.sentList[saveRuleObj.id]){
                    ruleArtNumNew = engartData.sentList[saveRuleObj.id]['ruleMaxId'];
                    var ruleData = JSON.parse(engartData.sentList[saveRuleObj.id]['data']);
                    unserializeRule(ruleData);
                }else{
                    clearFormValue(options.tabsBox);
                    ruleArtNumNew = 0;
                }

                $( options.classWord ).val('sentence');
                clearSelected();

                $.fancybox.open([{
                    href: '#ruleDlg',
                    width: 700,
                    height: 500,
                    autoSize: false
                }]);
            }
            // func. htmlDataBoxClick
        }

        /**
         * Добавляет слово в список выделеных слов
         * @param pObj - DOM Object страницы, в аттр. rel храниться его номер
         */
        function wordClick(pObj){
            var rel = $(pObj).attr('rel');
            // Есть ли в буффере
            var index = $.inArray(rel, selectedBuff );
            if ( index != -1 ){
                $(pObj).removeClass('selected');
                selectedBuff.splice( index, 1 );
            }else{
                $(pObj).addClass('selected');
                selectedBuff.push(rel);
            }
            // func. wordClick
        }

        /**
         * Отображение формы с правилами
         */
        function setRuleBtnClick(){
            var htmlTmpBuff = '';
            var num = 0;
            var nameWord = '';
            for( var i in selectedBuff ){
                var rel = selectedBuff[i];

                var isOsn = engartData.wordList[rel] != undefined;
                if ( !isOsn){
                    isOsn = $.inArray(rel, wordListLink ) != -1;
                }
                var disableStr = ' disabled="disabled"';
                var checkedStr = ' checked="checked"';
                var osnStr = '<input type="hidden" name="w'+rel+'" value="osn"/>';

                var name = $(options.htmlDataBox + ' span.word[rel='+rel+']:first').html();

                var advStr1 = (isOsn?disableStr:'');
                var advStr2 = (isOsn?checkedStr+disableStr:'');
                if ( num == 0 ){
                    advStr1 += checkedStr+disableStr;
                    advStr2 = disableStr;
                    nameWord += name + ' ';
                }

                var input1 = '<input type="radio" name="w'+rel+'" value="osn"'+advStr1+'/>';
                input1 += isOsn ? osnStr : (num == 0? osnStr: '');

                var input2  = '<input type="radio" name="w'+rel+'" value="scn"'+advStr2+'/>';
                input2 += isOsn ? '<input type="hidden" name="w'+rel+'" value="scn"/>' : '';


                htmlTmpBuff += '<tr><td>'+name+'</td>'
                        +'<td rel="osn">'+input1+'</td>'
                        +'<td rel="scn">'+input2+'</td>'
                        +'<td rel="remove" num="'+rel+'">'
                            +'<a href="#rmTypeWord"><img src="'+engartData.resUrl+'del_16.png" alt="Удалить"/></a>'
                        +'</td>'
                        +'</tr>';

                num++;
            } // for
            $(options.tabsType +' table>tbody').html(htmlTmpBuff);

            $(options.tabsSettings+' input[name="word"]:first').val(nameWord.trim());

            $.fancybox.open([{
                href: '#ruleDlg',
                width: 700,
                height: 500,
                autoSize: false
            }]);
            // func. setRuleBtnClick
        }

        function classWordChange(event){
            var val = event.target.value;
            $('#tabs-dynamic').html($('#'+val+'AdvBox').html());
            // func. classWordChange
        }

        function cbSaveWordDataSuccess(pData){
            if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }

            alert('Данные успешно сохранены');
            // func. cbSaveWordDataSuccess
        }

        function getWordSaveData(serialArr){
            var ruleData = {};
            var osnWordId = '';
            var secondWordId = '';
            for( var i in serialArr ){
                var name = serialArr[i].name;
                ruleData[name] = serialArr[i].value;
                // Если это первая буква 'w' и вторая часть число, то это ID слова
                var relWord = name.substr(1);
                if ( name.substr(0, 1) != 'w' || isNaN(relWord-0) ){
                    continue;
                }

                switch(serialArr[i].value){
                    case 'osn':
                        if ( wordRelSelect == relWord ){
                            continue;
                        }
                        osnWordId += ','+relWord;
                        wordListLink[parseInt(relWord)] = wordRelSelect;
                        break;
                    case 'scn':
                        secondWordId += ','+name.substr(1);
                        break;
                } // switch
            } // for

            osnWordId = osnWordId.substr(1);
            secondWordId = secondWordId.substr(1);

            var result = JSON.stringify(ruleData);
            var wordId = wordRelSelect ? wordRelSelect : selectedBuff[0];
            engartData.wordList[wordId] = {
                data: result,
                osnWordId: osnWordId,
                secondWordId: secondWordId,
                ruleMaxId: ruleArtNumNew
            };

            return result;
            // func. getWordSaveData
        }

        function getSentenceSaveData(serialArr){
            var ruleData = {};
            for( var i in serialArr ){
                var name = serialArr[i].name;
                ruleData[name] = serialArr[i].value;
            }
            var result = JSON.stringify(ruleData);
            engartData.sentList[saveRuleObj.id] = {
                data: result,
                ruleMaxId: ruleArtNumNew
            }
            return result;
            // func. getSentenceSaveData
        }

        /**
         * Сохраняем заполненые правила на сервер
         */
        function saveFormRuleBtnClick(){
            var serialArr = $('#ruleDlg').serializeArray();

            var saveData = '';
            if ( saveRuleObj.type == 'word'){
                saveData = getWordSaveData(serialArr);
            }else
            if ( saveRuleObj.type == 'sentence'){
                saveData = getSentenceSaveData(serialArr);
                sentIdMouseOn = null;
            } // if

            $.fancybox.close();
            clearSelected();

            var id = saveRuleObj.id == undefined ? '' : saveRuleObj.id;
            HAjax.saveWordData({
                data: 'json='+saveData+'&type='+saveRuleObj.type+'&id='+id+'&itemId='+engartData.objItemId+'&ruleMaxId='+ruleArtNumNew,
                methodType: 'POST'
            });
            // func. saveFormRuleBtnClick
        }

        /**
         * Закрываем окно с правилами
         */
        function cancelRuleBtnClick(){
            $.fancybox.close();
            // func. cancelRuleBtnClick
        }

        /**
         * Создаем взаимосвязь вторичного слова к основному слову
         */
        function initWordList(){
            // Бегаем по ранее сохранённым словам
            for( var wordId in engartData.wordList ){
                var str = engartData.wordList[wordId].osnWordId
                if ( str.length == 0){
                    continue;
                }
                // Получаем список номер основных слов слов
                var osnWordIdArr = str.split(',');
                // Указываем для каждого основного слова, его базовое слово
                for(var i in osnWordIdArr){
                    wordListLink[osnWordIdArr[i]] = wordId;
                } // for

            } // for
            // func. initWordList
        }

        function cbPublishArticle(pData){
            if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }

            alert('Данные поставлены в очередь публикации');
            // func. cbPublishArticle
        }

        /**
         * Выставление события на сервер, о пересоздании файл для публикации
         */
        function publishArtBtnClick(){
            HAjax.publishArticle({
                data: 'itemId='+engartData.objItemId,
                methodType: 'POST'
            });
            // func. publishArtBtnClick
        }

        function rmRuleBtnClick(){
            if (!confirm('Удалить правило?')) {
                return false;
            }
            var data = 'itemId='+engartData.objItemId+'&type='+saveRuleObj.type;
            if( saveRuleObj.type == 'word' ){
                data += '&rel='+wordRelSelect
            }else{
                data += '&rel='+saveRuleObj.id;
            }

            HAjax.removeRule({
                data: data,
                methodType: 'POST'
            });
            // func. rmRuleBtnClick
        }

        function cbRemoveRule(pData){
            if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }
            // Удаляем данные по правилу
            if ( pData['type'] == 'word'){
                delete engartData.wordList[pData['rel']];
                // Удаляем линки
                for( var i in wordListLink ){
                    if ( wordListLink[i] != pData['rel']){
                        continue;
                    }
                    delete wordListLink[i];
                }
            }else
            if ( pData['type'] == 'sentence'){
                delete engartData.sentList[pData['rel']];
            } // if

            $.fancybox.close();

            alert('Данные успешно удалены');
            // func. cbRemoveRule
        }

        function getContentCallBack(pId, pCaption, userData){
            var ruleArtCurrentId = userData.ruleArtCurrentId;
            var contId = userData.contId;
            $('#rart'+ruleArtCurrentId+' td[rel="set"]:first').html(pCaption);
            $('#rart'+ruleArtCurrentId+' input[name="ruleart['+ruleArtCurrentId+']"]:first').val(pId);
            $('#rart'+ruleArtCurrentId+' input[name="rcontid['+ruleArtCurrentId+']"]:first').val(contId);
            // func. getContentCallBack
        }

        function artRuleBrunchDbClick(pBrunchId, pTree){
            var urlWindow = utils.url({
                method: 'showTableItem',
                query: {id: pBrunchId}
            });

            var win = window.open( urlWindow, 'Выберите файл',
                    'width=800,height=600,scrollbars=yes,resizable=yes,'
                            +'location=no,status=yes,menubar=yes');
            win.onload = function() {
                win.parentCallback = getContentCallBack;
                win.callBackUsedData = {contId: pBrunchId, ruleArtCurrentId: ruleArtCurrentId};
            };
            //  func. artRuleBrunchDbClick
        }

        function initTree(){
            dhtmlxInit.init({
                'artRuleTree':{
                    tree:{
                        id:'artRuleTreeBox', json: engartData.artRuleTreeJson
                    }, // tree
                    dbClick: artRuleBrunchDbClick
                }
            }); // init

            artRuleTree = dhtmlxInit.tree['artRuleTree'];
            // func. initTrees
        }

        function addArtRuleLine(num){
            $(options.rulesArtBox + ' tbody:first').append('<tr id="rart' + num + '">' +
                        '<input type="hidden" name="ruleart[' + num + ']" value=""/>'+
                        '<input type="hidden" name="rcontid[' + num + ']" value=""/>'+
                        '<td rel="vip"><input type="radio" name="vip" value="'+num+'"/>' +
                        '<td rel="set">' +
                            '{Click and select rule}'+
                        '</td>' +
                        '<td rel="remove">' +
                            '<a href="#ruleArt"><img src="'+engartData.resUrl+'del_16.png" alt="Удалить правило" /></a>'+
                        '</td>' +
                    '</tr>');
            // func. addArtRuleLine
        }

        function addArtRuleBtnClick(){
            addArtRuleLine(ruleArtNumNew);
            ++ruleArtNumNew;
            // func. addArtRuleBtnClick
        }

        function tabsTypeTableClick(pEvent){
            var btnName = $(pEvent.target).attr('rel');
            if ( !btnName){
                btnName = $(pEvent.target).parents('*[rel]:first').attr('rel');
                if ( !btnName){
                    return false;
                }
            }
            switch(btnName){
                case 'remove':
                    if (confirm('Удалить элемент?')) {
                        var num = $(pEvent.target).parents('*[num]:first').attr('num');

                        var secondList = engartData.wordList[wordRelSelect].secondWordId;
                        engartData.wordList[wordRelSelect].secondWordId = secondList.replace(new RegExp(',?'+num,'g'), '');

                        var osnWordId = engartData.wordList[wordRelSelect].osnWordId;
                        engartData.wordList[wordRelSelect].osnWordId = secondList.replace(new RegExp(',?'+num,'g'), '');

                        $(pEvent.target).parents('tr:first').remove();

                    }
                    break;
                default:
                    return true;
            } // switch
            return false;
            // func. tabsTypeTableClick
        }

        function rulesArtBoxClick(pEvent){
            var btnName = $(pEvent.target).attr('rel');
            if ( !btnName){
                btnName = $(pEvent.target).parents('td:first').attr('rel');
                if ( !btnName){
                    return false;
                }
            }
            var $parentObj = $(pEvent.target).parents('tr:first');

            var artRuleNum = $parentObj.attr('id').substr(4);

            if ( ruleArtCurrentId != null ){
                $('#rart' + ruleArtCurrentId).removeClass('ruleArtSelect');
            }
            ruleArtCurrentId = artRuleNum;
            $parentObj.addClass('ruleArtSelect');

            //var itemObjId = $('input ruleart[' + ruleArtCurrentId + ']').val();
            var contId = $('#rart'+ruleArtCurrentId+' input[name="rcontid[' + ruleArtCurrentId + ']"]').val();

            if ( contId == '' ){
                artRuleTree.closeAllItems(0);
                artRuleTree.clearSelection();
            }else{
                artRuleTree.selectItem(contId);
            }

            switch(btnName){
                case 'set':
                    $(options.artRuleTreeBox).show();
                    break;
                case 'remove':
                     if (confirm('Удалить элемент?')) {
                        $('#rart'+ruleArtCurrentId).remove();
                     }
                     break;
                case 'vip':
                    return true;
            } // switch
            return false;
            // func. rulesArtBoxClick
        }

        function init(pOptions){
            options = pOptions;

            HAjax.create({
                saveWordData: cbSaveWordDataSuccess,
                removeRule: cbRemoveRule,
                publishArticle: cbPublishArticle
            });

            initWordList();
            initTree();

            // движение мышкой и клик по словам
            $(options.htmlDataBox).mousemove(htmlDataBoxMouseMove).click(htmlDataBoxClick);
            // Очистка красных выделенных слов
            $(options.clearSelectedBtn).click(clearSelectedBtnClick);
            // Установка правила на фразу/слово
            $(options.setRuleBtn).click(setRuleBtnClick);
            // Удаление правила
            $(options.rmRuleBtn).click(rmRuleBtnClick);
            $(options.tabsBox).tabs();
            // Изменение типа слова в правилах
            $(options.classWord).change(classWordChange);
            // Сохранение результата формы на сервер
            $(options.saveFormRuleBtn).click(saveFormRuleBtnClick);
            // Выставление события на сервер, о пересоздании файл для публикации
            $(options.publishArtBtn).click(publishArtBtnClick);
            // Закрытие окна правил
            $(options.cancelRuleBtn).click(cancelRuleBtnClick);
            $(options.addArtRuleBtn).click(addArtRuleBtnClick);
            $(options.rulesArtBox).click(rulesArtBoxClick);
            $(options.tabsType+' table').click(tabsTypeTableClick);

            // func. init
        }

        return {
            init: init
        }
    })();

    $(document).ready(function(){
        <?if ( !self::get('isNew')){?>
        engartMvc.init({
            htmlDataBox: '#htmlDataBox',
            setRuleBtn: '#setRuleBtn',
            clearSelectedBtn: '#clearSelectedBtn',
            tabsType: '#tabs-type',
            tabsBox: '#tabs',
            classWord: '#classWord',
            saveFormRuleBtn: '#saveFormRuleBtn',
            cancelRuleBtn: '#cancelRuleBtn',
            rmRuleBtn: '#rmRuleBtn',
            publishArtBtn: '#publishArtBtn',
            addArtRuleBtn: '#addArtRuleBtn',
            rulesArtBox: '#rulesArtBox',
            artRuleTreeBox: '#artRuleTreeBox',
            tabsSettings: '#tabs-settings'
        });
        <?}?>
    }); // $(document).ready

</script>