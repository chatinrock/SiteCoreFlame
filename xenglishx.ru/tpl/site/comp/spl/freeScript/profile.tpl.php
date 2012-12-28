<script src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<div class="widget" id="authBox">
	<div class="widgetColumnTitle">
		<div class="widgetTitle">
			<h3>Личный кабинет</h3>	
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="widgetColumnContent">
		<a href="#" id="exitBtn" class="button tiny white lightbox">Выход</a>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	var authMvc = (function(){
		
		function exitBtnClick(){
			jQuery.cookie("userExit", "1", {expires: 7*60*30, path: "/"});
			window.location.reload();
			return false;
			// func. exitBtnClick
		}
		
		function init(){
			jQuery('#exitBtn').click(exitBtnClick);
		}
	
		return {
			init: init
		}
	})();
	authMvc.init();
</script>
