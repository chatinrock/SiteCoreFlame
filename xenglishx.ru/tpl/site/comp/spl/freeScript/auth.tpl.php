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
		<a href="/pubform/authUser.html?lightbox[width]=400&lightbox[height]=300" class="button tiny orange lightbox">Вход</a>
		/ 
		<a href="/pubform/regUser.html?lightbox[width]=300&lightbox[height]=200" class="button tiny orange lightbox">Регистрация</a>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	var authMvc = (function(){
		var $lightboxObj = null;
		
		function enterUserAction(){
			jQuery('#ajaxLoadBox').show();
			jQuery('#wrongLoginBox').hide();
			jQuery.ajax({
				url: "/webcore/func/utils/user/",
				data: jQuery('#authForm').serialize(),
				type: 'POST'
			}).done(cbEnterUserAction);
			// func. enterUserAction
		}
		
		function cbEnterUserAction(pData){
			if ( pData['type'] == 'ok'){
				window.location.reload();
				return;
			}
			jQuery('#ajaxLoadBox').hide();
			jQuery('#wrongLoginBox').show();
			// func. cbEnterUserAction
		}
		
		function cbRegistrUserAction(pData){
			if ( pData['result'] ){
				jQuery('#eventBox').removeClass('waiting').addClass('error').html('Такой логин уже существует');
				return;
			}
			//jQuery('#eventBox').removeClass('waiting').addClass('success').html('');
			var email = jQuery('#regForm input[name="login"]').val();
			$lightboxObj.html('<div class="box success">Вы успешно зарегистрированы.<br/>Пароль будет выслан на '+email+'</div>');
			// func. cbRegistrUserAction
		}
		
		function registrUserAction(){
			jQuery('#eventBox').removeClass('error').addClass('waiting').html('Проверка Email. Ожидайте.').show();
			jQuery.ajax({
				url: "/webcore/func/utils/user/",
				data: 'type=checkLogin&'+jQuery('#regForm').serialize(),
				type: 'POST'
			}).done(cbRegistrUserAction);
			// func. registrUserAction
		}
		
		function lightboxObjClick(pEvent){
			var rel = jQuery(pEvent.target).attr('rel');
			if ( !rel ){
				return false;
			}
			
			switch( rel ){
				case 'reg': 
					registrUserAction();
				break;
				case 'enter':
					enterUserAction();
				break;
				case 'forget':
				
				break;			
			}
			return false;
			// func. lightboxObjClick
		}
		
		function pwdInputKeyPress(pEvent){
			if( pEvent && pEvent.keyCode == 13){
				enterUserAction();
			}
			// func. pwdInputKeyPress
		}
		
		function regEmailKeyPress(pEvent){
			if( pEvent && pEvent.keyCode == 13){
				registrUserAction();
			}
			// func. pwdInputKeyPress
		}
		
		function init(){
			jQuery('.lightbox').lightbox({
				'onOpen'  : function() {
					if ( $lightboxObj != null ){
						return;
					}
					$lightboxObj = jQuery(this).next();
					$lightboxObj.click(lightboxObjClick);
				},
			}); 
		}
	
		return {
			init: init,
			pwdInputKeyPress: pwdInputKeyPress,
			regEmailKeyPress: regEmailKeyPress
		}
	})();
	authMvc.init();
</script>
