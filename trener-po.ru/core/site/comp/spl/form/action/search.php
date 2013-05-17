<?
namespace site\core\site\comp\spl\form\action;

// Engine
use core\classes\request;
use site\core\ORM\people as peopleOrm;
use core\classes\filesystem;
use core\classes\site\dir as sitePath;
use core\classes\render;

// ORM
use ORM\comp\spl\objItem\objItem as objItemOrm;
use site\core\ORM\peopleDopCategory as peopleDopCategoryOrm;
use ORM\tree\compContTree;

// Conf
use \site\conf\DIR;

ini_set('display_errors', 1);
error_reporting(E_ALL);

class search{
    use \core\comp\spl\oiList\help\blog;

    public function run(){
        $prices = request::post('prices', '0;1000000');
        $rating  = request::postInt('rating');
        $metro  = request::post('metro');
        $pageNum  = request::postInt('pageNum', 1);

        $categoryId  = request::postInt('categoryId');
        if ( !$categoryId ){
            return [];
        }

        $pageSize = 8;

        $prices = explode(';', $prices);
        $prices[1] = isset($prices[1]) ? $prices[1] : 1000000;
        $prices = array_map('intVal', $prices);

        $sql = 'SELECT i.*, cc.seoName, cc.name category, cc.comp_id compId
              FROM '.objItemOrm::TABLE.' i
              LEFT OUTER JOIN '.peopleOrm::TABLE.' a0 ON a0.objItemId=i.id
              JOIN '.compContTree::TABLE.' cc ON cc.id=i.treeId
              WHERE (i.isPublic="yes" AND i.isDel=0 AND i.treeId = '.$categoryId.' OR
                        i.id IN (SELECT itemId FROM '.peopleDopCategoryOrm::TABLE.' pdc
                        WHERE pdc.categoryId = '.$categoryId.') )
              AND a0.price >= '.$prices[0].' AND a0.price <= '.$prices[1].'
              AND a0.rating > '.$rating;
        if ( $metro ){
            $metro = explode(',', $metro);
            $metro = array_map('intVal', $metro);
            $metro = implode(',', $metro);
            $sql .= ' AND i.id IN (SELECT pm.itemId FROM cu_people_metro pm WHERE pm.metroId IN ('.$metro.') ) ';
        }
        $sql .= ' ORDER BY rating desc, price, date_add DESC, id desc';

        $trenerHandle = (new peopleOrm())->sql($sql)->query();

        $recordCount = $trenerHandle->num_rows;
        if ( $recordCount == 0 ){
            return ['pagination'=>'<div id="pagination"></div>', 'file'=>''];
        }

        $trenerHandle->data_seek($pageSize * ($pageNum-1));

        $i = 0;
        while ($item = $trenerHandle->fetch_object()) {
            $path = DIR::APP_DATA . 'comp/' . $item->compId . '/' .$item->treeId .'/'. $item->id . '/';
            $file = $path.'data.txt';

            $data[$i] = filesystem::loadFileContentUnSerialize($file);
            $data[$i]['url'] = $data[$i]['seoUrl'].'/';
            $data[$i]['notefile'] = $path.'description.txt';
            ++$i;
            if ( $i == $pageSize ){
                break;
            }
        } // foreach
        $trenerHandle->close();

        $tplPath = sitePath::getSiteCompTplPath(true, 'spl/oiList/');
        $render = new render($tplPath, '');
        ob_start();
        $render->setMainTpl('.item.html')
            ->setVar('oiListData', $data)
            ->setContentType(null)
            ->render();
        $result['file'] = ob_get_clean();


        $paginationList = self::getPaginationList($pageNum, $recordCount/$recordCount);
        $tplPath = sitePath::getSiteCompTplPath(false, 'spl/oiList/');
        ob_start();
        $render->setTplPath($tplPath)
            ->setMainTpl('pagination.php')
            ->setVar('paginationList', $paginationList)
            ->setVar('pageNum', $pageNum)
            ->setVar('paginationUrlTpl', '#%s')
            ->setVar('pagionationUrlParam', [])
            ->setContentType(null)
            ->render();
        $result['pagination'] = ob_get_clean();

        return $result;
        // func. run
    }

} // class search