<?php

namespace site\core\admin\comp\spl\objItem\build\eng;

// Engine
use core\classes\admin\dirFunc;
use core\classes\filesystem;

// Model
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;
// Model
use site\core\admin\comp\spl\objItem\build\eng\model\model;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use ORM\tree\componentTree;

class databuild{


    public static function createFile($pUserData, $pEventBuffer, $pEventList){
        // Если ли вообще какая то активность по списку
        $isData = $pEventBuffer->selectFirst('id', 'eventName in (' . $pEventList . ')');
        if (!$isData) {
            return;
        }

        $objItemProp = (new componentTree())->selectFirst('*', 'sysname="objItem"');

        $engArtList = $pEventBuffer->selectAll('distinct userId, userData ', 'eventName in (' . $pEventList . ')');
        foreach($engArtList as $object){
            $compData = \unserialize($object['userData']);
            $objItemId = (int)$object['userId'];
            $longId = baseModel::getPath($compData['compId'], $compData['contId'], $objItemId);
            $loadDir = dirFunc::getSiteDataPath($longId);

            $wordData = model::createWordFile($objItemId, $longId, $loadDir, $objItemProp);
            $sentData = model::createSentFile($objItemId, $longId, $loadDir, $objItemProp);

            $filename = 'temp.txt';
            $engHtml = file_get_contents($loadDir.'engart.txt');
            //filesystem::copy($loadDir.'engart.txt', $loadDir, $filename );

            // Добавляем title для слов
            foreach( $wordData['osnWord'] as $rel => $data ){
                $title = isset($data['translt']) ? $data['translt'] : '';
                $searchStr = 'rel="'.$rel.'"';
                $targetStr = 'rel="'.$rel.'" title="'.$title.'"';
                $engHtml = str_replace($searchStr, $targetStr, $engHtml);
            } // for

            // Добавляем title для предложения
            foreach( $sentData as $num => $data ){
                $title = isset($data['translt']) ? $data['translt'] : '';
                $searchStr = 'id="sent'.$num.'"';
                $targetStr = 'id="sent'.$num.'" stitle="'.$title.'"';
                $engHtml = str_replace($searchStr, $targetStr, $engHtml);
            } // for

            $engHtml = preg_replace_callback('/<\/tr (\d+)>/', function($matches){
                $second = $matches[1];

                $time[0] = floor($second/3600%24);
                $time[1] = floor($second/60%60);
                $time[2] = floor($second%60);

                $time = array_map(function($val){
                    return str_pad($val, 2, "0", STR_PAD_LEFT);
                }, $time);

                return '<td class="time">'.implode(':', $time).'</td></tr>';
            }, $engHtml);

            $paramData = filesystem::loadFileContentUnSerialize($loadDir.'param.txt');

            $engHtml = str_replace('<table', '<table class="'.$paramData['type'].'"', $engHtml);

            file_put_contents($loadDir.$filename, $engHtml);

            $paramOptions = [];
            $paramOptions['resUrl'] = $paramData['resurl'];
            $paramOptions['type'] = $paramData['type'];
            $paramOptions['objId'] = $objItemId;
            $paramOptions['path'] = trim(substr($longId, 5), '/');

            $paramOptions = json_encode($paramOptions);

            $fa = fopen($loadDir.$filename, 'a' );
            fputs($fa, '<script type="text/javascript">var engWord = '.json_encode($wordData).'; var engSent='.json_encode($sentData).'; var paramOptions='.$paramOptions.';</script>');
            fclose($fa);
            filesystem::unlink($loadDir.'publish.txt');
            rename($loadDir.$filename, $loadDir.'publish.txt');
            // Удаляем временный файл
            filesystem::unlink($loadDir.$filename);
        }// foreach

        // func. createFile.
    }


    // class databuild
}