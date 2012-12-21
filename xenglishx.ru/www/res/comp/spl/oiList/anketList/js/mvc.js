var anketMvc = (function () {
    var options;
	var cookieOpt = {expires:60 * 60 * 24 * 7, path: '/'};
    // rmClass or rmObj
	var typeRmMark;
	
	function setTypeRmMark(pType){
		typeRmMark = pType;
		// func. setTypeRmMark
	}

    function selAnketBtnClick(pEvent) {
        var anketList = $.cookie('anketList');
        anketList = anketList ? anketList : '';

        var $obj = $(pEvent.target);
        var anketId = $obj.attr('id').substr(5);

        if ($obj.hasClass('red')) {
			removeMark($obj, anketId);
			anketList = anketList.replace(',' + anketId, '');
            $.cookie('anketList', anketList, cookieOpt);
        } else { // else
            $obj.addClass('red')
                .html('&raquo; Убрать метку')
                .parents('li:first')
                .addClass('selAnket');
            anketList = ',' + anketId + anketList;
            $.cookie('anketList', anketList, cookieOpt);
        } // if

        return false;
        // func. selAnketBtnClick
    }
	
	function removeMark($obj, anketId){
		if ( typeRmMark == 'rmClass' ){
			$obj.removeClass('red')
				.html('&raquo; Пометить анкету')
				.parents('li:first')
				.removeClass('selAnket');
		}else{
			//$obj.parents('li:first').remove();
			$obj.parents('li:first').hide('slow');
		}
		// func. removeMark
	}

    function initSelectData() {
        var anketList = $.cookie('anketList');
        if (anketList) {
            var list = anketList.substr(1).split(',');
            for (var i in list) {
                var id = list[i];
                $('#anket' + id).addClass('red')
                    .html('&raquo; Убрать метку')
                    .parents('li:first')
                    .addClass('selAnket');
            } // for
        } // if
        // func. initSelectData
    }

    function init(pOptions) {
        options = pOptions;
        initSelectData();
        $('#portfolio div.photoAction a.selAnketBtn').click(selAnketBtnClick);
        // func. init
    }

    return {
        init:init,
		setTypeRmMark:setTypeRmMark
    }
})();

$(document).ready(function () {
    anketMvc.init({

    });
}); // $(document).ready