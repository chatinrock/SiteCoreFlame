<?
// Core
use core\classes\request;
use core\classes\render;
use core\classes\filesystem;
use core\classes\validation\word as wordvalid;
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
$subName = request::get('num');
$profileName = request::get('profile');

session_start();
if ( !isset($_SESSION['userData']) ){
    header('Location: http://lps1.uplandingpage.com/auth/');
    exit;
}
$userData = $_SESSION['userData'];

if ( $_SESSION['userData']['site'] != $siteName ){
    die('Access forbidden');
}

if ( !wordvalid::isLatin($subName) ){
    die('Bad landing page name');
}

/*$confFile = DIR::APP_DATA.'conf/'.$subName.'/conf.php';
if ( !is_file($confFile)){
    die('ERROR: '.$confFile." not found".PHP_EOL);
}
include $confFile;*/

$mongoHandle = new MongoClient("mongodb://localhost");
$themeList = $mongoHandle->uplandingpage->profile->findOne(['user'=>$userData['_id'], 'name'=>$profileName], ['list'=>1, '_id'=>0]);
if ( !isset($themeList['list'][$subName]) ){
    die('Bad theme name');
}
$themeId = $themeList['list'][$subName];

$saveDir = DIR::APP_DATA.'site/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/'.$profileName.'/'.$subName.'/';
$tplFile = DIR::LANDING_PAGE_TPL.$themeId.'/index.html';

$tplPath = DIR::LANDING_PAGE_TPL.$themeId.'/party';
$treeFile = treeDhtmlx::createTreeOfDir($tplPath);
$treeFile = json_encode($treeFile);
$json = filesystem::loadFileContent($saveDir.'data.json');
// ============================================================================
$action = request::get('action');
switch($action){
    case 'save':
        header('Content-Type: application/json');
        $json = json_encode($_POST);
        filesystem::saveFile($saveDir, 'data.json', $json);
        echo json_encode([]);
        exit;
    case 'publish':
        header('Content-Type: application/json');
        $wwwDir = DIR::SITE_WWW.'s/'.$siteName[0].'/'.$siteName[1].'/'.$siteName.'/'.$profileName.'/'.$subName.'/';

        $adminBlockParser = new adminBlockParser('');
        $adminBlockParser->setBlockJson(json_decode($json, true));
        $adminBlockParser->setTplPath($tplPath);
        $data = $adminBlockParser->parseBlock($tplFile, adminBlockParser::RETURN_TYPE_RETURN);
        filesystem::mkdir($wwwDir);
        filesystem::saveFile($wwwDir, 'index.html', $data);
        echo json_encode([]);
        exit;
}

header('Content-Type: text/html;charset=UTF-8');

// ============================================================================
$file = request::get('file');
if ($file){
    $tplFile = DIR::LANDING_PAGE_TPL.$themeId.'/party'.$file;
    (new adminBlockParser($tplFile, adminBlockParser::RETURN_TYPE_ECHO));
    exit;
}
// ============================================================================

$adminBlockParser = new adminBlockParser('');
$adminBlockParser->setBodyEndData('<script>var blockData = {treeFileJson:'.$treeFile.', saveData: '.($json?:'null').'}</script>');
$adminBlockParser->setBlockJson(json_decode($json, true));
$adminBlockParser->setTplPath($tplPath);
$adminBlockParser->setAdminResPath(DIR::SITE_CORE.'tpl/include/');
$adminBlockParser->parseBlock($tplFile, adminBlockParser::RETURN_TYPE_ECHO);

//var_dump($treeFile);