<?php

namespace site\core\admin\comp\spl\objItem\logic\people;

// Engine
use core\classes\render;
use core\classes\admin\dirFunc;
use core\classes\arrays;
use core\classes\event as eventCore;
use core\classes\filesystem;
use core\classes\DB\table;
use core\classes\comp;

// Conf
use \DIR;
use site\conf\DIR as SITE_DIR;

// Model
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;
use site\core\admin\comp\spl\objItem\model\people\main as peopleModel;

// ORM
use ORM\tree\compContTree;
use ORM\tree\componentTree;
use site\core\ORM\people as peopleOrm;
use ORM\comp\spl\objItem\objItem as objItemOrm;

// Event
use admin\library\mvc\comp\spl\objItem\help\event\base\event as eventBase;

ini_set('display_errors', 1);
error_reporting(E_ALL);


/**
 * Description of review
 *
 * @author Козленко В.Л.
 */
class main extends \core\classes\component\abstr\admin\comp implements \core\classes\component\abstr\admin\table{
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

        $saveDir = baseModel::getPath($compId, $contId, $objItemId);
        $saveDir = dirFunc::getSiteDataPath($saveDir);

        $dopCategory = peopleModel::getDopCategory($objItemId);
        self::setJson('dopCategory', $dopCategory);

        $peopleFeaturesList = peopleModel::getFeatureList($objItemId);
        self::setJson('peopleFeaturesList', $peopleFeaturesList);

        $loadData = peopleModel::getSavedData($objItemId);
        self::setJson('loadData', $loadData);

        //$videoList = peopleModel::getVideoData($objItemId, 'video');
        //self::setJson('videoList', $videoList);

        //$compProp = comp::findCompPropBytContId($contId);
        //var_dump($compProp);

        $videoList = peopleModel::getVideoData($objItemId, 'review');
        self::setJson('otzyvList', $videoList);

        $imgData = filesystem::loadFileContentUnSerialize($saveDir.'img.srl');
        if ( $imgData ){
            foreach( $imgData as $key=>$val ){
                self::setVar($key, $val, '', false);
            } // foreach
        } // if

        $metroList = peopleModel::getMetroList($objItemId);
        self::setJson('metroList', $metroList);

        self::setVar('descripFile', $saveDir.'description.txt');

        $_SESSION['userData']['group'] = 'p'.$objItemId;
        $_SESSION['userData']['skey'] = 11;

        $this->view->setBlock('panel', $this->tplFile);
        $this->view->setTplPath(dirFunc::getAdminTplPathIn('manager'));
        $this->view->setMainTpl('main.tpl.php');
        // func. itemAction
    }

    public function saveDataAction(){
        if ( !self::isPost()){
            die('Only post');
        }
        $this->view->setRenderType(render::JSON);

        $compId = $this->compId;
        $contId = $this->contId;
        $objItemId = self::postInt('itemId');

        $seoUrl = (new objItemOrm())->get('seoUrl', 'id='.$objItemId);

        $idPref = baseModel::getPath($compId, $contId, $objItemId);

        $data = [
            'fio' => self::post('fio'),
            'email' => self::post('email'),
            'phone' => self::post('phone'),
            'rating' => self::postInt('rating', 0),
            'price' => self::postInt('price', 0),
            'exp' => self::postInt('exp'),
            'videoId' => self::postInt('video')
        ];

        (new peopleOrm())->saveExt(['objItemId' => $objItemId], $data);

        // Директория с данными статьи
        $saveDir = dirFunc::getSiteDataPath($idPref);

        include(DIR::SHARE_OBJECT.'explorer/profile/people.php');
        $filesOrm = new table('people');

        $data['imgs'] = peopleModel::saveImgData(self::post('preview'), self::post('gallery'), self::post('document'), $saveDir, $idPref, $filesOrm);
        $data['metro'] = peopleModel::saveMetroList(self::post('metro'), $objItemId);
        $data['feature'] = peopleModel::saveFeature(self::post('pf', []), $objItemId);
        //$data['video'] = peopleModel::saveVideo(self::post('video'), $objItemId, 'video', $idPref, $filesOrm);
        $data['video'] = peopleModel::getVideoPreview($data['videoId'], $filesOrm);
        $data['otzyv'] = peopleModel::saveVideo(self::post('otzyv'), $objItemId, 'review', $idPref, $filesOrm);
        $data['idSplit'] = $idPref;
        $data['seoUrl'] = $seoUrl;

        peopleModel::saveDopCategory(self::post('ct', []), $objItemId);
        filesystem::saveFile($saveDir, 'description.txt', self::post('description'));

        unset($data['email'], $data['phone']);
        filesystem::saveFile($saveDir, 'data.txt', serialize($data));

        // Для пересоздания oiList
        eventCore::callOffline(
            eventBase::NAME,
            eventBase::ACTION_TABLE_SAVE,
            ['contId' => $contId],
            $objItemId
        );
        // func. saveDataAction
    }

    // Возвращает частную таблицу с которой работает данных класс
    public function getTableCustom(){
        return peopleOrm::TABLE;
    }

    // class main (controller)
}