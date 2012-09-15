<?
$comHandle = self::get('comHandle');
ob_start();
    $oldId = null;
    $levelCount = 0;
    // Количество комментариев
    $commentCount = 0;
    $levelBuff = array();
	
    while ($item = $comHandle->fetch_object()) {
        $commentCount++;
        // Проверяем вложенный ли это комментарий
        if ($item->treeId == $oldId) {
			++$levelCount;
            // Начало блоко ребёнка
            echo '<ul class=\'children\'>';
        } else {
            if (isset($levelBuff[$item->treeId])) {
                $iCount = $levelCount - $levelBuff[$item->treeId];
                for ($i = 0; $i < $iCount; $i++) {
                    // Закрываем блок ребёнка
                    echo '</li></ul>';
                } // for
                $levelCount -= $iCount;
                // Закрываем комментарий
                echo '</li>';
            } // if
        } // if ($item->treeId == $oldId)
		
        if (!isset($levelBuff[$item->treeId])) {
            $levelBuff[$item->treeId] = $levelCount;
        } // if

        self::setVar('author', $item->userName);
        self::setVar('comment', $item->comment);
        self::setVar('commentCount', $commentCount);
        self::setVar('levelCount', $levelCount);
        self::setVar('dateAdd', $item->dateAdd);
        self::setVar('id', $item->id);
        self::includeBlock('comment');

        $oldId = $item->id;
    } // while

     for( $i = 0; $i < $levelCount; $i++){
      // Закрываем блок ребёнка
      echo '</li></ul>';
      } // for

$data = ob_get_clean();
?>
    <h4>Комментарии (<?= $commentCount ?>)</h4>
    <ol><?
		print $data;
	?></ol>

<?if ( $commentCount ){?>
<script>
    $(function($) {
        $('#headerCommentCount').html('<?=$commentCount ?> коментариев');
    });
</script>
<?}?>