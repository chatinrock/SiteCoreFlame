<?$tree = self::get('menuTree');
$count = count($tree['item']);?>


<div class="footer-widget">
<h5><?=$tree['public']['caption']?></h5>
    <div>
        <ul class="menu">
            <?for( $i = 0; $i < $count; $i++ ){ $item = $tree['item'][$i];?>
            <li class="<?=$item['class']?>">
                <a href="<?=$item['link']?>" title="Нажмите, что бы перейти в <?=$item['name']?>"><?=$item['name']?></a>
            </li>
            <?}?>

         </ul>
    </div>
</div>
