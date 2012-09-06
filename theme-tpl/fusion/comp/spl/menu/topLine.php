<?
$tree = self::get('menuTree');
$count = count($tree['item']);
?>

<div class="navi" id="mainMenu">
	<ul class="sf-menu">
	<?for( $i = 0; $i < $count; $i++ ){
        $item = current($tree['item']);
        next($tree['item']);?>
		<li class="<?=$item['class']?>">
			<a href="<?=$item['link']?>"><em class="hover"></em><span><?=$item['name']?></a>
		</li>
	<?}?>
	</ul>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#mainMenu a').each(function(ind, obj){
		var rgx = /[^/]+$/i;
		var href = document.location.href.replace(rgx ,"");
		if ( href === obj.href ){
			$(obj).parent().addClass('current');
		}
	});
});
</script>