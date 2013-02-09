<div>
	<a href="#saveParam" id="saveParamBtn" title="Сохранить параметры">
          <img src="<?= self::res('images/save_24.png') ?>" alt="Назад" />
     </a>
</div>

<div>
	<a id="prevSetBtn" href="#">
          <img alt="Выбрать" src="<?= self::res('images/folder_16.png') ?>"/>
          Выбрать
     </a>
	 <a target="_blank" class="hidden" href="#" id="prevShowBtn">
         <img alt="Посмотреть" src="<?= self::res('images/file_16.png') ?>"/>
         Посмотреть
     </a>
</div>

<form id="paramBoxForm">
	<div>KeyWords</div><div><input type="text" name="keywords" value="<?=self::get('seoKeywords')?>"/></div>
	<div>Descript</div><div><input type="text" name="descript" value="<?=self::get('seoDescr')?>"/></div>
	<div>Описание</div>
	<div>
		<textarea name="shortText" class="shortText"><?=self::get('shortText')?></textarea>
	</div>
</form>

<script>
	var paramData = {
		imgUrl: '<?=self::get('prevImgUrl')?>'
	}
	
	var paramMvc = (function(){
		var imgUrl = '';
		
		function getContentCallBack(pFuncNum, pUrl, pPreview){
			setImgUrl(pUrl);
			// func. getContentCallBack
		}
		
		function setImgUrl(pUrl){
			imgUrl = pUrl;
			$('#prevShowBtn').show().attr('href', pUrl);
			// func. setImgUrl
		}
		
		function cbSaveParamData(pData){
			if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }
			
            alert('Данные успешно сохранены');
			// func. cbSaveParamData
		}
		
		function prevSetBtnClick(){
			var urlWindow = utils.url({
				method: 'fileManager', 
				query: {CKEditorFuncNum: '25', type: 'img', id: engartData.objItemId}
			});
			console.log(urlWindow);
			var win = window.open( urlWindow, 'Выберите файл', 
				 'width=800,height=600,scrollbars=yes,resizable=yes,'
				+'location=no,status=yes,menubar=yes');
			win.onload = function() {
				win.funcNameCallBack = getContentCallBack;
                win.callBackUsedData = {};
            };
			return false;
			// func. prevSetBtn
		}
		
		function saveParamBtnClick(){
			var data = $('#paramBoxForm').serialize();
			HAjax.saveParamData({
				data: data+'&imgurl='+imgUrl+'&objItemId='+engartData.objItemId,
				methodType:'POST'
			});
			$.fancybox.close();
			return false;
			// func. saveParamBtnClick
		}
	
		function init(){
			$('#saveParamBtn').click(saveParamBtnClick);
			$('#prevSetBtn').click(prevSetBtnClick);
			
			HAjax.create({
                saveParamData: cbSaveParamData
            });
			
			setImgUrl(paramData.imgUrl);
			// func. init
		}
		init();
	})();
</script>