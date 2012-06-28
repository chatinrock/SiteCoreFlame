<?
$oiListData = self::get('oiListData');
$count = self::get('count');
$pageNum = self::get('pageNum');
$paginationUrlTpl = self::get('paginationUrlTpl');
$pagionationUrlParam = self::get('pagionationUrlParam');
$objItemDir = self::get('objItemDir');
$categoryUrlTpl = self::get('categoryUrlTpl');

echo '<section id="content" class="grid-block"><div id="system">
<div class="items items-col-1 grid-block">
<div class="grid-box width100">';
if ( is_array($oiListData)){
    $oiListDataCount = count($oiListData);
    for ($i = 0; $i < $oiListDataCount; $i++) {
        $item = $oiListData[$i];
        $categoryUrl = vsprintf($categoryUrlTpl, $item['seoName']);
        // TODO: Вставить data-permalink
        echo '<article id="item-' . $i . '" class="item" data-permalink="' . $item['url'] . '">';
        ?><header>
            <h1 class="title">
                <a href="<?= $item['url'] ?>" rel="bookmark" title="<?= $item['caption'] ?>"><?= $item['caption'] ?></a>
                <span class="article-dash"></span>
            </h1>
            <p class="meta clearfix">
                <time datetime="<?= $item['dateAdd'] ?>" pubdate><?= $item['dateAdd'] ?></time>. Категория: <a href="<?= $categoryUrl ?>"><?= $item['category'] ?></a>
                <span class="comment-link"><a href="<?= $item['url'] ?>#comments" title="Комментировать">Комментировать</a></span>
            </p>
        </header>

        <? if ($item['prevImgUrl']) { ?>
            <div class="post-thumbnail">
                <a href="<?= $item['url'] ?>" rel="bookmark" title="<?= $item['caption'] ?>">
                    <img width="960" height="300" src="<?= $item['prevImgUrl'] ?>" class="attachment-post-thumbnail wp-post-image" alt="<?= $item['caption'] ?>" title="<?= $item['caption'] ?>" />
                </a>
            </div>
        <? } ?>

        <div class="content clearfix">
            <?
            $text = @file_get_contents($objItemDir . $item['idSplit'] . 'kat.txt');
            if ($text) {
                echo $text;
            } else {
                self::loadFile($objItemDir . $item['idSplit'] . 'data.txt');
            }
            ?>
        </div>

        <!--<div class="meta-tags clearfix">
            <p class="taxonomy">Tags: <a href="?tag=adobe" rel="tag">Adobe</a><a href="?tag=war-framework" rel="tag">War Framework</a><a href="?tag=widgetkit" rel="tag">Widgetkit</a></p>
        </div>-->

        <p class="readmore-item">
            <a href="<?= $item['url'] ?>" title="<?= $item['caption'] ?>">Читать далее</a>
        </p>
        </article>
        <?
    } // for
}else{
    echo 'Wrong $oiListData mainTpl.php';
} // is_array
echo '</div></div>';

// Пагинация
echo '<div class="pagination">';
$paginationList = self::get('paginationList');

if ( $paginationList['prev'] ){
    $pagionationUrlParam[-1] = 1;
    echo '<a class="first" href="' . vsprintf($paginationUrlTpl, $count) . '">В начало</a>';
    $pagionationUrlParam[-1] = $pageNum-1;
    echo '<a class="next" href="' . vsprintf($paginationUrlTpl, $pagionationUrlParam) . '">«</a>';
}

for ($i = $paginationList['firstNum']; $i <= $paginationList['lastNum']; $i++) {
    if ($i != $pageNum) {
        $pagionationUrlParam[-1] = $i;
        echo '<a href="' . vsprintf($paginationUrlTpl, $pagionationUrlParam) . '">' . $i . '</a>';
    } else {
        echo '<strong>' . $i . '</strong>';
    }
}
if ( $paginationList['next'] ){
    $pagionationUrlParam[-1] = $pageNum+1;
    echo '<a class="next" href="' . vsprintf($paginationUrlTpl, $pagionationUrlParam) . '">»</a>';
}

echo '</div>';
?>

</div></section>