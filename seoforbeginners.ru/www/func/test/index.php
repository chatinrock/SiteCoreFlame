<?
umask(0020);
$data = '';
foreach( $_SERVER as $key => $item ){
	if ( substr($key, 0, 4) == 'HTTP' ){
		$data .= $key.' = '.$item."\r\n";
	}
}

$data .= 'IP: '.$_SERVER['REMOTE_ADDR']."\r\n======================\r\n\r\n";
$fw = fopen('/home/www/SiteCoreFlame/seoforbeginners.ru/www/func/test/db/db.txt', 'a+');
fwrite($fw, $data);
fclose($fw);