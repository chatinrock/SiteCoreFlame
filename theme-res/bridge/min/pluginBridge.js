var pluginBridge=function(){function f(c){var b=c.data;switch(b.action){case "show":a=window.open(b.url,"Explorer","width=980,height=830,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no"),a.onload=function(){a.explorerMvc.initData(b);a.explorerMvc.onCallback=function(c){parent.postMessage(c,"http://"+d+"/")}}}}function e(c){for(var b=window.location.search.substring(1).split("&"),a=0;a<b.length;a++){var d=b[a].split("=");if(decodeURIComponent(d[0])==c)return decodeURIComponent(d[1])}return null}
var d,a;return{init:function(){var a=window.addEventListener?"addEventListener":"attachEvent";(0,window[a])("attachEvent"==a?"onmessage":"message",f,!1);d=e("host");document.cookie="PHPSESSID="+e("PHPSESSID")+";expires=Thu, 01 Jan 2030 00:00:00 GMT; path=/"}}}().init(); 