<!--<div class="fullWidth">
    <h2>Лин</h2>
    <div></div>
</div>
<div class="clear"></div>
<div class="hrWrap">
    <div style="height:20px;" class="horizontalRule"></div>
    <div style="margin-top:4px;float:right;" class="backToTop"><a href="#" class="backToTop">Наверх</a></div>
    <div class="clear"></div>
    <div style="height:20px;" class="hr"></div>
</div>-->

<h3>Личный кабинет</h3>
<div style="height:20px;" class="hr"></div>

<h4>Балланс</h4>
<p>
    <div>Ваш балланс состовляет: 6820 руб.</div>
    <div><a href="/user/?type=billhistory" title="Открыть историю операций по вашему счету">&raquo; История операций</a></div>
</p>

<div class="clear"></div>
<div class="hrWrap">
    <div style="height:5px;" class="horizontalRule"></div>
    <div style="height:20px;" class="hr"></div>
</div>


<h4>Установить новый пароль</h4>
<div id="pwdErrorBox" class="box error hidden">Неверно введён старый пароль</div>
<?if ( self::get('cstatus') == 'ok' ){?>
<div class="box success">Пароль успешно изменён</div>
<?}else
if ( self::get('cstatus') == 'badold' ){?>
    <script type="text/javascript">jQuery('#pwdErrorBox').show()</script>
<?}?>
<div>
    <form id="pwdForm" class="pwdForm" action="/user/?type=newpwd" method="POST">
        <label>Старый пароль: </label>
        <input type="password" name="oldpwd" value="" title="Введите старый пароль" class="webInput pwdInput"/>
        <label>Новый пароль: </label>
        <input type="password" name="newpwd" value="" title="Введите новый пароль" class="webInput pwdInput"/>
        <input type="submit" value="Сменить пароль" class="button white medium submitBtn" title="Нажмите, что бы изменить ваш пароль"/>
    </form>
</div>
<script type="text/javascript" src="/res/comp/spl/freeScript/js/userpwd.js"></script>