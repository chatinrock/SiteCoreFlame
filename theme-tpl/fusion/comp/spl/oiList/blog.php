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
        // TODO: Вставить data-permalink
        ?>
		
		<div class="post">
		<? if ($item['prevImgUrl']) { ?>
                            <div class="frame">
								<img class="overlay-item-link" src="<?=$item['prevImgUrl']?>" width="692" height="262" alt="<?= $item['caption'] ?>" rel="<?= $item['url'] ?>"/>
							</div>
							<?}?>
                            <div class="content">
                                <div class="date">
                                    <span class="day">31</span>
                                    <span class="year">2012</span>
                                    <span class="month">dec</span>
									<!--<?= $item['dateAdd'] ?>-->
                                </div>
                                <div class="post-format-icon"></div>
                                <h2>
									<a class="bn" title="Читать <?= $item['caption']?>" href="<?= $item['url'] ?>" rel="bookmark">
										<?= $item['caption'] ?>
									</a>
								</h2>
                                <ul class="info">
                                    <li class="icons author">Автор</li>
                                    <li class="icons comment">
										<a href="<?= $item['url'] ?>#comments" title="Комментировать">
											Комментировать
										</a>
									</li>
                                    <li>
										Категория: 
										<a href="<?= $categoryUrl ?>" title="<?= $item['category'] ?>">
											<?= $item['category'] ?>
										</a>
									</li>
                                </ul>
                                <div class="clear"></div>
                                <div class="tx-content">
                                    <?
                        $text = @file_get_contents($objItemDir . $item['idSplit'] . 'kat.txt');
                        if ($text) {
                            echo $text;
                        } else {
                            self::loadFile($objItemDir . $item['idSplit'] . 'data.txt');
                        }
                        ?>
                                    <a class="bn" title="<?= $item['caption']?>" href="<?= $item['url'] ?>" rel="bookmark">Читать далее&rarr;</a>
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>
	
    <?
    } // for
} else {
    echo 'Wrong $oiListData mainTpl.php';
} // is_array
?>

<div class="pagination">
    <!--<span class="pages">Страница 1 из 11</span>-->
<?
$paginationList = self::get('paginationList');
$pageNum = self::get('pageNum');
$paginationUrlTpl = self::get('paginationUrlTpl');
$pagionationUrlParam = self::get('pagionationUrlParam');

// Показывать ли prev
if ( $paginationList['prev'] ){
    $pagionationUrlParam[-1] = 1;
	$href = vsprintf($paginationUrlTpl, 1);
    echo '<a href="' . $href . '" title="В начало">В начало</a>';
    $pagionationUrlParam[-1] = $pageNum-1;
	$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
    echo '<a href="' . $href . '" title="На страницу назад" class="prevlink">«</a>';
}

// Показываем числа
for ($i = $paginationList['firstNum']; $i <= $paginationList['lastNum']; $i++) {
    if ($i != $pageNum) {
        $pagionationUrlParam[-1] = $i;
		$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
        echo '<a href="' . $href . '" title="Страница '.$i.'">' . $i . '</a></li>';
    } else {
        echo '<span class="current">' . $i . '</span>';
    }
}
if ( $paginationList['next']){
    $pagionationUrlParam[-1] = $pageNum+1;
	$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
    echo '<a href="' . $href . '" title="Следующая страница" class="nextlink">»</a>';
}
?>
<div class="clear"></div>
</div>