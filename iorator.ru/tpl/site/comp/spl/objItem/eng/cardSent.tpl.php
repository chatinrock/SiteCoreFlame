<div class="card">
    <div class="commentBox">
        <div class="commentCaption">Комментарий</div>
        <div class="commentText"><?=self::get('comment')?></div>
    </div>

    <?$vipRule = self::get('vipRule');
    if ( $vipRule ){?>
    <div class="vipCommentBox">
        <div class="linkRule">VIP комментарий</div>
        <div class="rule">
            <a href="<?=$vipRule['href']?>" title="<?=$vipRule['title']?>"><?=$vipRule['title']?></a>
        </div>

    </div>
    <?}?>

    <div class="linkBox">
        <div class="linkRule">Связанные правила</div>
        <div class="rules"><?
            foreach(self::get('rule') as $rule ){
                echo '<div class="rule"><a href="'.$rule['href'].'" title="'.$rule['title'].'">'.$rule['title'].'</a></div>';
            }
            ?></div>
    </div>
</div>