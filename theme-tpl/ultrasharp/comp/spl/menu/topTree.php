<?
if ( !function_exists('menuChild') ){
function menuChild($item){
	$count = count($item);
	for( $i = 0; $i < $count; $i++ ){
	?>
		<li class="menu-item menu-item-type-post_type menu-item-object-page '<?=$item[$i]['class']?>">
			<a href="<?=$item[$i]['link']?>"><?=$item[$i]['name']?></a>
		

		<?if(isset($item[$i]['item'])){?>
			<ul class="sub-menu">
			<?menuChild($item[$i]['item']);?>
			</ul>
		<?}?>
		</li>
	<?}
}
}
$tree = self::get('menuTree'); ?>
<ul class="top-bar-menu">
<? menuChild($tree['item']); ?>
</ul>