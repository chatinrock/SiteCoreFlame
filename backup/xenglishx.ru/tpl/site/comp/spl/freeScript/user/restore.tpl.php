<h5>Введите новый пароль</h5>
<div id="wrongLoginBox" class="box error hidden">Длина пароля должна быть больше 4 символов</div>
<div>
    <form id="newPwdForm" class="newPwdForm" method="POST" action="/user/?type=restore&email=<?=self::get('email')?>&code=<?=self::get('code')?>">
        <p>
            <label>Новый пароль: </label>
            <input type="password" name="pwd" value="" title="Введите новый пароль" class="webInput pwdInput"/>
        </p>
        <p>
            <input type="submit" value="Сменить пароль" class="button blue" title="Нажмите, что бы изменить ваш пароль"/>
        </p>
    </form>
</div>
<script type="text/javascript" src="/res/comp/spl/freeScript/js/pwdrestore.js"></script>