<?php

namespace site\core\admin\comp\spl\objItem\logic\people;

// Engine
use core\classes\render;
use core\classes\filesystem;
use core\classes\event as eventCore;
use core\classes\admin\dirFunc;

// Plugin
use admin\library\mvc\plugin\fileManager\fileManager;

// Conf
use \DIR;

// ORM
use ORM\comp\spl\objItem\objItem as objItemOrm;
use ORM\comp\spl\objItem\metroStation as metroStationOrm;
use ORM\tree\compcontTree;
use ORM\tree\componentTree;

// Custom ORM
use site\core\admin\comp\spl\objItem\ORM\trener as trenerOrm;

// Model
use admin\library\mvc\comp\spl\objItem\help\model\base\model as objItemModel;
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

// Plugin
use admin\library\mvc\plugin\dhtmlx\model\tree as dhtmlxTree;

// Event
use admin\library\mvc\comp\spl\objItem\help\event\base\event as eventBase;
use admin\library\mvc\comp\spl\objItem\help\event\article\event as eventArticle;

/**
 * Description of review
 *
 * @author Козленко В.Л.
 */
class people extends \core\classes\component\abstr\admin\comp implements \core\classes\component\abstr\admin\table{
    use \admin\library\mvc\comp\spl\objItem\help\table;
    use \admin\library\mvc\comp\spl\objItem\help\file;
    use \admin\library\mvc\comp\spl\objItem\help\prop;

    public function init(){
        // func. init
    }

    public function itemAction() {
        $contId = $this->contId;
        self::setVar('contId', $contId);

        $itemObjId = self::getInt('id');
        self::setVar('objItemId', $itemObjId, -1);

        $loadData = (new trenerOrm())->selectFirst('*', 'objItemId='.$itemObjId);
        if ( $loadData ){
            $sexList['val']  = $loadData['sex'];
            $experienceList['list'] = $loadData['experience'];
            $ageList['list'] = $loadData['age'];
            foreach( $loadData as $key => $val){
               self::setVar($key, $val);
            } // foreach
        } // if

        $sexList['list'] = ['male' => 'Муж', 'fem' => 'Жен'];
        self::setVar('sexList', $sexList);

        $experienceList['list'] = range(0, 50);
        self::setVar('experienceList', $experienceList);

        $ageList['list'] = range(18, 75);
        self::setVar('ageList', $ageList);

        $stationIdList = (new metroStationOrm())->selectList('stationId', 'stationId', 'objItemId='.$itemObjId);
        self::setJson('stationIdList', $stationIdList);

        // Получаем данные по компоненту imgGallery
        //$objItemProp = (new componentTree())->selectFirst('*', 'sysname="imgGallery"');
        // Получаем весь список контента по oiList
        $contData = (new compcontTree())
            ->select('cc.*', 'cc')
            ->join(componentTree::TABLE.' c', 'c.id = cc.comp_id')
            ->where('cc.isDel="no" AND c.sysname="imgGallery"')
            ->fetchAll();
        // Преобразуем список в дерево Контента
        $contTree = dhtmlxTree::all($contData, 0);
        self::setJson('contTree', $contTree);

        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('manager'));
        $this->view->setMainTpl('main.tpl.php');
        // func. itemAction
    }

    public function metroManagerAction(){
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('plugin'));
        $this->view->setMainTpl('metroStation/window.tpl.php');
        // func. metroManager
    }

    public function saveDataAction() {
        $this->view->setRenderType(render::JSON);

        $contId = $this->contId;
        $compId = $this->compId;

        $objItemId = self::postInt('objItemId');

        $aprice = self::postSafe('aprice');
        $descrip = self::postSafe('descrip');

        $saveData = [
            'fio' => self::post('fio'),
            'address' => self::post('address'),
            'age' => self::postInt('age'),
            'experience' => self::postInt('experience'),
            'price' => self::postInt('price'),
            'sex' => self::post('sex'),
            'videoUrl' => self::post('videoUrl'),
            'email' => self::post('email'),
            'phone' => self::post('phone'),
            'photoUrl' => self::post('photoUrl'),
            'photoUrlPreview' => self::post('photoUrlPreview'),
            'galleryId' => self::postInt('galleryId')
        ];
        (new trenerOrm())->saveExt(['objItemId'=>$objItemId], $saveData);

        $stationList = self::post('stationList');
        $stationList = explode(',', $stationList);
        $stationList = array_map('intVal', $stationList);

        $metroStationOrm = new metroStationOrm();
        $metroStationOrm->delete(['objItemId' => $objItemId]);
        $metroStationOrm->insertMulti(['stationId' => $stationList], ['objItemId' => $objItemId]);

        /*$itemObjId= self::postInt('itemObjId');

        $caption = self::post('caption');
        $prevImgUrl = self::post('prevImgUrl');
        $videoUrl = self::post('videoUrl');

        eventCore::callOffline(
            eventBase::NAME,
            eventArticle::ACTION_SAVE,
            ['compId' => $compId, 'contId' => $contId],
            $itemObjId
        );

        (new reviewOrm())->saveExt(['itemObjId' => $itemObjId],
                                   ['caption' => $caption,
                                   'imgPrevUrl' => $prevImgUrl,
                                   'videoUrl' => $videoUrl]);

        // Директория с данными статьи
        $saveDir = baseModel::getPath($compId, $contId, $itemObjId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);

        $textDesc = self::post('textDesc');
        filesystem::saveFile($saveDir, 'text.txt', $textDesc);*/

        // func. saveDataAction
    }

    public function blockItemShowAction() {
        $this->view->setRenderType(render::NONE);
        echo 'article::blockItemShowAction() | No settings in this';
        // func. blockItemShowAction
    }

    // class review
}