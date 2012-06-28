<div id="header">

    <div class="wrapper">
        <div id="top-info">
            <div class="left">
                <span class="telephone"><?=self::varible('phone', 'Телефон');?></span>
                <!--<span class="fax">+0 (000) 000 000</span>-->
                <span class="address"><?=self::varible('addres', 'Адрес');?></span>
                <span class="email"><?=self::varible('email', 'E-mail');?></span>
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
                <!--<span id="search-box">
        
                <div class="pop-up">
                <div class="pop-up-wrapper">
                
                    <form action="#ultrasharp" method="get">
                    
                        <input type="text" name="s" id="s-input" value="Keywords..." onFocus="if(jQuery(this).val() == 'Keywords...') { jQuery(this).val(''); }" autocomplete="off" />
                        <input type="submit" id="s-submit" value="Search" class="button-color" />
                        
                        <div id="ajax-search"></div>
                        
                    
                    </form>

                </div>
                
                </div>
    
            </span>-->
            </div>

        </div>

        <div id="main-bar" class="full">
            <!-- /LOGO STARTS/ -->
            <!-- /LOGO ENDS/ -->
            <?= $this->block('menuMain') ?>

            <!-- /LOGO STARTS/ -->
            <div id="logo"><a href="http://themes.ddwebstudios.net/wordpress/ultrasharp/"><img
                    src="http://themes.ddwebstudios.net/wordpress/ultrasharp/wp-content/uploads/2012/06/logo-17.png"
                    alt="UltraSharp"/></a></div>
            <!-- /LOGO ENDS/ -->
        </div>
    </div>
</div>
