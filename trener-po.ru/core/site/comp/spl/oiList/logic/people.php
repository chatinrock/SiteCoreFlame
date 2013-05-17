<?php

namespace site\core\site\comp\spl\oiList\logic;

// Conf
use site\conf\DIR;
use site\conf\SITE;

// Engine
use core\classes\dbus;
use core\classes\render;
use core\classes\userUtils;
use core\classes\site\dir as sitePath;

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Description of main
 *
 * @author Козленко В.Л.
 */
class people {
	use \core\comp\spl\oiList\help\blog;

    public static $urlTplList = [
        'pageNav' => null,
        'category' => null
    ];
	
    /**
     * Отображение отзывов.
     * @param type $pName
     */
    public static function renderAction($pName) {
        $comp = dbus::$comp[$pName];
        $compId = $comp['compId'];
        $contId = $comp['contId'];
		
		// Если есть data, значит нам указали директорию
        if (!isset($comp['varName'])) {
            echo 'Error(renderByCategory): Not category varible';
            return;
        }
		
		$varName = $comp['varName'];
		
		list($pageNum, $categoryId, $catName, $fileCount, $catCap) = self::getDataCategory($varName);
		
		$file = DIR::APP_DATA . 'comp/' . $compId . '/' . $contId . '/' . $categoryId . '/prop.txt';
		//echo $file;
        $data = @file_get_contents($file);
        if ($data) {
            $prop = \unserialize($data);
            unset($data);
        }else{
            echo 'No found settings file data';
            return;
        } // if

		self::$_paginationList = self::getPaginationList($pageNum, $prop['fileCount']);
		//var_dump(self::$_paginationList);
		// Шаблон ссылки для пагинации
		self::$_paginationUrlTpl = isset($comp['urlTpl']['pageNav'])?$comp['urlTpl']['pageNav']:'';
		self::$_paginationUrlParam = [$catName];
		self::$_paginationPageNum = $pageNum;

        $file = DIR::APP_DATA . 'comp/' . $compId . '/' . $contId . '/'.$categoryId.'/'.$pageNum.'.txt';
		
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
				->setVar('categoryId', $categoryId)
				->setBlock('item', '.item.html')
                ->setMainTpl($tpl)
                ->setContentType(null)
                ->render();
        } // if ( $oiListData )

        // func. renderAction
    }
	
	
	

    // class. main
}