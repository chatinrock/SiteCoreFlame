<div class="grid-box width100 grid-v">
    <div class="module mod-box  deepest">
        <h3 class="module-title"><span class="color">Последние</span> статьи<span class="module-dash"></span></h3>
        <ul class="line">
            <?
                $list = self::get('list');
                $iCount = count($list);
                for( $i = 0; $i < $iCount; $i++ ){
                    ?>
                    <li>
                        <a href="<?=$list[$i]['url']?>" title="<?=$list[$i]['caption']?>"><?=$list[$i]['caption']?></a>
                    </li>
                    <?
                } // for
            ?>
        </ul>
    </div>
</div>