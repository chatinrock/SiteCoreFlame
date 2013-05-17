<?php

namespace site\core\site\comp\spl\objItem\logic;

// Conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\dbus;
use core\classes\render;
use core\classes\word;
use core\classes\userUtils;
use core\classes\filesystem;
use core\classes\site\dir as sitePath;

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Description of main
 *
 * @author Козленко В.Л.
 */
class peopleDescrip {

    public static $urlTplList = [
        'category' => null
    ];

    public static function init($pName) {
        $comp = dbus::$comp[$pName];
        $compId = $comp['compId'];

        if (!isset($comp['varName'])) {
            $contId = $comp['contId'];
        } else {
            $contId = dbus::$vars[$comp['varName']]['id'];
        }

        $isCompGetDatainVar = isset($comp['varTableName']);

        // Если есть varTableName, то это статья получает данные из переменной
        if ($isCompGetDatainVar) {
            $tableId = dbus::$vars[$comp['varTableName']]['id'];
        } else {
            // Если varTableName нет, то статья установленна статически
            $tableId = $comp['tableId'];
        }

        $idSplit = word::idToSplit($tableId);
        $dir = DIR::APP_DATA . 'comp/' . $compId . '/' . $contId . '/' . $idSplit;

        // Настроки статьи
        //$infoData = ;

 //       $infoData = unserialize($infoData);
       dbus::$comp[$pName]['data'] = filesystem::loadFileContentUnSerialize($dir . 'data.txt');
       dbus::$comp[$pName]['dir'] = $dir;
       dbus::$comp[$pName]['idPath'] = $compId . '/' . $contId . '/' . $idSplit;

        // func. init
    }

    /**
     * Отображение отзывов.
     * @param type $pName
     */
    public static function renderAction($pName) {
        $comp = dbus::$comp[$pName];
        $compId = $comp['compId'];
        $contId = $comp['contId'];

        $varData = dbus::$vars[$comp['varTableName']];


        // Получаем шаблон для статьи
        $tpl = userUtils::getCompTpl($comp);

        // Директорию, где храняться шаблоны компонента
        // Кастомный ли это шаблон или нет
        $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);
        $render = new render($tplPath, '');

        $render->setMainTpl($tpl)
            ->setVar('dir', $comp['dir'])
            ->setVar('infoData', $comp['data'])
            ->setVar('idPath', $comp['idPath'])
            ->setContentType(null)
            ->render();
        // func. renderAction
    }

    // class. main
}