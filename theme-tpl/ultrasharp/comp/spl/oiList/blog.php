<?
$oiListData = self::get('oiListData');
$count = self::get('count');
$pageNum = self::get('pageNum');
$paginationUrlTpl = self::get('paginationUrlTpl');
$pagionationUrlParam = self::get('pagionationUrlParam');
$objItemDir = self::get('objItemDir');
$categoryUrlTpl = self::get('categoryUrlTpl');

if (is_array($oiListData)) {
    $oiListDataCount = count($oiListData);
    for ($i = 0; $i < $oiListDataCount; $i++) {
        $item = $oiListData[$i];
        $categoryUrl = vsprintf($categoryUrlTpl, $item['seoName']);
        ?>
    <section>
        <div
            class="post-full post-full-left post-<?=$i?> post type-post status-publish format-standard hentry category-artists category-inspiration category-photography tag-example tag-featured tag-inspiration-2 tag-work "
            id="post-<?=$i?>">
            <article data-permalink="<?=$item['url']?>">
                <header>
                    <h2 class="post-title">
                        <a title="<?= $item['caption']?>" href="<?= $item['url'] ?>"
                           rel="bookmark"><?= $item['caption'] ?></a>
                    </h2>

                    <div class="post-info">

                        <span class="date"><time datetime="<?= $item['dateAdd'] ?>"
                                                 pubdate><?= $item['dateAdd'] ?></time></span>
                        <!--<span class="author">[Автор]</span>-->
                        <span class="categories">
							Категория: <a href="<?= $categoryUrl ?>"
                                          title="Открыть все статьи категории: <?=$item['category']?>" ><?= $item['category'] ?></a>
						</span>                                    
						<span class="comments">
							<a href="<?= $item['url'] ?>#comments" title="Нажмите, что бы прокомментировать материал">Комментировать</a>
						</span>
                    </div>
                    <? if ($item['prevImgUrl']) { ?>
                    <div class="post-thumb">
                        <a href="<?= $item['url'] ?>"><span class="imagePreload" style="width: 560px; height: 250px;"
                                                            title="<?= $item['caption'] ?>"><span><?= $item['prevImgUrl'] ?></span></span></a>

                    </div>
                    <? } ?>

                    <!--<span class="post-tags">
                     <a href="#tag/example/" rel="tag">example</a> + <a href="#tag/featured/" rel="tag">featured</a> + <a href="#tag/inspiration-2/" rel="tag">inspiration</a> + <a href="#ultrasharp/tag/work/" rel="tag">work</a>
                 </span>-->
                </header>

                <div class="post-content">
                    <!--<p>-->
					<?
                       /* $text = @file_get_contents($objItemDir . $item['idSplit'] . 'kat.txt');
                        if ($text) {
                            echo $text;
                        } else {
                            self::loadFile($objItemDir . $item['idSplit'] . 'data.txt');
                        }*/
                        ?>
                    <?self::loadFile($objItemDir . $item['idSplit'] . 'kat.txt'); ?>
                    <!--</p>-->

                    <div class="padding-10"></div>

                    <p>
                        <a href="<?= $item['url'] ?>" title='Нажмите, что бы прочитать полный текст об "<?= $item['caption'] ?>"' class="button-clear readnext">
                            <?=$caption?>
						</a>
                    </p>

                </div>

            </article>
        </div>
    </section>
    <?
    } // for
} else {
    echo 'Wrong $oiListData mainTpl.php';
} // is_array
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.imagePreload').each( function() { $(this).ddImagePreload(); });
    });
    jQuery(window).load(function() {
        jQuery('.post-thumb img').ddFadeOnHover(0.7);
    });
    jQuery('a.readnext').html('Читать далее');
</script>