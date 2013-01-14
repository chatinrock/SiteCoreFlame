<?php
namespace site\core\site\comp\spl\freeScript\ajax;

// Core
use core\classes\request;
use core\classes\filesystem;
use core\classes\render;

// Conf
use \site\conf\DIR as DIR_SITE;
use \site\conf\SITE as SITE_SITE;
use \site\conf\PRICE;

// ORM
use site\core\admin\comp\spl\freeScript\ORM\userBillHistory;
use ORM\users as usersOrm;
use site\core\admin\comp\spl\freeScript\ORM\userSpeakTime;

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
            case 'speakdate':
                self::_speakdate();
                break;
            case 'gettimedata':
                self::_gettimedata();
                break;
            case 'canceltime':
                self::_canceltime();
                break;
        } // switch

        // func. action
    }

    /**
     * Отмена заявки на день
     */
    private function _canceltime(){
        if ( !request::isPost() || !isset($_SESSION['userData'])){
            return;
        }
        header('Content-Type: application/json');
        $userId = $_SESSION['userData']['id'];

        try{
            $usersOrm = new usersOrm();
            $sum =
            /**
             * SELECT date_add(now(), INTERVAL 24 HOUR) < t.speakTime is24, t.speakTime, t.billhistid
             * FROM pr_users t
             * WHERE t.id = 9
             */
            $userData = $usersOrm->selectFirst('date_add(now(), INTERVAL 24 HOUR) < speakTime is24, billhistid', 'id='.$userId);
            // Если заявки нет, то и нечего отменять
            if ( !$userData['billhistid'] ){
                die(json_encode(['status' => 2, 'msg' => 'Нечего отменять']));
                return;
            }

            // Больше или равно 24 от момента заявки
            if ( $userData['is24'] ){
                // Больше, пользователю возвращает все деньги
                // Удаляем из истории заявку
                (new userBillHistory())->update('sum=0', 'id='.$userData['billhistid']);
                $fineSum = 0;//PRICE::SPEAK;
            }else{
                // меньше, пользователю возвращает часть денег
                $fineSum = PRICE::SPEAK * PRICE::FINE;
                (new userBillHistory())->update('sum=-'.$fineSum.', type="speakfine"', 'id='.$userData['billhistid']);
            } // if

            $sql = 'update pr_users u
                    left join  ct_user_speaktime us on u.id = us.userId and u.speakTime = us.speakTime
                    set u.speakTime = null, us.cancelTime = now(), u.billhistid=null, u.balance = u.balance + '.(PRICE::SPEAK - $fineSum).'
                    where u.id='.$userId;
            $usersOrm->sql($sql)->comment(__METHOD__)->query();

        }catch(\Exception $ex){
            die(json_encode(['status' => 1, 'msg' => $ex->getMessage()]));
        }

        echo json_encode(['status'=>0]);
        exit;
        // func. _canceltime
    }

    /**
     * Возвращаем дни которые заняты
     */
    private function _gettimedata(){
        if ( !isset($_SESSION['userData'])){
            return;
        }
        header('Content-Type: application/json');
        $date = request::get('date');
        $date = \DateTime::createFromFormat('j.n.Y', $date);
        if ( !$date ){
            die(json_encode(['status' => 2, 'msg' => 'Неверный формат даты']));
        }
        $date = $date->getTimestamp();
        $dbDate = date('Y-m-d', $date);
        try{
            /*
             * SELECT date_format(t.speakTime, "%H%i") `time`
             * FROM ct_user_speaktime t
             * WHERE t.speakTime >= "2013-01-18" AND t.speakTime < date_add("2013-01-18", INTERVAL 1 DAY)  AND t.cancelTime is null
             */
            $where = 'speakTime >= "'.$dbDate .'" AND speakTime < date_add("'.$dbDate .'", INTERVAL 1 DAY)  AND cancelTime is null';
            $list = (new userSpeakTime())->selectList('date_format(speakTime, "%H%i") `time`', 'time', $where);
            echo json_encode(['status'=>0, 'list'=>$list]);
            exit;
        }catch(\Exception $ex){
            die(json_encode(['status' => 1, 'msg' => $ex->getMessage()]));
        }
        // func. _gettimedata
    }

    /**
     * Занимаем день для пользователя
     */
    private function _speakdate(){
        if ( !isset($_SESSION['userData'])){
            return;
        }
        header('Content-Type: application/json');

        $userId = $_SESSION['userData']['id'];

        //ini_set('display_errors', 1);
        //ini_set('error_reporting',E_ALL );

        try{

            $usersOrm = new usersOrm();
            $userData = $usersOrm->selectFirst('UNIX_TIMESTAMP(speakTime) speakTime, balance', 'id='.$userId);
            if ( $userData['speakTime'] > time()){
                die(json_encode(['status' => 1, 'msg' => 'Вами уже назначено время разговора']));
            }

            if ( $userData['balance'] < PRICE::SPEAK ){
                die(json_encode(['status' => 'nomoney',
                                'msg' => 'Недостаточно средств на балансе для заявки',
                                'balance' => $userData['balance'],
                                'price' => PRICE::SPEAK]));
                exit;
            }

            $date = request::post('date');
            $date = \DateTime::createFromFormat('j.n.Y H:i', $date);
            if ( !$date ){
                die(json_encode(['status' => 2, 'msg' => 'Неверный формат даты']));
            }

            $date = $date->getTimestamp();
            $dbDate = date('Y-m-d H:i:s', $date);

            $userSpeakTime = new userSpeakTime();

            if ( $userSpeakTime->selectFirst('1', 'speakTime="'.$dbDate.'" AND cancelTime is NULL') ){
                die(json_encode(['status' => 3, 'msg' => 'Кто-то уже сейчас занял это время']));
            }

            $userSpeakTime->insert(['userId'=>$userId, 'speakTime'=>$dbDate]);

            $userBillHistory = new userBillHistory();
            $userBillHistory->insert(['userId'=>$userId, 'sum'=> -PRICE::SPEAK, 'type'=>'speak']);
            $billHistoryId = $userBillHistory->insertId();

            $usersOrm->update('speakTime="'.$dbDate.'", billhistid='.$billHistoryId.', balance = balance - '.PRICE::SPEAK, 'id='.$userId);
        }catch(\Exception $ex){
            die(json_encode(['status' => 4, 'msg' => $ex->getMessage()]));
        }

        echo json_encode(['status' => 0]);
        exit;
        // func. _speakdate
    }


    /**
     * Возвращаем историю по операциям
     */
    private static function _billhistory(){
        if ( !isset($_SESSION['userData'])){
            return;
        }
        $types = ['income' => 'Пополнение', 'renta' => 'Приват. доступ', 'speak'=>'Общение с препод.', 'speakfine'=>'Отмена менее чем за 24'];

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