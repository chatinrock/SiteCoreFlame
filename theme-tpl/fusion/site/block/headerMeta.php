<?
	$fbUrl = self::varible('fbUrl', 'Facebook Url');
	$vkUrl = self::varible('vkUrl', 'VKontakte Url');
	$googPlusUrl = self::varible('googlePlusUrl', 'Google Plus Url');
	$twitterUrl = self::varible('twitterUrl', 'Twitter Url');
	$youtubeUrl = self::varible('youtubeUrl', 'Youtube Url');
?><div id="headerMeta">
            <div class="container">
                <!--<div class="meta-left">
                    <div class="meta">Twitter :&nbsp;</div>
                    <div class="meta-tweet"></div>
                    <div class="clear"></div>
                </div>-->
                <div class="meta-left">
                    <span class="telephone"><?=self::varible('phone','Телефон');?></span>
                    <span class="email"><a href="mailto:<?=self::varible('email');?>?subject=Запись%20на%20курс" title="Нажмите что бы написать письмо"><?=self::varible('email','E-mail');?></a></span>
                </div>
				<div class="social">
                    <p>Подписывайтесь</p>
                    <ul>
						<? if ( $vkUrl ){ ?>
							<li><a class="text_replace vkontakte" href="<?=$vkUrl?>" target="_blank" rel="nofollow">vkontakte</a></li>
						<?}?>
						<? if ( $twitterUrl ){ ?>
							<li><a class="text_replace twitter" href="<?=$twitterUrl?>" target="_blank" rel="nofollow">twitter</a></li>
						<?}?>
						<? if ( $fbUrl ){ ?>
							<li><a class="text_replace facebook" href="<?=$fbUrl?>" target="_blank" rel="nofollow">facebook</a></li>
						<?}?>
						<? if ( $youtubeUrl ){ ?>
                        <li><a class="text_replace youtube" href="<?=$youtubeUrl?>" target="_blank" rel="nofollow">youtube</a></li>
						<?}?>
						
						<? if ( $googPlusUrl ){ ?>
							<li><a class="text_replace google" href="<?=$googPlusUrl?>" target="_blank" rel="nofollow">google</a></li>
						<?}?>
                        <!--<li><a class="text_replace linkedin" href="#">linkedin</a></li>-->
                    </ul>
                </div>
            </div>
        </div>