<article>	
<? 
if ( $infoData['isCloaking'] ){
	self::loadFile(self::get('dir') . 'cloak.txt');
}else{
	self::loadFile(self::get('dir') . 'kat.txt');
	self::loadFile(self::get('dir') . 'data.txt');
}?>
</article>