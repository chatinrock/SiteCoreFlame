<?php
namespace site\core\admin\comp\spl\objItem\build\eng\model;

// Engine
use core\classes\admin\dirFunc;
use core\classes\filesystem;
use core\classes\render;
use core\classes\word;

// Model
use admin\library\mvc\comp\spl\objItem\help\model\base\model as baseModel;

// ORM
use site\core\admin\comp\spl\objItem\ORM\engword as engwordOrm;
use site\core\admin\comp\spl\objItem\ORM\engsent as engsentOrm;
use ORM\comp\spl\objItem\objItem as objItemOrm;
use ORM\comp\spl\objItem\article\article as articleOrm;
use ORM\tree\compContTree;

// Conf
use \DIR;
use \site\conf\DIR as SITE_DIR;

class model{

    /*private static function setVipRuleVar(&$data, $render){
        if ( isset($data['vip'])){
            $vip = $data['vip'];
            $contId = $data['rcontid['.$vip.']'];
            $objItemId = $data['ruleart['.$vip.']'];
            if ( $objItemId && $contId){
                unset($data['rcontid['.$vip.']'], $data['ruleart['.$vip.']']);

                $objItemData = (new objItemOrm)
                    ->select('i.seoUrl, cc.seoName, cc.name category, a.urlTpl, i.caption', 'i')
                    ->join(compContTree::TABLE . ' cc', 'i.treeId=cc.id')
                    ->joinLeftOuter(articleOrm::TABLE. ' a', 'i.id=a.objItemId')
                    ->where('i.id=' . $objItemId)
                    ->comment(__METHOD__)
                    ->fetchFirst();

                $vipRule['href'] = sprintf($objItemData['urlTpl'], $objItemData['seoName'], $objItemData['seoUrl']);
                $vipRule['title'] = $objItemData['caption'];
                $render->setVar('vipRule', $vipRule);
            }
        } // if vip
        // func. setVipRuleVar
    }*/

    private static function setRuleVar($data, $render){
        $rule = [];
        foreach($data as $key=>$val){
            if ( !preg_match('/^rcontid\[(\d+)\]$/si', $key, $num) ){
                continue;
            }
            $contId = $data['rcontid['.$num[1].']'];
            if ( !$contId){
                continue;
            }
            $objItemId = $data['ruleart['.$num[1].']'];
            if ( !$objItemId){
                continue;
            }
            $objItemData = (new objItemOrm)
                ->select('i.seoUrl, cc.seoName, cc.name category, a.urlTpl, i.caption', 'i')
                ->join(compContTree::TABLE . ' cc', 'i.treeId=cc.id')
                ->joinLeftOuter(articleOrm::TABLE. ' a', 'i.id=a.objItemId')
                ->where('i.id=' . $objItemId)
                ->comment(__METHOD__)
                ->fetchFirst();

            $aTag['href'] = sprintf($objItemData['urlTpl'], $objItemData['seoName'], $objItemData['seoUrl']);
            $aTag['title'] = $objItemData['caption'];
            $rule[] = $aTag;
        } // foreach $data
        $render->setVar('rule', $rule);
        // func. setRuleVar
    }

    /**
     * Создание HTML файла для правил по слову
     * @param $pLoadDir
     * @param $pData
     */
    private static function createWordCard($pLoadDir, $pData){

        $render = new render(SITE_DIR::SITE_CORE.'tpl/site/comp/spl/objItem/eng/', '');
        $render->setContentType('');

        foreach( $pData as $obj ){
            $data = json_decode($obj['data'], true);
            $render->setVar('comment', $data['comment'], false);
            $render->setVar('transcr', $data['transcr']);
            $render->setVar('translate', $data['translate']);
            $render->setVar('word', $data['word']);

            $wordId = word::idToSplit($obj['wordId']);

            $vipFile = $pLoadDir.'word/'.$wordId.'/vip.html';
            $render->setVar('isVip', is_file($vipFile) && (filesize($vipFile)>0));

            self::setRuleVar($data, $render);
            $render->setMainTpl('help/cardWord.tpl.php');

            ob_start();
            $render->render();
            $codeData = ob_get_clean();



            filesystem::saveFile($pLoadDir.'word/'.$wordId, 'word.html', $codeData);
        } // foreach $pData
        // func. createWordCard
    }

    private static function createSentCard($pLoadDir, $pData){

        $render = new render(SITE_DIR::SITE_CORE.'tpl/site/comp/spl/objItem/eng/', '');
        $render->setContentType('');

        foreach( $pData as $obj ){
            $data = json_decode($obj['data'], true);
            $render->setVar('comment', $data['comment']);
            $render->setVar('translate', $data['translate']);

            $sentId = word::idToSplit($obj['sentId']);

            $vipFile = $pLoadDir.'sent/'.$sentId.'/vip.html';
            $render->setVar('isVip', is_file($vipFile) && (filesize($vipFile)>0));

            //self::setVipRuleVar($data, $render);
            self::setRuleVar($data, $render);

            $render->setMainTpl('help/cardSent.tpl.php');

            ob_start();
            $render->render();
            $codeData = ob_get_clean();

            filesystem::saveFile($pLoadDir.'sent/'.$sentId, 'sent.html', $codeData);
        } // foreach $pData
        // func. createWordCard
    }

    /*private static function getVIPId($formData, $objItemProp){
	
        if ( isset($formData['vip']) && $formData['vip'] != ''){
            $vipNum = $formData['vip'];
            $contId = $formData['rcontid['.$vipNum.']'];
            $objItemId = $formData['ruleart['.$vipNum.']'];
            if ( $contId && $objItemId ){
                $vipId = baseModel::getPath($objItemProp['id'], $contId, $objItemId);
                return rtrim(substr($vipId, 5), '/');
            }
        }
        return '';
        // func. getVIPId
    }*/

    public static function createSentFile($objItemId, $longId, $loadDir, $objItemProp){
        $engsentOrm = new engsentOrm();
        $saveWordData = $engsentOrm->selectAll('*', ['objItemId'=>$objItemId]);
        $osnWord = [];
        foreach( $saveWordData as $value){
            $sentId = $value['sentId'];
            $formData = \json_decode($value['data'], true);

            $osnWord[$sentId] = [];
            //$osnWord[$sentId]['translt'] = $formData['translate'];

            $prefixWordId = word::idToSplit($sentId);
            $vipFile = $loadDir.'sent/'.$prefixWordId.'vip.html';
            $osnWord[$sentId]['vipId'] = is_file($vipFile) && filesize($vipFile) > 0;
        } // foreach

        model::createSentCard($loadDir, $saveWordData);

        return $osnWord;
        // func. createSentFile
    }

    public static function createWordFile($objItemId, $longId, $loadDir, $objItemProp){

            $engwordOrm = new engwordOrm();
            $saveWordData = $engwordOrm->selectAll('*', ['objItemId'=>$objItemId]);

            $osnWord = [];
            $linkWord = [];
            foreach( $saveWordData as $value){
                $wordId = $value['wordId'];
                $formData = \json_decode($value['data'], true);

                $osnWord[$wordId] = [];
                //$osnWord[$wordId]['translt'] = $formData['translate'];
                $osnWord[$wordId]['transkr'] = $formData['transcr'];
                $osnWord[$wordId]['link'] = explode(',', $value['osnWordId']);
                $osnWord[$wordId]['sec'] = explode(',', $value['secondWordId']);

                $prefixWordId = word::idToSplit($wordId);
                $vipFile = $loadDir.'word/'.$prefixWordId.'vip.html';
                $osnWord[$wordId]['vipId'] = is_file($vipFile) && filesize($vipFile) > 0;

                foreach($osnWord[$wordId]['link'] as $secondId ){
                    $linkWord[$secondId] = $wordId;
                }
            } // foreach

            $result = [
                'osnWord' => $osnWord,
                'linkWord' => $linkWord
            ];

            model::createWordCard($loadDir, $saveWordData);

            return $result;
        // func. createWordFile
    }

    // class model
}