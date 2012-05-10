<?php

namespace site\conf;

class DIR {
    /** Путь для хранения данных компонентов @var string */
    const APP_DATA = '/home/www/SiteCoreFlame/seoforbeginners.ru/data/';
    // Папка с ядром сайта
    const SITE_CORE = '/home/www/SiteCoreFlame/seoforbeginners.ru/';
    // Для получения маштабированных изображений для direct access
    const URL_IMG_RESIZE_PUBLIC = 'http://seoforbeginners.ru/res/file/resize/';
    // URL для получения исходных файлов,доступных снаружи
    const URL_FILE_DIST = 'http://seoforbeginners.ru/res/file/source/';
    // Путь для хранения оригиналов файлов
    const FILE_UPLOAD_DATA = '/home/www/SiteCoreFlame/seoforbeginners.ru/www/res/file/source/';
    // Директория, куда сохранять маштабированные изображений для direct access
    const IMG_RESIZE_DATA = '/home/www/SiteCoreFlame/seoforbeginners.ru/www/res/file/resize/';
    // Папка где храняться скрипты для внешнего доступа
    const SITE_ROOT = '/home/www/SiteCoreFlame/seoforbeginners.ru/www/';
    // URL до ресурсов сайта
    const SITE_RES_URL = 'http://seoforbeginners.ru/res/';
    // Конфиг для логов Nginx
    const SITE_NGINX_LOG = '/var/log/www/seoforbeginners.ru/';
    // Папка с общий библиотекой
    const CORE = '/home/www/FlameCore/engine/';
}

?>