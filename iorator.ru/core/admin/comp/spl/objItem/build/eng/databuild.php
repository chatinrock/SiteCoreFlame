<?php

namespace site\core\admin\comp\spl\objItem\build\eng;

// Engine
use core\classes\admin\dirFunc;
use core\classes\filesystem;

// Model
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

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

            $filename = md5(time().rand()).'.txt';
            filesystem::copy($loadDir.'engart.txt', $loadDir, $filename );

            $paramData = filesystem::loadFileContentUnSerialize($loadDir.'param.txt');
            $paramOptions['resUrl'] = $paramData['resurl'];
            $paramOptions = json_encode($paramOptions);

            $fa = fopen($loadDir.$filename, 'a' );
            fputs($fa, '<script type="text/javascript">var engWord = '.$wordData.'; var engSent='.$sentData.'; var paramOptions='.$paramOptions.';</script>');
            fclose($fa);
            filesystem::unlink($loadDir.'publish.txt');
            rename($loadDir.$filename, $loadDir.'publish.txt');
        }// foreach



        echo "\n".'create end data';


        exit;
        // func. createFile.
    }


    // class databuild
}