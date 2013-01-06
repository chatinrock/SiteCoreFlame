<?php

namespace site\core\admin\comp\spl\objItem\logic\engart\model;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use ORM\comp\spl\objItem\objItem as objItemOrm;

// Engine
use core\classes\arrays;

/**
 * Логика по управлению английской статьёй
 * @author Козленко В.Л.
 */
class model{
    public static function html2data($pFile){
        $htmlData = file_get_contents($pFile);

        $htmlData = preg_replace_callback('/(\d+)\s+(\d+):(\d+):(\d+),\d+\s-->\s\d+:\d+:\d+,\d+/Smsiu', function($matches)use(&$relCount){
            $number = $matches[1];
            $second = $matches[2] * 60 * 60 + $matches[3] * 60 + $matches[4];
            return '</tr><tr class="part" id="second'.$second.'" line="line'.$number.'"><td>';
        }, $htmlData);


        $htmlData = substr($htmlData, 5);

        $wordCount = 0;
        // Вставка слов
        $htmlData = preg_replace_callback('/(<[^>]*>)|([\w\']+)|(&#\d+;)/siu', function($matches)use(&$wordCount){
            if ($matches[0][0] == '<' || $matches[0][0] == '&'){
                return $matches[0];
            }
            ++$wordCount;
            return '<span class="word" rel="'.$wordCount.'">'.$matches[0].'</span>';;
        }, $htmlData);

        // Обработка предложений
        $sentCount = 0;
        $htmlData = preg_replace_callback('/(<span class="word"[^>]*>[^<]*<\/span>[^.!?<]*)+([.!?<])/siu', function($matches)use(&$sentCount){
            ++$sentCount;
            $return = '<span class="sentence" id="sent'.$sentCount.'">';
            if ( substr($matches[0], -1) == '<' ){
                return $return.substr($matches[0], 0, strlen($matches[0])-1).'</span><';
            }

            return $return.$matches[0].'</span>';
        }, $htmlData);

        $htmlData .= '</td></tr>';
        return ['text' => '<table id="htmlDataBox" style="">'.$htmlData.'</table>', 'sentNum'=>$sentCount, 'wordNum'=> $wordCount];
        // func. loadHtmlData
    }

    public static function saveSentenceRule($itemId, $sentId, $ruleData, $ruleMaxId){
        $saveData = ['objItemId' => $itemId];
        $saveData['data'] = json_encode($ruleData);
        $saveData['ruleMaxId'] = $ruleMaxId;
        (new engsentOrm())->saveExt(['sentId'=>$sentId], $saveData);
        // func. saveSentenceRule
    }

    public static function saveWordRule($itemId, $ruleData, $ruleMaxId){
        $saveData = ['osnWordId'=>'', 'secondWordId' => '', 'data' => []];
        $saveData['ruleMaxId'] = $ruleMaxId;
        $wordId = [];
        foreach($ruleData as $key=>$val){
            if ( $key[0] == 'w' && is_numeric(substr($key, 1))){
                $num = (int)substr($key, 1);
                if ( !$wordId ){
                    $wordId['wordId'] = $num;
                    continue;
                } // if ( !$firstSave )

                if ( $val == 'osn' ){
                    $saveData['osnWordId'] .= ','.$num;
                }else{
                    $saveData['secondWordId'] .= ','.$num;
                }
                continue;
            } // if ( $key[0] == 'w' )

            $saveData['data'][$key] = $val;

        } // foreach

        $saveData['data'] = json_encode($saveData['data']);
        $saveData['objItemId'] = $itemId;
        $saveData['osnWordId'] = (string)substr($saveData['osnWordId'], 1);
        $saveData['secondWordId'] = (string)substr($saveData['secondWordId'], 1);

        (new engwordOrm())->saveExt($wordId, $saveData);
        // func. saveWordRule
    }

    private static function getItemIdFormRule(&$objItemIdList, $saveData){
        foreach( $saveData as $obj ){
            $dataJson = json_decode($obj['data'], true);
            foreach( $dataJson as $key=>$value){
                if ( substr($key, 0, 7) != 'ruleart' || !trim($value)){
                    continue;
                }
                $objItemIdList[] = $value;
            } // foreach
        } // foreach
        return $objItemIdList;
        // func. getItemIdFormRule
    }

    public static function getObjItemCaptionList($saveWordData, $saveSentData){
        $objItemIdList = [];
        self::getItemIdFormRule($objItemIdList, $saveWordData);
        self::getItemIdFormRule($objItemIdList, $saveSentData);

        $objItemData = [];
        if ( $objItemIdList ){
            $objItemData = (new objItemOrm())->selectAll('id, caption', ['id'=>$objItemIdList]);
            $objItemData = arrays::dbQueryToAssoc($objItemData, 'id', 'caption');
        }
        return $objItemData;
    }

    // class model ( engart )
}