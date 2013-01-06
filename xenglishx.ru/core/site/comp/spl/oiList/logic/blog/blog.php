<?php

namespace site\core\site\comp\spl\oiList\logic\blog;

// conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\word;
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;

/**
 * Description of article
 *
 * @author Козленко В.Л.
 */
class blog extends \core\comp\spl\oiList\logic\blog{

    public static function renderByOneAction($pName) {

        /*if ( !dbus::$user ){
            $file = DIR::SITE_CORE.'tpl/site/other/blog/forbid.tpl.php';
            self::_showForbid($file);
            return;
        }

        $isAllow = (boolean)(new usersOrm())->selectFirst('1', 'accessDate >= now() AND id='.dbus::$user['id']);
        if (!$isAllow){
            $file = DIR::SITE_CORE.'tpl/site/other/user/badbalance.html';
            self::_showForbid($file);
            return;
        }*/

        parent::renderByOneAction($pName);
        // func. renderByOneAction
    }

    public static function renderByCategoryAction($pName){
       parent::renderByCategoryAction($pName);
       // func. renderByCategoryAction
    }

}