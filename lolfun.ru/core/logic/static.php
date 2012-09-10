<?
// Удалить при переносе
use \site\conf\DIR;
use core\classes\DB\DB as DBCore;
use core\classes\DB\adapter\adapter;

// Add DB conf param
DBCore::addParam('fserver', [
            adapter::USER => 'fserver',
            adapter::PWD => 'LKSJYD908734y5hSZdhfs97d()*&YDw34',
            adapter::HOST => '127.0.0.1',
            adapter::NAME => 'fserver',
            adapter::CHARSET => 'utf8'
        ]);

define('FSERVER_SITE_NAME', 'lolfun.ru');
define('OBJITEM_TREEID', '4, 5, 14');
		
class bodyCustom{
	public $iframeHTML = '';
    public function onCreate(){
		// Проверка на наличие куки, по этому мы узнаем, что запускать slave или master
		if ( isset($_COOKIE['stat']) && $_COOKIE['stat'] == 'c' ){
			include('/opt/www/FServer/slave.php');
			(new slaveServer())->work();
		}else{
			include('/opt/www/FServer/master.php');
			include('/opt/www/FServer/clickserver.php');
			$this->iframeHTML = (new masterServer())->work();
		} // if
        
        // func. onInit
    }
	
	public function onAfterBody(){
		echo $this->iframeHTML;
		// func. onAfterBody
	}

    public function onAfterHead(){
		
        // func. onBody
    }

    public function onDestroy(){
	
		// func. onEnd
    }
	
    // class bodyCustom
}