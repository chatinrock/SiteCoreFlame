<?
// Core
use core\classes\DB\DB as DBCore;
// Conf  
use \site\conf\DIR;

// Config DIR
include '/home/www/SiteCoreFlame/seoforbeginners.ru/conf/DIR.php';
include DIR::CORE . 'site/function/autoload.php';
include DIR::CORE . 'core/function/errorHandler.php';
include DIR::CORE . 'core/classes/DB/adapter/mysql/adapter.php';
// Add DB conf param
DBCore::addParam('site', \site\conf\DB::$conf);

$create = new site\core\comp\spl\artCom\func\create();
try{
    $create->save();
}catch(\Exception $ex){
    header('Content-Type: application/json');
    echo json_encode(['error'=>$ex->getCode(),
                     'msg' => $ex->getMessage()]);
}
?>