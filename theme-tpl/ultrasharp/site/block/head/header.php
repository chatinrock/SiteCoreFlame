<div id="header">

    <div class="wrapper">
        <div id="top-info">
            <div class="left">
                <span class="telephone"><?=self::varible('phone', 'Телефон');?></span>
                <!--<span class="fax">+0 (000) 000 000</span>-->
                <span class="address"><?=self::varible('addres', 'Адрес');?></span>
                <span class="email">
					<a href="mailto:<?=self::varible('email');?>" title="Нажмите, что бы отправить письмо"><?=self::varible('email', 'E-mail');?></a>
				</span>
            </div>
        </div>
        <div id="top-bar">
            <div class="left">
                <div class="menu-left-top-bar-container">
                    <?= $this->block('menuLeftTop') ?>
                </div>
            </div>
            <div class="right">

                <div class="top-bar-menu">
                    <?= $this->block('menuRightTop') ?>
                </div>

                <div id="mySocialBtn">
                    <a href="<?=self::varible('vkUrl', 'VKontakte URL');?>" target="_blank" rel="nofollow">
						<img title="Наша страница Twitter" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/twitter23.png" alt="Twitter">
					</a>
                    <a href="<?=self::varible('fbUrl', 'Facebook URL');?>" target="_blank" rel="nofollow">
						<img title="Наша страница Facebook" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/facebook23.png" alt="Facebook">
					</a>
                    <a href="<?=self::varible('twitterUrl');?>" target="_blank" rel="nofollow">
						<img title="Наша страница Вконтакте" src="http://theme.codecampus.ru/plugin/mySocialBtn/images/white/vkontakte23.png" alt="Вконтакте">
					</a>
                </div>

                <span id="search-box">
					<div class="pop-up">
						<div class="pop-up-wrapper">
							<form action="#ultrasharp" method="get">
								<input type="text" name="s" id="s-input" value="Keywords..." onFocus="if(jQuery(this).val() == 'Keywords...') { jQuery(this).val(''); }" autocomplete="off" />
								<input type="submit" id="s-submit" value="Search" class="button-color" />
								<div id="ajax-search"></div>
							</form>
						</div>
					</div>
				</span>
            </div>
        </div>

        <div id="main-bar" class="full">
            <?= $this->block('menuMain') ?>

        </div>
    </div>
</div>
<div class="padding-40"></div>
