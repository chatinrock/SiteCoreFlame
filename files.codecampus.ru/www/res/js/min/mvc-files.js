var explorerMvc=function(){function k(a,b){return'<div class="file" id="file-'+b.id+'" num="'+a+'"><img src="'+(explorerData.dataUrl+"preview/"+b.path+b.file)+'" type="sel"/><div class="panel"><img src="'+g+'image-16.png" type="view"/><img src="'+g+'ok-16.png" type="sel"/><img src="'+g+'delete-16.png" type="rm"/></div><div class="status" type="sel"></div></div>'}function n(a){var b=jQuery(a.target).attr("type");if(b){a=jQuery(a.target).parents(".file:first");var d=parseInt(a.attr("num")),e=explorerData.list[d];
    "view"==b?jQuery.lightbox(explorerData.dataUrl+"src/"+e.path+e.file):("sel"==b?(j&&jQuery("#explorerPanel .type-sel").each(function(b,a){var d=a.id.substr(5);d!=e.id&&(delete c[d],jQuery(a).removeClass("type-sel"))}),a.removeClass("type-rm")):a.removeClass("type-sel"),a.hasClass("type-"+b)?(a.removeClass("type-"+b),delete c[e.id]):(a.addClass("type-"+b),c[e.id]=b))}}function l(a,b){var d={},c;for(c in a)a[c]==b&&(d[c]=b);return d}function m(a,b,c){for(var e in a)if(a[e][b]==c)return e;return-1}function p(){if(0==
    Object.keys(c).length)return explorerMvc.onCallback({list:{},length:0}),window.close(),!1;if(j){c=l(c,"sel");var a=Object.keys(c)[0],b=m(explorerData.list,"id",a);if(-1==b)return alert("Error 83"),!1;b=explorerData.list[b];explorerMvc.onCallback({id:a,url:explorerData.dataUrl+"src/"+b.path+b.file});window.close();return!1}var d={list:{},length:0};c=l(c,"sel");for(a in c){b=m(explorerData.list,"id",a);if(-1==b)return alert("Error 83"),!1;b=explorerData.list[b];d.list[a]=explorerData.dataUrl+"src/"+
    b.path+b.file;d.length++}explorerMvc.onCallback(d);window.close();return!1}function q(a){for(var b in a.list)jQuery("#file-"+a.list[b]).remove()}function r(){if(!confirm("\u0423\u0434\u0430\u043b\u0438\u0442\u044c?"))return!1;var a=[],b;for(b in c)"rm"==c[b]&&a.push(b);$.ajax({url:"?action=rm&profile="+explorerData.profile+"&group="+explorerData.group+"&subgroup="+explorerData.subgroup,data:"list="+a.join(","),type:"POST"}).done(q);return!1}function s(a){try{500>a?this.startUpload():0!=a&&alert("\u041d\u0435 \u0431\u043e\u043b\u044c\u0448\u0435 10 \u0438\u0437\u043e\u0431\u0440\u0430\u0436\u0435\u043d\u0438\u0439 \u0437\u0430 \u0440\u0430\u0437")}catch(b){this.debug(b)}}
    function t(){try{0<this.getStats().files_queued&&this.startUpload()}catch(a){this.debug(a)}}function u(a,b){try{var c=JSON.parse(b);if(c.error)alert(c.error);else{var e=explorerData.list.push(c.data)-1,f=k(e,c.data);h.append(f)}}catch(g){this.debug(g)}}function v(){if("rm"!=f){for(var a in explorerData.list){var b=explorerData.list[a];jQuery("#file-"+b.id).addClass("type-rm").removeClass("type-sel");c[b.id]="rm"}f="rm"}else c={},jQuery(".file").removeClass("type-rm"),f=null;return!1}function w(){if("sel"!=
        f){for(var a in explorerData.list){var b=explorerData.list[a];jQuery("#file-"+b.id).addClass("type-sel").removeClass("type-rm");c[b.id]="sel"}f="sel"}else c={},jQuery(".file").removeClass("type-sel"),f=null;return!1}var h,g="http://theme.codecampus.ru/plugin/icons/img/",c={},f=null,j;return{init:function(){h=jQuery("#explorerPanel");var a="",b;for(b in explorerData.list)a+=k(b,explorerData.list[b]);h.html(a);a="http://files.codecampus.ru/?action=upload&profile="+explorerData.profile+"&group="+explorerData.group+
        "&subgroup="+explorerData.subgroup+"&sess="+jQuery.cookie("PHPSESSID");new SWFUpload({upload_url:a,flash_url:"http://theme.codecampus.ru/plugin/SWFUpload_v2.2.0.1/swfupload.swf",file_size_limit:"20 MB",button_image_url:"http://theme.codecampus.ru/plugin/SWFUpload_v2.2.0.1//XPButtonUploadText_61x22.png",button_placeholder_id:"uploadBtn",button_width:61,button_height:22,button_window_mode:"opaque",file_post_name:"file",file_types:"*.jpg;*.gif;*.png;*.jpeg",file_types_description:"Image files",file_dialog_complete_handler:s,
        upload_complete_handler:t,upload_success_handler:u,debug:!1,debug_handler:function(){}});h.click(n);jQuery("#rmBtn").click(r);jQuery("#rmAllBtn").click(v);jQuery("#selAllBtn").click(w);jQuery("#selectBtn").click(p);j=-1!=document.location.search.search("single=1")},onCallback:function(){},initData:function(a){if(a.list)for(var b in a.list){var d=a.list[b];jQuery("#file-"+d).addClass("type-sel");c[d]="sel"}}}}();