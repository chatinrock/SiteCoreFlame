<?$infoData = self::get('infoData');?>
<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/star/css/star20.css"/>
<link rel="stylesheet" href="/res/css/main.css"/>

<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/hoverEx/hoverex-all.min.css" />
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/hoverEx/jquery.hoverex.min.js"></script>

<style>
    .photogallery .frame1{
        margin-left: 10px;
    }

    #reviewBox  .frame1{
        margin-right: 10px;
    }

    .post-thumb .ribbon{
        top: 200px;
        left: -5px;
    }

    .people .description{
        width: 100%;
        height: auto;
        padding-left: 0;
    }

    .seeVideo, .seeVideo:visited, .seeVideo:link, .seeVideo:active{
        font-size:16px;
        font-weight:bold;
        color:black;
        text-decoration:none;
        position:absolute;
        top:110px;
        left:300px;
        background:white;
        border-radius:4px;
        padding:8px 12px;
        box-shadow:0 0 5px rgba(0,0,0,.3);
        text-shadow:1px 1px 2px rgba(0,0,0,.5);
    }

    .videoPlayHover{
        background: url('http://theme.codecampus.ru/ultrasharp/images/hover/play.png') no-repeat center center;
        width: 100%;
        height: 100%;
        position:absolute;
        top:0;
        left:0;
    }

    .videoPlayHover a{
        width: 100%;
        height: 100%;
        display: block;
    }

    .peoplePreview{
        width: 630px;
    }

</style>

<?
$email = $infoData['seoUrl'].'@trener-po.ru';
?>

<div class="people">
    <?
    $videoCount = count($infoData['video']);
    if ( $videoCount > 0 ){?>
        <div class="post-thumb he-wrap">
            <span title="<?=$infoData['fio']?>">
                <img src="<?=$infoData['video']['imgUrl']?>" class="peoplePreview"/>
                <div class="videoPlayHover"></div>
                <div class="he-view">
                    <a rel="nofollow" href="<?=$infoData['video']['videoUrl']?>" class="videoLightbox a1 seeVideo" data-animate="jellyInDown">Смотреть</a>
                </div>
            </span>
            <div class="ribbon">1256 руб/час</div>
            <div class="star star<?=$infoData['rating']?>"><div></div></div>
        </div>
    <?}?>

    <div class="description">
        <h3><?=$infoData['fio']?></h3>
        <div>
            <div class="item"><span>Стаж:</span><span><?=$infoData['exp']?></span></div>
            <div class="item"><span>Метро:</span><span><?=$infoData['metro']?></span></div>
            <div class="item"><span>Email:</span><a href="mailto:<?=$email?>?Subject=Свяжитесь со мной"><?=$email?></a></div>
            <div class="feature"><?=$infoData['feature']?></div>
            <div class="note"><?$this->loadFile(self::get('dir').'description.txt')?></div>
        </div>
    </div>

    <? // jellyInDown

    $videoCount = count($infoData['otzyv']);
    if ( $videoCount > 0 ){?>
        <div class="divider-top"></div>
        <h5>Отзывы</h5>
        <div id="reviewBox">
            <?for($i=0; $i < $videoCount; $i++){?>
            <span class="frame1">
                <img src="/res/file/resize/comp/<?=self::get('idPath')?>/review/<?=$i?>.jpg"/>
                <div class="videoPlayHover">
                    <a href="<?=$infoData['otzyv'][$i]?>" class="videoLightbox" rel="nofollow"></a>
                </div>
            </span>
            <?}?>
        </div>
        <div class="clear"></div>
    <?}

    $galleryCount = count($infoData['imgs']['gallery']);
    if ( $galleryCount > 0 ){?>
        <div class="divider-top"></div>
        <h5>Фотогалерея</h5>
        <div class="photogallery">
            <?for( $i = 0; $i < $galleryCount; $i++ ){?>
                <span class="frame1">
                    <a href="<?=$infoData['imgs']['gallery'][$i]?>" class="lightbox">
                        <img src="/res/file/resize/comp/<?=self::get('idPath')?>/gallery/<?=$i?>.jpg"/>
                    </a>
                </span>
            <?}?>
        </div>
        <div class="clear"></div>
    <?}


    $documentCount = count($infoData['imgs']['document']);
    if ( $documentCount > 0 ){?>
        <div class="divider-top"></div>
        <h5>Документы</h5>
        <div class="photogallery">
            <?for( $i = 0; $i < $documentCount; $i++ ){?>
                <span class="frame1">
            <a href="<?=$infoData['imgs']['document'][$i]?>" class="lightbox">
                <img src="/res/file/resize/comp/<?=self::get('idPath')?>/document/<?=$i?>.jpg"/>
            </a>
          </span>
            <?}?>
        </div>
        <div class="clear"></div>
    <?}?>

</div>

<script>
    jQuery(document).ready(function(){
        jQuery('div.frame').each(function(num, obj){
            var img = new Image();
            img.src = jQuery(obj).attr('data-src');
            img['data-id'] = obj.id;
            img.onload = function() {
                if ( this.width < 200 ){
                    this.style.marginLeft = ((200-this.width)/2) + 'px';
                }
                if ( this.height < 200 ){
                    this.style.marginTop = ((200-this.height)/2) + 'px';
                }
                jQuery('#' + this['data-id']).append(this);
            } // img.onload
        }); // jQuery('#imgPeopleList div.frame')
    });

    jQuery('.lightbox').lightbox();

    jQuery('.videoLightbox').lightbox({
        width: 800,
        height: 450,
        modal: true
    });
</script>