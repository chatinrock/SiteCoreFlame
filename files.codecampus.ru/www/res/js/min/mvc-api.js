var mvcFileApi=function(){var a,b;return{init:function(){a=document.createElement("IFRAME");a.setAttribute("src","http://files.codecampus.ru/bridge/?host="+document.location.host+"&PHPSESSID="+jQuery.cookie("PHPSESSID"));a.style.width="1px";a.style.height="1px";a.style.visibility="hidden";document.body.appendChild(a);var c=window.addEventListener?"addEventListener":"attachEvent";(0,window[c])("attachEvent"==c?"onmessage":"message",function(a){"http://files.codecampus.ru"==a.origin&&b.apply(null,arguments)},
    !1)},showWindow:function(c,b,d,e,f){if(null!=a)return a.contentWindow.postMessage({action:"show",group:c,subgroup:b,profile:d,list:e,param:f},"http://files.codecampus.ru/"),!1},setCallback:function(a){b=a}}}();jQuery(document).ready(function(){mvcFileApi.init()});