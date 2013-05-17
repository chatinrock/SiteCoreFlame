<script src="res/plugin/classes/utils.js" type="text/javascript" xmlns="http://www.w3.org/1999/html"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen" />


<link   href="res/plugin/dhtmlxTree/codebase/dhtmlxtree.css" rel="stylesheet" type="text/css"/>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxcommon.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxtree.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/ext/dhtmlxtree_json.js"></script>


<script src="res/plugin/classes/utils.js" type="text/javascript"></script>

<script src="http://files.codecampus.ru/res/js/min/mvc-api.js" type="text/javascript"></script>
<script src="http://theme.codecampus.ru/bridge/min/themeBridgeApi.js" type="text/javascript"></script>

<style>
	.descriptionText{
		width: 450px;
		height: 150px;
	}

</style>
<div class="column">
    <div class="panel corners">

        <div class="title corners_top">
            <div class="title_element">
                <span id="history"><?=self::get('caption')?></span>
            </div>
        </div>
        <div class="panel"><?=self::get('saveData')?></div>

        <div class="boxmenu corners">
            <ul class="menu-items">
                <li>
                    <a href="#back1" id="backBtn" title="Назад">
                        <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                    </a>
                </li>
                <li>
                    <a href="#saveBtn" id="saveBtn" title="Сохранить">
                        <img src="<?= self::res('images/save_32.png') ?>" alt="Сохранить" /><span>Сохранить.</span>
                    </a>
                </li>
            </ul>
        </div>


        <div class="content">
            <form id="mainContent">
                <table>
                    <tr><td>ФИО</td><td><input type="text" name="fio"/></td></tr>
                    <tr><td>Email</td><td><input type="text" name="email"/></td></tr>
                    <tr><td>Телефон</td><td><input type="text" name="phone"/></td></tr>
                    <tr><td>Рейтинг</td>
                        <td>
                            1 - <input type="radio" name="rating" value="1"/>
                            <input type="radio" name="rating" value="2"/>
                            <input type="radio" name="rating" value="3"/>
                            <input type="radio" name="rating" value="4"/>
                            <input type="radio" name="rating" value="5"/> - 5
                        </td></tr>
                    <tr><td>Стаж</td><td><input type="text" name="exp"/></td></tr>
                    <tr><td>Фото на превью</td><td><input type="button" value="Фото на превью" id="imgPreviewBtn"/></td></tr>
                    <tr><td>Фото галлерея</td><td><input type="button" value="Фото галлерея" id="imgGalleryBtn"/></td></tr>
                    <tr><td>Документы</td><td><input type="button" value="Документы" id="imgDocumentBtn"/></td></tr>
                    <tr><td>Метро</td><td><input type="button" value="Метро" id="metroBtn"/></td></tr>
                    <tr><td>Видео</td><td><input type="button" value="Видео" id="videoBtn"/></td></tr>
                    <tr><td>Отзывы</td><td><input type="button" value="Отзывы" id="otzyvBtn"/></td></tr>
                    <tr><td>Цена</td><td><input type="text" name="price"/> руб.</td></tr>
                    <tr><td colspan="2">Доп. разделы</td></tr>
                    <tr><td colspan="2" id="dopCategory"></td></tr>
                    <tr><td colspan="2">Спец. свойства</td></tr>
                    <tr><td colspan="2" id="peopleFeaturesList"></td></tr>
                    <tr><td colspan="2">Свободный текст</td></tr>
                    <tr><td colspan="2"><textarea class="descriptionText" name="description"><?self::loadFile('descripFile', false)?></textarea></td></tr>
                </table>
            </form>
		</div>
    </div>
</div>


<script type="text/javascript">
    var peopleData = {
        contid: <?= self::get('contId') ?>,
        objItemId: <?= self::get('objItemId') ?>,
		dopCategory: <?= self::get('dopCategory')?>,
        peopleFeaturesList: <?=self::get('peopleFeaturesList') ?>,

        loadData: {
            data: <?=self::get('loadData');?>,
            galleryList: <?=self::get('galleryList', '[]');?>,
            imgPreview: <?=self::get('imgPreview', '{}');?>,
            documentList: <?=self::get('documentList', '[]');?>,
            metroList: <?=self::get('metroList', '[]')?>,
            otzyvList: <?=self::get('otzyvList', '[]')?>
        }
    };

    var contrName = peopleData.contid;
    var callType = 'comp';
    utils.setType(callType);
    utils.setContr(contrName);
    HAjax.setContr(contrName);

    var peopleMvc = (function(){

        var videoWin;

		function initDopCategory(){
            var html = '';
            for( var i in peopleData.dopCategory ){
                var obj = peopleData.dopCategory[i];
                var cheacked = obj.flag == 1 ? ' checked="checked"' : '';
                html += '<label>' + obj.name + ' <input type="checkbox" name="ct[]" value="'+obj.id+'"'+cheacked+'/></label>';
            }
            jQuery('#dopCategory').html(html);
			// func. initdopCategory
		}

        function initpeopleFeaturesList(){
            var html = '';
            for( var i in peopleData.peopleFeaturesList ){
                var obj = peopleData.peopleFeaturesList[i];
                var cheacked = obj.flag == 1 ? ' checked="checked"' : '';
                html += '<label>' + obj.name + ' <input type="checkbox" name="pf[]" value="'+obj.id+'"'+cheacked+'/></label>';
            }
            jQuery('#peopleFeaturesList').html(html);
            // func. initpeopleFeaturesList
        }

        function imgGalleryBtnClick(){
            mvcFileApi.setCallback(function(pEvent){
                peopleData.loadData.galleryList = pEvent.data.list;
            });

            var selectList = Object.keys(peopleData.loadData.galleryList);
            mvcFileApi.showWindow('p'+peopleData.objItemId, 'photo', 'people', selectList);
            return false;
            // func. imgGalleryBtnClick
        }

        function imgPreviewBtnClick(){
            mvcFileApi.setCallback(function(pEvent){
                if ( pEvent.data.length == 0 ){
                    alert('Вы ни чего не выбрали');
                    return;
                }
                peopleData.loadData.imgPreview = {id: pEvent.data.id, url: pEvent.data.url };
            });
            var imgId = peopleData.loadData.imgPreview.id;
            imgId = imgId ? [imgId] : [];
            mvcFileApi.showWindow('p'+peopleData.objItemId, 'photo', 'people', imgId, {single:1});
            return false;
            // func. imgPreviewBtnClick
        }

        function imgDocumentBtnClick(){
            mvcFileApi.setCallback(function(pEvent){
                peopleData.loadData.documentList = pEvent.data.list;
            });
            var selectList = Object.keys(peopleData.loadData.documentList);
            mvcFileApi.showWindow('p'+peopleData.objItemId, 'document', 'people', selectList);
            return false;
            // func. imgDocumentBtnClick
        }

        function metroBtnClick(){
            themeBridgeApi.setCallback(function(pEvent){
                peopleData.loadData.metroList = pEvent.data;
            });
            themeBridgeApi.showWindow({
                url: 'http://theme.codecampus.ru/plugin/metroStation/',
                action: 'show',
                list: peopleData.loadData.metroList
            });
            return false;
            // func. metroBtnClick
        }

        // callback сохранения данных
        function saveDataSuccess(pData) {
            if (pData['error']) {
                alert(pData['error']['msg']);
                return;
            }

            alert('Данные успешно сохранены');
            // func. saveDataSuccess
        }

        function saveBtnClick(){
            var data = jQuery('#mainContent').serialize();
            data += '&itemId=' + peopleData.objItemId;
            data += '&preview='+ JSON.stringify(peopleData.loadData.imgPreview);
            data += '&gallery='+ JSON.stringify(peopleData.loadData.galleryList);
            data += '&document='+ JSON.stringify(peopleData.loadData.documentList);
            data += '&metro='+ JSON.stringify(peopleData.loadData.metroList);
            data += '&video='+ peopleData.loadData.video;
            data += '&otzyv='+ JSON.stringify(peopleData.loadData.otzyvList);

            HAjax.saveData({
                data: data,
                methodType: 'POST'
            });
            return false;
            // func. saveBtnClick
        }

        function videoCallback(pList){
            peopleData.loadData.video = pList;
            // func. videoCallback
        }

        function videoBtnClick(){
            var params = "width=580,height=530,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no";
            if ( videoWin ){
                videoWin.close();
            }
            videoWin = window.open('/?$t=plugin&$c=video&id='+peopleData.objItemId+'&single=1', "VideoExp", params);
            videoWin.onload = function(){
                videoWin.videoMvc.cbResult = videoCallback;
                videoWin.videoMvc.setInitData([peopleData.loadData.video]);
                videoWin.moveTo(screen.width/2-290,screen.height/2-265);
            }
            // func. videoBtnClick
        }

        function otzyvCallback(pList){
            peopleData.loadData.otzyvList = pList;
            // func. otzyvCallback
        }

        function otzyvBtnClick(){
            var params = "width=580,height=530,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no";
            if ( videoWin ){
                videoWin.close();
            }
            videoWin = window.open('/?$t=plugin&$c=video&id='+peopleData.objItemId, "VideoExp", params);
            videoWin.onload = function(){
                videoWin.videoMvc.cbResult = otzyvCallback;
                videoWin.videoMvc.setInitData(peopleData.loadData.otzyvList);
                videoWin.moveTo(screen.width/2-290,screen.height/2-265);
            }
            // func. otzyvBtnClick
        }
	
		function init(){
            initDopCategory();
            initpeopleFeaturesList();

            jQuery('#imgPreviewBtn').click(imgPreviewBtnClick);
            jQuery('#imgGalleryBtn').click(imgGalleryBtnClick);
            jQuery('#imgDocumentBtn').click(imgDocumentBtnClick);
            jQuery('#metroBtn').click(metroBtnClick);
            jQuery('#saveBtn').click(saveBtnClick);
            jQuery('#videoBtn').click(videoBtnClick);
            jQuery('#otzyvBtn').click(otzyvBtnClick);

            $('#backBtn').attr('href', utils.url({}));

            HAjax.create({
                saveData:saveDataSuccess
            });

            peopleData.loadData.video = peopleData.loadData.data ? peopleData.loadData.data['videoId'] : {};

            for( var name in peopleData.loadData.data ){
                var value = peopleData.loadData.data[name];
                jQuery('input[type="checkbox"][name="'+ name +'"][value="'+ value +'"],input[type="radio"][name="'+ name +'"][value="'+ value +'"]').attr('checked', 'checked');
                jQuery('select[name="'+ name +'"],input[type="text"][name="'+ name +'"],input[type="password"][name="'+ name +'"],input[type="hidden"][name="'+ name +'"],textarea[name="'+ name +'"]').val(value);
            }

			// func. init
		}
		return{
			init: init
		}
    })();

    peopleMvc.init();
</script>