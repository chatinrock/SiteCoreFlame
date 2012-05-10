<div class="grid-box width100 grid-v">
    <div class="module mod-box deepest">
        <h3 class="module-title" style="margin-bottom: 0px;"><span class="color">Популярные</span> статьи<span
            class="module-dash"></span></h3>
    </div>
</div>
<?
$list = self::get('list');
$miniData = self::get('miniData');
$iCount = count($list);
for ($i = 0; $i < $iCount; $i++) {
    ?>
<div class="grid-box width100 grid-v articleList">
    <div class="module mod-box deepest">
        <h4>
            <a href="<?=$list[$i]['url']?>" title="<?=$list[$i]['caption']?> | Популярные статьи"><?=$list[$i]['caption']?></a>
        </h4>
        <a href="<?=$list[$i]['url']?>" title="<?=$list[$i]['caption']?> | Популярные статьи">
            <? if ( $list[$i]['prevImgUrl'] ){ ?>
            <img class="aligncenter" title="Превью <?=$list[$i]['caption']?>" src="<?=$list[$i]['prevImgUrl']?>" alt="Превью <?=$list[$i]['caption']?>"
                 width="276" height="54"/>
            <? } ?>
        </a>
        <?=$miniData[$i]?>
        <a href="<?=$list[$i]['url']?>" title="Read more">Читать&nbsp;далее</a>

        <div class="clear"></div>

    </div>
</div>
<?
} // for
?>
