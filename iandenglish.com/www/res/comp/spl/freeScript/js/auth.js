/**
* @author Козленко В.Л.
* Используется в блоке пользователя. Отвечает за регистрация, авторизация, восстановление пароля
*/
var authMvc = (function(){
	var $lightboxObj = null;
	
	/**
	* Отправка данных о авторизации на сервер
	*/
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
	
	/**
	* Результат по регистрации
	*/
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
	
	/**
	* Отправка данных о регистрации на сервер
	*/
	function registrUserAction(){
		jQuery('#eventBox').removeClass('error').addClass('waiting').html('Проверка Email. Ожидайте.').show();
		jQuery.ajax({
			url: "/webcore/func/utils/user/",
			data: 'type=regist&'+jQuery('#regForm').serialize(),
			type: 'POST'
		}).done(cbRegistrUserAction);
		// func. registrUserAction
	}

	/**
	* отображение формы: Забыл пароль
	*/
	function forgetUserAction(){
		$lightboxObj.load('/pubform/forgetUser.html');
		// func. forgetUserAction
	}

	function cbRestorePwdAction(pData){
		if ( pData['error'] == 'noexists' ){
			jQuery('#eventBox').removeClass('waiting').addClass('error').html('Такой логин/email не зарегистрирован');
			return;
		}


		var email = jQuery('#forgetForm input[name="login"]').val();
		$lightboxObj.html('<div class="box success">Ожидайте ссылки для восстановления на '+email+'</div>');
		// func. cbRestorePwdAction
	}

	/**
	* Отправка данных о восстановлении пароля на сервер
	*/
	function restorePwdAction(){
		jQuery.ajax({
			url: "/webcore/func/utils/user/",
			data: 'type=restore&'+jQuery('#forgetForm').serialize(),
			type: 'POST'
		}).done(cbRestorePwdAction);
		jQuery('#eventBox').removeClass('error').addClass('waiting').html('Проверка Email. Ожидайте.').show();

		// func. restorePwdAction
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
				forgetUserAction();
				break;
			case 'restore':
				restorePwdAction();
				break;
		}
		return false;
		// func. lightboxObjClick
	}
	
	function restorePwdKeyPress(pEvent){
		if( pEvent && pEvent.keyCode == 13){
			restorePwdAction();
		}
		// func. pwdInputKeyPress
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
	
	/**
	* Функция пользоваляет биндить сторонние кнопки для авторизации и регистрации
	*/
	function initLigtbox(pSelector){

		jQuery(pSelector).lightbox({
            width: 400,
            height: 300,
			'onOpen'  : function() {
				if ( $lightboxObj != null ){
					return;
				}
				$lightboxObj = jQuery(this).next();
				$lightboxObj.click(lightboxObjClick);
			}
		});
		// func. initLigtbox
	}
	
	function init(){
		 initLigtbox('.lightbox');
		// func. init
	}

	return {
		init: init,
		pwdInputKeyPress: pwdInputKeyPress,
		regEmailKeyPress: regEmailKeyPress,
		restorePwdKeyPress: restorePwdKeyPress,
		initLigtbox: initLigtbox
	}
})();
