<? if ( self::get('isFirst')){?>
<h3 class="comments-meta">Комментарии (1)<span class="article-dash"></span></h3>
<?}?><article id="comment-<?=self::get('id')?>" class="comment">

    <header class="comment-head">

        <img alt='Аватар' src='/res/images/comments_avatar.png' class='avatar avatar-70 photo' height='70' width='70' />								
        <h4 class="author"><a href='#author' rel='external nofollow' class='url'><?= self::get('author') ?></a></h4>

        <p class="meta">
            <time datetime="<?=self::get('dateAddSys')?>" pubdate><?=self::get('dateAdd')?></time>
            | <a class="permalink" href="#comment-<?=self::get('id')?>">#</a>
        </p>

    </header>

    <div class="comment-body">
        
        <div class="content">
            <p><?= self::get('comment') ?></p>
        </div>
        <p class="reply"><a href="#" rel="<?=self::get('id')?>">Ответить</a></p>                                
        
    </div>
</article>