<?
namespace site\core\admin\comp\spl\objItem\logic\article;

use \DIR;

/**
 * Description of article
 *
 * @author Козленко В.Л.
 */
class tsetad extends \core\classes\component\abstr\admin\comp{
    public function indexAction(){

        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(DIR::getTplPath('manager'));
        $this->view->setMainTpl('main.tpl.php');
    }

    public static function compPropAction(){

    }

    public function init(){

    }
// class tsetad
}