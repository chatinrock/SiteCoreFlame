var commentMvc = (function(){

	function init(){
		VK.init({apiId: customParam.vkAppId, onlyWidgets: true});
		VK.Widgets.Comments("vk_comments", {limit: 10, width: "625", attach: "*"});
		jQuery("#tabbed-nav").zozoTabs({
			animation: { duration: 0 },
			rounded: false
		});
	}
	return{
		init: init
	}
})();

var roomId = document.location.hash.substr(1);
jQuery.getScript('/room/'+roomId[0]+'/'+ roomId[1] + '/' + roomId + '/comment.js', function(data, textStatus, jqxhr) {
   $(document).ready(function(){
	   commentMvc.init();
   });
}).fail(function(jqxhr, settings, exception) {
	 jQuery('#tabbed-nav').html('Bad room');
});