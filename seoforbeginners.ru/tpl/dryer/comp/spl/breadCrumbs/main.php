<section id="breadcrumbs">
    <div class="breadcrumbs">
        <a href="/">
            Главная
        </a>
        <?
        $breadcrumbs = self::get('breadcrumbs');
        $iCount = count($breadcrumbs);
        for( $i = 0; $i < $iCount-1; $i++ ){
            $url = str_repeat('../', $iCount-$i-1);
            echo '<a href="'.$url.'">'.$breadcrumbs[$i]['caption'].'</a>';
        }
        if ( isset($breadcrumbs[$i]) ){
        ?>
        <strong><?=$breadcrumbs[$i]['caption']?></strong>
        <?}?>
    </div>
</section>