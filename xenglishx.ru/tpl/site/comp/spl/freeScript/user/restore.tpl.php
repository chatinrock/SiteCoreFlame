<h4>Введите новый пароль</h4>
<div id="wrongLoginBox" class="box error hidden">Длина пароля должна быть больше 4 символов</div>
<div>
    <form id="newPwdForm" class="newPwdForm" method="POST" action="/user/?type=restore&email=<?=self::get('email')?>&code=<?=self::get('code')?>">
        <label>Новый пароль: </label>
        <input type="password" name="pwd" value="" title="Введите новый пароль" class="webInput pwdInput"/>
        <input type="submit" value="Сменить пароль" class="button white medium submitBtn" title="Нажмите, что бы изменить ваш пароль"/>
    </form>
</div>
<script type="text/javascript" src="/res/comp/spl/freeScript/js/pwdrestore.js"></script>