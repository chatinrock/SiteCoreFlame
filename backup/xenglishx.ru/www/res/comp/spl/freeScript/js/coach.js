var timeMvc = (function(){

	var saveDate;
	var lastDayListTaken = [];
	var $confirmLighbox;
	// Выбранная ячейка в таблице
	var $selectTd;

	function cbConfirmResult(pData){
		if ( !pData ){
			jQuery('#errorBox').html('Неизвестная ошибка').show();
			jQuery.lightbox().close();
			return;
		}

		if ( pData['status'] == 'nomoney'){
			noMoney(pData['price'], pData['balance']);
			jQuery.lightbox().close();
			return;
		}

		if (pData['status'] != 0 ){
			jQuery('#errorBox').html(pData['msg']).show();
			jQuery.lightbox().close();
			return;
		}

		$confirmLighbox.html('<div class="box success">Время удачно сохранено</div>');
		$confirmLighbox.prev().removeClass('jquery-lightbox-loading');

		jQuery('#waitTime').html(saveDate);
		jQuery('#chouseTimeBox').hide();
		jQuery('#timeStatusBox').show();
		initTimeStatusBox();

		// func. cbConfirmResult
	}

	function confirmBtnClick(){
		$confirmLighbox.html('');
		$confirmLighbox.prev().addClass('jquery-lightbox-loading');
		jQuery.ajax({
			url: "/webcore/func/utils/ajax/?name=user&act=speakdate",
			data: 'date='+saveDate,
			type: 'POST'
		}).done(cbConfirmResult);
		return false;
		// func. confirmBtnClick
	}

	function selectBtnClick(){
		var selectTimeVal = jQuery('#timeBox input[name="time"]:checked').val();
		if ( selectTimeVal == undefined ){
			jQuery('#errorBox').html('Необходимо выбрать время встречи в таблице').show();
			return false;
		}
		var selectTime = selectTimeVal.split(':');
		selectTime = parseInt(selectTime[0]) * 60 * 60 + parseInt(selectTime[1]) * 60;

		var selectDateVal = jQuery( "#datepicker" ).datepicker( "getDate" );
		if ( selectDateVal == null ){
			jQuery('#errorBox').html('Выбирите дату').show();
			return false;
		}
		var selectDate = selectDateVal.getTime()/1000;
		selectDate += selectTime;

		var timeNow = (new Date()).getTime()/1000 - timeData.time;
		if ( selectDate <= timeNow ){
			jQuery('#errorBox').html('Нельзя назначить время встречи в прошлом').show();
			return false;
		}
		jQuery('#errorBox').hide();


		var formatDate = getFormatDate(selectDateVal);
		saveDate = formatDate + ' '+ selectTimeVal;

		jQuery('#confirmBox span.date:first').html(formatDate);
		jQuery('#confirmBox span.time:first').html(selectTimeVal);

		jQuery.lightbox('#confirmBox', {
			width: 250,
			height: 250,
			'onOpen': function(){
				$confirmLighbox = jQuery(this).next();
			}
		});

		return false;
		// func. selectBtnClick
	}


	function cbDatePickerSelect(pData){
		if ( !pData ){
			jQuery('#errorBox').html('Неизвестная ошибка').show();
			return;
		}
		if ( pData['status'] != 0 ){
			jQuery('#errorBox').html(pData['msg']).show();
			return;
		}

		for( var i in lastDayListTaken ){
			jQuery('#time'+lastDayListTaken[i]).removeClass('taken').attr('title', 'Свободно');
		}

		lastDayListTaken = pData.list;

		for( var i in pData.list){
			jQuery('#time'+pData.list[i]).addClass('taken').attr('title', 'Занято'); ;
		}

		jQuery('#preload').hide();
		// func. cbDatePickerSelect
	}

	function datePickerSelect(dateText, obj){
		jQuery.ajax({
			url: "/webcore/func/utils/ajax/?name=user&act=gettimedata&date="+dateText,
			type: 'GET'
		}).done(cbDatePickerSelect);
		jQuery('#preload').show();
		// func. datePickerSelect
	}

	function timeBoxClick(pEvent){
		if ( pEvent.target.tagName != 'TD'){
			var $obj = jQuery(pEvent.target).parents('td:first');
			if ( $obj.length == 0 ){
				return;
			}
		}else{
			var $obj = jQuery(pEvent.target);
		}

		if ( $obj.hasClass('taken')){
			return;
		}

		if ( $selectTd){
			$selectTd.removeClass('select');
			$selectTd.find('span.radio-container').removeClass('radio-checked');
		}

		$obj.addClass('select');
		
		console.log($obj.find('input[name="time"]:first'));
		
		$obj.find('input[name="time"]:first').attr('checked',true);
		$obj.find('span.radio-container').addClass('radio-checked');
		

		$selectTd = $obj;
		// func. timeBoxClick
	}

	function initChouseTimeBox(){
		if ( arguments.callee.flag ){
			return;
		}
		arguments.callee.flag = true;
		jQuery('#confirmBtn').click(confirmBtnClick);
		jQuery('#selectBtn').click(selectBtnClick);
		jQuery('#timeBox').click(timeBoxClick);

		/*var $timeTBodyBox = jQuery('#timeBox tbody:first').html('');
		var timeBegin = 12;
		var flag = true;
		for( var i = 0; i < 60; i+= 15){
			var min = i == 0 ? '00' : i;
			var time1 = (timeBegin);//+':'+min;
			var time2 = (timeBegin+2);//+':'+min;
			var time3 = (timeBegin+4);//+':'+min;
			var time4 = (timeBegin+6);//+':'+min;
			$timeTBodyBox.append('<tr>'+
					'<td title="Свободно" id="time'+time1+min+'">'+time1+':'+min+'<input type="radio" name="time" value="'+time1+':'+min+'"/></td>'+
					'<td title="Свободно" id="time'+time2+min+'">'+time2+':'+min+'<input type="radio" name="time" value="'+time2+':'+min+'"/></td>'+
					'<td title="Свободно" id="time'+time3+min+'">'+time3+':'+min+'<input type="radio" name="time" value="'+time3+':'+min+'"/></td>'+
					'<td title="Свободно" id="time'+time4+min+'">'+time4+':'+min+'<input type="radio" name="time" value="'+time4+':'+min+'"/></td>'
					+'</tr>')
			if ( i == 45 && flag ){
				++timeBegin;
				flag = false;
				i = -15;
			}
		} // for*/
		jQuery( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+3M", onSelect: datePickerSelect });

		var timeNow = jQuery( "#datepicker").datepicker('getDate');
		timeNow = getFormatDate(timeNow);
		datePickerSelect(timeNow, null);
		// func. initChouseTimeBox
	}

	function cbConfirmRemoveResult(pData){
		if ( !pData ){
			jQuery('#errorBox').html('Неизвестная ошибка').show();
			return;
		}
		if ( pData['status'] != 0 ){
			jQuery('#errorBox').html(pData['msg']).show();
			return;
		}

		jQuery('#errorBox').hide();
		jQuery('#successBox').html('Время встречи успешно отменено').show();
		jQuery('#chouseTimeBox').show();
		jQuery('#timeStatusBox').hide();
		initChouseTimeBox();
		jQuery.lightbox().close();
		// func. cbConfirmRemoveResult
	}

	function confirmRemoveBtnClick(){
		jQuery.ajax({
			url: "/webcore/func/utils/ajax/?name=user&act=canceltime",
			type: 'POST'
		}).done(cbConfirmRemoveResult);
		return false;
		// func. confirmRemoveBtnClick
	}

	function initTimeStatusBox(){
		if ( arguments.callee.flag ){
			return;
		}
		arguments.callee.flag = true;
		jQuery('#confirmRemoveBtn').click(confirmRemoveBtnClick);
		jQuery('#cancelTimeBtn').lightbox({
			width: 250,
			height: 250
		});
		// func. initTimeStatusBox
	}

	function getFormatDate(date){
		var monthNow = date.getMonth()+1;
		monthNow = monthNow < 10 ? '0'+monthNow : monthNow;
		var dateNow = date.getDate() < 10 ? '0'+date.getDate():date.getDate();
		return dateNow+'.'+monthNow+'.'+date.getFullYear();
		// func. getFormatDate
	}

	function noMoney(price, balance){
		var need = price - balance;
		jQuery('#informationBox').html('Недостаточно средств для заявки. Ваш баланс: '+balance+' руб. Необходимо '+ need
				+' руб.<br/> <a href="/user/" class="button blue small">&raquo; Пополнить баланс</a>').show();
	}

	function init(){
		if ( timeData.speakTime > (new Date).getTime()/1000-timeData.time ){
			var dateWait = new Date();
			dateWait.setTime(timeData.speakTime*1000);
			var min = dateWait.getMinutes();
			dateWait = getFormatDate(dateWait)+' '+dateWait.getHours()+':'+(min < 10 ?'0'+min: min);
			jQuery('#waitTime').html(dateWait);
			jQuery('#chouseTimeBox').hide();
			jQuery('#timeStatusBox').show();
			initTimeStatusBox();
		}else{
			jQuery('#chouseTimeBox').show();
			jQuery('#timeStatusBox').hide();
			initChouseTimeBox();
			if ( !timeData.isBalance ){
				noMoney(timeData.userData['price'], timeData.userData['balance']);
			}
		}
		jQuery('#priceText').html(timeData.userData['price']);
	}
	return{
		init: init
	}
})();

jQuery(document).ready(function() {
	timeMvc.init();
});