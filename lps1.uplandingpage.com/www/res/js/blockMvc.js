var blockMvc = (function(){
	var blockObj;

	var treeFile;
	var boxType = '';

	var saveData = {block:{}, varible:{}};

	function getBlockFullname($obj){
		var fullname = '';
		jQuery($obj).parents('.block-edit').each(function(num, obj){
			var param = JSON.parse(jQuery(obj).attr('block-param'));
			fullname = param.name + '/' + fullname;
		});
		var blockParam = $obj.attr('block-param');
		if ( blockParam ){
			fullname += JSON.parse(blockParam).name;
		}
		return fullname;
	}

	function initControlPanel(){
		var list = {};
		list[blockObj.name] = blockObj.text;

		// Формируем список вложенных блоков
		jQuery(blockObj.element).parents('.block-edit').each(function(num, obj){
			var param = JSON.parse(jQuery(obj).attr('block-param'));
			list[param.name] = param.text;
			blockObj.fullname = param.name + '/' + blockObj.fullname;
		});

		// Формируем список блоков в Select
		jQuery('#levelList').html('');
		for(var name in list ){
			jQuery('#levelList').append('<option name="'+name+'">'+list[name]+'</option>');
		}

		blockObj.fullname += blockObj.name;
		if ( saveData.block[blockObj.fullname] ){
			boxType = saveData.block[blockObj.fullname].type;
			jQuery('#' + boxType + 'TypeInput').attr("checked", 'checked');
			showTypeBox();
			if ( boxType == 'text'){
				jQuery('textarea#cmpText').val(saveData.block[blockObj.fullname].html);
				saveData.block[blockObj.fullname].file = '';
			}else{
				treeFile.selectItem(saveData.block[blockObj.fullname].file);
				saveData.block[blockObj.fullname].html = '';
			} // if ( boxType == 'text')
		}else{
			jQuery('#cmpText').val('');
			jQuery('#controlMainPanel input[name="type"]:checked').attr("checked", false);
			jQuery('#textTypeBox').hide();
			jQuery('#treeTypeBox').hide();
			treeFile._unselectItems();
		} // if ( saveData.block[blockObj.fullname] )

		// func. initControlPanel
	}

	function blockClick(pEvent){
		var blockEdit = jQuery(pEvent.target);
		if ( !blockEdit.hasClass('block-edit')){
			blockEdit = jQuery(pEvent.target).parents('.block-edit:first');
		}

		// Получаем параметры по блоку
		blockObj = JSON.parse(blockEdit.attr('block-param'));
		blockObj.element = blockEdit;
		blockObj.fullname = '';
		initControlPanel();

		jQuery.fancybox({
			href: '#controlMainPanel',
			maxWidth	: 600,
			maxHeight	: 320,
			autoSize	: false
		});
		/*jQuery.lightbox('#controlMainPanel', {
			width	: 600,
			height	: 300
		});*/
		
		
		// func. blockClick
	}

	function typeBoxChange(pObj){
		boxType = pObj.target.value
		showTypeBox();
		// func. typeBoxChange
	}

	function showTypeBox(){
		if ( boxType == 'file' ){
			jQuery('#treeTypeBox').show();
			jQuery('#textTypeBox').hide();
		}else
		if ( boxType == 'text' ){
			jQuery('#textTypeBox').show();
			jQuery('#treeTypeBox').hide();
		}
		// func. showTypeBox
	}

	function cmpSaveBtnClick(){

		// Удаляем всех детей, если они есть
		blockObj.element.find('.block-edit').each(function(num, obj){
			var fullname = getBlockFullname(jQuery(obj));
			delete saveData.block[fullname];
		});

		if ( boxType == 'text'){
			var html = jQuery('#cmpText').val();
			blockObj.element.html( html );
			saveData.block[blockObj.fullname] = {type:boxType, html:html};
		}else
		if ( boxType == 'file' ){
			var file = treeFile.getSelectedItemId();
			saveData.block[blockObj.fullname] = {type:boxType, file:file};
			blockObj.element.load('?file='+file);
		}

		jQuery.fancybox.close();
		//jQuery.LightBoxObject.close()
		// func. cmpSaveBtnClick
	}

	function saveHtmlBtnClick(){
		$.ajax({
			url: "?action=save",
			data: saveData,
			type : 'POST'
		}).done(function(pData) {
			if ( pData['err'] != undefined ){
				return false;
			}
			alert('Success save');
		});
		return false;
		// func. saveHtmlBtnClick
	}saveData


	function showSettingBtnClick(){
		var tableTBody = '';
		jQuery('.varible-edit').each(function(num, obj){
			var name = jQuery(obj).attr('name');
			var caption = jQuery(obj).attr('caption');
			var fullname = getBlockFullname(jQuery(obj));
			fullname = fullname == '' ? '::root' : fullname;
			var value = '';
			if ( saveData.varible && saveData.varible[fullname] && saveData.varible[fullname][name] ){
				value = saveData.varible[fullname][name].replace('"', '\"');
			}
			tableTBody += '<tr><td class="caption">'+caption+'</td><td><input type="text" class="varible" name="'+name+'" value="'+value+'"/></td></tr>';
		});
		jQuery('#controlVariblePanel table.varibleTable>tbody:first').html(tableTBody);

		jQuery.fancybox({
			href: '#controlVariblePanel',
			maxWidth	: 600,
			maxHeight	: 400,
			autoSize	: false
		});
		/*jQuery.lightbox('#controlVariblePanel', {
			width	: 600,
			height	: 300
		});*/
		return false;
		// func. showSettingBtnClick
	}

	function cvpSaveBtnClick(){
		saveData.varible = {};
		jQuery('#controlVariblePanel table.varibleTable input.varible').each(function(num, obj){
			var $varObj = jQuery('#varEdit-' + obj.name);
			$varObj.html(obj.value);
			var fullname = getBlockFullname($varObj);
			fullname = fullname == '' ? '::root' : fullname;
			if ( !saveData.varible[fullname] ){
				saveData.varible[fullname] = {};
			}
			saveData.varible[fullname][obj.name] = obj.value;
		});
		jQuery.fancybox.close();
		//jQuery.LightBoxObject.close()
		return false;
		// func. cvpSaveBtnClick
	}

	function publishHtmlBtnClick(){
		$.ajax({
			url: "?action=publish",
			type : 'POST'
		}).done(function(pData) {
			if ( pData['err'] != undefined ){
				return false;
			}
			alert('Success publish');
		});
		return false;
		// func. publishHtmlBtnClick
	}

	function init(){
		if ( blockData.saveData ){
			saveData = blockData.saveData;
		}

		// Находим все блоки и вешаем на них обработчик 
		jQuery('.block-edit').each(function(num, obj){
			var param = JSON.parse(jQuery(obj).attr('block-param'));
			jQuery(obj).click(blockClick);
		});
		
		//console.log(saveData.block);

		/*for( var fullname in saveData.varible ){
			for( var name in saveData.varible[fullname] ){
				jQuery('#varEdit-' + name).html(saveData.varible[fullname][name]);
			} // for( name )
		} // for( fullname )*/

		jQuery('#controlMainPanel input[name="type"]').click(typeBoxChange);

		// Клик по кноке Сохранить настройки блоков (cmp - controlMainPanel)
		jQuery('#cmpSaveBtn').click(cmpSaveBtnClick);
		// Клик по кнопке сохранить страницу
		jQuery('#saveHtmlBtn').click(saveHtmlBtnClick);
		// Клик по кнопке Настройки
		jQuery('#showSettingBtn').click(showSettingBtnClick);
		// Клиек по кнопке Сохранение переменных из настроек (cpv - controlVariblePanel)
		jQuery('#cvpSaveBtn').click(cvpSaveBtnClick);
		// Клик по кнопку Опубликовать страницу
		jQuery('#publishHtmlBtn').click(publishHtmlBtnClick);

		treeFile = new dhtmlXTreeObject('treeTypeBox', "100%", "100%", 0);
		treeFile.setSkin("dhx_skyblue");
		treeFile.setImagePath("http://theme.codecampus.ru/plugin/dhtmlx/dhtmlxTree/codebase/imgs/csh_vista/");
		treeFile.loadJSONObject(blockData.treeFileJson);

		// func. init
	}
	return {
		init: init
	}
})();
blockMvc.init();