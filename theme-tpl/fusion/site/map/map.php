<div class="five columns">
	<h3>Контакты</h3>
	<div class="contactBox">
		<p class="skype"><?=self::varible('skype','Skype');?></p>
		<p class="phone"><?=self::varible('phone','Телефон');?></p>
		<p class="icq"><?=self::varible('icq','ICQ');?></p>
		<p class="email">
			<a href="mailto:<?=self::varible('email');?>?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо">
				<?=self::varible('email','Email');?>
			</a>
		</p>
		<p class="map"><?=self::varible('address','Адрес');?></p>
	</div>
	
	<p>
		<a href="#" class="small_button" style="width: 200px;">Распечатать карту проезда</a>
	</p>
	<p>
		<a href="#" class="small_button" style="width: 200px;">Открыть в картах Yandex</a>
	</p>
	
</div>
<div class="eleven columns">
	<img alt="img" src="/res/images/map.png" style="width: 640px" alt="Карта проезда">
</div>