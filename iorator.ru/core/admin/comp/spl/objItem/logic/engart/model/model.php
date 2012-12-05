<?php

namespace site\core\admin\comp\spl\objItem\logic\engart\model;


/**
 * Логика по управлению английской статьёй
 * @author Козленко В.Л.
 */
class model{
    public static function html2data(){
        $htmlData = file_get_contents('W:/hosting/engdata/eng.txt');

        /*$htmlData = "
02:18:13,632 --> 02:18:16,254
A:

1184
02:18:16,468 --> 02:18:22,257
I";*/

        //$time = microtime(true);
        $htmlData = preg_replace_callback('/(\d+)\s+(\d+):(\d+):(\d+),\d+\s-->\s\d+:\d+:\d+,\d+/Smsiu', function($matches)use(&$relCount){
            $number = $matches[1];
            $second = $matches[2] * 60 * 60 + $matches[3] * 60 + $matches[4];
            return '</div><div class="part" id="second'.$second.'" line="line'.$number.'">';
        }, $htmlData);


        $htmlData = substr($htmlData, 6);

        $relCount = 0;
        // Вставка слов
        $htmlData = preg_replace_callback('/(<[^>]*>)|([\w\']+)|(&#\d+;)/siu', function($matches)use(&$relCount){
            if ($matches[0][0] == '<' || $matches[0][0] == '&'){
                return $matches[0];
            }
            ++$relCount;
            return '<span class="word" rel="'.$relCount.'">'.$matches[0].'</span>';;
        }, $htmlData);

        // Обработка предложений
        $relCount = 0;
        $htmlData = preg_replace_callback('/(<span class="word"[^>]*>[^<]*<\/span>[^.!?<]*)+([.!?<])/siu', function($matches)use(&$relCount){
            ++$relCount;
            $return = '<span class="sentence" id="sent'.$relCount.'">';
            if ( substr($matches[0], -1) == '<' ){
                return $return.substr($matches[0], 0, strlen($matches[0])-1).'</span><';
            }

            return $return.$matches[0].'</span>';
        }, $htmlData);

        $htmlData .= '</div>';
        //echo microtime(true) - $time;
        //echo $htmlData;

        //exit;

        //exit;
        return $htmlData;
        // func. loadHtmlData
    }

    // class model ( engart )
}