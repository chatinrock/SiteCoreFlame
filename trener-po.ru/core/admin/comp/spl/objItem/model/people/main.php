<?php

namespace site\core\admin\comp\spl\objItem\model\people;

// Conf
use site\conf\DIR as SITE_DIR;
use \DIR;

// ORM
use ORM\tree\compContTree;
use ORM\tree\componentTree;
use ORM\comp\spl\objItem\objItem as objItemOrm;
use site\core\ORM\people as peopleOrm;
use site\core\ORM\peopleFeatures as peopleFeaturesOrm;
use site\core\ORM\peopleMetro as peopleMetroOrm;
use site\core\ORM\peopleFeatureRelation as peopleFeatureRelationOrm;
use site\core\ORM\peopleDopCategory as peopleDopCategoryOrm;
use site\core\ORM\peopleVideo as peopleVideoOrm;
use ORM\plugin\video as videoOrm;

// Engine
use core\classes\filesystem;
use core\classes\DB\table;
use core\classes\arrays;


//ini_set('display_errors', 1);
//error_reporting(E_ALL);


/**
 * Description of review
 *
 * @author Козленко В.Л.
 */
class main{

    public static function getFeatureList($objItemId){
        return (new peopleFeaturesOrm())
            ->select('pf.id, pf.name, IF(ISNULL(pfr.itemId), 0, 1) flag', 'pf')
            ->joinLeftOuter(peopleFeatureRelationOrm::TABLE.' pfr', 'pf.id=pfr.featureId and pfr.itemId='.$objItemId)
            ->fetchAll();
        // func. getFeatureList
    }

    public static function getSavedData($objItemId){
        return (new peopleOrm())->selectFirst('*', ['objItemId' => $objItemId]);
        // func. getSavedData
    }

    public static function getDopCategory($objItemId){
        return (new compContTree())
            ->select('pct1.name, pct1.id, IF(ISNULL(pdc.itemId), 0, 1) flag', 'pct')
            ->join(compContTree::TABLE.' pct1', 'pct1.tree_id = pct.id')
            ->joinLeftOuter(peopleDopCategoryOrm::TABLE.' pdc', 'pct1.id=pdc.categoryId and pdc.itemId='.$objItemId)
            ->where('pct.mark = "people"')
            ->fetchAll();
        // func. getDopCategory
    }

    public static function getMetroList($objItemId){
        return (new peopleMetroOrm())->selectList('metroId', 'metroId', 'itemId='.$objItemId);
        // func. getMetroList
    }

   public static function saveMetroList($metroList, $objItemId){
       $peopleMetroOrm = new peopleMetroOrm();
       $peopleMetroOrm->delete('itemId='.$objItemId);

       $metroList = json_decode($metroList);
       if ( $metroList && is_array($metroList) ){
           $metroList = array_map('intVal', $metroList);
           $peopleMetroOrm->insertMulti(['metroId' => $metroList], ['itemId' => $objItemId]);
       }

       include(SITE_DIR::SITE_CORE.'core/site/array/station.php');

       $metroText = '';
       $metroList = $peopleMetroOrm->selectList('metroId', 'metroId', 'itemId='.$objItemId);
       foreach($metroList as $metroId){
           $metroText .= ', '.$stationList[$metroId];
       }
       return substr($metroText, 2);
       // func. saveMetroList
   }

    public static function saveFeature($peopleFeature, $objItemId){
        $peopleFeatureRelationOrm = new peopleFeatureRelationOrm();
        $peopleFeatureRelationOrm->delete('itemId='.$objItemId);
        if ( $peopleFeature && is_array($peopleFeature) ){
            $peopleFeature = array_map('intVal', $peopleFeature);
            $peopleFeatureRelationOrm->insertMulti(['featureId' => $peopleFeature], ['itemId' => $objItemId]);
        }

        $featureList = $peopleFeatureRelationOrm
            ->select('pf.name', 'pfr')
            ->join(peopleFeaturesOrm::TABLE.' pf', 'pf.id = pfr.featureId')
            ->where('pfr.itemId='.$objItemId)
            ->toList('name');

        return implode(', ', $featureList);
        // func. saveFeature
    }

    public static function saveDopCategory($peopleDopCategoryList, $objItemId){
        $peopleDopCategoryOrm = new peopleDopCategoryOrm();
        $peopleDopCategoryOrm->delete('itemId='.$objItemId);
        if ( !$peopleDopCategoryList || !is_array($peopleDopCategoryList) ){
            return;
        }
        $peopleDopCategoryList = array_map('intVal', $peopleDopCategoryList);
        $peopleDopCategoryOrm->insertMulti(['categoryId' => $peopleDopCategoryList], ['itemId' => $objItemId]);
        // func. saveFeature
    }

    /**
     * Получаем данные, ранее сохранённые методом self::saveVideo
     * @see Основная табл. cu_people_video
     * @param $objItemId - ID объекта по которому производим сохранение. см табл. pr_comp_objitem
     * @param $pType - тип объекта: VIDEO или REVIEW. см табл. cu_people_video
     * @return mixed
     */
    public static function getVideoData($objItemId, $pType){
        return (new peopleVideoOrm())->selectList('videoId', 'videoId', 'itemId='.$objItemId.' and type="'.$pType.'"');
        // func. getVideoData
    }

    /**
     * Сохраняет данные по видео данным и создаёт превью для картинок по видео
     * @see Основная табл. cu_people_video
     * @param $pVideoList - список ID видео. см табл. pr_plugin_video
     * @param $objItemId - ID объекта по которому производим сохранение. см табл. pr_comp_objitem
     * @param $pType - тип объекта: VIDEO или REVIEW. см табл. cu_people_video
     * @param $filesOrm - ORM объекта для доступа к параметрам файлов изображений
     */
    public static function saveVideo($pVideoList, $objItemId, $pType, $idPref, $filesOrm){
        $videoList = json_decode($pVideoList);
        if ( !is_array($videoList)){
            return;
        }
        $videoList = array_map('intVal', $videoList);

        $field = ['itemId'=>$objItemId, 'type'=>$pType];
        $peopleVideoOrm = new peopleVideoOrm();
        $peopleVideoOrm->delete($field);

        $fileDist = SITE_DIR::IMG_RESIZE_DATA.$idPref.$pType.'/';
        filesystem::mkdir($fileDist);
        exec('rm '.$fileDist.'*.jpg');

        if ( !$videoList ){
            return;
        }

        $peopleVideoOrm->insertMulti(['videoId'=>$videoList], $field);

        $result = [];
        //(new peopleVideoOrm())->selectList('videoId', 'videoId', 'itemId='.$objItemId.' and type="'.$pType.'"');

        $imgData = (new videoOrm())->selectAll('imgId, txt', ['id'=>$videoList]);
        $imgList = arrays::dbQueryToAssoc($imgData, 'imgId', 'txt');

        $imgDataList = $filesOrm->setHandleName('files')->selectAll('path, file, id', ['id'=>array_keys($imgList)]);
        foreach($imgDataList as $num=>$imgData){
            $fileSrc = \PROFILE::UPLOAD_DIR.$imgData['path'].$imgData['file'];
            $exec = SITE_DIR::SITE_CORE.'core/cli/people/resize200.sh '.$fileSrc.' '.$fileDist.$num.'.jpg &';
            \exec($exec);
            $result[] = $imgList[$imgData['id']];
            //$result[] = $imgData['url'];
        } // foreach

        return $result;
        // func. saveVideo
    }

    public static function saveImgData($pPreview, $gallery, $document, $saveDir, $idPref, $filesOrm){
        $imgData = filesystem::loadFileContentUnSerialize($saveDir.'img.srl');

        $preview = json_decode($pPreview);
        if ( !$preview || !isset($preview->id) || !$preview->id ){
            return;
        }
        $loadDataPreview = json_decode($imgData['imgPreview'], true) ?: ['id'=>-1];

        if ( $loadDataPreview['id'] != $preview->id ){
            $imgData = $filesOrm->setHandleName('files')->selectFirst('path, file', "id='".$preview->id."'");

            $fileSrc = \PROFILE::UPLOAD_DIR.$imgData['path'].$imgData['file'];

            $fileDist = SITE_DIR::IMG_RESIZE_DATA.$idPref;
            filesystem::mkdir($fileDist);
            $fileDist .= 'preview.jpg';

            $exec = SITE_DIR::SITE_CORE.'core/cli/people/resize200.sh '.$fileSrc.' '.$fileDist.' &';
            \exec($exec);
        } // if ( $imgData['imgPreview'] != $pPreview )

        $imgData = [
            'imgPreview' => $pPreview,
            'galleryList' => $gallery,
            'documentList' => $document
        ];
        filesystem::saveFile($saveDir, 'img.srl', serialize($imgData));

        $fileDist = SITE_DIR::IMG_RESIZE_DATA.$idPref.'gallery/';
        filesystem::mkdir($fileDist);
        exec('rm '.$fileDist.'*.jpg');

        $result['gallery'] = [];
        $gallery = @json_decode($gallery, true);
        if ( $gallery && is_array($gallery)){
            $imgDataList = $filesOrm->setHandleName('files')->selectAll('path, file', ['id'=>array_keys($gallery)]);
            foreach($imgDataList as $num=>$imgData){
                $fileSrc = \PROFILE::UPLOAD_DIR.$imgData['path'].$imgData['file'];
                $exec = SITE_DIR::SITE_CORE.'core/cli/people/resize110.sh '.$fileSrc.' '.$fileDist.$num.'.jpg &';
                \exec($exec);
                $result['gallery'][] = 'http://s01.file.codecampus.ru/people/src/'.$imgData['path'].$imgData['file'];
            } // foreach
        } // if ( $gallery && is_array($gallery))

        $fileDist = SITE_DIR::IMG_RESIZE_DATA.$idPref.'document/';
        filesystem::mkdir($fileDist);
        exec('rm '.$fileDist.'*.jpg');

        $result['document'] = [];
        $document = @json_decode($document, true);
        if ( $document && is_array($document) ){
            $imgDataList = $filesOrm->setHandleName('files')->selectAll('path, file', ['id'=>array_keys($document)]);
            foreach($imgDataList as $num=>$imgData){
                $fileSrc = \PROFILE::UPLOAD_DIR.$imgData['path'].$imgData['file'];
                $result['document'][] = 'http://s01.file.codecampus.ru/people/src/'.$imgData['path'].$imgData['file'];
                $exec = SITE_DIR::SITE_CORE.'core/cli/people/resize110.sh '.$fileSrc.' '.$fileDist.$num.'.jpg &';
                \exec($exec);
            }
        } // if ( $document && is_array($document) )
        //$result['document'] = count($imgDataList);
        return $result;
        // saveImgData
    }

    public static function getVideoPreview($pVideoId, $filesOrm){
        $result = [];

        $videoData = (new videoOrm())->selectFirst('imgId, txt', ['id'=>$pVideoId]);
        $imgDataList = $filesOrm->setHandleName('files')->selectFirst('path, file, id', ['id'=>$videoData['imgId']]);
        $result['videoUrl'] = $videoData['txt'];
        $result['imgUrl'] = 'http://s01.file.codecampus.ru/people/src/'.$imgDataList['path'].$imgDataList['file'];

        return $result;
        // func. getVideoPreview
    }

    // class main (model)
}