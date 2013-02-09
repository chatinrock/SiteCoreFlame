<div id="content">
    <div class="wrapper">
        <h1 class="page-title" id="pageTitle"><?$this->varible('pageTitle');?></h1>
        <h3 class="page-slogan"><?$this->varible('pageSlogan');?></h3>
        <div id="content-wrapper">
            <div class="block main-content" id="full-width">
                <div id="main-content">
                    <?$this->block('breadcrumbs');?>
                    <?$this->block('content');?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content-bottom-bg"></div>
        <div id="content-bottom-bg2"></div>
        <div class="clear"></div>
    </div>
</div>
