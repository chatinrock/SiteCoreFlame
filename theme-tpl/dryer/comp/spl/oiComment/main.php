<section id="comments">
    <?
    // Костыль, что бы избавить от is_file
    @self::loadFile(self::get('commFile'))
    ?>
</section>

<div id="respond">
    <h3>Оставить комментарий<span class="article-dash"></span></h3>
    <form class="short" action="#" method="post">
        <div class="author required">
            <input type="text" name="author" placeholder="Имя *" value="" size="22" aria-required='true' />
        </div>

        <div class="content">
            <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
        </div>

        <div class="actions">
            <input name="submit" type="submit" id="submit" tabindex="5" value="Отправить" />
            <!--<input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID' />-->
            <input type='hidden' name='parentId' value='0' />
            <a class="comment-cancelReply" style="display: none" href="#respond" id="cancelBtn">Отмена</a>
        </div>

    </form>
</div>
<script>
    dbus.oiComment = {param:{
        blockItemId: '<?= self::get('blockItemId') ?>',
        objItemId: '<?= self::get('objItemId') ?>'
    }};
</script>