<? $this->block('title'); ?>
<div id="content">
    <div class="wrapper">
        <?=self::block('contTitle')?>
        <div id="content-wrapper">
            <div class="block main-content" id="sidebar-right">
                <div id="sidebar">
                    <?$this->block('sidebar');?>
                </div>
                <div id="main-content">
                    <?$this->block('content');?>
                </div>
                <div class="clear"></div>
                <?self::block('postContent');?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content-bottom-bg"></div>
        <div id="content-bottom-bg2"></div>
        <div class="clear"></div>
    </div>
</div>