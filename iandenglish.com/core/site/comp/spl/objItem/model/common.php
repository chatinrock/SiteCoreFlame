<?php

namespace site\core\site\comp\spl\objItem\model;

// conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\word;
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;

use ORM\users as usersOrm;

/**
 * Общие функции
 *
 * @author Козленко В.Л.
 */
class common {
    const ACCESS_NOT_AUTH = 1;
    const ACCESS_SMALL_BALANCE = 2;
    const ACCESS_SUCCESS = 3;

    public static function getUserAccess($user){
        if ( !$user ){
            return self::ACCESS_NOT_AUTH;
        }

        // Проверем по числу, не истёк ли срок приватного просмотра
        $isAllow = (boolean)(new usersOrm())->selectFirst('1', 'balance > 0 AND id='.$user['id']);
        if (!$isAllow){
            return self::ACCESS_SMALL_BALANCE;
        } // if !$isAllow

        return self::ACCESS_SUCCESS;
        // func. getUserAccess
    }

    // class common
}