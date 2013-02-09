<?php

namespace site\core\site\comp\spl\objItem\ajax\eng;

// Core
use core\classes\request;
use core\classes\filesystem;

// Conf
use \site\conf\DIR as DIR_SITE;
use \site\conf\SITE as SITE_SITE;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use ORM\users as usersOrm;

class eng{

    private function _getSentVipPath($pId, $objId){
        return (new engsentOrm())->get('path', ['objItemId'=>$objId, 'sentId'=>$pId]);
        // func. _getSentVipFile
    }

    private function _getWordVipPath($pId, $objId){
        return (new engwordOrm())->get('path', ['objItemId'=>$objId, 'wordId'=>$pId]);
        // func. _getSentVipFile
    }

	public function echoArticle($pCompId, $pData){
        header('Content-Type: text/html; charset=UTF-8');
	    $type = request::get('type');
        $path = request::get('path');
        if ( !preg_match('/^\d+(\/\d+)+$/', $path)){
            die('Bad path');
        }

        switch($type){
            case 'word':
                $id = request::getInt('id');
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/word/'.$id.'.html';
                break;
            case 'vip':
                $id = request::getInt('id');
                $obj = request::get('obj');
                $objId = request::get('objid');
                /**/


                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/count.txt';
                $countData = @filesystem::loadFileContentUnSerialize($file);
                if ( !$countData){
                    die('Bad count data');
                }

                $isFree = ( $obj == 'sent' && $countData['sentNum'] * 0.15 >= $id ) || ($countData['wordNum'] * 0.15 >= $id);
                if ( !$isFree ){
                    if ( !isset($_SESSION['userData']) ){
                        $file = DIR_SITE::SITE_CORE.'tpl/site/other/user/forbid.tpl.php';
                        break;
                    }

                    $isAllow = (boolean)(new usersOrm())->selectFirst('1', 'accessDate >= now() AND id='.$_SESSION['userData']['id']);
                    if (!$isAllow){
                        $file = DIR_SITE::SITE_CORE.'tpl/site/other/user/badbalance.html';
                        break;
                    }
                } // if (!$isFree)

                $path = ( $obj == 'sent' ) ? self::_getSentVipPath($id, $objId) : self::_getWordVipPath($id, $objId);
                if ( !$path ){
                    die('Bad vip path');
                }

                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/data.txt';
                break;
            case 'sent':
                $id = request::getInt('id');
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/sent/'.$id.'.html';
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