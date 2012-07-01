<section id="content" class="grid-block"><div id="system">
        <article class="item" data-permalink="">
            <?=$this->varible('content', 'Сontent') ?>
            <?=self::block('content')?>


 
            
            <!--<div class="meta-tags clearfix">
               <p class="taxonomy">
                    Теги:
                    <a href="#?tag=adobe" rel="tag">Adobe</a>
                    <a href="#?tag=war-framework" rel="tag">War Framework</a>
                    <a href="#?tag=widgetkit" rel="tag">Widgetkit</a>
               </p>
            </div>-->

            <?= self::block('commnets') ?>
        </article>
    </div>
</section>
<script type="text/javascript" src="http://vk.com/js/api/share.js?11" charset="windows-1251"></script>
<script type="text/javascript">
window.onload = function () {
 document.getElementById('vk_share').innerHTML = VK.Share.button(
	{title: 'Советую к прочтению: ' + document.title, noparse: false}, 
	{type: "button", text: "Добавить на стенy"});

}
</script>