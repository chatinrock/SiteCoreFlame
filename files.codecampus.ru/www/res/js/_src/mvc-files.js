var explorerMvc = (function(){
    var $explorerPanel;

    var swfu;

    var pluginIconUrl = 'http://theme.codecampus.ru/plugin/icons/img/';

    var actFileList = {};

    var isActionAll = null;
    // Одиночный ли выбор
    var isSingleChoose;

    function initFiles(){
        var html = '';
        for( var i in explorerData.list ){
            html += addFileBox(i, explorerData.list[i]);
        }
        $explorerPanel.html(html);
        // func. initFiles
    }

    function addFileBox(num, obj){
        var url = explorerData.dataUrl + 'preview/' + obj.path + obj.file;
        return '<div class="file" id="file-'+obj.id+'" num="'+num+'"><img src="'+url+'" type="sel"/><div class="panel">'
            + '<img src="'+pluginIconUrl+'image-16.png" type="view"/>'
            + '<img src="'+pluginIconUrl+'ok-16.png" type="sel"/>'
            + '<img src="'+pluginIconUrl+'delete-16.png" type="rm"/>'
            + '</div><div class="status" type="sel"></div></div>'
        // func. addFileBox
    }

    function explorerPanelClick(pEvent){
        var type = jQuery(pEvent.target).attr('type');
        if ( !type ){
            return;
        }

        var $parent = jQuery(pEvent.target).parents('.file:first');
        var num = parseInt($parent.attr('num'));
        var obj = explorerData.list[num];

        if ( type == 'view'){
            var url = explorerData.dataUrl + 'src/' + obj.path + obj.file;
            jQuery.lightbox(url);
            return;
        }

        if ( type == 'sel'){
            if ( isSingleChoose ){
                jQuery('#explorerPanel .type-sel').each(function(num, domObj){
                    var id = domObj.id.substr(5);
                    if ( id == obj.id ){
                        return;
                    }
                    delete actFileList[id];
                    jQuery(domObj).removeClass('type-sel');
                });
            } // if ( isSingleChoose )

            $parent.removeClass('type-rm');
        }else{
            $parent.removeClass('type-sel');
        }

        if ( $parent.hasClass('type-'+type)){
            $parent.removeClass('type-'+type);
            delete actFileList[obj.id];
        }else{
            $parent.addClass('type-'+type);
            actFileList[obj.id] = type;
        }
        // func. explorerPanelClick
    }

    function initData(pData){
        if ( !pData.list ){
            return;
        }

        for( var i in pData.list ){
            var id = pData.list[i];
            jQuery('#file-'+id).addClass('type-sel');
            actFileList[id] = 'sel';
        } // for i
        // func. initData
    }

    function grep(pObj, pVal){
        var result = {};
        for( var id in pObj ){
            if ( pObj[id] == pVal ){
                result[id] = pVal;
            }
        } // for
        return result;
        // func. grep
    }

    function findItemArray(pObj, pObjKey, pVal){
        for(var i in pObj ){
            if ( pObj[i][pObjKey] == pVal ){
                return i;
            }
        }
        return -1;
        // func. findItemArray
    }

    function selectBtnClick(){

        if (Object.keys(actFileList).length == 0 ){
            explorerMvc.onCallback({list: {}, length: 0});
            window.close()
            return false;
        }

        if ( isSingleChoose ){
            actFileList = grep(actFileList, 'sel');
            var id = Object.keys(actFileList)[0];
            var num = findItemArray(explorerData.list, 'id', id);
            if ( num == -1 ){
                alert('Error 83');
                return false;
            }
            var obj = explorerData.list[num];
            var url = explorerData.dataUrl + 'src/' + obj.path + obj.file;
            explorerMvc.onCallback({id:id, url:url});
            window.close()
            return false;
        }


        var data = {
            list: {},
            length: 0
        };

        actFileList = grep(actFileList, 'sel');
        for( var id in actFileList ){
            var num = findItemArray(explorerData.list, 'id', id);
            if ( num == -1 ){
                alert('Error 83');
                return false;
            }
            var obj = explorerData.list[num];
            data.list[id] = explorerData.dataUrl + 'src/' + obj.path + obj.file
            data.length++;
        } // for id
        explorerMvc.onCallback(data);
        window.close();
        return false;
        // func. selectBtnClick
    }

    function rmFileFromPanel(pData){
        for( var i in pData.list){
            jQuery('#file-' + pData.list[i]).remove();
        } // for i
        // func. rmFileFromPanel
    }

    function rmBtnClick(){
        if (!confirm("Удалить?")) {
            return false;
        }
        var list = [];
        for( var id in actFileList){
            if ( actFileList[id] == 'rm' ){
                list.push(id);
            }
        } //  for id
        $.ajax({
            url: "?action=rm&profile="+explorerData.profile+"&group="+explorerData.group+"&subgroup=" + explorerData.subgroup,
            data: 'list='+list.join(','),
            type: 'POST'
        }).done(rmFileFromPanel);
        return false;
        // func. rmBtnClick
    }

    function onCallback(pData){
        // no code
        // func. onCallback
    }

    function onUploadSuccess(pFile, pData){
        var num = explorerData.list.push(pData.data)-1;
        var html = addFileBox(num, pData.data)
        $explorerPanel.append(html);
        // func. onUploadSuccess
    }

    function fileDialogComplete(numFilesSelected, numFilesQueued) {
        try {
            if (numFilesSelected < 500) {
                this.startUpload();
            } else
            if (numFilesSelected != 0) {
                alert('Не больше 10 изображений за раз');
            }
        } catch (ex) {
            this.debug(ex);
        }
        // func. fileDialogComplete
    }

    function uploadComplete(file) {
        try {
            if (this.getStats().files_queued > 0) {
                this.startUpload();
            } else {
                //console.log('all image get');
            }
        } catch (ex) {
            this.debug(ex);
        }
        // func. uploadComplete
    }

    /**
     * Загрузка завершина
     */
    function uploadSuccess(file, serverData) {
        try {
            // Получаем fileProgress
            var data = JSON.parse(serverData);//$.parseJSON(serverData);
            if (!data['error']) {
                onUploadSuccess(file, data);
            } else {
                alert(data['error']);
            }
        } catch (ex) {
            this.debug(ex);
        }
        // func. uploadSuccess
    }

    function initSwfLoader(){

        var uploadUrl = "http://files.codecampus.ru/?action=upload&"
            + "profile=" + explorerData.profile
            + "&group=" + explorerData.group
            + "&subgroup=" + explorerData.subgroup
            + "&sess="+jQuery.cookie('PHPSESSID');
        //console.log('upload: ',uploadUrl);

        swfu = new SWFUpload({
            upload_url : uploadUrl,
            flash_url : "http://theme.codecampus.ru/plugin/SWFUpload_v2.2.0.1/swfupload.swf",
            file_size_limit : "20 MB",

            // Адрес картинки для загрузки
            button_image_url : "http://theme.codecampus.ru/plugin/SWFUpload_v2.2.0.1//XPButtonUploadText_61x22.png",
            // ID элемента куда будет загружен флеш
            button_placeholder_id : "uploadBtn",
            button_width: 61,
            button_height: 22,
            button_window_mode: 'opaque',

            file_post_name: 'file',
            file_types: '*.jpg;*.gif;*.png;*.jpeg',
            file_types_description: "Image files",

            file_dialog_complete_handler: fileDialogComplete,
            upload_complete_handler : uploadComplete,
            upload_success_handler: uploadSuccess,

            /*swfupload_loaded_handler: function(){
                console.log('d');
                swfu.refreshCookies(true);
            },*/

            debug : false,
            debug_handler: function(pData){
                //console.log(pData);
            }
        });

        // func. initSwfLoader
    }

    function rmAllBtnClick(){
        if ( isActionAll != 'rm'){
            for(var i in explorerData.list){
                var obj = explorerData.list[i];
                jQuery('#file-'+obj.id).addClass('type-rm').removeClass('type-sel');
                actFileList[obj.id] = 'rm';
            }
            isActionAll = 'rm';
        }else{
            actFileList = {};
            jQuery('.file').removeClass('type-rm');
            isActionAll = null;
        }
        return false;
        // func. rmAllBtnClick
    }

    function selAllBtnClick(){
        if ( isActionAll != 'sel'){
            for(var i in explorerData.list){
                var obj = explorerData.list[i];
                jQuery('#file-'+obj.id).addClass('type-sel').removeClass('type-rm');
                actFileList[obj.id] = 'sel';
            } // for
            isActionAll = 'sel';
        }else{
            actFileList = {};
            jQuery('.file').removeClass('type-sel');
            isActionAll = null;
        }
        return false;
        // func. selAllBtnClick
    }

    function init(){
        $explorerPanel = jQuery('#explorerPanel');
        initFiles();
        initSwfLoader();

        $explorerPanel.click(explorerPanelClick);

        jQuery('#rmBtn').click(rmBtnClick);
        jQuery('#rmAllBtn').click(rmAllBtnClick);
        jQuery('#selAllBtn').click(selAllBtnClick);
        jQuery('#selectBtn').click(selectBtnClick);

        isSingleChoose = document.location.search.search("single=1") != -1;
        // func. init
    }

    return{
        init: init,
        onCallback: onCallback,
        initData: initData
    }
})();