<div class="card">

    <?if ( self::get('isVip')){?>
        <div class="box success vipComment">Доступен VIP комментарий.<br/><strong>Кликните по слову.</strong></div>
    <?}?>

    <div class="translateCaption">Перевод слова</div>
    <div class="translateBox word">
        <?=self::get('translate')?>
    </div>

    <?if ( self::get('comment')){?>
        <div class="commentCaption">Комментарий</div>
        <div class="commentBox">
            <?=self::get('comment')?>
        </div>
    <?}?>

    <?if ( self::get('rule') ){?>
    <div class="linkBox">
        <div class="linkRule">Связанные правила</div>
        <ul class="rules"><?
            foreach(self::get('rule') as $rule ){
                echo '<li><a href="'.$rule['href'].'" title="'.$rule['title'].'" target="_blank">'.$rule['title'].'</a></li>';
            }
            ?>
        </ul>
    </div>
    <?}?>
</div>