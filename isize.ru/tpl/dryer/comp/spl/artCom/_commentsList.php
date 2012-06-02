<?
ob_start()
?>
<ul class="level1 nested">

    <?
    $comHandle = self::get('comHandle');

    $oldId = null;
    $levelCount = 0;
    // Количество комментариев
    $commentCount = 0;
    $levelBuff = array();

    while ($item = $comHandle->fetch_object()) {
        $commentCount++;
        // Проверяем вложенный ли это комментарий
        if ($item->treeId == $oldId) {
            // Начало блоко ребёнка
            echo '<ul class=\'children\'><li>';
            ++$levelCount;
        } else {
            //$levelBuffNum = isset($levelBuff[$item->treeId]) ? $levelBuff[$item->treeId] : '-';
            //print "level: {$item->treeId}:{$levelBuffNum}  $levelCount\n";
            
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
            // Начало комментария
            echo '<li>';
        }
        if (!isset($levelBuff[$item->treeId])) {
            $levelBuff[$item->treeId] = $levelCount;
        } // if

        self::setVar('author', $item->userName);
        self::setVar('comment', $item->comment);
        self::setVar('dateAdd', $item->dateAdd);
        self::setVar('id', $item->id);
        self::includeBlock('comment');
        //echo "\ncom id:{$item->id}  tree:{$item->treeId}\n";

        $oldId = $item->id;
    } // while

     for( $i = 0; $i < $levelCount; $i++){
      // Закрываем блок ребёнка
      echo '</li></ul>';
      } // for
    ?>
</li>
</ul>
<?
$data = ob_get_clean();
?>
<h3 class="comments-meta">Комментарии (<?= $commentCount ?>)<span class="article-dash"></span></h3>
<?
print $data;
if ( $commentCount ){
?>
<script>
    $(function($) {
        $('#headerCommentCount').html('<?=$commentCount ?> коментариев');
    });
</script>
<?}?>