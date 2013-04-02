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

		jQuery(blockObj.element).parents('.block-edit').each(function(num, obj){
			var param = JSON.parse(jQuery(obj).attr('block-param'));
			list[param.name] = param.text;
			blockObj.fullname = param.name + '/' + blockObj.fullname;
		});

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
				jQuery('#cmpText').val(saveData.block[blockObj.fullname].html);
				saveData.block[blockObj.fullname].file = '';
			}else{
				treeFile.selectItem(saveData.block[blockObj.fullname].file);
				saveData.block[blockObj.fullname].html = '';
			}
		}else{
			jQuery('#cmpText').val('');
			jQuery('#controlMainPanel input[name="type"]:checked').attr("checked", false);
			jQuery('#textTypeBox').hide();
			jQuery('#treeTypeBox').hide();
			treeFile._unselectItems();
		}

		// func. initControlPanel
	}

	function blockClick(pEvent){
		var blockEdit = jQuery(pEvent.target);
		if ( !blockEdit.hasClass('block-edit')){
			blockEdit = jQuery(pEvent.target).parents('.block-edit:first');
		}

		blockObj = JSON.parse(blockEdit.attr('block-param'));
		blockObj.element = blockEdit;
		blockObj.fullname = '';
		initControlPanel();

		jQuery.fancybox({
			href: '#controlMainPanel',
			maxWidth	: 600,
			maxHeight	: 300,
			autoSize	: false
		});
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
	}


	function showSettingBtnClick(){
		var tableTBody = '';
		jQuery('.varible-edit').each(function(num, obj){
			var name = jQuery(obj).attr('name');
			var caption = jQuery(obj).attr('caption');
			var fullname = getBlockFullname(jQuery(obj));
			fullname = fullname == '' ? '::root' : fullname;
			var value = '';
			if ( saveData.varible[fullname] && saveData.varible[fullname][name] ){
				value = saveData.varible[fullname][name].replace('"', '\"');
			}
			tableTBody += '<tr><td class="caption">'+caption+'</td><td><input type="text" class="varible" name="'+name+'" value="'+value+'"/></td></tr>';
		});
		jQuery('#controlVariblePanel table.varibleTable>tbody:first').html(tableTBody);

		jQuery.fancybox({
			href: '#controlVariblePanel',
			maxWidth	: 600,
			maxHeight	: 300,
			autoSize	: false
		});
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

		jQuery('#cmpSaveBtn').click(cmpSaveBtnClick);
		jQuery('#saveHtmlBtn').click(saveHtmlBtnClick);
		jQuery('#showSettingBtn').click(showSettingBtnClick);
		jQuery('#cvpSaveBtn').click(cvpSaveBtnClick);
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