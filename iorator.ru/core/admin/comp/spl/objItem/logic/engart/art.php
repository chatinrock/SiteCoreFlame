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

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;

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

        $saveData = (new engwordOrm())->selectAll('*');
        $saveData = arrays::dbQueryToAssocAll($saveData, 'wordId');

        self::setJson('saveData', $saveData);


        $engartText = engartModel::html2data();
        self::setVar('engartText', $engartText, false);

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

        $saveData = [
                'osnWordId'=>'',
                'secondWordId' => '',
                'data' => []
             ];
        $wordId = [];
        foreach($ruleData as $key=>$val){
            if ( $key[0] == 'w' && is_numeric(substr($key, 1))){
                $num = (int)substr($key, 1);
                if ( !$wordId ){
                    $wordId['wordId'] = $num;
                    continue;
                } // if ( !$firstSave )

                if ( $val == 'osn' ){
                    $saveData['osnWordId'] .= ','.$num;
                }else{
                    $saveData['secondWordId'] .= ','.$num;
                }
                continue;
            } // if ( $key[0] == 'w' )

            $saveData['data'][$key] = $val;

        } // foreach



        $saveData['data'] = json_encode($saveData['data']);
        $saveData['osnWordId'] = (string)substr($saveData['osnWordId'], 1);
        $saveData['secondWordId'] = (string)substr($saveData['secondWordId'], 1);

        (new engwordOrm())->saveExt($wordId, $saveData);
        // func. saveDataAction
    }

    // class art
}