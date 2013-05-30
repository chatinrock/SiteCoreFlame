<script src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->


<script>
    yepnope({
        load: ['http://theme.codecampus.ru/plugin/payment/walletone.com/payMvc.js']
    });

</script>

<h4>Логин: <?=self::get('login')?></h4>
<h5>Балланс</h5>
<p>
    <div>Ваш балланс состовляет: <strong><?=self::get('balance')?> руб.</strong></div>
    <div style="margin-top: 10px"></div>

    <div>
        <a href="/res/form/payAuth.html?lightbox[width]=320&lightbox[height]=180&lightbox[iframe]=true" class="button bright-green medium lightbox" title="Нажмите, чтобы пополнить баланс">&raquo; Пополнить баланс</a>
        <a href="/webcore/func/utils/ajax/?name=user&act=billhistory&lightbox[width]=600&lightbox[height]=480" class="button blue medium lightbox" title="Нажмите, чтобы посмотреть историю операций">&raquo; История операций</a>
    </div>
</p>

<h5>Установить новый пароль</h5>
<div id="pwdErrorBox" class="box error hidden">Неверно введён старый пароль</div>
<?if ( self::get('cstatus') == 'ok' ){?>
<div class="box success">Пароль успешно изменён</div>
<?}else
if ( self::get('cstatus') == 'badold' ){?>
    <script type="text/javascript">jQuery('#pwdErrorBox').show()</script>
<?}?>
<div>
    <form id="pwdForm" class="pwdForm" action="/user/?type=newpwd" method="POST">
        <p>
            <label>Старый пароль: </label>
            <input type="password" name="oldpwd" value="" title="Введите старый пароль" class="webInput pwdInput"/>
        </p>
        <p>
            <label>Новый пароль: </label>
            <input type="password" name="newpwd" value="" title="Введите новый пароль" class="webInput pwdInput"/>
        </p>
        <p>
            <input type="submit" value="Сменить пароль" class="button blue submitBtn" title="Нажмите, чтобы изменить ваш пароль"/>
        </p>
    </form>
</div>
<script type="text/javascript" src="/res/comp/spl/freeScript/js/userpwd.js"></script>


