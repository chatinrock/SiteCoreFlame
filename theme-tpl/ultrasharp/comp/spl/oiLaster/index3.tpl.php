<div class="block" style="background-color: #ffffff;">
    <?$list = self::get('list');
    $iCount = count($list);
    for( $i = 0; $i < $iCount; $i++ ){
        $caption = $list[$i]['caption'];
        $url = $list[$i]['url'];
        ?>
        <div class="one-third <?$i==2?'last':''?>">

            <h2 class="no-margin-header"><a href="<?=$url?>" title="<?=$caption?>"><?=$caption?></a></h2>
            <p><?=$list[$i]['miniDesck']?></p>
            <div class="padding" style="height: 5px;"></div>
            <a href="<?=$url?>" class="button blue readnext" title="Нажмите, чтобы посмотреть <?=$caption?>"><?=$caption?></a>
            <div class="padding" style="height: 35px;"></div>
        </div>

    <?
    }
    ?>
</div>
<script type="text/javascript">
    jQuery('a.readnext').html('» Читать статью');
</script>