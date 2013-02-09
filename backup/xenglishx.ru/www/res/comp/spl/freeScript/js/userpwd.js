/**
* @author Козленко В.Л.
* @url http://{sitename}/user/
* Используется в личном кабинете пользователя
*/
var userPwdMvc = (function(){

	function showErrorBox(){
		jQuery('#pwdErrorBox').html('Длина нового пароля должна быть больше 4 символов').show();
		// func. showErrorBox
	}

	function newPwdFormSubmit(){
		var pwd = jQuery(this).find('input[name="newpwd"]').val();
		if ( pwd.trim().length < 5 ){
			showErrorBox();
			return false;
		}

		return true;
		// func. newPwdFormSubmit
	}

	function init(){
		jQuery('#pwdForm').submit(newPwdFormSubmit);
		jQuery('.lightbox').lightbox({
			/*'onOpen'  : function() {
				if ( $lightboxObj != null ){
					return;
				}
				$lightboxObj = jQuery(this).next();
				$lightboxObj.click(lightboxObjClick);
			}*/
		}); 
		// func. init
	}

	return{
		init: init
	}
})();
userPwdMvc.init();