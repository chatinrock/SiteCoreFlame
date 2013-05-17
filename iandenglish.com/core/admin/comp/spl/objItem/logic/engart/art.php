<?php

namespace site\core\admin\comp\spl\objItem\logic\engart;

// Engine
use core\classes\render;
use core\classes\admin\dirFunc;
use core\classes\arrays;
use core\classes\event as eventCore;
use core\classes\filesystem;
use core\classes\word;


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
class art extends \core\classes\component\abstr\admin\comp implements \core\classes\component\abstr\admin\table{
    use \admin\library\mvc\comp\spl\objItem\help\table;
    use \admin\library\mvc\comp\spl\objItem\help\file;
    use \admin\library\mvc\comp\spl\objItem\help\prop;
    use \admin\library\mvc\comp\spl\objItem\help\common;

    public function init(){
        // func. init
    }

    /**
     * Основной метод отображения
     */
    public function itemAction() {
        $contId = $this->contId;
        $compId = $this->compId;
        self::setVar('contId', $contId);

        $objItemId = self::getInt('id');
        self::setVar('objItemId', $objItemId, -1);

        // Директория с данными статьи
        $saveDir = baseModel::getPath($compId, $contId, $objItemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);
        self::setVar('saveData', $saveDir);

        $paramData = [];
        if ( self::isPost() ){
            $paramData['textfile'] = self::post('textfile');
            $paramData['resurl'] = self::post('resurl');
            $paramData['type'] = self::post('type');
            filesystem::saveFile($saveDir, 'param.txt', serialize($paramData));
            (new articleOrm())->insert(['objItemId'=>$objItemId]);
        }

        if ( is_file($saveDir.'param.txt') || $paramData){
            $paramData = $paramData?: filesystem::loadFileContentUnSerialize($saveDir.'param.txt');
            $textfile = $paramData['textfile'];

            // Получаем ранее сохранённые данные по словам ( если они есть )
            $saveWordData = (new engwordOrm())->selectAll('*', ['objItemId'=>$objItemId]);
            // Преобразуем массив для удобства
            $saveWordData = arrays::dbQueryToAssocAll($saveWordData, 'wordId');
            // Если данных не будет, то создадим в JS массив
            $saveWordData = $saveWordData?: new \stdClass();
            self::setJson('saveWordData', $saveWordData);

            // Получаем ранее сохранённые данные по предложениям ( если они есть )
            $saveSentData = (new engsentOrm())->selectAll('*', ['objItemId'=>$objItemId]);
            // Преобразуем массив для удобства
            $saveSentData = arrays::dbQueryToAssocAll($saveSentData, 'sentId');
            // Если данных не будет, то создадим в JS массив
            $saveSentData = $saveSentData?: new \stdClass();
            self::setJson('saveSentData', $saveSentData);

            // Получаем названия-заголовки для правил к предложениям и словам
            $objItemData = engartModel::getObjItemCaptionList($saveWordData, $saveSentData);
            self::setJson('objItemNameListJson', $objItemData);

            $engartText = filesystem::loadFileContent($saveDir.'engart.txt');
            if ( !$engartText  ){
                $engartData = engartModel::html2data($textfile);
                //echo 'File: '.$textfile;
                $engartText = $engartData['text'];
                filesystem::saveFile($saveDir, 'engart.txt', $engartText);
                unset($engartData['text']);
                filesystem::saveFile($saveDir, 'count.txt', serialize($engartData));
            }
            self::setVar('engartText', $engartText, false);

            $compcontTree = new compcontTree();
            $artRuleTreeData = $compcontTree->select('cc.*', 'cc')
                ->join(componentTree::TABLE . ' c', 'c.id=cc.comp_id')
                ->where('c.sysname="objItem" AND cc.isDel="no"')
                ->fetchAll();

            $artRuleTreeJson = dhtmlxTree::all($artRuleTreeData, 0);
            self::setJson('artRuleTreeJson', $artRuleTreeJson);
        }else{
            self::setVar('isNew', 1);
        }

        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('manager'));
        $this->view->setMainTpl('main.tpl.php');
        // func. itemAction
    }


	public function loadParamAction(){
		$compId = $this->compId;
        $contId = $this->contId;
	
		$objItemId = self::getInt('objItemId');
		$paramData = (new articleOrm())->selectFirst( '*', [ 'objItemId' => $objItemId ] );
		
		// Директория с данными статьи
        $loadDir = baseModel::getPath($compId, $contId, $objItemId);
        $loadDir = dirFunc::getSiteDataPath($loadDir);
	
		$shortText = filesystem::loadFileContent($loadDir.'kat.txt');
		self::setVar('shortText', $shortText); 
		
		self::setVar('prevImgUrl', $paramData['prevImgUrl']); 
		self::setVar('seoDescr', $paramData['seoDescr']); 
		self::setVar('seoKeywords', $paramData['seoKeywords']); 
		
		$this->view->setMainTpl('engart/param/param.tpl.php');
		// func. loadParamAction
	}

    /**
     * Ajax. onClick на кнопку опубликовать.<br/>
     * Помечает, что нужно пересоздать статьи
     */
    public function publishArticleAction(){
        $this->view->setRenderType(render::JSON);

        $objItemId = self::postInt('itemId');

        $compId = $this->compId;
        $contId = $this->contId;
		
		// Директория с данными статьи
        //$saveDir = baseModel::getPath($compId, $contId, $objItemId);
        //$saveDir = dirFunc::getSiteDataPath($saveDir);

        eventCore::callOffline(
            eventBase::NAME,
            'article::eng:build',
            ['compId' => $compId, 'contId' => $contId],
            $objItemId
        );

        eventCore::callOffline(
            eventBase::NAME,
            eventArticle::ACTION_SAVE,
            ['compId' => $compId, 'contId' => $contId],
            $objItemId
        );
        // func. publishArticleAction
    }

    /**
     * Ajax. Сохраняем данные по слову или предложению.
     * @throws \Exception
     */
    public function saveWordDataAction(){
        $this->view->setRenderType(render::JSON);
        $json = self::post('json');
        // $json = '{"w7":"osn","w8":"osn","w9":"scn","transcr":"","translate":"","comment":""}';
        $ruleData = @json_decode($json);
        if ( !$ruleData){
            throw new \Exception('Bad data', 34);
            return;
        }
        $ruleData->transcr = trim($ruleData->transcr,'[]');

        $itemId = self::postInt('itemId');
        $ruleMaxId = self::postInt('ruleMaxId');

        $compId = $this->compId;
        $contId = $this->contId;

        // Директория с данными статьи
        $saveDir = baseModel::getPath($compId, $contId, $itemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);

        $vipComment = self::post('vipcomment');
        $vipData['voice'] = self::post('vipVoice');

        //echo $vipComment;

        $type = self::post('type');
        switch($type){
            case 'sentence':
                $sentId = self::postInt('id');
                engartModel::saveSentenceRule($itemId, $sentId, $ruleData, $ruleMaxId);
                $prefSentId = word::idToSplit($sentId);
                filesystem::saveFile($saveDir.'sent/'.$prefSentId, 'vip.html', $vipComment);
                filesystem::saveFile($saveDir.'sent/'.$prefSentId, 'vip.data', json_encode($vipData));
                break;
            case 'word':
                $wordId = engartModel::saveWordRule($itemId, $ruleData, $ruleMaxId);
                $prefWordId = word::idToSplit($wordId);
                filesystem::saveFile($saveDir.'word/'.$prefWordId, 'vip.html', $vipComment);
                filesystem::saveFile($saveDir.'word/'.$prefWordId, 'vip.json', json_encode($vipData));
                break;
        } // switch
        // func. saveDataAction
    }
	
	// Возвращает частную таблицу с которой работает данных класс
    public function getTableCustom(){
        return articleOrm::TABLE;
    }

    /**
     * Ajax. Удаляет правило для предложения или слова
     */
    public function removeRuleAction(){
        $this->view->setRenderType(render::JSON);
        $wordId = self::post('rel');
        $objItemId = self::postInt('itemId');
        $type = self::post('type');

        $compId = $this->compId;
        $contId = $this->contId;

        // Директория с данными статьи
        /*$saveDir = baseModel::getPath($compId, $contId, $objItemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);

        $prefWordId = word::idToSplit($wordId);*/

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

    public function getVipCommentAction (){
        //$this->view->setRenderType(render::NONE);
        //header('Content-Type: text/html; charset=utf-8');
        $this->view->setRenderType(render::JSON);

        $type = self::get('type') == 'word' ? 'word' : 'sent';
        $objItemId = self::getInt('itemId');
        $wordId = self::getInt('wordId');

        $compId = $this->compId;
        $contId = $this->contId;

        // Директория с данными статьи
        $loadData = baseModel::getPath($compId, $contId, $objItemId);
        $loadData = dirFunc::getSiteDataPath($loadData);
        $prefWordId = word::idToSplit($wordId);

        $vipData['html'] = filesystem::loadFileContent($loadData.$type.'/'.$prefWordId.'vip.html');
        $vipData['data'] = json_decode(filesystem::loadFileContent($loadData.$type.'/'.$prefWordId.'vip.json'));
        $vipData['type'] = $type;
        self::setVar('json', $vipData);
        // func. getVipCommentAction
    }
	
	public function saveParamDataAction(){
		if ( !self::isPost()){
			die('Only post');
		}
		$this->view->setRenderType(render::JSON);
		
		$compId = $this->compId;
        $contId = $this->contId;
		
		$objItemId = self::postInt('objItemId');
		
		// Директория с данными статьи
        $saveDir = baseModel::getPath($compId, $contId, $objItemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);
		
		$shortText = self::post('shortText');
		filesystem::saveFile($saveDir, 'kat.txt', $shortText);
		
		$prevImgUrl = self::post('imgurl');
		//$seoKeywords = self::post('keywords');
		//$seoDescr = self::post('descript');
		
		eventCore::callOffline(
            eventBase::NAME,
            eventArticle::ACTION_SAVE,
            ['compId' => $compId, 'contId' => $contId],
            $objItemId
        );

		(new articleOrm())->saveExt(
            [ 'objItemId' => $objItemId ]
            ,['prevImgUrl' => $prevImgUrl,
             /*'seoKeywords' => $seoKeywords,
			 'seoDescr' => $seoDescr,*/
             'isCloaking' => false]
        );

        $seoData = serialize([
             'keywords' => self::post('keywords'),
             'descr' =>  self::post('descript'),
             'imgUrl' => self::post('imgUrl'),
             'videoUrl' => self::post('videoUrl')
        ]);
        filesystem::saveFile($saveDir, 'seo.txt', $seoData);
		
		// func. saveParamData
	}

    // class art
}