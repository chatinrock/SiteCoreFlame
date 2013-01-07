<?php
namespace site\core\site\comp\spl\freeScript\ajax;

// Core
use core\classes\request;
use core\classes\filesystem;
use core\classes\render;

// Conf
use \site\conf\DIR as DIR_SITE;
use \site\conf\SITE as SITE_SITE;

// ORM
use site\core\admin\comp\spl\freeScript\ORM\userBillHistory;

class user{

    public function action(){

        if ( !isset($_SESSION['userData'])){
            return;
        }
        //ini_set('display_errors', 1);
        //ini_set('error_reporting',E_ALL );
        $action = request::get('act');
        switch($action){
            case 'billhistory':
                self::_billhistory();
                break;
        } // switch

        // func. action
    }

    private static function _billhistory(){
        $types = ['income' => 'Пополнение', 'renta' => 'Приват. доступ', 'speak'=>'Общение с препод.'];

        $userBillHistoryOrm = new userBillHistory();
        $userId = $_SESSION['userData']['id'];
        $list = $userBillHistoryOrm->select('DATE_FORMAT(dateadd, "%d.%m.%Y") as date, sum, type')
            ->where(['userId'=>$userId], '')
            ->order('id DESC')
            ->limit(20)
            ->fetchAll();
        $iCount = count($list);
        for( $i = 0; $i < $iCount; $i++){
            $type = $list[$i]['type'];
            if ( isset($types[$type])){
                $list[$i]['type'] = $types[$type];
            }else{
                $list[$i]['type'] = 'Другое';
            }
        } // for
        $tpl = DIR_SITE::SITE_CORE.'tpl/site/other/user/billhistory.tpl.php';
        (new render('', ''))->setMainTpl($tpl)->setVar('list', $list)->setContentType(null)->render();
        // func. _billhistory
    }
    // class eng
}