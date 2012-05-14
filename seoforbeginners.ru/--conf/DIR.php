<?php

namespace site\conf;

class DIR {
    /** Путь для хранения данных компонентов @var string */
    const APP_DATA = 'W:/hosting/cms.lo/www/sites/english.lo/data/';
    // Папка с ядром сайта
    const SITE_CORE = 'W:/hosting/cms.lo/www/sites/english.lo/';
    // Для получения маштабированных изображений для direct access
    const URL_IMG_RESIZE_PUBLIC = 'http://english.lo/res/file/resize/';
    // URL для получения исходных файлов,доступных снаружи
    const URL_FILE_DIST = 'http://english.lo/res/file/source/';
    // Путь для хранения оригиналов файлов
    const FILE_UPLOAD_DATA = 'W:/hosting/english.lo/www/res/file/source/';
    // Директория, куда сохранять маштабированные изображений для direct access
    const IMG_RESIZE_DATA = 'W:/hosting/english.lo/www/res/file/resize/';
    // Папка где храняться скрипты для внешнего доступа
    const SITE_ROOT = 'W:/hosting/english.lo/www/';
    // URL до ресурсов сайта
    const SITE_RES_URL = 'http://english.lo/res/';
    // Конфиг для логов Nginx
    const SITE_NGINX_LOG = 'W:/hosting/english.lo/nlogs/';
    // Папка с общий библиотекой
    const CORE = 'w:/hosting/cms.lo/www/engine/';
}

?>