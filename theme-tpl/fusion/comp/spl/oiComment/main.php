<script>
    dbus.oiComment = {param:{
        blockItemId:'<?= self::get('blockItemId') ?>',
        objItemId:'<?= self::get('objItemId') ?>',
		noComment: false
    }};
</script>
<div id="comments" class="alt-bg-comments"><?
// Костыль, что бы избавить от is_file
if ( ! @self::loadFile(self::get('commFile')) ){
?><h4>Ни кто ни чего не написал. Вы будите первыми! &rarr;</h4><script>dbus.oiComment.param.noComment=true;</script><?}?></div>
<div id="respond">

    <div class="clear"></div>
    <div class="post-border-bottom"></div>
    <h4>Оставьте комментарий:</h4>

    <p><a rel="nofollow" id="cancelBtn" href="#respond" class="button"  style="display:none;" tabindex="4">Отмена</a>
    </p>

    <form action="#" method="post" id="oiCommentForm">
        <p>
            <label for="author">Имя<span>*</span>: </label>
            <input type="text" class="short" id="author" name="author" value="" tabindex="1" placeholder="Введите ваше имя"/>
        </p>

        <p>
            <label for="comment_msg">Комментарий<span>*</span>:</label>
            <textarea name="comment" id="comment_msg" rows="5" cols="" tabindex="2" placeholder="Введите комментарий"></textarea>
        </p>

        <p>
            <input type="submit" name="comment_submit" class="button" value="Отправить" tabindex="3"/>
        </p>
        <!--<input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID' />-->
        <input type='hidden' name='parentId' value='0'/>
    </form>
    <div class="clear"></div>
</div>