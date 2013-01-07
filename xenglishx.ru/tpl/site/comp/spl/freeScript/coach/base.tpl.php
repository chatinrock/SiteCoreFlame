<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jQueryUI/datepicker/style/grey/css/datepicker.css?v=1">
<script src="http://theme.codecampus.ru/plugin/jQueryUI/datepicker/js/jquery.ui.datepicker-ru.min.js"></script>
<h3>Выбирите время для разговора:</h3>
<div style="height:10px;" class="hr"></div>
<div class="box error hidden" id="errorBox"></div>
<div style="height:10px;" class="hr"></div>

    <style>
#preload{
    position: absolute;
    top: 0px;
    left: 0px;
    opacity: 0.8;
    width: 100%;
    height: 100%;
    border: 1px solid #c7c7c7;
    background:#FFFFFF url(http://theme.codecampus.ru/inspired/images/preloader/loader-16.gif) no-repeat center center;
    display: none;
}

#timePanel{
    margin-left: 20px;
    width: 400px;
    position: relative;
}

        #datepicker{
            margin-bottom: 10px;
        }

        #selectBtn{
            width: 198px;
            text-align: center;
        }

    </style>

<div class="childLeft">
    <div>
        <div id="datepicker"></div>
        <div><a href="#confirmBox" id="selectBtn" class="button tiny orange">Выбрать/Сохранить</a></div>
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
                <tr></tr>
            </tbody>
        </table>
        <div id="preload" title="Загрузка"></div>
    </div>
</div>
<div class="clear"></div>

<div id="confirmBox" class="hidden">
    <h3>Подтвердите выбранное время</h3>
    <div class="box information">Вы выбрали: <br/><span class="strong date">23.02.12</span> в <span class="strong time">12:24</span></div>
    <p>Внимание: При отмене заявки менее, чем за 24 часа, возвращаеться 50% оплаты, более чем 24 часа возвращается полная оплата</p>
    <div style="text-align: center;"><a href="#confirm" id="confirmBtn" class="button tiny orange">Все правильно. Сохранить</a></div>
</div>

<script>
    if ( !jQuery.lightbox ){
        document.write('<script src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js" type="text/javascript"><\/script>\
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />\
<!--[if IE 6]>\
    <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />\
<![endif]-->');
    }
</script>
<script type="text/javascript">
    var timeData = {
        // Коррекция с временем сервера
        time: Math.round((new Date).getTime()/1000-<?=self::get('timeServer')?>)
    }

    var timeMvc = (function(){

        function confirmBtnClick(){

            return false;
            // func. confirmBtnClick
        }

        function selectBtnClick(){
            var selectTimeVal = jQuery('#timeBox input[name="time"]:checked').val();
            if ( selectTimeVal == undefined ){
                jQuery('#errorBox').html('Выбирите время').show();
                return false;
            }
            var selectTime = selectTimeVal.split(':');
            selectTime = parseInt(selectTime[0]) * 60 * 60 + parseInt(selectTime[1]) * 60;

            var selectDateVal = jQuery( "#datepicker" ).datepicker( "getDate" );
            if ( selectDateVal == null ){
                jQuery('#errorBox').html('Выбирите дату').show();
                return false;
            }
            var selectDate = selectDateVal.getTime()/1000;
            selectDate += selectTime;

            var timeNow = (new Date()).getTime()/1000 - timeData.time;
            if ( selectDate <= timeNow ){
                jQuery('#errorBox').html('Нельзя выбрать в прошлом').show();
                return false;
            }
            jQuery('#errorBox').hide();


            var date = selectDateVal.getDate();
            date = date < 10 ? '0'+date : date;
            var month = selectDateVal.getMonth()+1;
            date = date + '.' + (month < 10 ? '0'+month : month) + '.'+selectDateVal.getFullYear();

            jQuery('#confirmBox span.date:first').html(date);
            jQuery('#confirmBox span.time:first').html(selectTimeVal);

            jQuery.lightbox('#confirmBox', {
                width: 250,
                height: 250
            });

            return false;
            // func. selectBtnClick
        }

        function init(){
            jQuery('#confirmBtn').click(confirmBtnClick);
            jQuery('#selectBtn').click(selectBtnClick);/*.lightbox({
                width: 250,
                height: 250

            });*/

            var $timeTBodyBox = jQuery('#timeBox tbody:first');
            var timeBegin = 12;
            var flag = true;
            for( var i = 0; i < 60; i+= 15){
                var min = i == 0 ? '00' : i;
                var time1 = (timeBegin)+':'+min;
                var time2 = (timeBegin+2)+':'+min;
                var time3 = (timeBegin+4)+':'+min;
                var time4 = (timeBegin+6)+':'+min;
                $timeTBodyBox.append('<tr>'+
                        '<td id="time'+time1+'">'+time1+'<input type="radio" name="time" value="'+time1+'"/></td>'+
                        '<td id="time'+time2+'">'+time2+'<input type="radio" name="time" value="'+time2+'"/></td>'+
                        '<td id="time'+time3+'">'+time3+'<input type="radio" name="time" value="'+time3+'"/></td>'+
                        '<td id="time'+time4+'">'+time4+'<input type="radio" name="time" value="'+time4+'"/></td>'
                        +'</tr>')
                if ( i == 45 && flag ){
                    ++timeBegin;
                    flag = false;
                    i = -15;
                }
            } // for
            jQuery( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+3M" });
        }
        return{
            init: init
        }
    })();
    jQuery(function() {
        timeMvc.init();
    });

</script>