<?php

namespace site\conf;

class DIR {
// ================= Ресурсы
    /** Путь для хранения данных компонентов @var string */
    const APP_DATA = '/opt/www/SiteCoreFlame/probookshelf.ru/data/';
    // Путь для хранения оригиналов файлов
    const FILE_UPLOAD_DATA = '/opt/www/SiteCoreFlame/probookshelf.ru/www/res/file/source/';
    // Директория, куда сохранять маштабированные изображений для direct access
    const IMG_RESIZE_DATA = '/opt/www/SiteCoreFlame/probookshelf.ru/www/res/file/resize/';
	const TPL = '/opt/www/SiteCoreFlame/theme-tpl/fusion/';

// ================= URL для ресурсов
    // Для получения маштабированных изображений для direct access
    const URL_IMG_RESIZE_PUBLIC = 'http://probookshelf.ru/res/file/resize/';
    // URL для получения исходных файлов,доступных снаружи
    const URL_FILE_DIST = 'http://probookshelf.ru/res/file/source/';
    // URL до ресурсов сайта
    const SITE_RES_URL = 'http://probookshelf.ru/res/';

    // Папка где храняться скрипты для внешнего доступа
    //const SITE_ROOT = '/opt/www/SiteCoreFlame/probookshelf.ru/www/';

// ================= Nginx
    // Конфиг для логов Nginx
    const SITE_NGINX_LOG = '/opt/nginx-1.2.0/logs/nlogs/probookshelf.ru/';

// ================= Скрипты
    // Папка с общий библиотекой
    const CORE = '/opt/www/FlameCore/engine/';
    // Папка с ядром сайта
    const SITE_CORE = '/opt/www/SiteCoreFlame/probookshelf.ru/';
}

?>