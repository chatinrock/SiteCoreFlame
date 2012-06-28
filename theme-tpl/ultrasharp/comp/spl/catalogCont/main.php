<div class="grid-box width100 grid-v">
    <div class="module mod-box  deepest">

        <h3 class="module-title"><span class="color">Категории</span><span class="module-dash"></span>
        </h3>
        <ul class="menu menu-sidebar">
            <?
                $list = self::get('list');
                $iCount = count($list);
                for( $i = 0; $i < $iCount; $i++ ){
                    ?><li class="level1 item97"><a class="level1" href="<?=$list[$i]['url']?>"><?=$list[$i]['name']?></span></a></li><?
                } // for
            ?>
        </ul>
    </div>
</div>