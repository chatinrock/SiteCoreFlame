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
                $path = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/'.$obj.'/'.$prefWordId;

                //echo '<div id="#vipVoice"></div><script>engMvc.setVipVoice('. (@file_get_contents($path.'vip.json')?:'{}').');</script>';

                //header('Content-Type: javascript/json');
                //echo json_encode($data);
                self::printVipData($path);

                exit;
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


    function printVipData($path){
        $vipData = (@json_decode(file_get_contents($path.'vip.json'))?:'');

        echo <<<EOD
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
    <head>
      <meta charset="UTF-8" />
      <link rel="shortcut icon" href="/res/icons/favicon.ico" />
      <link href="/res/icons/icon128.png" rel="icon"/>
      <link href="/res/icons/icon128.png" rel="apple-touch-icon-precomposed"/>

      <link rel="stylesheet" type="text/css" media="all" href="http://theme.codecampus.ru/ultrasharp/css/style.css" />
      <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/colors/blue.css" media="screen" />
      <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/shortcodes.css" media="screen" />
      <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/fixed.css" media="screen" />
    </head>
    <body class="empty-body">
EOD;

    if ( $vipData && isset($vipData->voice) && $vipData->voice ){
        echo <<<EOD
         <div id="header">
            <div id="flashBox"></div>
            <div id="playerBox"></div>
        </div>

        <script>var vipVoiceUrl='{$vipData->voice}';</script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
        <script src="http://theme.codecampus.ru/plugin/swfPlayerApi/main.js"></script>
        <link type="text/css" rel="stylesheet" href="/res/comp/spl/objItem/eng/css/main.css"/>
        <link type="text/css" rel="stylesheet" href="http://theme.codecampus.ru/plugin/FancyMusicPlayer_v2.2.1/css/jquery.fancyMusicPlayer-white.css"/>
        <script src="/res/comp/spl/objItem/eng/js/vipPlayer.js"></script>
EOD;
    }

        $file = $path.'vip.html';
        $fr = fopen($file, 'r');
        if ( @fpassthru($fr) ){
            fclose($fr);
        }

        echo '<body></html>';
        // func. printVipData
    }

    // class eng
}