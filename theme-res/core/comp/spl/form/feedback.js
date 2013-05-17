var feedbackMvc = (function(){

	function cbFormSubmitResult(pData){
		if ( !pData || !pData['status'] == undefined){
			return;
		}

		if ( pData['status'] != 0 ){
			jQuery('#eventBox').html(pData['msg']).addClass('error').show();
			return;
		}

		jQuery('#eventBox').html('���� ��������� �������. �������� ������').removeClass('error').addClass('success').show();
		jQuery('#contactForm').hide();
		// func. cbFormSubmitResult
	}

	function formSubmit(){
		var $contactForm = jQuery('#contactForm');

		var $obj = $contactForm.find('input[name="feedback[name]"]');
		if ( $obj.val().trim().length == 0 ){
			jQuery('#eventBox').html('������� ���� ���').addClass('error').show();
			$obj.addClass('inputError');
			return false;
		}
		$obj.removeClass('inputError');


		var $obj = $contactForm.find('input[name="feedback[email]"]');
		if ( $obj.val().trim().length == 0 ){
			jQuery('#eventBox').html('������� ��� Email').addClass('error').show();
			$obj.addClass('inputError');
			return false;
		}
		$obj.removeClass('inputError');


		var $obj = $contactForm.find('select[name="feedback[title]"]');
		if ( $obj.val().trim().length == 0 ){
			jQuery('#eventBox').html('�������� ���� ���������').addClass('error').show();
			$obj.addClass('inputError');
			return false;
		}
		$obj.removeClass('inputError');

		var $obj = $contactForm.find('textarea[name="feedback[msg]"]');
		if ( $obj.val().trim().length == 0 ){
			jQuery('#eventBox').html('�������� ���� ���������').addClass('error').show();
			$obj.addClass('inputError');
			return false;
		}
		$obj.removeClass('inputError');

		jQuery.ajax({
			url: "/webcore/func/comp/spl/form/?form[action]=feedback",
			data: $contactForm.serialize(),
			type: 'POST'
		}).done(cbFormSubmitResult);

		return false;
	}

	function init(){
		if ( jQuery.cookie('userData')){
			var userData = eval('('+jQuery.cookie('userData')+')');
			jQuery('#contactForm input[name="user[email]"]').val(userData['email']);
		}

		jQuery('#contactForm').submit(formSubmit);
		// func. init
	}
	return{
		init: init
	}
})();

feedbackMvc.init();