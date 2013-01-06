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
        if ( isset($infoData['isPrivate']) && $infoData['isPrivate'] == '1'){

            if ( !dbus::$user ){
                $file = DIR::SITE_CORE.'tpl/site/other/blog/forbid.tpl.php';
                self::_showForbid($file);
                return;
            }

            $isAllow = (boolean)(new usersOrm())->selectFirst('1', 'accessDate >= now() AND id='.dbus::$user['id']);
            if (!$isAllow){
                $file = DIR::SITE_CORE.'tpl/site/other/user/badbalance.html';
                self::_showForbid($file);
                return;
            }

            /*$render = new $render();
            $render->setMainTpl($tpl)
                ->setVar('dir', $comp['dir'])
                ->setVar('infoData', $infoData)
                ->setContentType(null)
                ->render();*/
        }

        parent::renderAction($pName);
    }


    // class article
}