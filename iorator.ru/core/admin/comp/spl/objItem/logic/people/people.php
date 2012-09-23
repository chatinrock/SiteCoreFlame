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
        $compId = $this->compId;
        self::setVar('contId', $contId);

        $objItemId = self::getInt('id');
        self::setVar('objItemId', $objItemId, -1);

        $loadData = (new trenerOrm())
                ->select('t.*, oi.caption galleryItem', 't')
                ->joinLeftOuter(objItemOrm::TABLE.' oi', 'oi.id=t.galleryItemid')
                ->where('objItemId='.$objItemId)
                ->fetchFirst();
        if ( $loadData ){
            foreach( $loadData as $key => $val){
               self::setVar($key, $val);
            } // foreach

            $sexList['val']  = $loadData['sex'];
            $experienceList['val'] = $loadData['experience'];
            $ageList['val'] = $loadData['age'];

        } // if

        $sexList['list'] = ['male' => 'Муж', 'fem' => 'Жен'];
        self::setVar('sexList', $sexList);

        $experienceList['list'] = range(0, 50);
        self::setVar('experienceList', $experienceList);

        $ageList['list'] = range(18, 75);
        self::setVar('ageList', $ageList);

        $stationIdList = (new metroStationOrm())->selectList('stationId', 'stationId', 'objItemId='.$objItemId);
        self::setJson('stationIdList', $stationIdList);

        // Получаем весь список контента по oiList
        $contData = (new compcontTree())
            ->select('cc.*', 'cc')
            ->where('cc.isDel="no" AND cc.comp_id = '.$this->compId)
            ->fetchAll();
        // Преобразуем список в дерево Контента
        $contTree = dhtmlxTree::all($contData, 0);
        self::setJson('contTree', $contTree);

        // Директория с данными статьи
        $loadDir = baseModel::getPath($compId, $contId, $objItemId);
        $loadDir = dirFunc::getSiteDataPath($loadDir);

        $aprice = filesystem::loadFileContent($loadDir . 'aprice.txt');
        self::setVar('aprice', $aprice);

        $descrip = filesystem::loadFileContent($loadDir . 'descrip.txt');
        self::setVar('descrip', $descrip);

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

    public function loadGalleryItemListAction(){
        $this->view->setRenderType(render::JSON);
        $galleryId = self::getInt('galleryId');
        $term = self::get('term');

        $objItem = new objItemOrm();
        $term = $objItem->escape($term);
        $list = $objItem->selectAll('id, caption label, caption value', 'treeId='.$galleryId.' AND caption like "%'.$term.'%"');
        self::setVar('json', $list);
        // func. loadGalleryItemListAction
    }

    public function saveDataAction() {
        $this->view->setRenderType(render::JSON);

        $contId = $this->contId;
        $compId = $this->compId;

        $objItemId = self::postInt('objItemId');

        eventCore::callOffline(
            eventBase::NAME,
            eventArticle::ACTION_SAVE,
            ['compId' => $compId, 'contId' => $contId],
            $objItemId
        );

        // Директория с данными статьи
        $saveDir = baseModel::getPath($compId, $contId, $objItemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);

        $aprice = self::postSafe('aprice');
        filesystem::saveFile($saveDir, 'aprice.txt', $aprice);

        $descrip = self::postSafe('descrip');
        filesystem::saveFile($saveDir, 'descrip.txt', $descrip);

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
            'galleryId' => self::postInt('galleryId'),
            'galleryItemid' => self::postInt('galleryItemid')
        ];
        (new trenerOrm())->saveExt(['objItemId'=>$objItemId], $saveData);

        $stationList = self::post('stationList');
        $stationList = explode(',', $stationList);
        $stationList = array_map('intVal', $stationList);

        $metroStationOrm = new metroStationOrm();
        $metroStationOrm->delete(['objItemId' => $objItemId]);
        $metroStationOrm->insertMulti(['stationId' => $stationList], ['objItemId' => $objItemId]);

        // func. saveDataAction
    }

    public function blockItemShowAction() {
        $this->view->setRenderType(render::NONE);
        echo 'article::blockItemShowAction() | No settings in this';
        // func. blockItemShowAction
    }

    /* Настройка метода для buildsys\library\event\comp\spl\objItem\article\model

    */
    public function saveDataInfo($pObjItemId, $pObjItemOrm){
        $objItemData = $pObjItemOrm
            ->select('i.id, i.seoUrl, i.treeId, i.caption, i.isPublic'
                         . ',cc.seoName, cc.name category, a.urlTpl, i.date_add dateunf', 'i')
            ->joinLeftOuter(trenerOrm::TABLE. ' a', 'i.id=a.objItemId')
            ->join(compContTree::TABLE . ' cc', 'i.treeId=cc.id')
            ->where('i.id=' . $pObjItemId)
            ->comment(__METHOD__)
            ->fetchFirst();

        // Данные предыдушей статьи
        $return['prev'] = $pObjItemOrm
            ->select('i.id, i.seoUrl, i.caption, cc.seoName, a.urlTpl', 'i')
            ->joinLeftOuter(trenerOrm::TABLE. ' a', 'i.id=a.objItemId')
            ->join(compContTree::TABLE . ' cc', 'i.treeId=cc.id')
            ->where(
            'date("' . $objItemData['dateunf'] . ' ") >= date(i.date_add)
                AND i.isPublic = "yes"
                AND i.isDel = 0
                And i.treeId = ' . $objItemData['treeId'] . '
                AND i.id < ' . $objItemData['id'])
            ->order('i.date_add DESC, i.id desc')
            ->fetchFirst();

        // Данные следующей статьи
        $return['next'] = $pObjItemOrm
            ->select('i.id, i.seoUrl, i.caption, cc.seoName, a.urlTpl', 'i')
            ->joinLeftOuter(trenerOrm::TABLE. ' a', 'i.id=a.objItemId')
            ->join(compContTree::TABLE . ' cc', 'i.treeId=cc.id')
            ->where(
            'date("' . $objItemData['dateunf'] . ' ") <= date(i.date_add)
                AND i.isPublic = "yes"
                AND i.isDel = 0
                And i.treeId = ' . $objItemData['treeId'] . '
                AND i.id > ' . $objItemData['id'])
            ->order('i.date_add ASC')
            ->fetchFirst();

        $objItemData['canonical'] = sprintf($objItemData['urlTpl'], $objItemData['seoName'], $objItemData['seoUrl']);

        unset($objItemData['seoUrl'], $objItemData['urlTpl'], $objItemData['treeId'], $objItemData['dateunf']);

        $return['obj'] = $objItemData;

        return $return;
        // func. saveDataInfo
    }

    public function getTableCustom(){
        return trenerOrm::TABLE;
    }

    // class review
}