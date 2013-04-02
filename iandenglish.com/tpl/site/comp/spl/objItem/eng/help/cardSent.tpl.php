<div class="card">
    <div class="translateCaption">Перевод</div>
    <div class="translateBox">
        <?=self::get('translate')?>
    </div>

    <div class="commentCaption">Комментарий</div>
    <div class="commentBox">
        <?=self::get('comment')?>
    </div>

    <?$vipRule = self::get('vipRule');
    if ( $vipRule ){?>
    <div class="vipCommentBox">
        <div class="linkRule">VIP комментарий</div>
        <ul class="rules">
            <li><a href="<?=$vipRule['href']?>" title="<?=$vipRule['title']?>"><?=$vipRule['title']?></a></li>
        </ul>

    </div>
    <?}?>

    <div class="linkBox">
        <div class="linkRule">Связанные правила</div>
        <ul class="rules"><?
            foreach(self::get('rule') as $rule ){
                echo '<li><a href="'.$rule['href'].'" title="'.$rule['title'].'" target="_blank">'.$rule['title'].'</a></li>';
            }
            ?>
        </ul>
    </div>
</div>