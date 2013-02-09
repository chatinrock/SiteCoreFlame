<?

include '/opt/www/FlameCore/engine/core/function/errorHandler.php';
include('/opt/www/FlameCore/engine/core/classes/filesystem.php');


$old = '/opt/www/SiteCoreFlame/backup/xenglishx.ru';
$new = '/opt/www/SiteCoreFlame/iandenglish.com';

$oldList = \core\classes\filesystem::rDir2Arr($old);

foreach( $oldList as $file ){
	$file = substr( $file, strlen($old));
	if ( is_file($new.$file) || is_dir($new.$file) ){
		$chmod = fileperms($old.$file);
		$stat = stat($old.$file);

		chown($new.$file, $stat['uid']);
		chmod($new.$file, $chmod);
		chgrp($new.$file, $stat['gid']);
		echo $new.$file.' '.$chmod ."\n";
	}
}