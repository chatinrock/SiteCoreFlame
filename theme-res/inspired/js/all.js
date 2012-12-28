/* cookieMonster: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.cookie.js) */
/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
 jQuery.cookie=function(key,value,options){if(arguments.length>1&&String(value)!=="[object Object]"){options=jQuery.extend({},options);if(value===null||value===undefined){options.expires=-1}if(typeof options.expires==='number'){var days=options.expires,t=options.expires=new Date();t.setDate(t.getDate()+days)}value=String(value);return(document.cookie=[encodeURIComponent(key),'=',options.raw?value:encodeURIComponent(value),options.expires?'; expires='+options.expires.toUTCString():'',options.path?'; path='+options.path:'',options.domain?'; domain='+options.domain:'',options.secure?'; secure':''].join(''))}options=value||{};var result,decode=options.raw?function(s){return s}:decodeURIComponent;return(result=new RegExp('(?:^|; )'+encodeURIComponent(key)+'=([^;]*)').exec(document.cookie))?decode(result[1]):null};



/* superFish: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/superfish.js) */
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl()},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=($.inArray($$[0],o.$path)>-1);$$.hideSuperfishUl();if(o.$path.length&&$$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path)}},o.delay)},getMenu=function($menu){var menu=$menu.parents(['ul.',c.menuClass,':first'].join(''))[0];sf.op=sf.o[menu.serial];return menu},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone())};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join(' ')).filter('li:has(ul)').removeClass(o.pathClass)});sf.o[s]=sf.op=o;$('li:has(ul)',this)[($.fn.hoverIntent&&!o.disableHI)?'hoverIntent':'hover'](over,out).each(function(){if(o.autoArrows)addArrow($('>a:first-child',this))}).not('.'+c.bcClass).hideSuperfishUl();var $a=$('a',this);$a.each(function(i){var $li=$a.eq(i).parents('li');$a.eq(i).focus(function(){over.call($li)}).blur(function(){out.call($li)})});o.onInit.call(this)}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7))menuClasses.push(c.shadowClass);$(this).addClass(menuClasses.join(' '))})};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined)this.toggleClass(sf.c.shadowClass+'-off')};sf.c={bcClass:'sf-breadcrumb',menuClass:'sf-js-enabled',anchorClass:'sf-with-ul',arrowClass:'sf-sub-indicator',shadowClass:'sf-shadow'};sf.defaults={hoverClass:'sfHover',pathClass:'overideThisToUse',pathLevels:1,delay:800,animation:{opacity:'show'},speed:'normal',autoArrows:false,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=(o.retainPath===true)?o.$path:'';o.retainPath=false;var $ul=$(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass).find('>ul').hide().css('visibility','hidden');o.onHide.call($ul);return this},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+'-off',$ul=this.addClass(o.hoverClass).find('>ul:hidden').css('visibility','visible');sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul)});return this}})})(jQuery);




/* verticalMenu: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/verticalMenu.js) */
/*
	Programmer: Lukasz Czerwinski
	CodeCanyon: http://codecanyon.net/user/Lukasz_Czerwinski
	
	If this script you like, please put a comment on codecanyon.
	
*/
(function($){$.fn.menu=function(settings){var el,item,httpAdress;settings=jQuery.extend({Speed:220,autostart:0,autohide:1,itemLink:1,openAll:0},settings);el=$(this);item=el.children("ul").parent("li").children("a");httpAdress=window.location;item.addClass("inactive");function _item(){var clickThis=$(this);if(settings.autohide){if(clickThis.parent().parent().parent().is("li")){clickThis.parent().parent().find(".active").parent("li").children("ul").slideUp(settings.Speed/1.2,function(){$(this).parent("li").children("a").removeClass().addClass("inactive")})}else{el.parent().parent().find(".active").parent("li").children("ul").slideUp(settings.Speed/1.2,function(){$(this).parent("li").children("a").removeClass().addClass("inactive")})}}if(clickThis.attr("class")=="inactive"){clickThis.parent("li").children("ul").slideDown(settings.Speed,function(){clickThis.removeClass().addClass("active");if(settings.itemLink&&clickThis.attr("href").length>5){window.location.href=clickThis.attr("href")}})}if(clickThis.attr("class")=="active"){clickThis.removeClass().addClass("inactive");clickThis.parent("li").children("ul").slideUp(settings.Speed)}return false}item.unbind('click').click(_item);if(settings.autostart){el.children("a").each(function(){if(this.href==httpAdress){if(settings.itemLink){$(this).parent("li").children("ul").slideDown(100,function(){$(this).parent("li").children(".inactive").removeClass().addClass("active")})}else{$(this).parent("li").parents("li").children("ul").slideDown(settings.Speed,function(){$(this).parent("li").children(".inactive").removeClass().addClass("active")})}}})}if(settings.openAll){item.parent("li").children("ul").find(".inactive").parent("li").children("ul").slideDown(settings.Speed,function(){$(this).parent("li").children(".inactive").removeClass().addClass("active")})}}})(jQuery);



/* jquery-tabs: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.tools.tabs.min.js) */
/*
 
 jQuery Tools 1.2.5 Tabs- The basics of UI design.

 NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.

 http://flowplayer.org/tools/tabs/

 Since: November 2008
 Date:    Wed Sep 22 06:02:10 2010 +0000 
*/
(function(c){function p(d,b,a){var e=this,l=d.add(this),h=d.find(a.tabs),i=b.jquery?b:d.children(b),j;h.length||(h=d.children());i.length||(i=d.parent().find(b));i.length||(i=c(b));c.extend(this,{click:function(f,g){var k=h.eq(f);if(typeof f=="string"&&f.replace("#","")){k=h.filter("[href*="+f.replace("#","")+"]");f=Math.max(h.index(k),0)}if(a.rotate){var n=h.length-1;if(f<0)return e.click(n,g);if(f>n)return e.click(0,g)}if(!k.length){if(j>=0)return e;f=a.initialIndex;k=h.eq(f)}if(f===j)return e;
g=g||c.Event();g.type="onBeforeClick";l.trigger(g,[f]);if(!g.isDefaultPrevented()){o[a.effect].call(e,f,function(){g.type="onClick";l.trigger(g,[f])});j=f;h.removeClass(a.current);k.addClass(a.current);return e}},getConf:function(){return a},getTabs:function(){return h},getPanes:function(){return i},getCurrentPane:function(){return i.eq(j)},getCurrentTab:function(){return h.eq(j)},getIndex:function(){return j},next:function(){return e.click(j+1)},prev:function(){return e.click(j-1)},destroy:function(){h.unbind(a.event).removeClass(a.current);
i.find("a[href^=#]").unbind("click.T");return e}});c.each("onBeforeClick,onClick".split(","),function(f,g){c.isFunction(a[g])&&c(e).bind(g,a[g]);e[g]=function(k){k&&c(e).bind(g,k);return e}});if(a.history&&c.fn.history){c.tools.history.init(h);a.event="history"}h.each(function(f){c(this).bind(a.event,function(g){e.click(f,g);return g.preventDefault()})});i.find("a[href^=#]").bind("click.T",function(f){e.click(c(this).attr("href"),f)});if(location.hash&&a.tabs=="a"&&d.find("[href="+location.hash+"]").length)e.click(location.hash);
else if(a.initialIndex===0||a.initialIndex>0)e.click(a.initialIndex)}c.tools=c.tools||{version:"1.2.5"};c.tools.tabs={conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialIndex:0,event:"click",rotate:false,history:false},addEffect:function(d,b){o[d]=b}};var o={"default":function(d,b){this.getPanes().hide().eq(d).show();b.call()},fade:function(d,b){var a=this.getConf(),e=a.fadeOutSpeed,l=this.getPanes();e?l.fadeOut(e):l.hide();l.eq(d).fadeIn(a.fadeInSpeed,b)},slide:function(d,
b){this.getPanes().slideUp(200);this.getPanes().eq(d).slideDown(400,b)},ajax:function(d,b){this.getPanes().eq(0).load(this.getTabs().eq(d).attr("href"),b)}},m;c.tools.tabs.addEffect("horizontal",function(d,b){m||(m=this.getPanes().eq(0).width());this.getCurrentPane().animate({width:0},function(){c(this).hide()});this.getPanes().eq(d).animate({width:m},function(){c(this).show();b.call()})});c.fn.tabs=function(d,b){var a=this.data("tabs");if(a){a.destroy();this.removeData("tabs")}if(c.isFunction(b))b=
{onBeforeClick:b};b=c.extend({},c.tools.tabs.conf,b);this.each(function(){a=new p(c(this),d,b);c(this).data("tabs",a)});return b.api?a:this}})(jQuery);




/* imgPreloader: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.imgpreload.js) */
/*

Copyright (c) 2009 Dimas Begunoff, http://www.farinspace.com

Licensed under the MIT license
http://en.wikipedia.org/wiki/MIT_License

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

function imgpreload(imgs,settings){if(settings instanceof Function){settings={all:settings}}if(typeof imgs=="string"){imgs=[imgs]}var loaded=[];var t=imgs.length;var i=0;for(i;i<t;i++){var img=new Image();img.onload=function(){loaded.push(this);if(settings.each instanceof Function){settings.each.call(this)}if(loaded.length>=t&&settings.all instanceof Function){settings.all.call(loaded)}};img.src=imgs[i]}}if(typeof jQuery!="undefined"){(function($){$.imgpreload=imgpreload;$.fn.imgpreload=function(settings){settings=$.extend({},$.fn.imgpreload.defaults,(settings instanceof Function)?{all:settings}:settings);this.each(function(){var elem=this;imgpreload($(this).attr('src'),function(){if(settings.each instanceof Function){settings.each.call(elem)}})});var urls=[];this.each(function(){urls.push($(this).attr('src'))});var selection=this;imgpreload(urls,function(){if(settings.all instanceof Function){settings.all.call(selection)}});return this};$.fn.imgpreload.defaults={each:null,all:null}})(jQuery)}



/* colorBox: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.colorbox-min.js) */
// ColorBox v1.3.19 - jQuery lightbox plugin
// (c) 2011 Jack Moore - jacklmoore.com
// License: http://www.opensource.org/licenses/mit-license.php
/*(function(a,b,c){function Z(c,d,e){var g=b.createElement(c);return d&&(g.id=f+d),e&&(g.style.cssText=e),a(g)}function $(a){var b=y.length,c=(Q+a)%b;return c<0?b+c:c}function _(a,b){return Math.round((/%/.test(a)?(b==="x"?z.width():z.height())/100:1)*parseInt(a,10))}function ba(a){return K.photo||/\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(a)}function bb(){var b;K=a.extend({},a.data(P,e));for(b in K)a.isFunction(K[b])&&b.slice(0,2)!=="on"&&(K[b]=K[b].call(P));K.rel=K.rel||P.rel||"nofollow",K.href=K.href||a(P).attr("href"),K.title=K.title||P.title,typeof K.href=="string"&&(K.href=a.trim(K.href))}function bc(b,c){a.event.trigger(b),c&&c.call(P)}function bd(){var a,b=f+"Slideshow_",c="click."+f,d,e,g;K.slideshow&&y[1]?(d=function(){F.text(K.slideshowStop).unbind(c).bind(j,function(){if(K.loop||y[Q+1])a=setTimeout(W.next,K.slideshowSpeed)}).bind(i,function(){clearTimeout(a)}).one(c+" "+k,e),r.removeClass(b+"off").addClass(b+"on"),a=setTimeout(W.next,K.slideshowSpeed)},e=function(){clearTimeout(a),F.text(K.slideshowStart).unbind([j,i,k,c].join(" ")).one(c,function(){W.next(),d()}),r.removeClass(b+"on").addClass(b+"off")},K.slideshowAuto?d():e()):r.removeClass(b+"off "+b+"on")}function be(b){U||(P=b,bb(),y=a(P),Q=0,K.rel!=="nofollow"&&(y=a("."+g).filter(function(){var b=a.data(this,e).rel||this.rel;return b===K.rel}),Q=y.index(P),Q===-1&&(y=y.add(P),Q=y.length-1)),S||(S=T=!0,r.show(),K.returnFocus&&a(P).blur().one(l,function(){a(this).focus()}),q.css({opacity:+K.opacity,cursor:K.overlayClose?"pointer":"auto"}).show(),K.w=_(K.initialWidth,"x"),K.h=_(K.initialHeight,"y"),W.position(),o&&z.bind("resize."+p+" scroll."+p,function(){q.css({width:z.width(),height:z.height(),top:z.scrollTop(),left:z.scrollLeft()})}).trigger("resize."+p),bc(h,K.onOpen),J.add(D).hide(),I.html(K.close).show()),W.load(!0))}function bf(){!r&&b.body&&(Y=!1,z=a(c),r=Z(X).attr({id:e,"class":n?f+(o?"IE6":"IE"):""}).hide(),q=Z(X,"Overlay",o?"position:absolute":"").hide(),s=Z(X,"Wrapper"),t=Z(X,"Content").append(A=Z(X,"LoadedContent","width:0; height:0; overflow:hidden"),C=Z(X,"LoadingOverlay").add(Z(X,"LoadingGraphic")),D=Z(X,"Title"),E=Z(X,"Current"),G=Z(X,"Next"),H=Z(X,"Previous"),F=Z(X,"Slideshow").bind(h,bd),I=Z(X,"Close")),s.append(Z(X).append(Z(X,"TopLeft"),u=Z(X,"TopCenter"),Z(X,"TopRight")),Z(X,!1,"clear:left").append(v=Z(X,"MiddleLeft"),t,w=Z(X,"MiddleRight")),Z(X,!1,"clear:left").append(Z(X,"BottomLeft"),x=Z(X,"BottomCenter"),Z(X,"BottomRight"))).find("div div").css({"float":"left"}),B=Z(X,!1,"position:absolute; width:9999px; visibility:hidden; display:none"),J=G.add(H).add(E).add(F),a(b.body).append(q,r.append(s,B)))}function bg(){return r?(Y||(Y=!0,L=u.height()+x.height()+t.outerHeight(!0)-t.height(),M=v.width()+w.width()+t.outerWidth(!0)-t.width(),N=A.outerHeight(!0),O=A.outerWidth(!0),r.css({"padding-bottom":L,"padding-right":M}),G.click(function(){W.next()}),H.click(function(){W.prev()}),I.click(function(){W.close()}),q.click(function(){K.overlayClose&&W.close()}),a(b).bind("keydown."+f,function(a){var b=a.keyCode;S&&K.escKey&&b===27&&(a.preventDefault(),W.close()),S&&K.arrowKey&&y[1]&&(b===37?(a.preventDefault(),H.click()):b===39&&(a.preventDefault(),G.click()))}),a("."+g,b).live("click",function(a){a.which>1||a.shiftKey||a.altKey||a.metaKey||(a.preventDefault(),be(this))})),!0):!1}var d={transition:"elastic",speed:300,width:!1,initialWidth:"600",innerWidth:!1,maxWidth:!1,height:!1,initialHeight:"450",innerHeight:!1,maxHeight:!1,scalePhotos:!0,scrolling:!0,inline:!1,html:!1,iframe:!1,fastIframe:!0,photo:!1,href:!1,title:!1,rel:!1,opacity:.9,preloading:!0,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",open:!1,returnFocus:!0,reposition:!0,loop:!0,slideshow:!1,slideshowAuto:!0,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:!1,onLoad:!1,onComplete:!1,onCleanup:!1,onClosed:!1,overlayClose:!0,escKey:!0,arrowKey:!0,top:!1,bottom:!1,left:!1,right:!1,fixed:!1,data:undefined},e="colorbox",f="cbox",g=f+"Element",h=f+"_open",i=f+"_load",j=f+"_complete",k=f+"_cleanup",l=f+"_closed",m=f+"_purge",n=!a.support.opacity&&!a.support.style,o=n&&!c.XMLHttpRequest,p=f+"_IE6",q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X="div",Y;if(a.colorbox)return;a(bf),W=a.fn[e]=a[e]=function(b,c){var f=this;b=b||{},bf();if(bg()){if(!f[0]){if(f.selector)return f;f=a("<a/>"),b.open=!0}c&&(b.onComplete=c),f.each(function(){a.data(this,e,a.extend({},a.data(this,e)||d,b))}).addClass(g),(a.isFunction(b.open)&&b.open.call(f)||b.open)&&be(f[0])}return f},W.position=function(a,b){function i(a){u[0].style.width=x[0].style.width=t[0].style.width=a.style.width,t[0].style.height=v[0].style.height=w[0].style.height=a.style.height}var c=0,d=0,e=r.offset(),g=z.scrollTop(),h=z.scrollLeft();z.unbind("resize."+f),r.css({top:-9e4,left:-9e4}),K.fixed&&!o?(e.top-=g,e.left-=h,r.css({position:"fixed"})):(c=g,d=h,r.css({position:"absolute"})),K.right!==!1?d+=Math.max(z.width()-K.w-O-M-_(K.right,"x"),0):K.left!==!1?d+=_(K.left,"x"):d+=Math.round(Math.max(z.width()-K.w-O-M,0)/2),K.bottom!==!1?c+=Math.max(z.height()-K.h-N-L-_(K.bottom,"y"),0):K.top!==!1?c+=_(K.top,"y"):c+=Math.round(Math.max(z.height()-K.h-N-L,0)/2),r.css({top:e.top,left:e.left}),a=r.width()===K.w+O&&r.height()===K.h+N?0:a||0,s[0].style.width=s[0].style.height="9999px",r.dequeue().animate({width:K.w+O,height:K.h+N,top:c,left:d},{duration:a,complete:function(){i(this),T=!1,s[0].style.width=K.w+O+M+"px",s[0].style.height=K.h+N+L+"px",K.reposition&&setTimeout(function(){z.bind("resize."+f,W.position)},1),b&&b()},step:function(){i(this)}})},W.resize=function(a){S&&(a=a||{},a.width&&(K.w=_(a.width,"x")-O-M),a.innerWidth&&(K.w=_(a.innerWidth,"x")),A.css({width:K.w}),a.height&&(K.h=_(a.height,"y")-N-L),a.innerHeight&&(K.h=_(a.innerHeight,"y")),!a.innerHeight&&!a.height&&(A.css({height:"auto"}),K.h=A.height()),A.css({height:K.h}),W.position(K.transition==="none"?0:K.speed))},W.prep=function(b){function g(){return K.w=K.w||A.width(),K.w=K.mw&&K.mw<K.w?K.mw:K.w,K.w}function h(){return K.h=K.h||A.height(),K.h=K.mh&&K.mh<K.h?K.mh:K.h,K.h}if(!S)return;var c,d=K.transition==="none"?0:K.speed;A.remove(),A=Z(X,"LoadedContent").append(b),A.hide().appendTo(B.show()).css({width:g(),overflow:K.scrolling?"auto":"hidden"}).css({height:h()}).prependTo(t),B.hide(),a(R).css({"float":"none"}),o&&a("select").not(r.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(k,function(){this.style.visibility="inherit"}),c=function(){function q(){n&&r[0].style.removeAttribute("filter")}var b,c,g=y.length,h,i="frameBorder",k="allowTransparency",l,o,p;if(!S)return;l=function(){clearTimeout(V),C.hide(),bc(j,K.onComplete)},n&&R&&A.fadeIn(100),D.html(K.title).add(A).show();if(g>1){typeof K.current=="string"&&E.html(K.current.replace("{current}",Q+1).replace("{total}",g)).show(),G[K.loop||Q<g-1?"show":"hide"]().html(K.next),H[K.loop||Q?"show":"hide"]().html(K.previous),K.slideshow&&F.show();if(K.preloading){b=[$(-1),$(1)];while(c=y[b.pop()])o=a.data(c,e).href||c.href,a.isFunction(o)&&(o=o.call(c)),ba(o)&&(p=new Image,p.src=o)}}else J.hide();K.iframe?(h=Z("iframe")[0],i in h&&(h[i]=0),k in h&&(h[k]="true"),h.name=f+ +(new Date),K.fastIframe?l():a(h).one("load",l),h.src=K.href,K.scrolling||(h.scrolling="no"),a(h).addClass(f+"Iframe").appendTo(A).one(m,function(){h.src="//about:blank"})):l(),K.transition==="fade"?r.fadeTo(d,1,q):q()},K.transition==="fade"?r.fadeTo(d,0,function(){W.position(0,c)}):W.position(d,c)},W.load=function(b){var c,d,e=W.prep;T=!0,R=!1,P=y[Q],b||bb(),bc(m),bc(i,K.onLoad),K.h=K.height?_(K.height,"y")-N-L:K.innerHeight&&_(K.innerHeight,"y"),K.w=K.width?_(K.width,"x")-O-M:K.innerWidth&&_(K.innerWidth,"x"),K.mw=K.w,K.mh=K.h,K.maxWidth&&(K.mw=_(K.maxWidth,"x")-O-M,K.mw=K.w&&K.w<K.mw?K.w:K.mw),K.maxHeight&&(K.mh=_(K.maxHeight,"y")-N-L,K.mh=K.h&&K.h<K.mh?K.h:K.mh),c=K.href,V=setTimeout(function(){C.show()},100),K.inline?(Z(X).hide().insertBefore(a(c)[0]).one(m,function(){a(this).replaceWith(A.children())}),e(a(c))):K.iframe?e(" "):K.html?e(K.html):ba(c)?(a(R=new Image).addClass(f+"Photo").error(function(){K.title=!1,e(Z(X,"Error").text("This image could not be loaded"))}).load(function(){var a;R.onload=null,K.scalePhotos&&(d=function(){R.height-=R.height*a,R.width-=R.width*a},K.mw&&R.width>K.mw&&(a=(R.width-K.mw)/R.width,d()),K.mh&&R.height>K.mh&&(a=(R.height-K.mh)/R.height,d())),K.h&&(R.style.marginTop=Math.max(K.h-R.height,0)/2+"px"),y[1]&&(K.loop||y[Q+1])&&(R.style.cursor="pointer",R.onclick=function(){W.next()}),n&&(R.style.msInterpolationMode="bicubic"),setTimeout(function(){e(R)},1)}),setTimeout(function(){R.src=c},1)):c&&B.load(c,K.data,function(b,c,d){e(c==="error"?Z(X,"Error").text("Request unsuccessful: "+d.statusText):a(this).contents())})},W.next=function(){!T&&y[1]&&(K.loop||y[Q+1])&&(Q=$(1),W.load())},W.prev=function(){!T&&y[1]&&(K.loop||Q)&&(Q=$(-1),W.load())},W.close=function(){S&&!U&&(U=!0,S=!1,bc(k,K.onCleanup),z.unbind("."+f+" ."+p),q.fadeTo(200,0),r.stop().fadeTo(300,0,function(){r.add(q).css({opacity:1,cursor:"auto"}).hide(),bc(m),A.remove(),setTimeout(function(){U=!1,bc(l,K.onClosed)},1)}))},W.remove=function(){a([]).add(r).add(q).remove(),r=null,a("."+g).removeData(e).removeClass(g).die()},W.element=function(){return a(P)},W.settings=d})(jQuery,document,this);
*/


/* isotope: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.isotope.min.js) */
/**
 * Isotope v1.5.19
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd",transitionProperty:"transitionEnd"}[j],r=h("transitionDuration"));var s=b.event,t;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",t&&clearTimeout(t),t=setTimeout(function(){jQuery.event.handle.apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var u=["width","height"],v=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!b.browser.opera,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=u.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&v.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){var c=this,d=function(){c.$allAtoms=c.$allAtoms.not(a),a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this.$filteredAtoms=this.$filteredAtoms.not(a),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),v.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var w=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){w("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){w("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);



/* easing: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/jquery.easing.1.3.js) */
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b}});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */



/* custom: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/custom.js) */
jQuery.noConflict();

jQuery(document).ready(function($) {
	//DEMO ONLY JS
	if(jQuery.cookie('skin') != null){
		var skinCookie = jQuery.cookie('skin');
	}
	else{
		var skinCookie = 'orange';
	}
	if(skinCookie == 'creative-orange'){
		defaultBtnColor = 'black';
	}
	else if(skinCookie == 'charcoal'){
		defaultBtnColor = 'charcoal';
	}
	else{
		defaultBtnColor = 'white';
	}
	jQuery('.skinSwitch').removeClass('white');
	jQuery('.skinSwitch').addClass(defaultBtnColor);
	
	//Switch Layer Slider Button Colors
	
	var lsBtnColor = 'white';
	
	if(skinCookie == 'orange'){
		lsBtnColor = 'orange';
	}
	if(skinCookie == 'light-grey-orange'){
		lsBtnColor = 'orange';
	}
	if(skinCookie == 'light-green'){
		lsBtnColor = 'lightgreen';
		jQuery('.layerSliderFallBack img').remove();
		jQuery('.layerSliderFallBack').prepend('<img alt="Teal Skin Responsive Fallback Image" src="http://themes.curtycurt.com/images/inspired/layerslider/fallback-light-green.jpg" />');
	}
	if(skinCookie == 'teal'){
		lsBtnColor = 'teal';
		jQuery('.layerSliderFallBack img').remove();
		jQuery('.layerSliderFallBack').prepend('<img alt="Teal Skin Responsive Fallback Image" src="http://themes.curtycurt.com/images/inspired/layerslider/fallback-teal.jpg" />');
	}
	if(skinCookie == 'charcoal'){
		lsBtnColor = 'orange';
		window.setTimeout(function(){
			jQuery('#layerslider_2').removeClass('ls-customskin');
			jQuery('#layerslider_2').addClass('ls-customdarkskin');
		}, 100);
		jQuery('.layerSliderFallBack img').remove();
		jQuery('.layerSliderFallBack').prepend('<img alt="Chacoal Skin Responsive Fallback Image" src="http://themes.curtycurt.com/images/inspired/layerslider/fallback-charcoal.jpg" />');
	}
	if(skinCookie == 'dark-purple'){
		jQuery('.layerSliderFallBack img').remove();
		jQuery('.layerSliderFallBack').prepend('<img alt="Chacoal Skin Responsive Fallback Image" src="http://themes.curtycurt.com/images/inspired/layerslider/fallback-dark-purple.jpg" />');
	}
	
	jQuery('.lsbtnswitch').removeClass('white');
	jQuery('.lsbtnswitch').addClass(lsBtnColor);
	
	
	
	if(skinCookie == 'charcoal' || skinCookie == 'creative-orange'){
		if ($(".fancyBoxLight").length > 0){
			$('.fancyBoxLight').removeClass('fancyBoxLight').addClass('fancyBoxDark');
		}
		if ($(".toggleLightSkin").length > 0){
			$('.toggleLightSkin').removeClass('toggleLightSkin').addClass('toggleDarkSkin');
		}
		if ($(".lightTable").length > 0){
			$('.lightTable').removeClass('lightTable').addClass('darkTable');
		}
		if ($(".lightPriceTable").length > 0){
			$('.lightPriceTable').removeClass('lightPriceTable').addClass('darkPriceTable');
		}
	}
	//Prevent Default for Demo Buttons Page Clicks
	 $("#allTheButtons .button").click(function(event){
        event.preventDefault();
    });
	
	//Non-Responsive Slider Fallbacks
	if ($(".theLayerSlider").length > 0){
		if($(".theLayerSlider").width() > $(".theLayerSlider").parent().width()){
			$(".theLayerSlider").hide();
			$(".layerSliderFallBack").show();
		}
	}
	if ($(".carousel").length > 0){
		if($(".carousel").width() > $(".carousel").parent().width()){
			$(".carousel").hide();
			$(".carouselFallBack").show();
		}
	}
	if ($(".anythingOuterWrap").length > 0){
		if($(".anythingOuterWrap").width() > $(".anythingOuterWrap").parent().width()){
			$(".anythingOuterWrap").hide();
			$(".anythingFallBack").show();
		}
	}
	if ($(".kwicksOuterWrap").length > 0){
		if($(".kwicksOuterWrap").width() > $(".kwicksOuterWrap").parent().width()){
			$(".kwicksOuterWrap").hide();
			$(".kwicksFallBack").show();
		}
	}
	if ($(".nivoOuterWrap").length > 0){
		if($(".nivoOuterWrap").width() > $(".nivoOuterWrap").parent().width()){
			$(".nivoOuterWrap").hide();
			$(".nivoFallBack").show();
		}
	}
	if ($(".pieceMaker1OuterWrap").length > 0){
		if($(".pieceMaker1OuterWrap").width() > $(".pieceMaker1OuterWrap").parent().width()){
			$(".pieceMaker1OuterWrap").hide();
			$(".pieceMaker1FallBack").show();
		}
	}
	if ($(".pieceMaker2OuterWrap").length > 0){
		if($(".pieceMaker2OuterWrap").width() > $(".pieceMaker2OuterWrap").parent().width()){
			$(".pieceMaker2OuterWrap").hide();
			$(".pieceMaker2FallBack").show();
		}
	}
	
	//Recheck on Resize
	$(window).resize(function() {
		if ($(".theLayerSlider").length > 0){
			if($(".theLayerSlider").width() > $(".theLayerSlider").parent().width()){
				$(".theLayerSlider").hide();
				$(".layerSliderFallBack").show();
			}
			else{
				$(".theLayerSlider").show();
				$(".layerSliderFallBack").hide();
			}
		}
		if ($(".carousel").length > 0){
			if($(".carousel").width() > $(".carousel").parent().width()){
				$(".carousel").hide();
				$(".carouselFallBack").show();
			}
			else{
				$(".carousel").show();
				$(".carouselFallBack").hide();
			}
		}
		if ($(".anythingOuterWrap").length > 0){
			if($(".anythingOuterWrap").width() > $(".anythingOuterWrap").parent().width()){
				$(".anythingOuterWrap").hide();
				$(".anythingFallBack").show();
			}
			else{
				$(".anythingOuterWrap").show();
				$(".anythingFallBack").hide();
			}
		}
		if ($(".kwicksOuterWrap").length > 0){
			if($(".kwicksOuterWrap").width() > $(".kwicksOuterWrap").parent().width()){
				$(".kwicksOuterWrap").hide();
				$(".kwicksFallBack").show();
			}
			else{
				$(".kwicksOuterWrap").show();
				$(".kwicksFallBack").hide();
			}
		}
		if ($(".nivoOuterWrap").length > 0){
			if($(".nivoOuterWrap").width() > $(".nivoOuterWrap").parent().width()){
				$(".nivoOuterWrap").hide();
				$(".nivoFallBack").show();
			}
			else{
				$(".nivoOuterWrap").show();
				$(".nivoFallBack").hide();
			}
		}
		if ($(".pieceMaker1OuterWrap").length > 0){
			if($(".pieceMaker1OuterWrap").width() > $(".pieceMaker1OuterWrap").parent().width()){
				$(".pieceMaker1OuterWrap").hide();
				$(".pieceMaker1FallBack").show();
			}
			else{
				$(".pieceMaker1OuterWrap").show();
				$(".pieceMaker1FallBack").hide();
			}
		}
		if ($(".pieceMaker2OuterWrap").length > 0){
			if($(".pieceMaker2OuterWrap").width() > $(".pieceMaker2OuterWrap").parent().width()){
				$(".pieceMaker2OuterWrap").hide();
				$(".pieceMaker2FallBack").show();
			}
			else{
				$(".pieceMaker2OuterWrap").show();
				$(".pieceMaker2FallBack").hide();
			}
		}
	});

	if ($(".portInnerFullWidth").length > 0){
		$("#portfolioGrid").css('margin-left','0px');
	}
	$(window).resize(function() {
		var $portfolioGrid = $('#portfolioGrid');
		$portfolioGrid.isotope({
			itemSelector : '.element',
			resizable : true,
			resizesContainer : true,
			containerStyle : { position: 'relative', overflow: 'hidden' },
			transformsEnabled : true,
			layoutMode : 'fitRows'
		});
	});	
	//Main Navigation Menu Activation
	$('#navWrap ul.sf-menu').superfish();
	
	//Accordion SideBar Menu Activation
	$("#sideBar .widget_nav_menu ul li").menu();
	$("#footer .widget_nav_menu ul li").menu();
	
	//Social Icon Opacity Animation
	$('.socialIcons li').each(function(index) {
		$(this).hover(
		  function () {
			if(typeof document.documentElement.style.opacity!='undefined'){
				$(this).animate({opacity: socialActiveAlpha});
			}
		  }, 
		  function () {
			if(typeof document.documentElement.style.opacity!='undefined'){
				$(this).animate({opacity: socialInactiveAlpha});
			}
		  }
		);
	});
	
	//Enable Tabs
	$("ul.tabs1menu").tabs("div.verticalPanels > div", {tabs:'li'});
	$("ul.tabs2menu").tabs("div.panels > div", {tabs:'li'});
	
	//ADD TOGGLE CONTENT FUNCTIONALITY
	$('.toggle').click(function() {
		$(this).siblings('.toggle_show').slideToggle('fast');
		if($(this).children().hasClass('up')){
			$(this).children().removeClass('up');
			$(this).children().addClass('down');
			$(this).parent('.toggleWrapper').removeClass('inactive');
			$(this).parent('.toggleWrapper').addClass('active');
		}
		else if($(this).children().hasClass('down')){
			$(this).children().removeClass('down');
			$(this).children().addClass('up');
			$(this).parent('.toggleWrapper').removeClass('active');
			$(this).parent('.toggleWrapper').addClass('inactive');
		}
	});
	
	//ADD SEARCH INPUT ANIMATION
	$('#search_field').focus(function() {
		$(this).fadeTo('fast', 1);
	});
	$('#search_field').blur(function() {
		$(this).fadeTo('fast', 0);
	});
	
	$('#headerSearchField').focus(function() {
		$(this).fadeTo('fast', 1);
	});
	$('#headerSearchField').blur(function() {
		$(this).fadeTo('fast', 0);
	});

	$('#searchsubmit').val('');
	$('#s').focus(function() {
		$(this).fadeTo('fast', 1);
	});
	$('#s').blur(function() {
		$(this).fadeTo('fast', 0);
	});
	$("#s").click(function() {
		this.value = '';
	});
	
	
	//Preload Images
	$('.imageWrapper img').imgpreload
	({
		each: function()
		{
			if($(this).siblings().length > 0){
				$(this).siblings('.imagePreloader').delay(700).fadeOut('slow');
			}
			else{
				$(this).parent().siblings('.imagePreloader').delay(700).fadeOut('slow');
			}
		},
		all: function()
		{
		}
	});
	
	//hide preloaders on hidden images
	if ($('.imagePreloader:hidden').length ) {
		$('.imagePreloader:hidden').css('display','none');
	}
	if ($('.kwicksPreloader:hidden').length ) {
		$('.kwicksPreloader:hidden').css('display','none');
	}
	if ($('.nivoPreloader:hidden').length ) {
		$('.nivoPreloader:hidden').css('display','none');
	}
	
	//ADD IMAGE ICON HOVER LISTENERS/HANDLERS
	$('.iconHolder').each(function(index) {
		var prt = $(this).parents('.imageWrapper');
		prt.hover(
		  function () {
			$(this).find('.responsiveImage').stop().animate({ opacity: 0.5 }, 300, 'easeOutExpo');
			$(this).find('.iconHolder').animate({ opacity: 1, left: '0', top: '0' }, 300, 'easeOutExpo');
		  }, 
		  function () {
			$(this).find('.responsiveImage').stop().animate({ opacity: 1 }, 300, 'easeInExpo');
			$(this).find('.iconHolder').animate({ opacity: 0, left: '150%', top: '150%'}, 300, 'easeInExpo', function(){
				$(this).css({left: '-150%', top: '-150%'});
			});
		
		  }
		);
	});
	
	//Remove bottom margin from last widget
	if(jQuery('#sideBarWidgets').length){
		jQuery('#sideBarWidgets').children('.widget:last').css({'margin-bottom':'0px','padding-bottom':'0px','border-bottom':'none'});
	}
	//Remove bottom margin from last tweet
		window.setTimeout(function(){
			$('.tweet_list').each(function(index) {
				jQuery(this).children('.item:last').css({'margin-bottom':'0px'});
			});
		}, 2000);
	
	//ADD SCROLL TO TOP ANIMATION
    $(".backToTop").click(function(event){
        event.preventDefault();
        //goto that anchor by setting the body scroll top to anchor top
        $('html, body').animate({scrollTop:0}, 500);
    });
	
	//ADD BUTTON STYLES TO WP GENERATED HTML
	$('.comment-reply-link').addClass('button tiny '+ defaultBtnColor);
	$('#submit').addClass('button medium '+ defaultBtnColor);
	$('#cancel-comment-reply-link').addClass('buttonPro '+ defaultBtnColor);
	

	//ADD COLORBOX FUNCTIONALITY FOR IMAGES
	/*$('.lightbox[href*="http://vimeo.com/"]').each(function(){
		$(this).attr('href', this.href.replace("vimeo.com/", "player.vimeo.com/video/"));
	});
	$('.lightbox[href*="http://www.vimeo.com/"]').each(function(){
		$(this).attr('href', this.href.replace("www.vimeo.com/", "player.vimeo.com/video/"));
	});
	
	//Clean Up Youtube Url's
	var regex1 = new RegExp('feature=player_embedded&', 'i');
	var regex2 = new RegExp('watch\\?v=', 'i');
	$('.lightbox[href*="http://www.youtube.com/"]').each(function() {
		$(this).attr('href',this.href.replace(regex1,''));
	});
	$('.lightbox[href*="http://www.youtube.com/"]').each(function() {
		$(this).attr('href',this.href.replace(regex2,'v/'));
	});
	
	$('.lightbox').each(function(index) {
		//remove button classes & then add them back in at end
		var btnClasses = '';
		if ($(this).attr('data-btn')){
			btnClasses = $(this).attr('data-btn');
			$(this).removeClass(btnClasses);
		}
		$(this).removeClass('lightbox');
		var vWidth;
		var vHeight;
		var groupName = '';
		var relObj;
		if($(this).attr('class') == 'lbIFrame'){
			vWidth = $(this).attr('data-iframewidth');
			vHeight = $(this).attr('data-iframeheight');
			$(this).colorbox({width:vWidth, height:vHeight, iframe:true});
		}
		else if($(this).attr('class') == 'lbVideo'){
			vWidth = $(this).attr('data-iframewidth');
			vHeight = $(this).attr('data-iframeheight');
			$(this).colorbox({iframe:true, innerWidth:vWidth, innerHeight:vHeight});
		}
		else{
			if ($(this).attr('data-rel')){
				groupName = $(this).attr('data-rel');
				relObj = {rel:groupName}
			}
			$(this).colorbox(relObj); 
		}
		
		if ($(this).attr('data-btn')){
			$(this).addClass(btnClasses);
		}
		
	});*/
	
	addToolTips();
	//Disable Social Tooltips on Mobile and Tablets
	var bWidth = $(window).width();
	if(bWidth < 990){
		$('.vtip').each(function(index) {
			$(this).removeClass('vtip');
			$(this).addClass('ttip');
			$(this).unbind();
		});
	}
	//Re-Enable or Disable Social ToolTips on Resize
	$(window).resize(function() {
		bWidth = $(window).width();
		if(bWidth < 990){
			$('.vtip').each(function(index) {
				$(this).removeClass('vtip');
				$(this).addClass('ttip');
				$(this).unbind();
			});
		}
		else{
			if ($(".ttip").length > 0){
				$('.ttip').each(function(index) {
					$(this).removeClass('ttip');
					$(this).addClass('vtip');
				});
				addToolTips();
			}
		}
	});
	
	$(function(){
		
		var $portfolioGrid = $('#portfolioGrid');

		$portfolioGrid.imagesLoaded( function(){
		  $portfolioGrid.isotope({
			itemSelector : '.element',
			resizable : true,
			resizesContainer : true,
			containerStyle : { position: 'relative', overflow: 'hidden' },
			transformsEnabled : true,
			layoutMode : 'fitRows'
		  });
		});
			    
		var $optionSets = $('#options .option-set'),
			$optionLinks = $optionSets.find('a');
		
		//PORTFOLIO CATEGORY CLICK HANDLER
		$optionLinks.click(function(){
		
			var $this = $(this);
			if ( $this.hasClass('selected') ) {
				return false;
			}
			
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');

			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
				
			value = value === 'false' ? false : value;
			options[ key ] = value;
			
			if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
				// changes in layout modes need extra logic
				changeLayoutMode( $this, options )
			} 
			else {
				// otherwise, apply new options
				$portfolioGrid.isotope( options );
			}
			
			return false;
		});

    });
	
	
});

function addToolTips(){
	/**
	Vertigo Tip by www.vertigo-project.com
	*/
	this.vtip = function() {    
		this.xOffset = -25; // x distance from mouse
		this.yOffset = -40; // y distance from mouse       
		
		jQuery(".vtip").unbind().hover(    
			function(e) {
				this.t = this.title;
				this.title = ''; 
				this.top = (e.pageY + yOffset); this.left = (e.pageX + xOffset);
				
				jQuery('body').append( '<div id="vtip" style="z-index:30000;">' + this.t + '<div class="vTipArrow"></div></div>' );
						
				jQuery('div#vtip').css("top", this.top+"px").css("left", this.left+"px").fadeIn("fast");
				
			},
			function() {
				this.title = this.t;
				jQuery("div#vtip").fadeOut("fast").remove();
			}
		).mousemove(
			function(e) {
				this.top = (e.pageY + yOffset);
				this.left = (e.pageX + xOffset);
							 
				jQuery("div#vtip").css("top", this.top+"px").css("left", this.left+"px");
			}
		);
	};
	jQuery(document).ready(function(jQuery){vtip();})
}

function uniqeid(){
	var newDate = new Date;
	return newDate.getTime();
}



/* skinSwitcher: (http://themes.curtycurt.com/inspired/wp-content/themes/options/js/skinSwitcher.js) */
jQuery.noConflict();

jQuery(document).ready(function($){
	
	var siteUrl = 'http://themes.curtycurt.com/inspired/wp-content/themes/options';

	$('#optionsPanel').animate({
			left: 0
		}, 300, 'easeInOutQuint', function() {
			$('#optionsPanel').animate({left: -323}, 900, 'easeInOutQuint');
	});
		
		
		
		
	$('#switchToggleButton').click(function() {
		
		$('#optionsPanel').animate({
			left: parseInt($('#optionsPanel').css('left')) == -323 ? 0 : -323
		}, 800, 'easeInOutQuint', function() {
		// Animation complete.
		});
		
		$('.gearBtn').animate({
			top: parseInt($('#optionsPanel').css('left')) == -323 ? 37 : 0
		}, 400, 'easeInOutQuint', function() {
		// Animation complete.
		});
		
		$('.arrowBtn').animate({
			top: parseInt($('#optionsPanel').css('left')) == -323 ? 0 : -37
		}, 400, 'easeInOutQuint', function() {
		// Animation complete.
		});
		
	});
	
	
	//ADD SKIN SELECTION LISTENERS
	$('#menu-item-886').click(setSkin);
	$('#menu-item-874').click(setSkin);
	$('#menu-item-877').click(setSkin);
	$('#menu-item-3107').click(setSkin);
	$('#menu-item-880').click(setSkin);
	$('#menu-item-875').click(setSkin);
	$('#menu-item-878').click(setSkin);
	$('#menu-item-896').click(setSkin);
	$('#menu-item-879').click(setSkin);
	$('#menu-item-882').click(setSkin);
	$('#menu-item-887').click(setSkin);
	$('#menu-item-881').click(setSkin);
	$('#menu-item-892').click(setSkin);
	$('#menu-item-895').click(setSkin);
	$('#menu-item-885').click(setSkin);
	$('#menu-item-888').click(setSkin);
	$('#menu-item-883').click(setSkin);
	$('#menu-item-876').click(setSkin);
	$('#menu-item-893').click(setSkin);
	$('#menu-item-884').click(setSkin);
	
	
	window.setTimeout(function(){
		//ADD SKIN SELECTION LISTENERS
		$('#light-grey-orange').click(setSkin);
		$('#cream').click(setSkin);
		$('#crimson-red').click(setSkin);
		$('#creative-orange').click(setSkin);
		$('#light-green').click(setSkin);
		$('#charcoal').click(setSkin);
		$('#dark-purple').click(setSkin);
		$('#minimal').click(setSkin);
		$('#sage').click(setSkin);
		$('#light-blue').click(setSkin);
		$('#blue').click(setSkin);
		$('#orange').click(setSkin);
		$('#tan').click(setSkin);
		$('#light-brick').click(setSkin);
		$('#pink').click(setSkin);
		$('#aqua').click(setSkin);
		$('#blue-grey').click(setSkin);
		$('#light-purple').click(setSkin);
		$('#teal').click(setSkin);
		$('#gold').click(setSkin);
	
	}, 1000);
	
	$(window).resize(function() {
		$('#light-grey-orange').click(setSkin);
		$('#cream').click(setSkin);
		$('#crimson-red').click(setSkin);
		$('#creative-orange').click(setSkin);
		$('#light-green').click(setSkin);
		$('#charcoal').click(setSkin);
		$('#dark-purple').click(setSkin);
		$('#minimal').click(setSkin);
		$('#sage').click(setSkin);
		$('#light-blue').click(setSkin);
		$('#blue').click(setSkin);
		$('#orange').click(setSkin);
		$('#tan').click(setSkin);
		$('#light-brick').click(setSkin);
		$('#pink').click(setSkin);
		$('#aqua').click(setSkin);
		$('#blue-grey').click(setSkin);
		$('#light-purple').click(setSkin);
		$('#teal').click(setSkin);
		$('#gold').click(setSkin);
	});
	
	function setSkin(event){
		event.preventDefault();
		var skinID = jQuery(this).attr('id');
		switch(skinID){
			case 'menu-item-886':
				var skin = 'light-grey-orange';
			break;
			case 'menu-item-874':
				var skin = 'cream';
			break;
			case 'menu-item-877':
				var skin = 'crimson-red';
			break;
			case 'menu-item-3107':
				var skin = 'creative-orange';
			break;
			case 'menu-item-880':
				var skin = 'light-green';
			break;
			case 'menu-item-875':
				var skin = 'charcoal';
			break;
			case 'menu-item-878':
				var skin = 'dark-purple';
			break;
			case 'menu-item-896':
				var skin = 'minimal';
			break;
			case 'menu-item-879':
				var skin = 'sage';
			break;
			case 'menu-item-882':
				var skin = 'light-blue';
			break;
			case 'menu-item-887':
				var skin = 'blue';
			break;
			case 'menu-item-881':
				var skin = 'orange';
			break;
			case 'menu-item-892':
				var skin = 'tan';
			break;
			case 'menu-item-895':
				var skin = 'light-brick';
			break;
			case 'menu-item-885':
				var skin = 'pink';
			break;
			case 'menu-item-888':
				var skin = 'aqua';
			break;
			case 'menu-item-883':
				var skin = 'blue-grey';
			break;
			case 'menu-item-876':
				var skin = 'teal';
			break;
			case 'menu-item-893':
				var skin = 'light-purple';
			break;
			case 'menu-item-884':
				var skin = 'gold';
			break;
			case 'light-grey-orange':
				var skin = 'light-grey-orange';
			break;
			case 'cream':
				var skin = 'cream';
			break;
			case 'crimson-red':
				var skin = 'crimson-red';
			break;
			case 'creative-orange':
				var skin = 'creative-orange';
			break;
			case 'light-green':
				var skin = 'light-green';
			break;
			case 'charcoal':
				var skin = 'charcoal';
			break;
			case 'dark-purple':
				var skin = 'dark-purple';
			break;
			case 'minimal':
				var skin = 'minimal';
			break;
			case 'sage':
				var skin = 'sage';
			break;
			case 'light-blue':
				var skin = 'light-blue';
			break;
			case 'blue':
				var skin = 'blue';
			break;
			case 'orange':
				var skin = 'orange';
			break;
			case 'tan':
				var skin = 'tan';
			break;
			case 'light-brick':
				var skin = 'light-brick';
			break;
			case 'pink':
				var skin = 'pink';
			break;
			case 'aqua':
				var skin = 'aqua';
			break;
			case 'blue-grey':
				var skin = 'blue-grey';
			break;
			case 'teal':
				var skin = 'teal';
			break;
			case 'light-purple':
				var skin = 'light-purple';
			break;
			case 'gold':
				var skin = 'gold';
			break;
		}
		var ajaxData = 'skin=' + skin;
		//MAKE AJAX CALL & SET COOKIE
		jQuery.ajax({
			type: "POST",
			url: siteUrl + "/style-switcher.php",
			data: ajaxData,
			success: function(responseText){
				//REFRESH PAGE
				//window.location.reload();
				window.location = 'http://themes.curtycurt.com/inspired';
			}
		});	
	}

	$('.dropdown-menu').each(function(index) {
		$(this).change(setMobileSkin);
	});

	function setMobileSkin(e){
		var skin = '';
		var select = e.target;
		var option = select.options[select.selectedIndex];
		if ($(option).hasClass('menu-item-886')) {
			skin = 'light-grey-orange';
		}		
		if ($(option).hasClass('menu-item-874')) {
			skin = 'cream';
		}		
		if ($(option).hasClass('menu-item-877')) {
			skin = 'crimson-red';
		}
		if ($(option).hasClass('menu-item-3107')) {
			skin = 'creative-orange';
		}		
		if ($(option).hasClass('menu-item-880')) {
			var skin = 'light-green';
		}		
		if ($(option).hasClass('menu-item-875')) {
			skin = 'charcoal';
		}		
		if ($(option).hasClass('menu-item-878')) {
			skin = 'dark-purple';
		}		
		if ($(option).hasClass('menu-item-896')) {
			skin = 'minimal';
		}		
		if ($(option).hasClass('menu-item-879')) {
			skin = 'sage';
		}		
		if ($(option).hasClass('menu-item-882')) {
			skin = 'light-blue';
		}		
		if ($(option).hasClass('menu-item-887')) {
			skin = 'blue';
		}		
		if ($(option).hasClass('menu-item-881')) {
			skin = 'orange';
		}		
		if ($(option).hasClass('menu-item-892')) {
			skin = 'tan';
		}		
		if ($(option).hasClass('menu-item-895')) {
			skin = 'light-brick';
		}		
		if ($(option).hasClass('menu-item-885')) {
			skin = 'pink';
		}		
		if ($(option).hasClass('menu-item-888')) {
			skin = 'aqua';
		}		
		if ($(option).hasClass('menu-item-883')) {
			skin = 'blue-grey';
		}	
		if ($(option).hasClass('menu-item-876')) {
			skin = 'teal';
		}	
		if ($(option).hasClass('menu-item-893')) {
			skin = 'light-purple';
		}	
		if ($(option).hasClass('menu-item-884')) {
			skin = 'gold';
		}	
		
		if(skin != ''){
			var ajaxData = 'skin=' + skin;
			//MAKE AJAX CALL & SET COOKIE
			jQuery.ajax({
				type: "POST",
				url: siteUrl + "/style-switcher.php",
				data: ajaxData,
				success: function(responseText){
					//REFRESH PAGE
					window.location.reload();
				}
			});
		}
	}
	

});



/* layerslider_js: (http://themes.curtycurt.com/inspired/wp-content/themes/options/framework/plug-ins/LayerSlider/js/layerslider.kreaturamedia.jquery-min.js) */
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(6(a){a.4q.17=6(c){4((3g c).2D("4t|4i")){19 3.T(6(a){4L b(3,c)})}y{4(c=="8"){7 d=a(3).8("2z");4(d){19 d}}y{19 3.T(6(b){7 d=a(3).8("2z");4(d){4(!d.g.18){4(3g c=="4B"){4(c>0&&c<d.g.1a+1&&c!=d.g.U){d.2i(c)}}y{1O(c){B"W":d.o.1X();d.W("2m");C;B"X":d.o.2h();d.X("2m");C;B"16":4(!d.g.Y){d.o.3U();d.g.15=p;d.16()}C}}}4((d.g.Y||!d.g.Y&&d.g.15)&&c=="10"){d.o.3K();d.g.15=r;d.g.w.9(\'L[u*="1D.1H"], L[u*="1I.1o"]\').T(6(){1C(a(3).8("2r"))});d.10()}}})}}};7 b=6(c,d){7 e=3;e.$35=a(c).V("5-2O");e.$35.8("2z",e);e.3p=6(){e.o=a.3d({},b.3q,d);e.g=a.3d({},b.38);4(a(c).9(".5-11").N==1){e.o.1R=r;e.o.32=r;e.o.2k=r;e.o.2s=r;e.o.1d=0;e.o.27=r;e.o.1e=p;e.o.S=1}e.g.2K=a(c)[0].1x.E;a(c).9(\'.5-11, *[G*="5-s"]\').T(6(){4(a(3).t("22")||a(3).t("1x")){4(a(3).t("22")){7 b=a(3).t("22").1F().P(";")}y{7 b=a(3).t("1x").1F().P(";")}1B(x=0;x<b.N;x++){1t=b[x].P(":");4(1t[0].1h("4r")!=-1){1t[1]=e.3n(1t[1])}a(3).8(a.2p(1t[0]),a.2p(1t[1]))}}a(3).8("44",a(3)[0].1x.M);a(3).8("47",a(3)[0].1x.R)});a(c).9(\'*[G*="5-2U-"]\').T(6(){7 b=a(3).t("G").P(" ");1B(7 d=0;d<b.N;d++){4(b[d].1h("5-2U-")!=-1){7 e=F(b[d].P("5-2U-")[1]);a(3).12(6(b){b.1j();a(c).17(e)})}}});e.g.1a=a(c).9(".5-11").N;e.o.S=e.o.S<e.g.1a+1?e.o.S:1;e.o.S=e.o.S<1?1:e.o.S;e.g.1g=1;4(e.o.20){e.g.1g=0}a(c).9(\'L[u*="1D.1H"]\').T(6(){4(a(3).1f(\'[G*="5-s"]\')){7 b=a(3);a.36("2W://4k.3z.2Z/4I/3h/4u/"+a(3).t("u").P("34/")[1].P("?")[0]+"?v=2&4h=42&3J=?",6(a){b.8("23",F(a["4e"]["4j$4x"]["4l$3W"]["4s"])*2A)});7 c=a("<1k>").V("5-1E").K(a(3).1f());a("<1y>").K(c).V("5-1A").t("u","2W://1y.3z.2Z/4N/"+a(3).t("u").P("34/")[1].P("?")[0]+"/"+e.o.3S);a("<1k>").K(c).V("5-3V");a(3).1f().q({E:a(3).E(),Q:a(3).Q()}).12(6(){e.g.18=p;4(e.g.1b){4(e.o.1e!=r){e.g.1b=r}e.g.15=p}y{e.g.15=e.g.Y}4(e.o.1e!=r){e.10()}e.g.2j=p;a(3).9("L").t("u",a(3).9("L").8("1U"));a(3).9(".5-1E").13(e.g.v.d).2V(e.g.v.2C,6(){4(e.o.1e=="29"&&e.g.15==p){7 a=2t(6(){e.16()},b.8("23")-e.g.v.d);b.8("2r",a)}e.g.18=r})});7 d="&";4(a(3).t("u").1h("?")==-1){d="?"}a(3).8("1U",a(3).t("u")+d+"3H=1");a(3).t("u","")}});a(c).9(\'L[u*="1I.1o"]\').T(6(){4(a(3).1f(\'[G*="5-s"]\')){7 b=a(3);7 c=a("<1k>").V("5-1E").K(a(3).1f());a.36("2W://1o.2Z/3h/4O/4c/"+a(3).t("u").P("4c/")[1].P("?")[0]+".42?3J=?",6(d){a("<1y>").K(c).V("5-1A").t("u",d[0]["4g"]);b.8("23",F(d[0]["3W"])*2A);a("<1k>").K(c).V("5-3V")});a(3).1f().q({E:a(3).E(),Q:a(3).Q()}).12(6(){e.g.18=p;4(e.g.1b){4(e.o.1e!=r){e.g.1b=r}e.g.15=p}y{e.g.15=e.g.Y}4(e.o.1e!=r){e.10()}e.g.2j=p;a(3).9("L").t("u",a(3).9("L").8("1U"));a(3).9(".5-1E").13(e.g.v.d).2V(e.g.v.2C,6(){4(e.o.1e=="29"&&e.g.15==p){7 a=2t(6(){e.16()},b.8("23")-e.g.v.d);b.8("2r",a)}e.g.18=r})});7 d="&";4(a(3).t("u").1h("?")==-1){d="?"}a(3).8("1U",a(3).t("u")+d+"3H=1");a(3).t("u","")}});4(e.o.20){e.o.S=e.o.S-1==0?e.g.1a:e.o.S-1}e.g.U=e.o.S;e.g.w=a(c).9(".5-11:1v("+(e.g.U-1)+")");e.g.D=6(){19 a(c).E()};e.g.H=6(){19 a(c).Q()};4(e.o.2T){7 f=a("<1y>").K(a(c)).t("u",e.o.2T).t("1x",e.o.3Z);4(e.o.2Y!=r){a("<a>").K(a(c)).t("1i",e.o.2Y).t("4m",e.o.3Q).q({4E:"1m",4n:"1m"}).4C(f)}}a(c).9(".5-11").4D(\'<1k G="5-1K"></1k>\');4(a(c).q("31")=="4A"){a(c).q("31","4z")}a(c).9(".5-1K").q({4v:e.o.48});4(e.o.2X){a(c).9(".5-1K").q({4w:"1M("+e.o.2X+")"})}a(c).9(".5-3G").q({1n:-(e.g.D()/2)+"1S",1q:-(e.g.H()/2)+"1S"});4(e.o.32){a(\'<a G="5-J-W" 1i="#" />\').12(6(b){b.1j();a(c).17("W")}).K(a(c));a(\'<a G="5-J-X" 1i="#" />\').12(6(b){b.1j();a(c).17("X")}).K(a(c))}4(e.o.2k||e.o.2s){a(\'<1k G="5-A-J-1r" />\').K(a(c));4(e.o.2s){a(\'<2v G="5-A-1J" />\').K(a(c).9(".5-A-J-1r"));1B(x=1;x<e.g.1a+1;x++){a(\'<a 1i="#"></a>\').K(a(c).9(".5-A-1J")).12(6(b){b.1j();a(c).17(a(3).3I()+1)})}a(c).9(".5-A-1J a:1v("+(e.o.S-1)+")").V("5-J-1c")}4(e.o.2k){a(\'<a G="5-J-16" 1i="#" />\').12(6(b){b.1j();a(c).17("16")}).3E(a(c).9(".5-A-J-1r"));a(\'<a G="5-J-10" 1i="#" />\').12(6(b){b.1j();a(c).17("10")}).K(a(c).9(".5-A-J-1r"))}y{a(\'<2v G="5-J-3y 5-J-4y" />\').3E(a(c).9(".5-A-J-1r"));a(\'<2v G="5-J-3y 5-J-4F" />\').K(a(c).9(".5-A-J-1r"))}}4(e.o.3C&&a(c).9(".5-11").N>1){a("3O").2q("4M",6(a){4(!e.g.18){4(a.3k==37){e.o.1X();e.W("2m")}y 4(a.3k==39){e.o.2h();e.X("2m")}}})}4("4K"4J 1L&&a(c).9(".5-11").N>1&&e.o.3D){a(c).2q("4G",6(a){7 b=a.1s?a.1s:a.3w.1s;4(b.N==1){e.g.2o=e.g.1G=b[0].3A}});a(c).2q("4H",6(a){7 b=a.1s?a.1s:a.3w.1s;4(b.N==1){e.g.1G=b[0].3A}4(3v.3o(e.g.2o-e.g.1G)>45){a.1j()}});a(c).2q("4f",6(b){4(3v.3o(e.g.2o-e.g.1G)>45){4(e.g.2o-e.g.1G>0){e.o.2h();a(c).17("X")}y{e.o.1X();a(c).17("W")}}})}4(e.o.3c==p&&a(c).9(".5-11").N>1){a(c).9(".5-1K").4p(6(){e.o.3N();4(e.g.Y){e.10();e.g.1b=p}},6(){4(e.g.1b==p){e.16();e.g.1b=r}})}a(c).V("5-"+e.o.2l);7 g=e.o.3a+e.o.2l+"/2l.q";4(3t.3s){3t.3s(g)}y{a(\'<4o 22="4S" 1i="\'+g+\'" 5A="5l/q" />\').K(a("5j"))}4(e.o.20==p){4(e.o.1R){e.g.Y=p}e.X()}y{e.1Q(e.g.w,6(){e.g.w.30(2A,6(){a(3).V("5-1c");4(e.o.28){a(3).13(a(3).8("1N")+25).3l(6(){a(3).9(".5-1A").12();a(3).43()})}});4(e.o.1R){e.16()}})}a(1L).5k(6(){e.1z(e.g.w,6(){19})});a(c).13(5p).3l(6(){e.1z(e.g.w,6(){19},p)});e.o.3T(a(c))};e.16=6(){4(e.g.Y){4(e.g.14=="W"&&e.o.3u){e.W()}y{e.X()}}y{e.g.Y=p;e.33()}};e.33=6(){7 b=a(c).9(".5-1c").8("3m")?F(a(c).9(".5-1c").8("3m")):e.o.3x;1C(e.g.1P);e.g.1P=1L.2t(6(){e.16()},b)};e.10=6(){1C(e.g.1P);e.g.Y=r};e.3n=6(b){4(a.2p(b.1F())=="5u"||a.2p(b.1F())=="5t"){19 b.1F()}y{19 b.O("5s","5q").O("5m","5r").O("5w","5n").O("5v","5y").O("5D","5G").O("5z","5B").O("5x","5C").O("5F","5E").O("5o","5h").O("4Z","4Y").O("50","51").O("52","4X").O("4W","4R")}};e.W=6(a){4(e.g.U<2){e.g.1g+=1}4(e.g.1g>e.o.1d&&e.o.1d>0&&!a){e.g.1g=0;e.10();4(e.o.27==r){e.o.1d=0}}y{7 b=e.g.U<2?e.g.1a:e.g.U-1;e.g.14="W";e.2i(b,e.g.14)}};e.X=6(a){4(!(e.g.U<e.g.1a)){e.g.1g+=1}4(e.g.1g>e.o.1d&&e.o.1d>0&&!a){e.g.1g=0;e.10();4(e.o.27==r){e.o.1d=0}}y{7 b=e.g.U<e.g.1a?e.g.U+1:1;e.g.14="X";e.2i(b,e.g.14)}};e.2i=6(b,d){4(e.g.2j==p){e.g.2j=r;e.g.Y=e.g.15;e.g.w.9(\'L[u*="1D.1H"], L[u*="1I.1o"]\').T(6(){a(3).1f().9(".5-1E").30(e.g.v.2B,6(){a(3).1f().9("L").t("u","")})})}a(c).9(\'L[u*="1D.1H"], L[u*="1I.1o"]\').T(6(){1C(a(3).8("2r"))});1C(e.g.1P);e.g.24=b;e.g.I=a(c).9(".5-11:1v("+(e.g.24-1)+")");4(!d){4(e.g.U<e.g.24){e.g.14="X"}y{e.g.14="W"}}7 f=0;4(a(c).9(\'L[u*="1D.1H"], L[u*="1I.1o"]\').N){f=e.g.v.2B}2t(6(){e.1Q(e.g.I,6(){e.1w()})},f)};e.1Q=6(b,c){4(e.o.1Q){7 d=[];7 f=0;4(b.q("1p-1u")!="1m"&&b.q("1p-1u").1h("1M")!=-1){7 g=b.q("1p-1u");g=g.2D(/1M\\((.*)\\)/)[1].O(/"/3b,"");d.2M(g)}b.9("1y").T(6(){d.2M(a(3).t("u"))});b.9("*").T(6(){4(a(3).q("1p-1u")!="1m"&&a(3).q("1p-1u").1h("1M")!=-1){7 b=a(3).q("1p-1u");b=b.2D(/1M\\((.*)\\)/)[1].O(/"/3b,"");d.2M(b)}});4(d.N==0){e.1z(b,c)}y{1B(x=0;x<d.N;x++){a("<1y>").4Q(6(){4(++f==d.N){e.1z(b,c)}}).t("u",d[x])}}}y{e.1z(b,c)}};e.1z=6(b,c,d){4(!d){b.q({2u:"3F",4d:"5i"})}e.41();1B(7 f=0;f<b.49().N;f++){7 g=b.49(":1v("+f+")");7 h=g.8("44");7 i=g.8("47");4(h&&h.1h("%")!=-1){g.q({M:e.g.D()/2S*F(h)-g.40()/2})}4(i&&i.1h("%")!=-1){g.q({R:e.g.H()/2S*F(i)-g.2Q()/2})}}4(!d){b.q({2u:"1m",4d:"4T"})}c();a(3).43()};e.41=6(){4(a(c).21(".5-1W-1V-2O").N){a(c).21(".5-1W-1V-3M").q({Q:a(c).2Q(p)});a(c).21(".5-1W-1V-2O").q({Q:a(c).2Q(p)});a(c).21(".5-1W-1V-3M").q({E:a(1L).E(),M:-a(1L).E()/2});4(e.g.2K.P("%")!=-1){7 b=F(e.g.2K);7 d=a("3O").E()/2S*b-(a(c).40()-a(c).E());a(c).E(d)}}a(c).9(".5-1K").q({E:e.g.D(),Q:e.g.H()});4(e.g.w&&e.g.I){e.g.w.q({E:e.g.D(),Q:e.g.H()});e.g.I.q({E:e.g.D(),Q:e.g.H()})}y{a(c).9(".5-11").q({E:e.g.D(),Q:e.g.H()})}a(c).9(".5-3G").q({1n:-(e.g.D()/2)+"1S",1q:-(e.g.H()/2)+"1S"})};e.1w=6(){e.o.4a();e.g.18=p;e.g.I.V("5-3R");7 b=2P=2d=2N=2e=2y=26=2E=1T=4P=2g=4U="29";7 d=2G=e.g.D();7 f=2F=e.g.H();7 g=e.g.14=="W"?e.g.w:e.g.I;7 h=g.8("1l")?g.8("1l"):e.o.4b;7 i=e.g.3B[e.g.14][h];4(i=="M"||i=="Z"){d=2d=2G=26=0;2g=0}4(i=="R"||i=="A"){f=b=2F=2e=0;1T=0}1O(i){B"M":2P=2e=0;1T=-e.g.D();C;B"Z":b=2y=0;1T=e.g.D();C;B"R":2N=26=0;2g=-e.g.H();C;B"A":2d=2E=0;2g=e.g.53;C}e.g.w.q({M:b,Z:2P,R:2d,A:2N});e.g.I.q({E:2G,Q:2F,M:2e,Z:2y,R:26,A:2E});7 j=e.g.w.8("2a")?F(e.g.w.8("2a")):e.o.2H;7 k=e.g.w.8("2b")?F(e.g.w.8("2b")):e.o.2L;7 l=e.g.w.8("2f")?e.g.w.8("2f"):e.o.2R;e.g.w.13(j+k/54).1w({E:d,Q:f},k,l,6(){e.g.w=e.g.I;e.g.U=e.g.24;a(c).9(".5-11").2w("5-1c");a(c).9(".5-11:1v("+(e.g.U-1)+")").V("5-1c").2w("5-3R");a(c).9(".5-A-1J a").2w("5-J-1c");a(c).9(".5-A-1J a:1v("+(e.g.U-1)+")").V("5-J-1c");e.g.18=r;e.o.46();4(e.g.Y){e.33()}});e.g.w.9(\' > *[G*="5-s"]\').T(6(){7 b=a(3).8("1l")?a(3).8("1l"):i;7 c,d;1O(b){B"M":c=-e.g.D();d=0;C;B"Z":c=e.g.D();d=0;C;B"R":d=-e.g.H();c=0;C;B"A":d=e.g.H();c=0;C}7 f=a(3).8("3Y")?a(3).8("3Y"):r;1O(f){B"M":c=e.g.D();d=0;C;B"Z":c=-e.g.D();d=0;C;B"R":d=e.g.H();c=0;C;B"A":d=-e.g.H();c=0;C}7 g=e.g.w.8("3X")?F(e.g.w.8("3X")):e.o.3f;7 h=F(a(3).t("G").P("5-s")[1])*g;7 j=a(3).8("2a")?F(a(3).8("2a")):e.o.2H;7 k=a(3).8("2b")?F(a(3).8("2b")):e.o.2L;7 l=a(3).8("2f")?a(3).8("2f"):e.o.2R;4(f=="2c"||!f&&b=="2c"){a(3).13(j).2V(k,l)}y{a(3).10().13(j).1w({1n:-c*h,1q:-d*h},k,l)}});7 m=e.g.I.8("1N")?F(e.g.I.8("1N")):e.o.2J;7 n=e.g.I.8("1Z")?F(e.g.I.8("1Z")):e.o.2x;7 o=e.g.I.8("1Y")?e.g.I.8("1Y"):e.o.2I;e.g.I.13(j+m).1w({E:e.g.D(),Q:e.g.H()},n,o);e.g.I.9(\' > *[G*="5-s"]\').T(6(){7 b=a(3).8("1l")?a(3).8("1l"):i;7 c,d;1O(b){B"M":c=-e.g.D();d=0;C;B"Z":c=e.g.D();d=0;C;B"R":d=-e.g.H();c=0;C;B"A":d=e.g.H();c=0;C;B"2c":d=0;c=0;C}7 f=e.g.I.8("3L")?F(e.g.I.8("3L")):e.o.3e;7 g=F(a(3).t("G").P("5-s")[1])*f;7 h=a(3).8("1N")?F(a(3).8("1N")):e.o.2J;7 k=a(3).8("1Z")?F(a(3).8("1Z")):e.o.2x;7 l=a(3).8("1Y")?a(3).8("1Y"):e.o.2I;4(b=="2c"){a(3).q({2u:"1m",1n:0,1q:0}).13(j+h).30(k,l,6(){4(e.o.28==p){a(3).9(".5-1A").12()}})}y{a(3).q({2u:"3F",1n:c*g,1q:d*g}).10().13(j+h).1w({1n:0,1q:0},k,l,6(){4(e.o.28==p){a(3).9(".5-1A").12()}})}})};e.3p()};b.3q={1R:p,S:1,3u:r,3C:p,3D:p,1Q:p,32:p,2k:p,2s:p,2l:"5d",3a:"/5c/5e/",3c:p,48:"5f",2X:r,20:r,2T:r,3Z:"31: 5g; z-3I: 5b; M: 3P; R: 3P;",2Y:r,3Q:"5a",1d:0,27:p,28:p,1e:"29",3S:"56.55",3T:6(){},3U:6(){},3K:6(){},3N:6(){},4a:6(){},46:6(){},1X:6(){},2h:6(){},4b:"Z",3x:57,3e:.45,3f:.45,2x:3i,2L:3i,2I:"3j",2R:"3j",2J:0,2H:0};b.38={58:"2.0",1b:r,Y:r,18:r,1a:2n,14:"X",1P:2n,D:2n,H:2n,3B:{W:{M:"Z",Z:"M",R:"A",A:"R"},X:{M:"M",Z:"Z",R:"R",A:"A"}},v:{d:3r,2C:59,2B:3r}}})(4V)',62,353,'|||this|if|ls|function|var|data|find||||||||||||||||true|css|false||attr|src||curLayer||else||bottom|case|break|sliderWidth|width|parseInt|class|sliderHeight|nextLayer|nav|appendTo|iframe|left|length|replace|split|height|top|firstLayer|each|curLayerIndex|addClass|prev|next|autoSlideshow|right|stop|layer|click|delay|prevNext|originalAutoSlideshow|start|layerSlider|isAnimating|return|layersNum|paused|active|loops|autoPauseSlideshow|parent|nextLoop|indexOf|href|preventDefault|div|slidedirection|none|marginLeft|vimeo|background|marginTop|wrapper|touches|param|image|eq|animate|style|img|makeResponsive|videopreview|for|clearTimeout|www|vpcontainer|toLowerCase|touchEndX|youtu|player|slidebuttons|inner|window|url|delayin|switch|slideTimer|imgPreload|autoStart|px|layerMarginLeft|videoSrc|forceresponsive|wp|cbPrev|easingin|durationin|animateFirstLayer|closest|rel|videoDuration|nextLayerIndex||nextLayerTop|forceLoopNum|autoPlayVideos|auto|delayout|durationout|fade|curLayerTop|nextLayerLeft|easingout|layerMarginTop|cbNext|change|pausedByVideo|navStartStop|skin|clicked|null|touchStartX|trim|bind|videoTimer|navButtons|setTimeout|display|span|removeClass|durationIn|nextLayerRight|LayerSlider|1e3|fi|fo|match|nextLayerBottom|nextLayerHeight|nextLayerWidth|delayOut|easingIn|delayIn|sliderOriginalWidth|durationOut|push|curLayerBottom|container|curLayerRight|outerHeight|easingOut|100|yourLogo|linkto|fadeOut|http|globalBGImage|yourLogoLink|com|fadeIn|position|navPrevNext|timer|embed|el|getJSON||global||skinsPath|gi|pauseOnHover|extend|parallaxIn|parallaxOut|typeof|api|1500|easeInOutQuint|which|queue|slidedelay|ieEasing|abs|init|options|500|createStyleSheet|document|twoWaySlideshow|Math|originalEvent|slideDelay|sides|youtube|clientX|slideDirections|keybNav|touchNav|prependTo|block|bg|autoplay|index|callback|cbStop|parallaxin|helper|cbPause|body|10px|yourLogoTarget|animating|youtubePreview|cbInit|cbStart|playvideo|duration|parallaxout|slideoutdirection|yourLogoStyle|outerWidth|resizeSlider|json|dequeue|originalLeft||cbAnimStop|originalTop|globalBGColor|children|cbAnimStart|slideDirection|video|visibility|entry|touchend|thumbnail_large|alt|undefined|media|gdata|yt|target|outline|link|hover|fn|easing|seconds|object|videos|backgroundColor|backgroundImage|group|sideleft|relative|static|number|append|wrapAll|textDecoration|sideright|touchstart|touchmove|feeds|in|ontouchstart|new|keydown|vi|v2|layerMarginRight|load|Bounce|stylesheet|visible|layerMarginBottom|jQuery|bounce|Back|Circ|circ|elastic|Elastic|back|sliderHeight89|80|jpg|maxresdefault|4e3|version|750|_blank|1001|layerslider|lightskin|skins|transparent|absolute|Expo|hidden|head|resize|text|easein|easeOut|expo|150|easeInOut|easeIn|easeinout|linear|swing|quad|easeout|quint|Quad|cubic|type|Cubic|Quint|quart|Sine|sine|Quart'.split('|'),0,{}))




/* layerslider_easing: (http://themes.curtycurt.com/inspired/wp-content/themes/options/framework/plug-ins/LayerSlider/js/jquery-easing-1.3.js) */
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */



