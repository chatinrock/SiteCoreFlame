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

class databuild{


    public static function createFile($pUserData, $pEventBuffer, $pEventList){
        // Если ли вообще какая то активность по списку
        $isData = $pEventBuffer->selectFirst('id', 'eventName in (' . $pEventList . ')');
        if (!$isData) {
            return;
        }

        $engArtList = $pEventBuffer->selectAll('distinct userId, userData ', 'userId', 'eventName in (' . $pEventList . ')');

        foreach($engArtList as $object){
            $compData = \unserialize($object['userData']);
            $objItemId = (int)$object['userId'];

            $loadDir = baseModel::getPath($compData['compId'], $compData['contId'], $objItemId);
            $loadDir = dirFunc::getSiteDataPath($loadDir);

            $saveWordData = (new engwordOrm())->selectAll('*', ['objItemId'=>$objItemId]);

            $osnWord = [];
            $linkWord = [];

            foreach( $saveWordData as $value){
                $wordId = $value['wordId'];
                $osnWord[$wordId] = [];

                $formData = \json_decode($value['data'], true);
                $osnWord[$wordId]['translt'] = $formData['translate'];
                $osnWord[$wordId]['transkr'] = $formData['transcr'];
                $osnWord[$wordId]['link'] = explode(',', $value['osnWordId']);
                $osnWord[$wordId]['sec'] = explode(',', $value['secondWordId']);

                foreach($osnWord[$wordId]['link'] as $secondId ){
                    $linkWord[$secondId] = $wordId;
                }
            } // foreach

            $result = ['osnWord' => $osnWord, 'linkWord' => $linkWord];
            $result = json_encode($result);

            $filename = md5(time().rand()).'.txt';
            echo $filename;

            filesystem::copy($loadDir.'engart.txt', $loadDir, $filename );
            $fa = fopen($loadDir.$filename, 'a' );
            fputs($fa, '<script type="text/javascript">var engData = '.$result.';</script>');
            fclose($fa);
            filesystem::unlink($loadDir.'publish.txt');
            rename($loadDir.$filename, $loadDir.'publish.txt');

        }// foreach






        /*var engData = {
            // Заполняется скриптом
            osnWord: {
                1:{
                    'link': [2],
                    'sec': [3],
                    translt: 'Текст',
                    transkr: 'θɔːt'
                },
                4:{
                    translt: 'Разбросанный',
                    transkr: '\'skætəd'
                },
                11:{
                    translt: 'Разбросанный',
                    transkr: '\'skætəd'
                }

            },
            linkWord:{
                2:1
            }
    } // engData*/

        echo 'create end data';

        //
        //


        exit;
        // func. createFile.
    }


    // class databuild
}