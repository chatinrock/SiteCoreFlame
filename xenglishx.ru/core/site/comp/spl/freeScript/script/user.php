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
		
		if ( isset($_SESSION['userData'])){
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
			unset($_SESSION['userData']);
		}
		// func. init
	}
	
	// class userMvc
} 