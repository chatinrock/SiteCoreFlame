<div id="footer">
            <div class="container">
        		<div class="four columns">
                    <div class="contact-widget">
                        <h4>Контакты</h4>
                        <!--<p></p>-->
                        <ul>
                            <li><span>Телефон : </span><?=self::varible('phone','Телефон');?></li>
                            <li><span>Email : </span><a href="mailto:<?=self::varible('email');?>?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо"><?=self::varible('email','E-mail');?></a></li>
                            <li><span>Адрес : </span><?=self::varible('address','Адрес');?></li>
                        </ul>
                    </div>
                </div>
        		<div class="four columns">
					<?self::block('footerLastList');?>
                </div>
        		<!--<div class="four columns">
                    <div class="twitter-widget">
                        <h4>Из Twitter-а</h4>
                        <div class="tweet"></div>
                    </div>
                </div>-->
        		<div class="four columns">
                    <?self::block('catogories');?>
                </div>
        	</div><!-- container -->
        </div>