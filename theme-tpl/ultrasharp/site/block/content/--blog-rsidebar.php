<div id="content">
    <div class="wrapper">
		<?$this->block('title');?>	
        <div id="content-wrapper">
            <div class="block main-content" id="sidebar-right">
                <div id="sidebar">
                    <?$this->block('sidebar');?>
                </div>
                <div id="main-content">
                    <?$this->block('breadcrumb');?>
                    <?$this->block('artList');?>
					<?$this->block('author');?>
					<?$this->block('otherPosts');?>
					<?$this->block('comments');?>
					<?$this->block('respond');?>
                </div>
                <div class="clear"></div>
                <?self::block('pagination');?>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content-bottom-bg"></div>
        <div id="content-bottom-bg2"></div>
        <div class="clear"></div>
    </div>
</div>