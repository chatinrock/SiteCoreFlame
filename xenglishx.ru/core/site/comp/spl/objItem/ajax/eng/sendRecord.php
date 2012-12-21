<?php

namespace site\core\site\comp\spl\objItem\ajax\eng;

// Core
use core\classes\request;

// ORM
use site\core\admin\comp\spl\objItem\ORM\userRecord as userRecordOrm;
use site\core\admin\comp\spl\objItem\ORM\voiceRecord as voiceRecordOrm;

// Conf
use \site\conf\DIR as DIR_SITE;

class sendRecord{
	public function saveData($pCompId, $pData){
        header('Content-Type: application/json');

        $text = request::post('text');
        $time = request::postInt('time');
        $userId = request::post('userId');
        $isText = (boolean)trim($time);

        try{
        $userId = (new userRecordOrm())->get('userId', 'userId', ['key'=>$userId]);
        if ( !$userId ){
            die('Bad userId');
        }

        (new voiceRecordOrm())->insert(['userId'=>$userId, 'text'=>$text, 'duration'=>$time, 'isText'=>$isText]);
        }catch(\Exception $ex){
            echo json_encode(['error'=>1, 'msg'=>'Ошибка базы данных']);
            exit;
        }
        // func. echoArticle
	}
    // class eng
}