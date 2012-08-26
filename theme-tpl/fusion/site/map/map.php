<?
$icqNumber=self::varible('icq','ICQ');
$icqNumberClear=str_replace(' ', '', $icqNumber);
?>
<div class="five columns">
	<h3>Контакты</h3>
	<div class="contactBox">
		<p class="skype">
			<a href="skype:<?=self::varible('skype')?>?call" rel="nofollow" title="Позвонить с помощью Skype" class="callSkype">
				<?=self::varible('skype','Skype');?>
			</a>
		</p>
		<p class="phone"><?=self::varible('phone','Телефон');?></p>
		<p class="icq"><?=$icqNumber?> <img src="http://status.icq.com/online.gif?icq=<?=$icqNumberClear?>&img=27"/></p>
		<p class="email">
			<a href="mailto:<?=self::varible('email');?>?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо">
				<?=self::varible('email','Email');?>
			</a>
		</p>
		<p class="map">
			<a href="<?=self::varible('yalink')?>" title="Просмотреть карту проезда на картах Yandex" rel="nofollow" target="_blank">
				<?=self::varible('address','Адрес');?>
			</a>
		</p>
	</div>
	
	<p>
		<a href="#"  class="small_button" style="width: 200px;" rel="nofollow" target="_blank" title="Распечатать карту проезда">Распечатать карту проезда</a>
	</p>
	<p>
		<a href="<?=self::varible('yalink', 'Ссылка яндекс.карта')?>" title="Просмотреть карту проезда на картах Yandex" class="small_button" style="width: 200px;" rel="nofollow" target="_blank">Открыть в картах Yandex</a>
	</p>
	
</div>
<div class="eleven columns">
	<img src="/res/images/map/map.jpg" style="width: 640px" alt="Карта проезда: <?=self::varible('address')?>" title="<?=self::varible('address')?>">
</div>
<script type="text/javascript">
if ( typeof skypeCheck == undefined){
	var src = 'http://download.skype.com/share/skypebuttons/js/skypeCheck.js';
	importResList["js"].push({src: src, func: function(){
		$('a.callSkype').click(function(){
			return skypeCheck();
		});
	}});
}

$(document).ready(function(){
	$('#printMapBtn').click(function(){
		var hWind = window.open('','myconsole', 'width=850,height=650,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
		hWind.document.writeln(
		  '<html><head><title>Карта проезда. Печать</title></head><body>'
		   +'<img src="/res/images/map/print.jpg" style="width:800px"/>'
		   +'</body></html>'
		);
		hWind.document.close();
		hWind.print();
		return false;
	});
});
</script>