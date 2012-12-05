<script src="res/plugin/classes/utils.js" type="text/javascript"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen" />

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

    #verbAdvBox{

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


    span.sentence:hover{
        text-decoration: underline;
        /*background-position: right center;
          background-image: url(/res/images/info.png);
          background-repeat: no-repeat;
          padding-right: 18px;
          margin-right: 18px;*/
    }
</style>

<div class="column" >
    <div class="panel corners">

        <div class="title corners_top">
            <div class="title_element">
                <span id="history"><?=self::get('caption')?></span>
            </div>
        </div>

        <div class="boxmenu corners">
            <ul class="menu-items">
                <li>
                    <a href="#back" id="backBtn" title="Назад">
                        <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                    </a>
                </li>
                <li>
                    <a href="#save" id="saveBtn" title="Сохранить">
                        <img src="<?= self::res('images/save_32.png') ?>" alt="Сохранить" /><span>Сохранить</span>
                    </a>
                </li>
                <li>
                    <a href="#publish" id="publishBtn" title="Опубликовать">
                        <img src="<?= self::res('images/publish_32.png') ?>" alt="Опубликовать" /><span>Опубликовать</span>
                    </a>
                </li>
             </ul>
        </div>


        <div class="content">


           <!-- <div id="ytapiplayer">
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

            <div id="htmlDataBox" style=""><?=self::get('engartText')?></div>

        </div>
    </div>
</div>

<div id="ruleBtnPanel">
    <input type="button" value="Clear Sel" id="clearSelectedBtn"/>
    <input type="button" value="Set Rule" id="setRuleBtn"/>
</div>

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
        </tbody>
    </table>
</div>


<form id="ruleDlg" class="hidden">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-type">Типы Слов</a></li>
            <li><a href="#tabs-settings">Осн. настр.</a></li>
            <li><a href="#tabs-dynamic">Расширен. настр</a></li>
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
                            <option value="phrasalverb">Фраз. глагол</option>
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
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Транскрип.</td>
                    <td><input type="text" name="transcr"/></td>
                </tr>
                <tr>
                    <td>Перевод.</td>
                    <td><input type="text" name="translate"/></td>
                </tr>
                <!--<tr>
                    <td>Звучание.</td>
                    <td>// Сделать<input type="hidden" name="soundFile" value=""/></td>
                </tr>-->
            </table>

            <table style="width: 100%">
                <tr>
                    <td colspan="2">Комментарий.</td>
                </tr>
                <tr>
                    <td><textarea name="comment" style="width: 100%"></textarea></td>
                </tr>
            </table>

        </div> <!-- <div id="tabs-settings"> -->

        <div id="tabs-dynamic"></div>
    </div><!-- <div id="tabs"> -->
    <div>
        <input type="button" value="Сохранить" id="saveRuleBnt"/>
        <input type="button" value="Удалить" id="rmRuleBtn"/>
        <input type="button" value="Отмена" id="cancelRuleBtn"/>
    </div>
</form>

<script type="text/javascript">
    var engartData = {
        contid: <?= self::get('contId') ?>,
        objItemId: <?= self::get('objItemId') ?>,
        // Список ранее сохранённых правил
        wordList: <?= self::get('saveData') ?>
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
         * Номер выделенного слова, уже для сущ. правил
          * @type {Number}
         */
        var wordRelCurrentSelect = null;
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

        function clearSelectedBtnClick(){
            clearSelected();
            // func. clearSelectedBtnClick
        }

        function clearSelected(){
            selectedBuff = [];
            $(options.htmlDataBox+' span.selected').removeClass('selected');
            // func. clearSelected
        }

        function wordMouseOut(pEvent){
            var rel = wordRelCurrentSelect;

            $(pEvent.target).unbind('mouseout');
            removeWordClassRule(rel);
            wordRelCurrentSelect = null;
            selectedBuff = [];
            // func. wordMouseOut
        }

        /**
         * Обработка наведения мыши на слово
         * @param pEvent
         */
        function htmlDataBoxMouseMove(pEvent){
            if ( $(pEvent.target).hasClass('word') ){
                var rel = $(pEvent.target).attr('rel');
                if ( !engartData.wordList[rel]){
                    if ( !wordListLink[rel]){
                        return;
                    }
                    rel = wordListLink[rel];
                }

                if (wordRelCurrentSelect == rel ){
                    return;
                }

                wordRelCurrentSelect = rel;

                $(pEvent.target).mouseout(wordMouseOut);
                addWordClassRule(rel);

                // engartData.wordList
            }
            // func. htmlDataBoxMouseMove
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

        /*
        $('input[type="checkbox"],input[type="radio"]', element).removeAttr('checked');
			$('select,input[type="text"],input[type="password"],input[type="hidden"],textarea', element).val('');
         */

        function setRuleField(){
            var rel = wordRelCurrentSelect;
            $('#ruleDlg input[name="w'+rel+'"]').filter('[value="osn"]').attr('checked', true);
            for( var i in wordOsnList ){
                $('#ruleDlg input[name="w'+wordOsnList[i]+'"]').filter('[value="osn"]').attr('checked', true);
            }
            for( var i in wordSecondList ){
                $('#ruleDlg input[name="w'+wordSecondList[i]+'"]').filter('[value="scn"]').attr('checked', true);
            }
            var ruleData = JSON.parse(engartData.wordList[rel].data);
            unserializeForm(ruleData)
            console.log(ruleData);

            // func. setRuleField
        }

        function unserializeForm(pData){
            for( var key in pData){
                var value = pData[key];
                $('input[type="checkbox"][name="'+ key +'"][value="'+ value +'"],input[type="radio"][name="'+ key +'"][value="'+ value +'"]').attr('checked', 'checked');
                $('select[name="'+ key +'"],input[type="text"][name="'+ key +'"],input[type="password"][name="'+ key +'"],input[type="hidden"][name="'+ key +'"],textarea[name="'+ key +'"]').val(value);
            }
            // func. unserializeForm
        }

        function htmlDataBoxClick(pEvent){
            // Слово имеет уже правило, нужно показать окно
            if ( $(pEvent.target).hasClass('ruleOsn') ){
                // Очищаем выделнные
                clearSelected();
                selectedBuff = [wordRelCurrentSelect];
                selectedBuff = selectedBuff.concat(wordOsnList, wordSecondList);
                // Отображение формы Установка правил
                setRuleBtnClick();
                // Установка ранее выбранных правил в элементы формы
                setRuleField();
            }else
            // Выделение слова
            if ( $(pEvent.target).hasClass('word') ){
                wordClick(pEvent.target);
            }else
            // Выделение предложения
            if ( $(pEvent.target).hasClass('sentence') ){
                console.log('sentence');
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
            for( var i in selectedBuff ){
                var rel = selectedBuff[i];
                var name = $(options.htmlDataBox + ' span.word[rel='+rel+']:first').html();
                htmlTmpBuff += '<tr><td>'+name+'</td>'
                        +'<td><input type="radio" name="w'+rel+'" value="osn"/></td>'
                        +'<td><input type="radio" name="w'+rel+'" value="scn"/></td>'
                        +'</tr>';
            } // for



            $(options.tabsType +' table>tbody').html(htmlTmpBuff);
            $.fancybox.open([{
                href: '#ruleDlg',
                width: 500,
                height: 300,
                autoSize: false
            }]);
            // func. setRuleBtnClick
        }

        function classWordChange(event){
            var val = event.target.value;
            $('#tabs-dynamic').html($('#'+val+'AdvBox').html());
            // func. classWordChange
        }

        function cbSaveDataSuccess(pData){
            if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }

            alert('Данные успешно сохранены');
            // func. cbSaveDataSuccess
        }

        /**
         * Сохраняем заполненые правила на сервер
         */
        function saveRuleBntClick(){
            var ruleData = {};
            var serialArr = $('#ruleDlg').serializeArray();
            var relOsn = selectedBuff[0];

            var osnWordId = '';
            var secondWordId = '';
            for( var i in serialArr ){
                var name = serialArr[i].name;
                ruleData[name] = serialArr[i].value;
                // Если это первая буква 'w' и вторая часть число, то это ID слова
                if ( name.substr(0, 1) == 'w' && !isNaN(name.substr(1)-0) ){
                    switch(serialArr[i].value){
                        case 'osn':
                            osnWordId += ','+name.substr(1);
                            wordListLink[parseInt(name.substr(1))] = relOsn;
                            break;
                        case 'scn':
                            secondWordId += ','+name.substr(1);
                            break;
                    } // switch
                } // if
            } // for

            osnWordId = osnWordId.substr(1);
            secondWordId = secondWordId.substr(1);

            var data2jsonStr = JSON.stringify(ruleData);

            engartData.wordList[relOsn] = {
                data: data2jsonStr,
                osnWordId: osnWordId,
                secondWordId: secondWordId
            };
            console.log(engartData.wordList[relOsn], relOsn);

            $.fancybox.close();
            HAjax.saveData({
                data: 'json='+data2jsonStr,
                methodType: 'POST'
            });
            clearSelected();

            // func. saveRuleBntClick
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
                // Получаем список номер основных слов слов
                var osnWordIdArr = engartData.wordList[wordId].osnWordId.split(',');
                // Указываем для каждого основного слова, его базовое слово
                for(var i in osnWordIdArr){
                    wordListLink[osnWordIdArr[i]] = wordId;
                } // for

            } // for
            // func. initWordList
        }

        function rmRuleBtnClick(){

            // func. rmRuleBtnClick
        }

        function init(pOptions){
            options = pOptions;

            HAjax.create({
                saveData: cbSaveDataSuccess
            });

            initWordList();

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
            // Сохранение результата
            $(options.saveRuleBnt).click(saveRuleBntClick);
            // Закрытие окна правил
            $(options.cancelRuleBtn).click(cancelRuleBtnClick);

            // func. init
        }

        return {
            init: init
        }
    })();

    $(document).ready(function(){
        engartMvc.init({
            htmlDataBox: '#htmlDataBox',
            setRuleBtn: '#setRuleBtn',
            clearSelectedBtn: '#clearSelectedBtn',
            tabsType: '#tabs-type',
            tabsBox: '#tabs',
            classWord: '#classWord',
            saveRuleBnt: '#saveRuleBnt',
            cancelRuleBtn: '#cancelRuleBtn',
            rmRuleBtn: '#rmRuleBtn'
        });
    }); // $(document).ready

</script>