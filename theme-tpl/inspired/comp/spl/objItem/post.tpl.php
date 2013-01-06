<div id="post-155"
     class="post-155 post type-post status-publish format-standard hentry category-lightbox-posts tag-17-shadows tag-big-image tag-lightbox">
    <?
    $infoData = self::get('infoData');
    $categoryUrlTpl = self::get('categoryUrlTpl');
    ?>
    <script type="text/javascript">
        var article = {
            caption: '<?= $infoData['caption'] ?>',
            imgUrl: '<?= $infoData['prevImgUrl'] ?>'
        }
    </script>

    <div class="post-head">
        <div class="post-title">
            <h1><?= $infoData['caption'] ?></h1>
        </div>
    </div>
    <div class="clear"></div>
    <div class="post-meta">
        <ul>
            <li class="post-date">
                <div class="meta-info">
                    Дата: <?=substr($infoData['date_add'], 0, 8)?>
                </div>
                <div class="clear"></div>
            </li>
            <li class="post-cat">
                <div class="meta-info">
                    Категория:<a href="<?=sprintf($categoryUrlTpl, $infoData['seoName'])?>"
                                 title="Посмотреть все материалы в <?=$infoData['category']?>"
                                 rel="category"><?=$infoData['category']?></a>
                </div>
                <div class="clear"></div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
    <div class="outerImageWrap"
         style="max-width:900px;margin-left:auto;margin-right:auto;margin-bottom:0px;margin-top:0px;">
        <div class="imageBorder smallBorder" style="">
            <div class="imageWrapper">
                <img class="responsiveImage" src="<?= $infoData['prevImgUrl'] ?>" alt="<?= $infoData['caption'] ?>"
                     title="<?= $infoData['caption'] ?>"/>
                <span class="imagePreloader" style="position:absolute;top:0px;width:100%;height:100%;overflow:hidden;"></span>
            </div>
        </div>
    </div>
    <div class="spacer" style="height:10px;"></div>
    <div class="clear"></div>
    <div class="post-tags"></div>
    <div class="socialBtnBox"></div>
    <div class="post-text">
        <p><? if ($infoData['isCloaking']) {
            self::loadFile(self::get('dir') . 'cloak.txt');
        } else {
            if ($infoData['divArticle'] == 0) {
                self::loadFile(self::get('dir') . 'kat.txt');
            }
            self::loadFile(self::get('dir') . 'data.txt');
        }?></p>
        <div class="socialBtnBox"></div>
    </div>
    <div class="clear"></div>
</div> 