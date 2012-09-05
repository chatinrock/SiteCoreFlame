<?
$phone = self::varible('phone','Телефон');
$email = self::varible('email','Email');
$address = self::varible('address','Адрес');
?><div id="footer">
            <div class="container">
        		<div class="four columns">
                    <div class="contact-widget">
                        <h4>Контакты</h4>
                        <!--<p></p>-->
                        <ul>
                            <?if ($phone){?><li><span>Телефон : <?=$phone?></span></li><?}?>
                            <?if ($email){?><li><span>Email : </span><a href="mailto:<?=$email?>?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо"><?=$email?></a></li><?}?>
                            <?if ($address){?><li><span>Адрес : </span><?=$address?></li><?}?>
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