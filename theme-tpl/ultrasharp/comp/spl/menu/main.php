<?$tree = self::get('menuTree');
$count = count($tree['item']);?>

<ul id="menu-main_bar_menu" class="left">
<?for( $i = 0; $i < $count; $i++ ){ 
	$item = $tree['item'][$i];
	$nameList = explode('|', $item['name'], 2);
	
	$name = $nameList[0];
	$nameSecond = isset($nameList[1])?$nameList[1]:'';
	?>
    <li class="<?=$item['class']?>"><a href="<?=$item['link']?>"><?=$name?><span><?=$nameSecond?>&nbsp;	</span></a></li>
<?}?>
</ul>