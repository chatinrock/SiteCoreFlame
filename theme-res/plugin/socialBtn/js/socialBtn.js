var socialBtnMvc = (function(){

	function formatCount( count ) {
		if ( count < 1000 )
			return count;
		if ( count >= 1000 && count < 10000 )
			return String( count ).substring( 0, 1 ) + 'K+';
		return '10K+';
		// func. formatCount
	}

	function setCount(pElemId, pCount){
		jQuery( pElemId + ' span' ).html( '<span class="share-count">' + formatCount( pCount ) + '</span>' );
		// func. setCount
	}

	/*function updateFacebookCount(pData){
		if ( 'undefined' != typeof pData[0].total_count && ( pData[0].total_count * 1 ) > 0 ) {
			setCount('#sharing-facebook-'+pData[0].anon, pData[0].total_count);
		}
		// func. updateFacebookCount
	}*/

	function init(){

		for( var url in socialBtnData ){
			var num = socialBtnData[url].num;
			var $btn = jQuery( '.socialBtn[name="sharing-facebook-' + num +'"]');
			if ( $btn.length ){
				$btn.attr('href', url);

				/*var src = 'https://api.facebook.com/method/fql.query?query=';
				src += encodeURIComponent( "SELECT total_count, url, '"+num+"' FROM link_stat WHERE url='" + socialBtnData[num].url + "'" );
				src += '&format=json&callback=socialBtnMvc.updateFacebookCount';
				jQuery.getScript( src );*/

				jQuery.getJSON('http://api.facebook.com/restserver.php?method=links.getStats&callback=?&urls=' + url + '&format=json', function(pData) {
					// вставл€ем в DOM
					// $('#fb_sharer span').text(data[0].share_count);
					var count = location.href.length * 11 + pData[0].share_count;
					var num = socialBtnData[pData[0].url].num;
					setCount('.socialBtn[name="sharing-facebook-' + num +'"]', count);
				});
			} // $btn facebook

			$btn = jQuery( '.socialBtn[name="sharing-vk-' + num +'"]' );
			if ( $btn.length ){
				$btn.attr('href', url);
				jQuery.getJSON('http://vkontakte.ru/share.php?act=count&index='+num+'&url=' + url + '&format=json&callback=?');
			}

			var $btn = jQuery( '.socialBtn[name="sharing-twitter-' + num  +'"]' );
			if ( $btn.length ){
				$btn.attr('href', url);
				jQuery.getJSON('http://urls.api.twitter.com/1/urls/count.json?url=' + url + '&callback=?', function(pData) {
					var num = socialBtnData[pData.url].num;
					var count = pData.count + Math.round(location.href.length / 5);
					setCount('.socialBtn[name="sharing-twitter-' + num  +'"]', count);
				});
			}
		} // for

		var $socialBtnList = jQuery('.socialBtnList');

		$socialBtnList.find( 'a.facebook' ).click(function(){
			var url = jQuery(this).attr('href');
			url = 'http://www.facebook.com/sharer.php?u='+url+'&t='+socialBtnData[url].title+'&src=sp';
			window.open( url, 'FaceBook', 'menubar=1,resizable=1,width=600,height=400' );
			return false;
		});

		$socialBtnList.find('a.vkontakte').click(function(){
			var url = jQuery(this).attr('href');
			url = 'http://vkontakte.ru/share.php?url='+url;
			window.open( url, 'VKontakte', 'menubar=1,resizable=1,width=600,height=400' );
			return false;
		});

		$socialBtnList.find('a.twitter').click(function(){
			var url = jQuery(this).attr('href');
			url = 'http://twitter.com/share?url='+url+'&text='+socialBtnData[url].title;
			window.open( url, 'Twitter', 'menubar=1,resizable=1,width=600,height=400' );
			return false;
		});

		// func. init
	}

	return{
		init: init,
		setCount: setCount
		//,updateFacebookCount: updateFacebookCount
	}
})();

if ( typeof(VK) == 'undefined'){
	VK = {};
}

if ( typeof(VK.Share) == 'undefined'){
	VK.Share = {};
}

// объ€вл€ем callback метод
VK.Share.count = function(num, count){
	count += location.href.length * 13;
	socialBtnMvc.setCount('.socialBtn[name="sharing-vk-' + num +'"]', count);
};