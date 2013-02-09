<?php

namespace site\core\site\comp\spl\objItem\logic\blog;

// conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\word;
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;

// Site Core
use \site\core\site\comp\spl\objItem\model\common;

// ORM
use ORM\users as usersOrm;

/**
 * Description of article
 *
 * @author Козленко В.Л.
 */
class article extends \core\comp\spl\objItem\logic\article\article{

    private static function _showForbid($file){
        (new render('', ''))->setMainTpl($file)->setContentType(null)->render();
        // func. _showForbid
    }


    public static function renderAction($pName) {
        $comp = dbus::$comp[$pName];
        $infoData = $comp['data'];
        // Если статья имеет статус приватная
        if ( isset($infoData['isPrivate']) && $infoData['isPrivate'] == '1'){

            $userSuccess = common::getUserAccess(dbus::$user);
            // Авторизован ли пользователь
            if ( $userSuccess == common::ACCESS_NOT_AUTH ){
                // Если данных нет, то показывает сообщение о не достаточном доступе
                $file = DIR::SITE_CORE.'tpl/site/other/blog/forbid.tpl.php';
                self::_showForbid($file);
                return;
            }

            // Истёк ли срок приватного просмотра?
            if ($userSuccess == common::ACCESS_SMALL_BALANCE){
                // Показываем сообщение о недостаточном балансе
                $file = DIR::SITE_CORE.'tpl/site/other/user/badbalance.html';
                self::_showForbid($file);
                return;
            } // if !$isAllow
        } // if isset(isPrivate)

        parent::renderAction($pName);
        // func. renderAction
    }


    // class article
}