<?
namespace core\comp\spl\freeScript\logic;

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
        $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);


        $render = new render($tplPath, '');
        $render->setVar('timeServer', time());


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