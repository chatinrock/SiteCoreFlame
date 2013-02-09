<?php

namespace site\conf;

//$language = 'ru';
class SITE {
    /** @var string Тема сайта */
    const THEME_NAME = 'ultrasharp';
    /** @var string Временная зона */
    const TIMEZONE = 'Europe/Moscow';

    const NAME = 'xenglishx.ru';
    const DISPLAY_NAME = 'xENGLISHx.ru';
    // Поля из БД, которые будет помещены в $_SESSION['userData'] и в dbus::$user
    const USER_DATA_FIELD = 'uniq, fio, pwd, id, login';

    const FEEDBACK_EMAIL = 'www.dft@mail.ru';

}