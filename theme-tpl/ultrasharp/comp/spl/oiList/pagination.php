<div id="pagination">
	<ul>
<?
$paginationList = self::get('paginationList');
$pageNum = self::get('pageNum');
$paginationUrlTpl = self::get('paginationUrlTpl');
$pagionationUrlParam = self::get('pagionationUrlParam');

// Показывать ли prev
if ( $paginationList['prev'] ){
    $pagionationUrlParam[-1] = 1;
	$href = vsprintf($paginationUrlTpl, 1);
    echo '<li><a href="' . $href . '" title="В начало">В начало</a></li>';
    $pagionationUrlParam[-1] = $pageNum-1;
	$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
    echo '<a href="' . $href . '" title="На страницу назад">«</a>';
}

// Показываем числа
for ($i = $paginationList['firstNum']; $i <= $paginationList['lastNum']; $i++) {
    if ($i != $pageNum) {
        $pagionationUrlParam[-1] = $i;
		$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
        echo '<li><a class="page" href="' . $href . '" title="Страница '.$i.'">' . $i . '</a></li>';
    } else {
        echo '<li class="current"><a href="#">' . $i . '</a></li>';
    }
}
if ( $paginationList['next'] ){
    $pagionationUrlParam[-1] = $pageNum+1;
	$href = vsprintf($paginationUrlTpl, $pagionationUrlParam);
    echo '<li><a href="' . $href . '" title="Следующая страница">»</a></li>';
}
?>
	</ul>
</div>