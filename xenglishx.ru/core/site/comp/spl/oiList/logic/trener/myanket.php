<?php
namespace site\core\site\comp\spl\oiList\logic\trener;

// Conf
use site\conf\DIR;
use site\conf\SITE;

// ORM
use site\core\admin\comp\spl\objItem\ORM\trener as trenerOrm;
use ORM\comp\spl\objItem\objItem as objItemOrm;
use ORM\tree\compcontTree;

// Engine
use core\classes\dbus;
use core\classes\render;
use core\classes\userUtils;
use core\classes\site\dir as sitePath;
use  core\classes\cookie;

class myanket{

    use \core\comp\spl\oiList\help\blog;

    public static function renderAction($pName){
        $comp = dbus::$comp[$pName];
        $compId = $comp['compId'];

        $anketList = cookie::getListNum('anketList');
        $oiListData = [];
        if ( count($anketList) > 1 ){
            unset($anketList[0]);
            $where = implode(',', $anketList);
            $oiListData = (new trenerOrm())
                ->select('t.fio caption, t.photoUrl url, t.*, oi.id, cc.seoName cat', 't')
                ->join(objItemOrm::TABLE.' oi', 'oi.id=t.objItemId')
                ->join(compcontTree::TABLE.' cc', 'cc.id=oi.treeId')
                ->where('t.objItemId in ('.$where.') and oi.isPublic="yes" and oi.isDel = 0')
                ->fetchAll();
        }

        if ($oiListData) {
            $tpl = userUtils::getCompTpl($comp);
            $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);
            (new render($tplPath, ''))
                ->setVar('oiListData', $oiListData)
                ->setVar('typeRmMark', 'rmObj')
                ->setMainTpl($tpl)
                ->setContentType(null)
                ->render();
        } // if ( $oiListData )

        // func. render
    }

    // class trener
}

