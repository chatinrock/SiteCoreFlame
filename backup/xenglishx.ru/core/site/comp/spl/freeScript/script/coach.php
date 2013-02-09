<?
namespace core\comp\spl\freeScript\logic;

// conf
use site\conf\DIR;
use \site\conf\PRICE;

// Engine
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;
use core\classes\request;
use core\classes\password;

// ORM
use ORM\users as usersOrm;

class coachMvc{

    public function run($comp){

        if ( !dbus::$user ){
            $file = DIR::SITE_CORE.'tpl/site/other/blog/forbid.tpl.php';
            (new render('', ''))->setMainTpl($file)->setContentType(null)->render();
            return;
        }

        $userId = dbus::$user['id'];
        $userData = (new usersOrm())->selectFirst('UNIX_TIMESTAMP(speakTime) speakTime, balance', 'id='.$userId);

        $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);

        $render = new render($tplPath, '');
        $render->setVar('timeServer', time());
        $render->setVar('speakTime', $userData['speakTime']?:0);
        $render->setVar('isBalance', $userData['balance'] >= PRICE::SPEAK );
        $render->setJson('userData', ['balance'=>$userData['balance'], 'price' => PRICE::SPEAK ]);

        $tpl = userUtils::getCompTpl($comp);
        $render->setMainTpl($tpl)
            ->setContentType(null)
            ->render();

        // func. run
    }



    public function init(&$comp){

        // func. init
    }

    // class userMvc
}