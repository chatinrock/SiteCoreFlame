/**
* @author Козленко В.Л.
* Используется в авторизированном блоке пользователя на странице
*/
var profileMvc = (function(){
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
profileMvc.init();