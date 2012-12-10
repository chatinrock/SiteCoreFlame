<?php

namespace site\core\admin\comp\spl\objItem\logic\engart;

// Engine
use core\classes\render;
use core\classes\admin\dirFunc;
use core\classes\arrays;

// Conf
use \DIR;

// Model
use site\core\admin\comp\spl\objItem\logic\engart\model\model as engartModel;

// Plugin
use admin\library\mvc\plugin\dhtmlx\model\tree as dhtmlxTree;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use ORM\tree\compContTree;
use ORM\tree\componentTree;
use ORM\comp\spl\objItem\objItem as objItemOrm;

/**
 * Description of review
 *
 * @author Козленко В.Л.
 */
class art extends \core\classes\component\abstr\admin\comp implements \core\classes\component\abstr\admin\table{
    use \admin\library\mvc\comp\spl\objItem\help\table;
    use \admin\library\mvc\comp\spl\objItem\help\file;
    use \admin\library\mvc\comp\spl\objItem\help\prop;

    public function init(){
        // func. init
    }

    public function itemAction() {
        $contId = $this->contId;
        $compId = $this->compId;
        self::setVar('contId', $contId);

        $objItemId = self::getInt('id');
        self::setVar('objItemId', $objItemId, -1);

        $saveWordData = (new engwordOrm())->selectAll('*', ['objItemId'=>$objItemId]);
        $saveWordData = arrays::dbQueryToAssocAll($saveWordData, 'wordId');
        $saveWordData = $saveWordData?: new \stdClass();
        self::setJson('saveWordData', $saveWordData);

        $saveSentData = (new engsentOrm())->selectAll('*', ['objItemId'=>$objItemId]);
        $saveSentData = arrays::dbQueryToAssocAll($saveSentData, 'sentId');
        $saveSentData = $saveSentData?: new \stdClass();
        self::setJson('saveSentData', $saveSentData);

        $objItemData = engartModel::getObjItemCaptionList($saveWordData, $saveSentData);
        self::setJson('objItemNameListJson', $objItemData);

        $engartText = engartModel::html2data();
        self::setVar('engartText', $engartText, false);

        $compcontTree = new compcontTree();
        $artRuleTreeData = $compcontTree->select('cc.*', 'cc')
            ->join(componentTree::TABLE . ' c', 'c.id=cc.comp_id')
            ->where('c.sysname="objItem" AND cc.isDel="no"')
            ->fetchAll();

        $artRuleTreeJson = dhtmlxTree::all($artRuleTreeData, 0);
        self::setJson('artRuleTreeJson', $artRuleTreeJson);

        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('manager'));
        $this->view->setMainTpl('main.tpl.php');
        // func. itemAction
    }

    public function saveDataAction(){
        $this->view->setRenderType(render::JSON);
        $json = self::post('json');
        // $json = '{"w7":"osn","w8":"osn","w9":"scn","transcr":"","translate":"","comment":""}';
        $ruleData = @json_decode($json);
        if ( !$ruleData){
            throw new \Exception('Bad data', 34);
            return;
        }

        $itemId = self::postInt('itemId');

        $type = self::post('type');
        switch($type){
            case 'sentence':
                $sentId = self::postInt('id');
                engartModel::saveSentenceRule($itemId, $sentId, $ruleData);
                break;
            case 'word':
                engartModel::saveWordRule($itemId, $ruleData);
                break;
        } // switch

        // func. saveDataAction
    }

    public function removeRuleAction(){
        $this->view->setRenderType(render::JSON);
        $wordId = self::post('rel');
        $objItemId = self::postInt('itemId');
        $type = self::post('type');
        switch($type){
            case 'sentence':
                (new engsentOrm())->delete(['sentId'=>$wordId, 'objItemId'=>$objItemId]);
                break;
            case 'word':
                (new engwordOrm())->delete(['wordId'=>$wordId, 'objItemId'=>$objItemId]);
                break;
        }

        self::setVar('json', ['rel'=>$wordId, 'type'=> $type]);
        // func. removeRuleAction
    }

    // class art
}