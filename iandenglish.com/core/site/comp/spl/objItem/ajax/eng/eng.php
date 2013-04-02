<?php

namespace site\core\site\comp\spl\objItem\ajax\eng;

// Core
use core\classes\request;
use core\classes\filesystem;
use core\classes\word;

// Site Core
use \site\core\site\comp\spl\objItem\model\common;

// Conf
use \site\conf\DIR as DIR_SITE;
use \site\conf\SITE as SITE_SITE;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use ORM\users as usersOrm;

class eng{

    /*private function _getSentVipPath($pId, $objId){
        return (new engsentOrm())->get('path', ['objItemId'=>$objId, 'sentId'=>$pId]);
        // func. _getSentVipFile
    }

    private function _getWordVipPath($pId, $objId){
        return (new engwordOrm())->get('path', ['objItemId'=>$objId, 'wordId'=>$pId]);
        // func. _getSentVipFile
    }*/

    /**
     * Основной метод. Вызывается из файла в папке<br/>
     * /{Core path}/SiteCoreFlame/{Sitename}/data/utils/ajax
     * @param $pCompId ID компонента
     * @param $pData Данные указанные при настройке Ajax
     */
    public function echoArticle($pCompId, $pData){
        header('Content-Type: text/html; charset=UTF-8');
	    $type = request::get('type');
        // Получем путь для файла
        $path = request::get('path');
        // Обрабатываем путь на правильность. Разрешены только цифры в пути
        if ( !preg_match('/^\d+(\/\d+)+$/', $path)){
            die('Bad var path');
        }

        switch($type){
            case 'word':
                $id = request::getInt('id');
                $prefWordId = word::idToSplit($id);
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/word/'.$prefWordId.'word.html';
                break;
            case 'sent':
                $id = request::getInt('id');
                $prefWordId = word::idToSplit($id);
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/sent/'.$prefWordId.'sent.html';
                break;
            // Получаение VIP правила
            case 'vip':
                $id = request::getInt('id');
                $obj = request::get('obj') == 'sent' ? 'sent' : 'word';
                //$objId = request::get('objid');

                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/count.txt';
                $countData = @filesystem::loadFileContentUnSerialize($file);
                if ( !$countData){
                    die('Bad count data');
                }

                $isFree = ( $obj == 'sent' && $countData['sentNum'] * 0.15 >= $id ) || ($countData['wordNum'] * 0.15 >= $id);
                if ( !$isFree ){
                    $userSuccess = common::getUserAccess($_SESSION['userData']);

                    // Авторизован ли пользователь
                    if ( $userSuccess == common::ACCESS_NOT_AUTH ){
                        // Пользователь не авторизован
                        $file = DIR_SITE::SITE_CORE.'tpl/site/other/user/forbid.tpl.php';
                        break;
                    }

                    // Истёк ли срок приватного просмотра?
                    if ($userSuccess == common::ACCESS_SMALL_BALANCE){
                        // Показываем сообщение о недостаточном балансе
                        $file = DIR_SITE::SITE_CORE.'tpl/site/other/user/badbalance.html';
                        break;
                    }
                } // if (!$isFree)

                /*$path = ( $obj == 'sent' ) ? self::_getSentVipPath($id, $objId) : self::_getWordVipPath($id, 'Id);
                if ( !$path ){
                    die('Bad vip path');
                }

                $prefWordId = word::idToSplit($id);
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/data.txt';*/

                $id = request::getInt('id');
                $prefWordId = word::idToSplit($id);
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/'.$obj.'/'.$prefWordId.'vip.html';
                break;
            default:
                die('Bad type');
        }

        $fr = fopen($file, 'r');
        if ( @fpassthru($fr) ){
            fclose($fr);
        }else{
            die('Bad Id');
        }
        // func. echoArticle
	}
    // class eng
}