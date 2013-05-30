<?
// Core
use core\classes\request;
use core\classes\DB\DB as DBCore;
use \core\classes\hashkey;

// Conf
use \site\conf\DIR;
use \site\conf\SITE as SITE_SITE;

// ORM
use site\core\admin\comp\spl\freeScript\ORM\userBillHistory;
use ORM\users as usersOrm;

ini_set('display_errors', 1);
error_reporting(E_ALL);

//$data = file_get_contents('data/data.txt');
//$_POST = unserialize($data);

//$data = serialize($_POST);
//file_put_contents('data/data.txt', $data);

$amount = request::postInt('WMI_PAYMENT_AMOUNT');
$login = request::post('login');
$moneyType = request::post('WMI_CURRENCY_ID');
$shopOrderId = request::post('WMI_ORDER_ID');
if ( $moneyType != '643' ){
    die('WMI_RESULT=RETRY&WMI_DESCRIPTION=wrong money code');
}

if (!include DIR::PROJECT_WWW . 'iandenglish.com/conf/SITE.php') {
    die('WMI_RESULT=RETRY&WMI_DESCRIPTION=Conf file site ' . $_SERVER['HTTP_HOST'] . ' not found');
}

if (!isset($_POST["WMI_SIGNATURE"])){
    die('WMI_RESULT=RETRY&WMI_DESCRIPTION=WMI_SIGNATURE not found');
}

if ( hashkey::checkHashKey(SITE_SITE::SHOP_SKEY) != $_POST['WMI_SIGNATURE'] ){
    die('wroing hash code');
}

include '/opt/www/SiteCoreFlame/iandenglish.com/conf/DB.php';
include DIR::CORE . 'core/classes/DB/adapter/mysql/adapter.php';
// Add DB conf param
DBCore::addParam('site', \site\conf\DB::$conf);

include '/opt/www/SiteCoreFlame/iandenglish.com/core/admin/comp/spl/freeScript/ORM/userBillHistory.php';

$userBillHistory = new userBillHistory();
// Проверяем, а не обратывали ли мы этот платёж ранее
$isExits = $userBillHistory->isExists(['shopOrderId'=>$shopOrderId]);
if ( $isExits ){
    //die('WMI_RESULT=OK&WMI_DESCRIPTION=bill exists');
}

$usersOrm = new usersOrm();
// Получаем данные по пользователю
$userId =  $usersOrm->get('id', ['login'=>$login]);
if ( !$userId ){
    die('WMI_RESULT=OK&WMI_DESCRIPTION=user not found');
}

if (!isset($_POST["WMI_ORDER_STATE"]) || strtoupper($_POST["WMI_ORDER_STATE"]) != "ACCEPTED"){
    die('WMI_RESULT=OK&WMI_DESCRIPTION=wrong WMI_ORDER_STATE');
}

// Вносим в историю поступивший платёж
$userBillHistory->insert(['userId'=>$userId, 'sum'=>$amount, 'type'=>'income', 'shopOrderId'=>$shopOrderId]);

$amount = $amount >= 790 * 6 ? 990 * 6 : $amount;
// Обновляем данные
$usersOrm->update('balance = balance + '.$amount, 'id='.$userId);
