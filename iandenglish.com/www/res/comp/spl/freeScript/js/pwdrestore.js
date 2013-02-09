/**
* @author Козленко В.Л.
* @url http://{sitename}/user/?type=restore&email={email}&code={code}
* Используется при восстановлении пароля
*/
var pwdMvc = (function(){

	function showErrorBox(){
		jQuery('#wrongLoginBox').show();
		// func. showErrorBox
	}

	function newPwdFormSubmit(){
		var pwd = jQuery(this).find('input[name="pwd"]').val();
		if ( pwd.trim().length < 5 ){
			showErrorBox();
			return false;
		}

		return true;
		// func. newPwdFormSubmit
	}

	function init(){
		jQuery('#newPwdForm').submit(newPwdFormSubmit);
		// func. init
	}

	return{
		init: init
	}
})();
pwdMvc.init();