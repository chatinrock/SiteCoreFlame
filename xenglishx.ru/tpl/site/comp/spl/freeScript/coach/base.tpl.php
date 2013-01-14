<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jQueryUI/datepicker/style/grey/css/datepicker.css?v=1">
<!-- Перевод календаря -->
<script src="http://theme.codecampus.ru/plugin/jQueryUI/datepicker/js/jquery.ui.datepicker-ru.min.js"></script>

<link rel="stylesheet" href="/res/comp/spl/freeScript/css/coach.css?v=1">

<div class="box error hidden" id="errorBox"></div>
<div class="box success hidden" id="successBox"></div>
<div class="box information hidden" id="informationBox"></div>

<div id="timeStatusBox" class="hidden">
    <h3>Статус общения</h3>
    <div style="height:10px;" class="hr"></div>
    <p>Репетитор ожидает вас в <span id="waitTime" class="strong"></span>. Skype репетитора: xxxxx</p>
    <div><a href="#confirmRemoveBox" id="cancelTimeBtn" class="button orange medium">Отменить встречу</a></div>
</div>

<div id="chouseTimeBox" class="hidden">
    <h3>Выбирите время для разговора:</h3>

    <div style="height:20px;" class="hr"></div>

    <div class="childLeft">
        <div>
            <div id="datepicker"></div>
            <div><a href="#confirmBox" id="selectBtn" class="button tiny orange" title="Нажмите, что бы забронировать время">Сохранить</a></div>
        </div>
        <div class="lightTable" id="timePanel">
            <table id="timeBox">
                <thead>
                    <th>12-13</th>
                    <th>14-15</th>
                    <th>16-17</th>
                    <th>18-19</th>
                </thead>
                <tbody>
                    <tr><td title="Свободно" id="time1200">12:00<input name="time" value="12:00" type="radio"></td><td title="Свободно" id="time1400">14:00<input name="time" value="14:00" type="radio"></td><td title="Свободно" id="time1600">16:00<input name="time" value="16:00" type="radio"></td><td title="Свободно" id="time1800">18:00<input name="time" value="18:00" type="radio"></td></tr><tr><td title="Свободно" id="time1215">12:15<input name="time" value="12:15" type="radio"></td><td title="Свободно" id="time1415">14:15<input name="time" value="14:15" type="radio"></td><td title="Свободно" id="time1615">16:15<input name="time" value="16:15" type="radio"></td><td title="Свободно" id="time1815">18:15<input name="time" value="18:15" type="radio"></td></tr><tr><td title="Свободно" id="time1230">12:30<input name="time" value="12:30" type="radio"></td><td title="Свободно" id="time1430">14:30<input name="time" value="14:30" type="radio"></td><td title="Свободно" id="time1630">16:30<input name="time" value="16:30" type="radio"></td><td title="Свободно" id="time1830">18:30<input name="time" value="18:30" type="radio"></td></tr><tr><td title="Свободно" id="time1245">12:45<input name="time" value="12:45" type="radio"></td><td title="Свободно" id="time1445">14:45<input name="time" value="14:45" type="radio"></td><td title="Свободно" id="time1645">16:45<input name="time" value="16:45" type="radio"></td><td title="Свободно" id="time1845">18:45<input name="time" value="18:45" type="radio"></td></tr><tr><td title="Свободно" id="time1300">13:00<input name="time" value="13:00" type="radio"></td><td title="Свободно" id="time1500">15:00<input name="time" value="15:00" type="radio"></td><td title="Свободно" id="time1700">17:00<input name="time" value="17:00" type="radio"></td><td title="Свободно" id="time1900">19:00<input name="time" value="19:00" type="radio"></td></tr><tr><td title="Свободно" id="time1315">13:15<input name="time" value="13:15" type="radio"></td><td title="Свободно" id="time1515">15:15<input name="time" value="15:15" type="radio"></td><td title="Свободно" id="time1715">17:15<input name="time" value="17:15" type="radio"></td><td title="Свободно" id="time1915">19:15<input name="time" value="19:15" type="radio"></td></tr><tr><td title="Свободно" id="time1330">13:30<input name="time" value="13:30" type="radio"></td><td title="Свободно" id="time1530">15:30<input name="time" value="15:30" type="radio"></td><td title="Свободно" id="time1730">17:30<input name="time" value="17:30" type="radio"></td><td title="Свободно" id="time1930">19:30<input name="time" value="19:30" type="radio"></td></tr><tr><td title="Свободно" id="time1345">13:45<input name="time" value="13:45" type="radio"></td><td title="Свободно" id="time1545">15:45<input name="time" value="15:45" type="radio"></td><td title="Свободно" id="time1745">17:45<input name="time" value="17:45" type="radio"></td><td title="Свободно" id="time1945">19:45<input name="time" value="19:45" type="radio"></td></tr>
                </tbody>
            </table>
            <div id="preload" title="Загрузка"></div>
        </div>
    </div>

    <div class="clear"></div>

    <div style="height:10px;" class="hr"></div>
    <h3>Стоимость:</h3>
    <p>Стоимость <strong>общения/корректировки с репетитором</strong>, составляет всего <span class="grey" id="priceText"></span> руб. за 20 минут.</p>

</div> <!-- <div id="chouseTimeBox"> -->

<div id="confirmBox" class="hidden">
    <h3>Подтвердите выбранное время</h3>
    <div class="box information">Вы выбрали: <br/><span class="strong date">23.02.12</span> в <span class="strong time">12:24</span></div>
    <p>Внимание: При отмене заявки менее, чем за 24 часа, возвращаеться 50% оплаты, более чем за 24 часа возвращается полная оплата</p>
    <div style="text-align: center;"><a href="#confirm" id="confirmBtn" class="button tiny orange">Все правильно. Сохранить</a></div>
</div>

<div id="confirmRemoveBox" class="hidden">
    <h3>Подтвердите отмену</h3>
    <div class="box information">Вы собираетесь отменить встречу?</div>
    <p>Внимание: При отмене заявки менее, чем за 24 часа, возвращаеться 50% оплаты, более чем за 24 часа возвращается полная оплата</p>
    <div style="text-align: center;"><a href="#confirmRemove" id="confirmRemoveBtn" class="button tiny orange">Да.Все правильно</a></div>
</div>

<script>
    if ( !jQuery.lightbox ){
        document.write('<script src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js" type="text/javascript"><\/script>\
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />\
<!--[if IE 6]>\
    <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />\
<![endif]-->');
    }
    var timeData = {
        // Коррекция с временем сервера
        time: Math.round((new Date).getTime()/1000-<?=self::get('timeServer')?>),
        speakTime: <?=self::get('speakTime')?>,
        isBalance: <?=self::get('isBalance')?'true':'false'?>,
        userData: <?=self::get('userData', '{}')?>
    }
</script>
<script type="text/javascript" src="/res/comp/spl/freeScript/js/coach.js"></script>