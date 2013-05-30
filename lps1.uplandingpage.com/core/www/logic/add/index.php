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
} // if ( $siteName == 'default')

session_start();

if ( !isset($_SESSION['userData']) ){
    header('Location: http://lps1.uplandingpage.com/auth/');
    exit;
}
$userData = $_SESSION['userData'];

if ( $_SESSION['userData']['site'] != $siteName ){
    die('Access forbidden');
}

if ( !filesystemValid::isSafe($siteName) ){
    die('Bad site name');
}


$dataSiteDir = DIR::APP_DATA.'site/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/';
/*if ( !is_dir($dataSiteDir ) ){
    die('Bad site name');
}*/

$mongoHandle = new MongoClient("mongodb://localhost");
$profileList = $mongoHandle->uplandingpage->profile->find(['user'=>$userData['_id']], ['name'=>1, '_id'=>0, 'list'=>1]);
$profileList = iterator_to_array($profileList);

$themeData = [];
foreach($profileList as $num=>$item ){
    $themeListTmp = array_flip($item['list']);
    $themeData = array_merge($themeData, $themeListTmp);

    $item['data'] = [];
    foreach($item['list'] as $subName=>$themeId){
        $dir = $dataSiteDir.$item['name'].'/'.$subName;
        if ( is_dir($dir) ){
            $profileList[$num]['data'][$subName] = is_file($dir.'/off') ? 'turnoff' : 'exists';
        }else{
            $profileList[$num]['data'][$subName] = '';
        }
    } // foreach $themeListTmp
} // foreach $profileList

$themeData = array_keys($themeData);
$themeData = $mongoHandle->uplandingpage->themes->find(['_id'=>['$in'=>$themeData]]);
$themeDataTemp = [];
foreach($themeData as $item){
    $themeDataTemp[$item['_id']] = $item;
    unset($themeDataTemp[$item['_id']]['_id']);
}
$themeData = $themeDataTemp;

$dirList = [];
$siteDir = DIR::APP_DATA.'site/';

$duri = substr($_SERVER['DOCUMENT_URI'], 0, strlen($_SERVER['DOCUMENT_URI'])-5);
$duri = filesystem::andEndSlash($duri);

$typeAction = request::post('type');
if ( $typeAction == 'update' ){
    $createType = request::post('createType');
    $profileName = request::post('profile');
    $profileNum = setProfileDataStatus($profileList, $profileName);

    foreach($createType as $subName=>$actionType){
        if ( !preg_match('/[\w-_]+/', $subName) ){
            continue;
        }

        $themeId = $profileList[$profileNum]['list'][$subName];

        $render = new render(DIR::SITE_CORE.'tpl/', '');
        $render->setMainTpl('distribution.php.tpl');

        $wwwPath = DIR::SITE_WWW.'s/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/'.$profileName.'/'.$subName.'/';
        $dataPath = $dataSiteDir.$profileName.'/'.$subName.'/';
        switch($actionType){
            case 'create':
                filesystem::copyR($siteDir.'d/e/default/'.$themeId.'/*', $dataPath, true);
                filesystem::copy(DIR::SITE_CORE.'tpl/index.html', $wwwPath, 'index.html');

                if ( $profileNum !== null ){
                    $profileList[$profileNum]['data'][$subName] = 'exists';
                }
                break;
            case 'update':
                $json = filesystem::loadFileContent($dataPath.'data.json');
                $json = $json ? json_decode($json, true) : [];

                $tplPath = DIR::LANDING_PAGE_TPL.$themeId.'/party';
                $tplFile = DIR::LANDING_PAGE_TPL.$themeId.'/index.html';

                $adminBlockParser = new adminBlockParser('');
                $adminBlockParser->setBlockJson($json);
                $adminBlockParser->setTplPath($tplPath);
                $data = $adminBlockParser->parseBlock($tplFile, adminBlockParser::RETURN_TYPE_RETURN);

                filesystem::saveFile($wwwPath, 'index.html', $data);
                break;
            case 'remove':
                filesystem::rmdirR($dataPath, true);
                filesystem::rmdirR($wwwPath);

                if ( $profileNum !== null ){
                    $profileList[$profileNum]['data'][$subName] = '';
                }
                break;
			case 'turnoff':
			    $fempty = fopen($dataPath.'off', 'w');
				if ( $fempty ){
					fclose($fempty);
				}
                filesystem::rename($wwwPath.'index.html', $wwwPath.'-index.html');
                if ( $profileNum !== null ){
                    $profileList[$profileNum]['data'][$subName] = 'turnoff';
                }
				break;
            case 'turnon':
                filesystem::unlink($dataPath.'off');
                filesystem::rename($wwwPath.'-index.html', $wwwPath.'index.html');
                if ( $profileNum !== null ){
                    $profileList[$profileNum]['data'][$subName] = 'exists';
                }
                break;
        } // switch
    } // foreach

    $dirListKey = array_filter($profileList[$profileNum]['data'], function($item){
        return $item && $item != 'turnoff';
    });
    $dirListKey = var_export(array_keys($dirListKey), true);

    $redirectUrl = $userData['domain'] ? '/' : $duri;

    $renderDir = DIR::SITE_CORE.'core/www/site'.$duri.$profileName;
    filesystem::mkdir($renderDir);
    $render = new render(DIR::SITE_CORE.'tpl/', '');
    $render->setMainTpl('distribution.php.tpl')
        ->setVar('dirList', $dirListKey, false)
        ->setVar('dirCount', count($profileList[$profileNum]['list']))
        ->setVar('profileName', $profileName)
        ->setVar('host', $_SERVER['HTTP_HOST'])
        ->setVar('duri', $redirectUrl)
        ->renderToFile($renderDir.'/index.php');
} // if

//var_dump($profileList);

$render = new render(DIR::SITE_CORE.'tpl/', '');
$render->setMainTpl('core.tpl.php')
    ->setBlock('content', 'add/content.tpl.php')
    ->setVar('themeData', $themeData)
    ->setVar('host', $_SERVER['HTTP_HOST'])
    ->setVar('duri', $duri)
    ->setVar('siteName', $siteName)
    ->setVar('profileList', $profileList)
    ->render();
// renderFile


function setProfileDataStatus($profileList, $profileName){
    foreach($profileList as $num=>$item){
        if ( $item['name'] == $profileName ){
            //$profileList[$num]['data'][$id] = $status;
            return $num;
        }
    }
    return null;//$profileList;
    // func. setProfileDataStatus
}