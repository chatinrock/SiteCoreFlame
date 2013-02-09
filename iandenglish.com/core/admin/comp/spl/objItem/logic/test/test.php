<?php

namespace site\core\admin\comp\spl\objItem\logic\test;

// Engine
use core\classes\render;
use core\classes\admin\dirFunc;
use core\classes\arrays;
use core\classes\event as eventCore;
use core\classes\filesystem;

// Conf
use \DIR;

// Model
use site\core\admin\comp\spl\objItem\logic\engart\model\model as engartModel;
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

// Plugin
use admin\library\mvc\plugin\dhtmlx\model\tree as dhtmlxTree;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use ORM\tree\compContTree;
use ORM\tree\componentTree;
use ORM\comp\spl\objItem\objItem as objItemOrm;
use ORM\comp\spl\objItem\article\article as articleOrm;

// Event
use admin\library\mvc\comp\spl\objItem\help\event\base\event as eventBase;
use admin\library\mvc\comp\spl\objItem\help\event\article\event as eventArticle;


/**
 * Description of review
 *
 * @author Козленко В.Л.
 */
class test extends \core\classes\component\abstr\admin\comp implements \core\classes\component\abstr\admin\table{
    use \admin\library\mvc\comp\spl\objItem\help\table;
    use \admin\library\mvc\comp\spl\objItem\help\file;
    use \admin\library\mvc\comp\spl\objItem\help\prop;
    use \admin\library\mvc\comp\spl\objItem\help\common;

    public function init(){
        // func. init
    }

    public function itemAction() {
        $contId = $this->contId;
        $compId = $this->compId;
        self::setVar('contId', $contId);

        $objItemId = self::getInt('id');
        self::setVar('objItemId', $objItemId, -1);


        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('manager'));
        $this->view->setMainTpl('main.tpl.php');
        // func. itemAction
    }


    // class art
}