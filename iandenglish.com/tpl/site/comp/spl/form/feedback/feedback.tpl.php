<h4>Ваше сообщение очень важно для нас!</h4>
<p>Здравствуйте! <strong>Меня зовут Влад</strong>, я занимаюсь поддержкой пользователей.
    Для более быстрого ответа, пожалуйста, заполните ваше имя, обратный адрес электронной почты.
    Выберите тему сообщения, чтобы я знал кому переадресовать данное сообщение.
    Напишите сообщение, далее нажмите на кнопку отправить.
    Я постараюсь ответить сразу же, после получения сообщения. <strong>Я буду рад вам помочь!</strong>
</p>
<div>
	<ul class="contactList">
		<li class="skype"><a href="skype:<?=self::tplVarible('skype');?>?call"><?=self::tplVarible('skype');?></a></li>
		<li class="icq"><?=self::tplVarible('icq');?></li>
		<li class="email"><a href="mailto:<?=self::tplVarible('email');?>" title="Нажмите, что бы отправить письмо"><?=self::tplVarible('email');?></a></li>
	</ul>

    <ul class="contactList">
        <li class="vkontakte"><a href="<?=self::tplVarible('vkUrl');?>" target="_blank" rel="nofollow" title="Наша страница Вконтакте"><?=self::tplVarible('vkUrl');?></a></li>
        <li class="facebook"><a href="<?=self::tplVarible('fbUrl');?>" target="_blank" rel="nofollow" title="Наша страница Facebook"><?=self::tplVarible('fbUrl');?></a></li>
        <li class="twitter"><a href="<?=self::tplVarible('twitterUrl');?>" target="_blank" rel="nofollow" title="Наша страница Twitter"><?=self::tplVarible('twitterUrl');?></a></li>
    </ul>
    <div class="clear"></div>
</div>

<h4>Онлайн форма связи</h4>
<div class="box hidden" id="eventBox"></div>
<div class="contactFormBorder">
    <div class="contactWrap">
        <form class="contactForm" id="contactForm">
            <p>
                <label>Ваше имя: </label>
                <input type="text" value="" name="feedback[name]" class="nameInput" title="Напишите Ваше имя">
            </p
            <p>
                <label>Ваш Email: </label>
                <input type="text" name="feedback[email]" value="" class="emailInput" title="Напишите Ваш Email">
            </p>
            <p>
                <label>Тема сообщения: </label>
                <select name="feedback[title]" class="selectInput" value="Выберите тему сообщения">
                    <option>Захотелось написать</option>
                    <option>Финансовый вопрос</option>
                    <option>Ошибка в сервисе</option>
                    <option>Преподаватель не вышел на связь</option>
                    <option>Не могу авторизоваться</option>
                    <option>Партнёрство</option>
                    <option>У меня есть гениальная идея для вас!</option>
                    <option>Другое</option>
                </select>
            </p>
            <p>
                <label>Сообщение: </label>
                <textarea class="messageInput" title="Напишите Ваше сообщение" name="feedback[msg]"></textarea>
            </p>
            <p>
                <input type="submit" value="Отправить сообщение" title="Нажмите на кнопку, чтобы отправить сообщение" class="button blue">
            </p>
        </form>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript" src="/res/comp/spl/form/feedback/js/feedback.js?v=1"></script>