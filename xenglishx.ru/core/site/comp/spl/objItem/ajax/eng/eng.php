<?php

namespace site\core\site\comp\spl\objItem\ajax\eng;

// Core
use core\classes\request;

// Conf
use \site\conf\DIR as DIR_SITE;

class eng{
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
                $file = DIR_SITE::SITE_CORE.'data/comp/'.$path.'/data.txt';
                // TODO: проверить сумму и авторизованность пользователя
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