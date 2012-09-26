<?php

namespace site\core\admin\comp\spl\objItem\build\people;

// Orm
use ORM\comp\spl\objItem\article\article as articleOrm;

// Model
use admin\library\mvc\comp\spl\objItem\model as objItemModel;
use buildsys\library\event\comp\spl\objItem\model as eventModelObjitem;
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

// Engine
use core\classes\admin\dirFunc;

// Conf
use \DIR;

// Custom ORM
use site\core\admin\comp\spl\objItem\ORM\trener as trenerOrm;

/**
 * Description of event
 *
 * @author Козленко В.Л.
 */
class people implements \admin\library\mvc\comp\spl\objItem\help\builderAbs {

    public static function getTable(){
        return [trenerOrm::TABLE];
        // func. getTable
    }

    /**
     * Способ сортировки
     * @param $pAdvField
     */
    public static function setAdvField($pAdvField){
        $pAdvField['order'] = 'rating DESC';
        return $pAdvField;
        // func. getOrder
    }

    public static function getOIListArray($objItemItem, $objItemCompId){
        $url = sprintf($objItemItem->urlTpl, $objItemItem->seoName, $objItemItem->seoUrl);
        $idSplit = baseModel::getPath($objItemCompId, $objItemItem->treeId, $objItemItem->id);
        return [
            'caption' => $objItemItem->caption,
            'id' => $objItemItem->id,
            'url' => $url,
            'idSplit' => $idSplit,
            // Название категории, к которой пренадлежит статья
            'category' => $objItemItem->category,
            // Сео название категории
            'seoName' => $objItemItem->seoName,
            'dateAdd' => $objItemItem->date_add,
            'age' => $objItemItem->age,
            'experience' => $objItemItem->experience,
            'fio' => $objItemItem->fio,
            'price' => $objItemItem->price,
            'photoUrl' => $objItemItem->photoUrl,
            'rating' => $objItemItem->rating
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

    // class. people
}