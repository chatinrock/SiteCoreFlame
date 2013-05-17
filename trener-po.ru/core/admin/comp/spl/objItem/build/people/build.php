<?php

namespace site\core\admin\comp\spl\objItem\build\people;

// Orm
use site\core\ORM\people as peopleOrm;
use site\core\ORM\peopleFeatures as peopleFeaturesOrm;
use site\core\ORM\peopleMetro as peopleMetroOrm;
use site\core\ORM\peopleFeatureRelation as peopleFeatureRelationOrm;
use site\core\ORM\peopleDopCategory as peopleDopCategoryOrm;

// Model
use admin\library\mvc\comp\spl\objItem\model as objItemModel;
use buildsys\library\event\comp\spl\objItem\model as eventModelObjitem;
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

// Engine
use core\classes\admin\dirFunc;

// Conf
use \DIR;
use site\conf\DIR as SITE_DIR;

/**
 * Description of event
 *
 * @author Козленко В.Л.
 */
class build implements \admin\library\mvc\comp\spl\objItem\help\builderAbs {

    public static function getTable(){
        return [peopleOrm::TABLE];
    }

    public function setAdvField(){
        return [
            'order' => 'rating desc, price, date_add DESC, id desc',
            'select' => '%select%, (SELECT pdc.categoryId FROM cu_people_dopCategory pdc WHERE pdc.itemId = i.id) AS dopItemId'
        ];
    }

    public static function getOIListArray($objItemItem, $objItemCompId){
        $url = sprintf($objItemItem->urlTpl, $objItemItem->seoName, $objItemItem->seoUrl);
        $idSplit = baseModel::getPath($objItemCompId, $objItemItem->treeId, $objItemItem->id);

        include(SITE_DIR::SITE_CORE.'core/site/array/station.php');

        $metroText = '';
        $metroList = (new peopleMetroOrm())->selectList('metroId', 'metroId', 'itemId='.$objItemItem->id);
        foreach($metroList as $metroId){
            $metroText .= ', '.$stationList[$metroId];
        }
        $metroText = substr($metroText, 2);

        $saveDir = dirFunc::getSiteDataPath($idSplit);

        $featureList = (new peopleFeatureRelationOrm())
            ->select('pf.name', 'pfr')
            ->join(peopleFeaturesOrm::TABLE.' pf', 'pf.id = pfr.featureId')
            ->where('pfr.itemId='.$objItemItem->id)
            ->toList('name');

        $featureList = implode(', ', $featureList);

        //var_dump($objItemItem);

        return [
            'caption' => $objItemItem->caption,
            'id' => $objItemItem->id,
            'fio' => $objItemItem->fio,
            'rating' => $objItemItem->rating,
            'price' => $objItemItem->price,
            'idSplit' => $idSplit,
            'url' => $url,
            'seoName' => $objItemItem->seoName,
            'category' => $objItemItem->category,
            'exp' => $objItemItem->exp,
            'metro' => $metroText,
            'notefile' => $saveDir.'description.txt',
            'feature' => $featureList,
            'seoUrl' => $objItemItem->seoUrl
        ];
        // func. getOIListArray
    }

    public static function getOILasterArray($objItemObj, $objItemCompId, $oiLasterItemProp, $listCount){
        return [];
        // func. getOILasterArray
    }

    public static function getOIPopularArray($objItemObj, $objItemCompId, $oiPopularItemProp, $listCount){
        return [];
        // func. getOIPopularArray
    }

    public static function getOIRandomArray($objItemObj, $objItemCompId, $rndObjItemProp, $listCount, $arrCount){
        return [];
        // func. getOIRandomArray
    }

    // class. build
}