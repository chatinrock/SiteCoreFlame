<? 
namespace core\comp\spl\freeScript\logic;

// Engine
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;

class userMvc{
	public function run($comp){
		$tpl= userUtils::getCompTpl($comp);
		
		if ( dbus::$user ){
			$tpl = 'profile.tpl.php';
		}

		$tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);
		$render = new render($tplPath, ''); 
				
		$render->setMainTpl($tpl)
			  ->setContentType(null)
			  ->render();
		// func. run
	}
	
	public function init($comp){
		if ( isset($_COOKIE['userExit'])){
			session_destroy();
			setCookie("userExit", "", time() - 3600, '/');
			setCookie("userId", "", time() - 3600, '/');
			//unset($_SESSION['userData']);
			dbus::$user = null;
		}
        if ( !dbus::$user && isset($_COOKIE['userId'])){
            setCookie("userId", "", time() - 3600, '/');
        }
		// func. init
	}
	
	// class userMvc
} 