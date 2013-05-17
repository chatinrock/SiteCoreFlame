<?
include('/opt/www/FlameCore/engine/core/classes/filesystem.php');
include('/opt/www/FlameCore/engine/core/function/errorHandler.php');

use core\classes\filesystem;

$consoleData = getopt('n:');
$siteName=isset($consoleData['n'])?$consoleData['n']:'';

if ( !is_string($siteName) || !trim($siteName) ){
	echo "Use: createSite.php -n={sitename}".PHP_EOL;
	exit;
} // if

chdir('/opt/www/SiteCoreFlame/');
 
filesystem::mkdir($siteName.'/www/', 0755);
filesystem::mkdir($siteName.'/data/comp/', 0775);
$chown = 'sudo /bin/chown -R www-data:www-data /opt/www/SiteCoreFlame/'.$siteName.'/data/comp';
system($chown);

filesystem::mkdir($siteName.'/data/utils/', 0775);
$chown = 'sudo /bin/chown -R www-data:www-data /opt/www/SiteCoreFlame/'.$siteName.'/data/utils';
system($chown);

filesystem::mkdir($siteName.'/core/', 0755);
filesystem::mkdir($siteName.'/conf/', 0755);
system('cp site-tpl/conf/* '.$siteName.'/conf/');
filesystem::mkdir('/opt/nginx-1.2.0/logs/nlogs/'.$siteName, 0755);

