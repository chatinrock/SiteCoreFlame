<ul class="menu menu-dropdown"><?
$tree = self::get('menuTree');
$count = count($tree['item']);
for( $i = 0; $i < $count; $i++ ){
    $item = $tree['item'][$i];//['name'];
    echo '<li class="level1 item24 '.$item['class'].'">'.
             '<a  class="level1" href="'.$item['link'].'">'.
                '<span>'.$item['name'].'</span>'.
             '</a>'.
          '</li>';
}
?>
</ul>