<?
if ( !function_exists('menuChild') ){
    function menuChild($item){
        $count = count($item);
        for( $i = 0; $i < $count; $i++ ){
			$nameList = explode('|', $item[$i]['name'], 2);
			$nameFirst = $nameList[0];
			$nameSecond = isset($nameList[1])?$nameList[1]:'';
            ?>
        <li class="<?=$item[$i]['class']?>">
            <a href="<?=$item[$i]['link']?>"><?=$nameFirst?><span><?=$nameSecond?>&nbsp;	</span></a>


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


    <ul id="menu-main_bar_menu" class="left">
    <? menuChild($tree['item']); ?>
    </ul>
    <div id="logo"><a href="/"><img src="/res/images/logo.png" alt="" /></a></div>
<script type="text/javascript">
    $(window).load(function() {
        //animates our menu
		$('#main-bar ul').ddDropDown(false);
		jQuery('#main-bar').mainBar('227dbd');
    });
</script>
