<?php
namespace site\core\site\comp\spl\oiList\logic\trener;

// Conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\dbus;
use core\classes\render;
use core\classes\userUtils;
use core\classes\site\dir as sitePath;

class trener{

    use \core\comp\spl\oiList\help\blog;

    public static $urlTplList = [
        'pageNav' => ''
    ];

    public static function renderAction($pName){
        $comp = dbus::$comp[$pName];
        $compId = $comp['compId'];
        //$contId = $comp['contId'];
        $varName = $comp['varName'];
        $contId = dbus::$vars[$varName]['id'];

        $file = DIR::APP_DATA . 'comp/' . $compId . '/' . $contId . '/prop.txt';
        $compProp  = @file_get_contents($file);
        $compProp = unserialize($compProp);

        $category = dbus::$vars[$varName.'Name'];

        //$pageNum = 36;
        $pageNum = 1;
        //$compProp['fileCount'] = 40;
        $paginationList = self::getPaginationList($pageNum, $compProp['fileCount']);
        $pageNavTpl = isset($comp['urlTpl']['pageNav'])?$comp['urlTpl']['pageNav']:'';
        $pagUrlParam = [$category];

        $file = DIR::APP_DATA . 'comp/' . $compId . '/' . $contId . '/1.txt';
        $data = @file_get_contents($file);
        if (!$data) {
            return;
        }
        $oiListData = \unserialize($data);
        if ($oiListData) {
            $tpl = userUtils::getCompTpl($comp);
            $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);
            (new render($tplPath, ''))
                ->setVar('oiListData', $oiListData)
                ->setVar('paginationList', $paginationList)
                ->setVar('pageNum', $pageNum)
                ->setVar('pageNavTpl', $pageNavTpl)
                ->setVar('pagUrlParam', $pagUrlParam)
                ->setMainTpl($tpl)
                ->setContentType(null)
                ->render();
        } // if ( $oiListData )
        // func. render
    }
    // class trener
}

