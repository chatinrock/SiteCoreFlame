<link   href="res/plugin/dhtmlxTree/codebase/dhtmlxtree.css" rel="stylesheet" type="text/css"/>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxcommon.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxtree.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/ext/dhtmlxtree_json.js"></script>

<script src="res/plugin/classes/utils.js" type="text/javascript"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen"/>

<link rel="stylesheet" type="text/css" href="/res/plugin/jquery/css/jquery.ui.autocomplete.css"/>

<style type="text/css">
    .bold {font-weight: bold}
    .vmiddle{vertical-align: middle; height: 40px}
    .vmiddle img{vertical-align: middle}
    .treeBlock{vertical-align:top; width:200px; height:218px;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;}
    img.img_button{cursor: pointer}

    div.caption{font-weight: bold}

    div.left > div{float: left; margin-right: 5px;}
    div.photo{
        height: 128px;
        width: 128px;
        background-color: #DDDDDD;
        cursor: pointer;
    }

    div.vspace10{
        padding-bottom: 10px;
    }

    input.fio, input.galleryItem{
        width: 300px;
    }
    textarea.descrip{
        width: 70%;
        height: 200px;;
    }

    textarea.aprice{
        width: 70%;
        height: 200px;;
    }

    textarea.address{
        width: 50%;
        height: 100px;;
    }

</style>
<!-- start panel right column -->
<div class="column" >
    <!-- start panel right panel -->
    <div class="panel corners">
        <!-- start panel right title -->
        <div class="title corners_top">
            <div class="title_element">

                <a style="margin-left: 10px" href="" title="В начало">
                    <img src="<? self::res('images/home_16x16.png') ?>" alt="В начало" width="16" height="16" title="В начало"/>
                    В начало /
                </a>
                <span id="history">{Hisotry}</span>
            </div>
        </div><!-- end title -->
        <!-- start panel right content -->
        <div class="content">


            <div class="boxmenu corners">
                <ul class="menu-items">
                    <li>
                        <a href="#back" id="backBtn" title="Назад">
                            <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                        </a>
                    </li>
                    <li>
                        <a href="#save" id="saveBtn" title="Сохранить">
                            <img src="<?= self::res('images/save_32.png') ?>" alt="Сохранить" /><span>Сохранить</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content">

                <form id="mainForm">
                    <div class="left">
                        <div class="photo" id="ptohoImgBtn"></div>
                        <div>
                            <div class="caption">ФИО</div>
                            <div class="vspace10"><?=self::text('name="fio" class="fio"', self::get('fio'))?></div>

                            <div class="left">
                                <div>
                                    <div class="caption">Возраст</div>
                                    <div class="vspace10"><?self::select(self::get('ageList'), 'name="age" class="age"');?></div>
                                </div>
                                <div>
                                    <div class="caption">Пол</div>
                                    <div class="vspace10"><?self::selectKeyName(self::get('sexList'), 'name="sex" class="sex"');?></div>
                                </div>
                                <div>
                                    <div class="caption">Стаж</div>
                                    <div class="vspace10"><?self::select(self::get('experienceList'), 'name="experience" class="experience"');?></div>
                                </div>

                                <div>
                                    <div class="caption">Рейтинг</div>
                                    <div class="vspace10"><?self::select(self::get('ratingList'), 'name="rating" class="rating"');?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br style='clear:both'/>
                    <div>

                        <div class="caption">Телефон</div>
                        <div class="vspace10"><?=self::text('name="phone" class="phone"', self::get('phone'))?></div>

                        <div class="email">E-Mail</div>
                        <div class="vspace10"><?=self::text('name="email" class="email"', self::get('email'))?></div>

                        <div class="caption">Цена за одно занятие</div>
                        <div class="vspace10"><?=self::text('name="price" class="price"', self::get('price'))?> руб</div>

                        <div class="caption">Метро</div>
                        <div class="vspace10">
                            <a href="#" id="metroBtn">
                                <img src="<?= self::res('images/help/metro_20.png') ?>" alt="Выбрать" />
                                Выбрать
                            </a>
                        </div>

                        <div class="caption">Url видео</div>
                        <div class="vspace10"><?=self::text('name="videoUrl" class="videoUrl"', self::get('videoUrl'))?></div>

                        <div class="caption">Галлерея</div>
                        <div class="vspace10">
                            <div>
                                <a href="#contTreeDlg" id="imgGalleryBtn" >
                                    <img src="<?= self::res('images/folder_16.png') ?>" alt="Выбрать" />
                                    <span id="imgGalleryText"></span>
                                </a>
                            </div>
                            <div>
                                <?=self::text('id="galleryItem" class="galleryItem"', self::get('galleryItem'))?>
                            </div>
                        </div>

                        <div class="caption">Адрес</div>
                        <div class="vspace10"><?=self::textarea('name="address" class="address"', self::get('address'))?></div>

                        <div class="caption">Общие цены</div>
                        <div class="vspace10"><?=self::textarea('name="aprice" class="aprice"', self::get('aprice'))?></div>

                        <div class="caption">Описание</div>
                        <div class="vspace10"><?=self::textarea('name="descrip" class="descrip"', self::get('descrip'))?></div>
                    </div>

                </div><!-- end panel right content -->
            </form>

        </div><!-- end panel right content -->
    </div><!-- end panel right panel -->
</div><!-- end panel right column -->

<div id="contTreeDlg" style="width:250px;height:350px; display: none"></div>

<script type="text/javascript">
    var peopleData = {
        contid: <?= self::get('contId') ?>,
        itemObjId: <?= self::get('objItemId') ?>,
        stationIdList: <?= self::get('stationIdList', '[]') ?>,
        photoUrlPreview: '<?= self::get('photoUrlPreview')?>',
        photoUrl: '<?= self::get('photoUrl')?>',
        contTreeJson: <?= self::get('contTree') ?>,
        galleryId: '<?=self::get('galleryId')?>',
        galleryItemid: '<?=self::get('galleryItemId')?>'
    } // var peopleData

    var contrName = peopleData.contid;
    var callType = 'comp';
    utils.setType(callType);
    utils.setContr(contrName);
    HAjax.setContr(contrName);

function fileManagerCallBack(pFuncNum, pUrl, pPreviewUrl){
   peopleMvc.photoFileManagerCallBack(pUrl, pPreviewUrl);
   // func fileManagerCallBack
}

var peopleMvc = (function(){
    var options = {};

    // Дерево контента. Основное дерево.
    var contTree;

    function cbMetroStationSelect(pStationList){
        peopleData.stationIdList = pStationList;
        //alert("I'm a function in the parent window " + stationList.length);
        // func. cbMetroStationSelect
    }

    function metroBtnClick(){
        var urlWindow = utils.url({
            method: 'metroManager',
            query: {id: peopleData.itemObjId}
        });
        var win = window.open( urlWindow, 'Выберите станции',
                'width=810,height=874,scrollbars=yes,resizable=yes,'
                        +'location=no,status=no,menubar=no');
        win.onload = function() {
            win.panel.cbReturnMetroSelect = cbMetroStationSelect;
            win.stationMap.setStationSelect(peopleData.stationIdList);
        };
        win.focus();
        // func. metroBtnClick
    }

    function saveBtnClick(){
        var data = $(options.mainForm).serialize();
        data += '&objItemId='+peopleData.itemObjId;
        data += '&photoUrlPreview='+peopleData.photoUrlPreview;
        data += '&photoUrl='+peopleData.photoUrl;
        data += '&stationList='+peopleData.stationIdList.join(',');
        data += '&galleryId='+peopleData.galleryId;
        data += '&galleryItemid='+peopleData.galleryItemid;

        HAjax.saveData({
            data: data,
            methodType: 'POST'
        });
        return false;

        // func. saveBtnClick
    }

    function prevImgBtnClick(){
        var urlWindow = utils.url({
            method: 'fileManager',
            query: {CKEditorFuncNum: '25', type: 'img', id: reviewData.itemObjId}
        });
        window.open( urlWindow, 'Выберите файл',
                'width=800,height=600,scrollbars=yes,resizable=yes,'
                        +'location=no,status=yes,menubar=yes');
        win.onload = function() {

        }
        return false;
        // func. prevImgBtnClick
    }

    function cbSaveDataSuccess(pData){
        if (pData['error']) {
            alert(pData['error']['msg']);
            return;
        }

        alert('Данные успешно сохранены');
        // func. cbSaveDataSuccess
    }

    function ptohoImgBtnClick(){
        var urlWindow = utils.url({
            method: 'fileManager',
            query: {CKEditorFuncNum: '25', type: 'img', id: peopleData.itemObjId}
        });
        window.open( urlWindow, 'Выберите файл',
                'width=800,height=600,scrollbars=yes,resizable=yes,'
                        +'location=no,status=yes,menubar=yes');
        return false;
        // func. ptohoImgBtnClick
    }

    function photoFileManagerCallBack(pUrl, pUrlPreview){
        $(options.ptohoImgBtn).css("background-image", "url('"+pUrlPreview+"')");
        peopleData.photoUrl = pUrl;
        peopleData.photoUrlPreview = pUrlPreview;
        // func. photoFileManagerCallBack
    }

    function initTree() {
        dhtmlxInit.init({
            'contTree':{
                tree:{
                    id:'contTreeDlg', json: peopleData.contTreeJson
                }, // tree
                dbClick: contBrunchDbClick
            }
        }); // init

        contTree = dhtmlxInit.tree['contTree'];
        // func. initTrees
    }

    function contBrunchDbClick(pBrunchId, pTree){
        // Получаем тип ветки: 1-папка, 0-файл
        var type = pTree.getUserData(pBrunchId, 'type');
        // Выбрать можно только файл
        if (type != 1) {
            return false;
        }
        var text = utils.getTreeUrl(pTree, pBrunchId);
        peopleData.galleryId = pBrunchId;
        $(options.imgGalleryText).html(text);

        var url = utils.url({
            method: 'loadGalleryItemList',
            query: {galleryId: peopleData.galleryId}
        });

        $( options.galleryItem ).autocomplete({
            source: url
        });

        $.fancybox.close();
        // class classBrunchDbClick
    }

    function beforeContDlgShow(){
        contTree.selectItem(peopleData.galleryId);
        // func. beforeContDlgShow
    }

    function galleryItemSelect(event, ui){
            /*log( ui.item ?
                    "Selected: " + ui.item.value + " aka " + ui.item.id :
                    "Nothing selected, input was " + this.value );*/
        console.log(ui.item.id);
        peopleData.galleryItemid= ui.item.id;
        $(options.galleryItem).val(ui.item.value);

        // func. galleryItemSelect
    }


    function init(pOptions){
        options = pOptions;
        // Ссылка для кнопки Назад
        $(options.backBtn).attr('href', utils.url({}));
        $(options.metroBtn).click(metroBtnClick);
        $(options.saveBtn).click(saveBtnClick);
        $(options.ptohoImgBtn).click(ptohoImgBtnClick);

        HAjax.create({
            saveData: cbSaveDataSuccess
        });

        if ( peopleData.photoUrlPreview ){
            photoFileManagerCallBack(peopleData.photoUrl, peopleData.photoUrlPreview);
        }// if

        $(options.imgGalleryBtn).fancybox({
            beforeShow: beforeContDlgShow
        });

        initTree();

        if ( peopleData.galleryId ){
            var text = utils.getTreeUrl(contTree, peopleData.galleryId);
            $(options.imgGalleryText).html(text);
        } // if

        var url = utils.url({
            method: 'loadGalleryItemList',
            query: {galleryId: peopleData.galleryId}
        });

        $( options.galleryItem ).autocomplete({
            source: url,
            minLength: 2,
            select: galleryItemSelect
        });

        // func. init
    }

    return {
        init: init,
        photoFileManagerCallBack: photoFileManagerCallBack
    }
})();

$(document).ready(function(){
    peopleMvc.init({
        backBtn: '#backBtn',
        // Кнопка выбора метро
        metroBtn: '#metroBtn',
        mainForm: '#mainForm',
        saveBtn: '#saveBtn',
        ptohoImgBtn: '#ptohoImgBtn',
        imgGalleryBtn: '#imgGalleryBtn',
        imgGalleryText: '#imgGalleryText',
        galleryItem: '#galleryItem'
    });
});
</script>