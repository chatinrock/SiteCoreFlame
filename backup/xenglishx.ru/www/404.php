<?php $time = microtime(true);

header('Content-Type: text/html;charset=UTF-8');
// Core
use core\classes\request;
use core\classes\dbus;
use core\classes\DB\DB as DBCore;
// Conf 
use \site\conf\DIR;
// ORM
use ORM\tree\compContTree;

// Config DIR
include '/opt/www/SiteCoreFlame/xenglishx.ru/conf/DIR.php';
include DIR::CORE.'site/function/autoload.php';
include DIR::CORE.'core/function/errorHandler.php';
include DIR::CORE.'core/classes/DB/adapter/mysql/adapter.php';
// Add DB conf param
DBCore::addParam('site', \site\conf\DB::$conf);

session_start();


dbus::$user = isset($_SESSION['userData']) ? $_SESSION['userData'] : null;
try{
}catch(Exception $ex){
    header('Status: 500 Internal Server Error');
    exit;
}dbus::$comp['mainmenu'] = array (
  'tpl' => 'mainTree.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '9',
);dbus::$comp['leftmenu'] = array (
  'tpl' => 'topLine.php',
  'isTplOut' => 0,
  'compId' => '5',
  'nsPath' => 'spl/menu/',
  'contId' => '8',
);

?>404<? echo '<!-- '.(microtime(true) - $time).' -->'; ?>