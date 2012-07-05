<? if ( self::get('isFirst')){?>
<div id="comments" class="alt-bg-comments">
    <h4>Комментарии (1)</h4>
    <ol>
<?}?>
<?
$podsv = self::get('commentCount') % 2 ? 'odd' : 'even';
?>
<li class="comment byuser <?=$podsv?> thread-<?=$podsv?> level-<?=self::get('levelCount')?>" id="comment-<?=self::get('id')?>">
<div class="comment-info">

                <img alt=''
                     src='/res/images/comments_avatar.png'
                     class='avatar avatar-60 photo' height='60' width='60'/>
                <span class="author"><?= self::get('author') ?></span>

                <span class="date">
				<time datetime="<?=self::get('dateAddSys')?>" pubdate><?=self::get('dateAdd')?>
				| <a class="permalink" href="#comment-<?=self::get('id')?>">#</a>
				</time></span>
            </div>
            <div class="comment-content">
				<p><?=self::get('comment')?></p>
                <span class="reply"><a href="#" rel="<?=self::get('id')?>">Ответить</a></span></p>
            </div>
            <div class="clear"></div>

<? if ( self::get('isFirst')){?>
</ol>
</div>
<?}?>