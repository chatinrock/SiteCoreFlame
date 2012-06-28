<?$tree = self::get('menuTree');
$count = count($tree['item']);?>

<ul class="top-bar-menu">
<?for( $i = 0; $i < $count; $i++ ){ $item = $tree['item'][$i];?>
    <li class="menu-item menu-item-type-post_type menu-item-object-page <?=$item['class']?>">
             <a href="<?=$item['link']?>"><?=$item['name']?></a>
    </li>
<?}?>
</ul>