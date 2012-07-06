<?$list=self::get('list');?><div id="related-posts">
    <h3>Вам это будет интересно</h3>
    <?
    $listCount = count($list);
    for( $i = 0; $i < $listCount; $i++){
        $item=$list[$i];?>
        <div class="related-item related-item-1800 one-third <?=$listCount-1==$i?'last':''?>">
            <a href="<?=$item['url']?>" title="<?=$item['caption']?>">
                <span class="image"><img width="158" height="110" src="<?=$item['prevImgUrl']?>" alt="<?=$item['caption']?>" title="<?=$item['caption']?>" /></span>
                <span class="title"><?=$item['caption']?></span>
            </a>
        </div>
        <?}?>
</div>
<div class="clear"></div>
<div class="post-border-bottom"></div>
<script type="text/javascript">
    $(window).load(function() {
        jQuery('#related-posts img').ddFadeOnHover(.8);
    });
</script> 