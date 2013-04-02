<?
// Core
use core\classes\request;
use core\classes\render;
use core\classes\filesystem;
use core\classes\validation\filesystem as filesystemValid;
use core\classes\validation\word as wordValid;
use core\classes\tplParser\adminBlockParser;
use admin\library\mvc\plugin\dhtmlx\model\tree as treeDhtmlx;

// Conf 
use \site\conf\DIR;
use \landing\conf\CONF as LP_CONF;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Config DIR
include '/opt/www/SiteCoreFlame/lps1.uplandingpage.com/conf/DIR.php';
include DIR::CORE.'site/function/autoload.php';
include DIR::CORE.'core/function/errorHandler.php';

$siteName = request::get('category');
if ( $siteName == 'default'){
    die('Default site don\'t edit');
}


if ( !filesystemValid::isSafe($siteName) ){
    die('Bad site name');
}

$dataSiteDir = DIR::APP_DATA.'site/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/';
if ( !is_dir($dataSiteDir ) ){
    die('Bad site name');
}

$dirConf = DIR::APP_DATA.'conf/';
$list = filesystem::dir2array($dirConf, filesystem::DIR);

$dirList = [];
foreach($list as $nameFolder ){
    $item = filesystem::loadFileContent(DIR::APP_DATA.'conf/'.$nameFolder.'/descr.json');
    if ( !$item ){
        continue;
    }
    $item = json_decode($item, true);
    $item['id'] = $nameFolder;
    $item['isCreate'] = is_dir($dataSiteDir.'/'.$nameFolder);
    $dirList[$nameFolder] = $item;
    // foreach
}

$siteDir = DIR::APP_DATA.'site/';

$duri = substr($_SERVER['DOCUMENT_URI'], 0, strlen($_SERVER['DOCUMENT_URI'])-5);
$duri = filesystem::andEndSlash($duri);

$typeAction = request::post('type');
if ( $typeAction == 'update' ){
    $createType = request::post('createType');
    foreach($createType as $id=>$type){
        if ( !wordvalid::isLatin($id) ){
            continue;
        }

        $render = new render(DIR::SITE_CORE.'tpl/', '');
        $render->setMainTpl('distribution.php.tpl');

        $wwwPath = DIR::SITE_WWW.'s/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/'.$id.'/';
        switch($type){
            case 'create':
                if (is_dir($dataSiteDir.$id)){
                    continue;
                }
                filesystem::copyR($siteDir.'d/e/default/'.$id, $dataSiteDir, true);

                filesystem::copy(DIR::SITE_CORE.'tpl/index.html', $wwwPath, 'index.html');
                $dirList[$id]['isCreate'] = true;
                break;
            case 'update':
                $theme = $dirList[$id]['theme'];
                $json = filesystem::loadFileContent($dataSiteDir.$id.'/data.json');
                $tplPath = DIR::LANDING_PAGE_TPL.$theme.'/party';
                $tplFile = DIR::LANDING_PAGE_TPL.$theme.'/index.html';

                $adminBlockParser = new adminBlockParser('');
                $adminBlockParser->setBlockJson(json_decode($json, true));
                $adminBlockParser->setTplPath($tplPath);
                $data = $adminBlockParser->parseBlock($tplFile, adminBlockParser::RETURN_TYPE_RETURN);

                filesystem::saveFile($wwwPath, 'index.html', $data);
                break;
            case 'remove':
                filesystem::rmdirR($dataSiteDir.$id, true);
                filesystem::rmdirR($wwwPath);
                $dirList[$id]['isCreate'] = false;
                break;
        } // switch
    } // foreach

    $dirListKey = array_filter($dirList, function($item){
        return $item['isCreate'];
    });
    $dirListKey = var_export(array_keys($dirListKey), true);

    $render = new render(DIR::SITE_CORE.'tpl/', '');
    $render->setMainTpl('distribution.php.tpl')
        ->setVar('dirList', $dirListKey, false)
        ->setVar('dirCount', count($dirListKey))
        ->setVar('host', $_SERVER['SERVER_NAME'])
        ->setVar('duri', $duri)
        ->renderToFile(DIR::SITE_CORE.'core/www/site'.$duri.'index.php');
} // if

$render = new render(DIR::SITE_CORE.'tpl/', '');
$render->setMainTpl('core.tpl.php')
    ->setBlock('content', 'add/content.tpl.php')
    ->setVar('dirList', $dirList)
    ->setVar('host', $_SERVER['SERVER_NAME'])
    ->setVar('duri', $duri)
    ->setVar('siteName', $siteName)
    ->render();
// renderFile