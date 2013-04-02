<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs
   ================================================== -->
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/base.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/skeleton.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/layout.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
     ================================================== -->
    <link rel="shortcut icon" href="/res/img/favicon.ico">
    <link rel="apple-touch-icon" href="/res/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/res/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/res/img/apple-touch-icon-114x114.png">

    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>

    <link rel="stylesheet" href="/res/css/admin.css">

    <style>
        #commentBox{
            border: 0px;
            width: 640px;
            overflow-x: hidden;
            height: 800px;
            /*border: 1px solid black;*/
        }
    </style>
</head>
<body>

<div class="container">
    <!---------------------------------------------------->
    <div class="sixteen columns" id="statusPanel">
        <div class="three columns">
            Коннект: <span id="connStatusText">Соединение</span>
        </div>
        <div class="three columns">
            Посетителей: <span id="viewCountText">0</span>
        </div>
        <div class="two columns">
            <a href="#imgSlide" id="slideSettingsBtn">Слайды</a>
        </div>
        <div class="two columns">
            <a href="#layerList" id="layerSettingBtn">Слои</a>
        </div>
        <div class="five columns">
            <a href="#begin" id="rtmpPlayBtn">Начать трансляцию</a>
        </div>
    </div>
    <!---------------------------------------------------->
    <div class="three columns" id="sliderListBox">
        <ul></ul>
    </div>
    <div class="twelve columns">
        <div class="sliderSettingsPanel">
            <div class="four columns alpha">
                <select id="layerListBox"></select>
            </div>
            <div class="eight columns omega alpha text-right">полный размер <input type="checkbox" id="fullSizeCb"/></div>
        </div>
        <div id="sliderShowBox">
            <img src="" id="sliderShowImg"/>
        </div>
        <div class="four columns alpha">
            <input type="button" id="prevSlideBtn" value="&laquo; Пред"/>
        </div>
        <div class="four columns alpha text-center">
            <input type="button" value="в режим &ldquo;Презентация&rdquo;" id="switchModeBtn"/>
        </div>
        <div class="four columns omega text-right">
            <input type="button" id="nextSlideBtn" value="След &raquo;"/>
        </div>
    </div>
    <!---------------------------------------------------->
    <!--<div id="footerBox" class="twelve columns"></div>-->
</div> <!--container-->

<div class="container">
    <div class="three columns">&nbsp;</div>
    <div class="twelve columns">
        <iframe id="commentBox"></iframe>
    </div>
</div>

<div id="controllerSwfBox"></div>

<script type="text/javascript">
var adminData = {
    slideList:<?=self::get('slideList')?>,
    layerList:<?=self::get('layerList')?>,
    userData:<?=self::get('userData');?>
}

var roomId = adminData.userData['roomId'];
var customJs = '<script  type="text\/javascript" src="/room/'+roomId[0]+'/'+ roomId[1] + '/' + roomId + '/comment.js"><\/script>';
document.write(customJs);

var adminMvc = (function(){
    // Есть ли соединение с сервером
    var connected = false;
    // Объект SWF-мост
    var objBridge;
    // Текущее состояние клиента: wait - нет публикации, play - публикация
    var publishStatus = 'wait';
    // Текущее состоянии презентации: video - включён режим видео, slide - включен режим презентации
    var publishMode = 'video';
    // Текущая картинка презентации
    var slideCurrentUrl = null;
    // Номер текущей картинки в презентации
    var slideCurrentId = -1;

    var TEXT_BEGIN_PLAY = 'Начать трансляцию';
    var TEXT_STOP_PLAY = 'Остановить трансляцию';

    var TEXT_PUBLISH_MODE_VIDEO = 'в режим “Видео”';
    var TEXT_PUBLISH_MODE_SLIDE = 'в режим “Презентация”';
	
    // Handle таймер для получения размера комнаты
    var intrvalGetRoomSize;

    var mouseX, mouseY;
    var imgMouseX, imgMouseY;

    var slidePanelWidth, slidePanelHeight;

    var slideImg;

    var fileCodeCampusIframeObj = null;

    var currentLayerSelect = 'none';
    var win;
	
	var isSliderShowBox = false;

    function sliderPreviewClick(pEvent){
        if ( !connected ){
            alert('Еще нет соединения с сервером');
            return;
        }

        var id = jQuery(pEvent.target).attr('num');
        if ( id == undefined ){
            return;
        }

        var num = Object.keys(adminData.slideList).indexOf(id);
        setSlide(num);

        return false;
        // func. sliderPreviewClick
    }

    function resizeTagImg(){
        var $sliderShowBox = jQuery('#sliderShowBox');
        var divWidth = $sliderShowBox.width();
        var divHeight = $sliderShowBox.height();

        var koff = divWidth / divHeight;
        if ( this.width / this.height <= koff ){
            var width = this.width * divHeight / this.height;
            this.height = divHeight;
            this.style.marginLeft = ((divWidth - width ) / 2) + 'px';
        }else{
            var height = this.height / (this.width / divWidth);
            this.width = divWidth;
            this.style.marginTop = (( divHeight - height ) / 2) + 'px';
            //imageLoader.x = 0;
        }

        var sliderShowImg = document.getElementById('sliderShowImg');
        sliderShowImg.parentNode.replaceChild(this, sliderShowImg);

        // func. resizeTagImg
    }
	

    function setSlide(num, pIsInit){
	
		var id = Object.keys(adminData.slideList)[num];
        if ( !adminData.slideList[id] ){
            return;
        }
        slideCurrentId = num;

        var imgUrl = adminData.slideList[id];
        if ( slideCurrentUrl == imgUrl ){
            return;
        }

        slideImg = new Image();
        slideImg.id = 'sliderShowImg';
        slideImg.onload = resizeTagImg;
        slideImg.src = imgUrl;

        slideCurrentUrl = imgUrl;

        //console.log(publishMode, pIsInit, publishStatus);
        if ( publishMode == 'slide' && !pIsInit && publishStatus == 'play' ){
			
            objBridge.writeData({
                action: 'sliderLoad',
                slideUrl: imgUrl,
                fullsize: document.getElementById('fullSizeCb').checked
            });
        } // if ( publishMode == 'slide' )
        // func. setSlide
    }

    function nextSlideBtnClick(){
        setSlide(slideCurrentId+1);
        return false;
        // func. nextSlideBtnClick
    }

    function prevSlideBtnClick(){
        setSlide(slideCurrentId-1);
        return false;
        // func. nextSlideBtnClick
    }

    function switchModeBtnClick(pEvent){
        if ( publishMode == 'video' ){
            publishMode = 'slide';
            jQuery(pEvent.target).val(TEXT_PUBLISH_MODE_VIDEO);
			var sendData = {
				action: 'sliderLoad',
				slideUrl: slideCurrentUrl,
				fullsize: document.getElementById('fullSizeCb').checked
			};
        }else{
            publishMode = 'video';
            jQuery(pEvent.target).val(TEXT_PUBLISH_MODE_SLIDE);
            var sendData = { action: 'sliderUnload'};
        } // if ( publishMode == 'video' )

        if ( publishStatus == 'play' ){
			console.log(sendData);
            objBridge.writeData(sendData);
        }

        return false;
        // func. switchModeBtnClick
    }

    function documentMouseMove(e){
        mouseX = e.pageX;
        mouseY = e.pageY;
        // func. documentMouseMove
    }

    function slideSettingsBtnClick(){
        if ( fileCodeCampusIframeObj == null ){
            return;
        }
        fileCodeCampusIframeObj.contentWindow.postMessage({
            action: 'show',
            group: roomId,
            subgroup: 'slide',
            profile: 'livevideo',
            list: Object.keys(adminData.slideList)
        }, "http://files.codecampus.ru/");

        return false;
        // func. slideSettingsBtnClick
    }

    function initSlider(){
        var $sliderListBox = jQuery('#sliderListBox ul:first');
        for( var id in adminData.slideList ){
            var url = adminData.slideList[id];
            $sliderListBox.append('<li><img src="'+url+'" num="'+id+'" alt=""/></li>');
        } // for

        $sliderListBox.click(sliderPreviewClick);
        jQuery('#prevSlideBtn').click(prevSlideBtnClick);
        jQuery('#nextSlideBtn').click(nextSlideBtnClick);
        jQuery('#switchModeBtn').click(switchModeBtnClick);

        jQuery('#fullSizeCb').click(fullSizeCbClick);

        $(document).mousemove(documentMouseMove);

        slidePanelWidth = jQuery('#sliderShowBox').width();
        slidePanelHeight = jQuery('#sliderShowBox').height();

        jQuery('#slideSettingsBtn').click(slideSettingsBtnClick);
        // func. initSlider
    }

    function fullSizeCbClick(pEvent){
        if ( publishStatus != 'play' || publishMode != 'slide' ){
            return;
        }
        objBridge.writeData({
            action: 'fullsize',
            fullsize: pEvent.target.checked,
            slideUrl: slideCurrentUrl
        });
        // func. fullSizeCbClick
    }

    function layerListBoxChange(pEvent){
        var num = jQuery(pEvent.target).val();
        if ( !num){
            return;
        }
		currentLayerSelect = num;
		
		if (publishStatus != 'play' ){
			return;
		}
        
        if ( num == 'none' ){
            objBridge.writeData({
                action: 'rmLayers'
            });
            return;
        }

        //console.log(adminData.layerList[num].list);
        objBridge.writeData({
            action: 'setLayers',
            list: adminData.layerList[num].list,
            num: num
        });

        return false;
        // func. layerListBoxChange
    }

    function initProfile(){
        var $layerListBox = jQuery('#layerListBox');
        $layerListBox.html('<option value="none">[Пусто]</option>');
        for( var i in adminData.layerList ){
            var obj = adminData.layerList[i];
            $layerListBox.append('<option value="'+i+'">'+obj.name+'</option>');
        } // for
        $layerListBox.val(currentLayerSelect);
        // func. initProfile
    }

    function initSwf(){
        var flashvars = adminData.userData;
        flashvars['objBridge'] = 'adminMvc';
        flashvars['ctrlUrl'] = 'controller01.lv.codecampus.ru';

        var params = {};
        var attributes = {};

        swfobject.embedSWF("/res/swf/controllerRtmp.swf", "controllerSwfBox", "1", "1", "9.0.0","expressInstall.swf", flashvars, params, attributes, function(obj){
            if ( !obj.success ){
                alert('Обнаружена проблема доступа к Flash. Перезапустите браузер');
                return;
            }
            objBridge = document.getElementById('controllerSwfBox');
        });
        // initSwf
    }

    function onSwfConnect(){
        jQuery('#connStatusText').html('Соединино').addClass('conn-success');
        connected = true;

        // func. onSwfConnect
    }

    function initSwfData(obj){
		//console.log(obj);
        if ( obj.publishStatus == 'play' ){
            publishStatus = 'play';
            jQuery('#rtmpPlayBtn').html(TEXT_STOP_PLAY);
        }

        if ( obj.publishMode == 'slide' ){
            publishMode = 'slide';
            jQuery('#switchModeBtn').val(TEXT_PUBLISH_MODE_VIDEO);
        } // if
		
		for( var id in adminData.slideList ){
			if ( adminData.slideList[id] == obj.slideUrl ){
				slideCurrentId = Object.keys(adminData.slideList).indexOf(id);
				break;
			} // if
		} // for
		setSlide(slideCurrentId, true);

        if ( obj.layerMode != null ){
            jQuery('#layerListBox').val(obj.layerMode.num);
        }else{
            jQuery('#layerListBox').val('none');
        }

        document.getElementById('fullSizeCb').checked = obj.fullsize;
        // func. initSwfData
    }

    function onSwfSocketData(obj){
        switch(obj.action){
            case 'roomSize':
                jQuery('#viewCountText').html(obj.size);
                break;
            case 'init':
                jQuery('#loginBox').css('display', 'none');
                jQuery('#mainBox').css('display', 'block');
                initSwfData(obj);
                break;
            case 'loginError':
                jQuery('#statusLogin').html('Неверный логин или пароль');
                break;
        }
        // func. onSwfSocketData
    }

    /*function onSwfConnectHandler(obj){
        console.log('onSwfConnectHandler')
        // func. onSwfConnectHandler
    }*/

    function timerGetRoomSize(){
        intrvalGetRoomSize = setInterval(function(){
            if ( !connected ){
                return;
            }
            objBridge.writeData({
                action: 'getRoomSize'
            });
        }, 5000); 
        // func. timerGetRoomSize
    }

    function rtmpPlayBtnClick(){
        if ( publishStatus != 'play' ){
			publishStatus = 'play';
			var layerMode = currentLayerSelect == 'none' ? null : {list: adminData.layerList[currentLayerSelect].list, num: currentLayerSelect};
			
            objBridge.writeData({
                action: 'rtmpPlay',
                publishStatus: publishStatus,
                publishMode: publishMode, // video или slide
                slideUrl: slideCurrentUrl,
				layerMode: layerMode,
                fullsize: document.getElementById('fullSizeCb').checked
            });
            jQuery('#rtmpPlayBtn').html(TEXT_STOP_PLAY);
        }else{
            if (!confirm("Остановить?")) {
                return false;
            }
			publishStatus = 'wait';
            objBridge.writeData({action: 'rtmpStop', type: 'none' });
            jQuery('#rtmpPlayBtn').html(TEXT_BEGIN_PLAY);
        }
        return false;
        // func. rtmpPlayBtnClick
    }

    function initMenuButton(){
        jQuery('#rtmpPlayBtn').click(rtmpPlayBtnClick);
        // func. initMenuButton
    }

    function cursorSendPos(){
        if ( !connected || publishStatus != 'play' || publishMode != 'slide' ){
            return;
        }
		var $sliderShowBox = jQuery('#sliderShowBox');
        var x = $sliderShowBox.offset().left;
        var y = $sliderShowBox.offset().top;
        x = mouseX - x;
        y = mouseY - y;
		
        if (( imgMouseX == x && imgMouseY == y) || !isSliderShowBox){
            return;
        }
        imgMouseX = x;
        imgMouseY = y;
        objBridge.writeData({
            action: 'cursorPos',
            pos: {x: x, y: y, w:slidePanelWidth ,h: slidePanelHeight}
        });
        // func. cursorSendPos
    }

    function imageWindowCallback(e){
        var data = e.data;
        jQuery('#sliderListBox li').remove();
        for( var id in data.list ){
            jQuery('#sliderListBox ul').append('<li><img src="'+data.list[id]+'" num="'+id+'" alt=""/></li>');
        }
        adminData.slideList = data.list;
        jQuery.ajax('?action=saveSlide', {
            type: 'post',
            data: 'data='+JSON.stringify(adminData.slideList)
        });
        // func. imageWindowCallback
    }

    function initIframeCallback(){
        // Create IE + others compatible event handler
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
        // Listen to message from child window
        eventer(messageEvent,imageWindowCallback, false);
        // func. initIframeCallback
    }

    function onSwfSecurityError(pEvent){
        console.log('onSwfSecurityError');
        // func. onSwfSecurityError
    }

    function onSwfIoError(pEvent){
        console.log('onSwfIoError');
        // func. onSwfIoError
    }

    function onSwfClose(pEvent){
        connected = false;
        jQuery('#connStatusText').html('Соединение').removeClass('conn-success');
        clearInterval(intrvalGetRoomSize);
        console.log('onSwfClose');
        // func. onSwfClose
    }

    function initFileCodecampusIframe(){
        fileCodeCampusIframeObj = document.createElement("IFRAME");
        fileCodeCampusIframeObj.setAttribute("src", "http://files.codecampus.ru/bridge/?host="+document.location.host+'&PHPSESSID=' + jQuery.cookie('PHPSESSID'));
        fileCodeCampusIframeObj.style.width = 1+"px";
        fileCodeCampusIframeObj.style.height = 1+"px";
        fileCodeCampusIframeObj.style.visibility = 'hidden';
        document.body.appendChild(fileCodeCampusIframeObj);
        // func. initFileCodecampusIframe
    }

    function layerWinCallback(pData){
        adminData.layerList = pData;
        initProfile();

        jQuery.ajax('?action=saveLayer', {
            type: 'post',
            data: 'data='+JSON.stringify(pData)
        });
        // func. layerWinCallback
    }

    function layerSettingBtnClick(){
        var win = window.open('/admin/layer/#'+roomId, 'Layer', 'width=980,height=830,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no');
        win.onload = function(){
            win.layerMvc.setLayerList(adminData.layerList);
            win.layerMvc.layerWinCallback = layerWinCallback;
        }
        return false;
        // func. layerSettingBtnclick
    }

    function loginBtnClick(){
        jQuery('#statusLogin').html('<img src="/res/img/loader.gif" alt="Loading"/> Проверка логина и пароля');
        var login = jQuery('#loginForm input[name="login"]').val();
        var pwd = jQuery('#loginForm input[name="pwd"]').val();
        objBridge.getAuthorize(login, pwd);
        return false;
        // func. loginBtnClick
    }

    function init(){
        initSlider();
        initProfile();
        initSwf();
        timerGetRoomSize();
        setInterval(cursorSendPos, 330);

        initIframeCallback();
        initMenuButton();
        initFileCodecampusIframe();


        jQuery('#layerListBox').change(layerListBoxChange);
        jQuery('#layerSettingBtn').click(layerSettingBtnClick);

        jQuery('#loginBtn').click(loginBtnClick);

        jQuery('#commentBox').attr('src', '/comment/?room='+roomId+'#'+roomId);
		
		jQuery('#sliderShowBox').mouseover(function(){
			isSliderShowBox = true;
		}).mouseout(function(){
			isSliderShowBox = false;
		});;
        // func. init
    }

    return{
        init: init,
        connectHandler: onSwfConnect,
        onSocketData: onSwfSocketData,
        securityErrorHandler: onSwfSecurityError,
        ioErrorHandler: onSwfIoError,
        closeHandler: onSwfClose
    }
})();

jQuery(document).ready(function(){
    adminMvc.init();
});

</script>


</body>
</html>