/*!
 * jQuery Color Animations v@VERSION
 * https://github.com/jquery/jquery-color
 *
 * Copyright 2013 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 */
(function(g,n){function p(a,b,c){var d=t[b.type]||{};if(null==a)return c||!b.def?null:b.def;a=d.floor?~~a:parseFloat(a);return isNaN(a)?b.def:d.mod?(a+d.mod)%d.mod:0>a?0:d.max<a?d.max:a}function u(a){var b=h(),c=b._rgba=[];a=a.toLowerCase();k(x,function(d,f){var e,j=f.re.exec(a);e=j&&f.parse(j);j=f.space||"rgba";if(e)return e=b[j](e),b[l[j].cache]=e[l[j].cache],c=b._rgba=e._rgba,!1});return c.length?("0,0,0,0"===c.join()&&g.extend(c,q.transparent),b):q[a]}function r(a,b,c){c=(c+1)%1;return 1>6*c? a+6*(b-a)*c:1>2*c?b:2>3*c?a+6*(b-a)*(2/3-c):a}var y=/^([\-+])=\s*(\d+\.?\d*)/,x=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(a){return[a[1],a[2],a[3],a[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(a){return[2.55*a[1],2.55*a[2],2.55*a[3],a[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(a){return[parseInt(a[1],16),parseInt(a[2],16), parseInt(a[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(a){return[parseInt(a[1]+a[1],16),parseInt(a[2]+a[2],16),parseInt(a[3]+a[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(a){return[a[1],a[2]/100,a[3]/100,a[4]]}}],h=g.Color=function(a,b,c,d){return new g.Color.fn.parse(a,b,c,d)},l={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0, type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},t={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},v=h.support={},w=g("<p>")[0],q,k=g.each;w.style.cssText="background-color:rgba(1,1,1,.5)";v.rgba=-1<w.style.backgroundColor.indexOf("rgba");k(l,function(a,b){b.cache="_"+a;b.props.alpha={idx:3,type:"percent",def:1}});h.fn=g.extend(h.prototype,{parse:function(a,b,c,d){if(a===n)return this._rgba=[null,null,null,null],this;if(a.jquery||a.nodeType)a= g(a).css(b),b=n;var f=this,e=g.type(a),j=this._rgba=[];b!==n&&(a=[a,b,c,d],e="array");if("string"===e)return this.parse(u(a)||q._default);if("array"===e)return k(l.rgba.props,function(d,c){j[c.idx]=p(a[c.idx],c)}),this;if("object"===e)return a instanceof h?k(l,function(c,d){a[d.cache]&&(f[d.cache]=a[d.cache].slice())}):k(l,function(d,c){var b=c.cache;k(c.props,function(d,e){if(!f[b]&&c.to){if("alpha"===d||null==a[d])return;f[b]=c.to(f._rgba)}f[b][e.idx]=p(a[d],e,!0)});f[b]&&0>g.inArray(null,f[b].slice(0, 3))&&(f[b][3]=1,c.from&&(f._rgba=c.from(f[b])))}),this},is:function(a){var b=h(a),c=!0,d=this;k(l,function(a,e){var j,g=b[e.cache];g&&(j=d[e.cache]||e.to&&e.to(d._rgba)||[],k(e.props,function(a,d){if(null!=g[d.idx])return c=g[d.idx]===j[d.idx]}));return c});return c},_space:function(){var a=[],b=this;k(l,function(c,d){b[d.cache]&&a.push(c)});return a.pop()},transition:function(a,b){var c=h(a),d=c._space(),f=l[d],e=0===this.alpha()?h("transparent"):this,j=e[f.cache]||f.to(e._rgba),g=j.slice(),c=c[f.cache]; k(f.props,function(a,d){var f=d.idx,e=j[f],h=c[f],k=t[d.type]||{};null!==h&&(null===e?g[f]=h:(k.mod&&(h-e>k.mod/2?e+=k.mod:e-h>k.mod/2&&(e-=k.mod)),g[f]=p((h-e)*b+e,d)))});return this[d](g)},blend:function(a){if(1===this._rgba[3])return this;var b=this._rgba.slice(),c=b.pop(),d=h(a)._rgba;return h(g.map(b,function(a,b){return(1-c)*d[b]+c*a}))},toRgbaString:function(){var a="rgba(",b=g.map(this._rgba,function(a,d){return null==a?2<d?1:0:a});1===b[3]&&(b.pop(),a="rgb(");return a+b.join()+")"},toHslaString:function(){var a= "hsla(",b=g.map(this.hsla(),function(a,d){null==a&&(a=2<d?1:0);d&&3>d&&(a=Math.round(100*a)+"%");return a});1===b[3]&&(b.pop(),a="hsl(");return a+b.join()+")"},toHexString:function(a){var b=this._rgba.slice(),c=b.pop();a&&b.push(~~(255*c));return"#"+g.map(b,function(a){a=(a||0).toString(16);return 1===a.length?"0"+a:a}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}});h.fn.parse.prototype=h.fn;l.hsla.to=function(a){if(null==a[0]||null==a[1]||null==a[2])return[null, null,null,a[3]];var b=a[0]/255,c=a[1]/255,d=a[2]/255;a=a[3];var f=Math.max(b,c,d),e=Math.min(b,c,d),j=f-e,g=f+e,h=0.5*g;return[Math.round(e===f?0:b===f?60*(c-d)/j+360:c===f?60*(d-b)/j+120:60*(b-c)/j+240)%360,0===j?0:0.5>=h?j/g:j/(2-g),h,null==a?1:a]};l.hsla.from=function(a){if(null==a[0]||null==a[1]||null==a[2])return[null,null,null,a[3]];var b=a[0]/360,c=a[1],d=a[2];a=a[3];c=0.5>=d?d*(1+c):d+c-d*c;d=2*d-c;return[Math.round(255*r(d,c,b+1/3)),Math.round(255*r(d,c,b)),Math.round(255*r(d,c,b-1/3)),a]}; k(l,function(a,b){var c=b.props,d=b.cache,f=b.to,e=b.from;h.fn[a]=function(a){f&&!this[d]&&(this[d]=f(this._rgba));if(a===n)return this[d].slice();var b,s=g.type(a),l="array"===s||"object"===s?a:arguments,m=this[d].slice();k(c,function(a,d){var b=l["object"===s?a:d.idx];null==b&&(b=m[d.idx]);m[d.idx]=p(b,d)});return e?(b=h(e(m)),b[d]=m,b):h(m)};k(c,function(d,b){h.fn[d]||(h.fn[d]=function(c){var e=g.type(c),f="alpha"===d?this._hsla?"hsla":"rgba":a,h=this[f](),k=h[b.idx];if("undefined"===e)return k; "function"===e&&(c=c.call(this,k),e=g.type(c));if(null==c&&b.empty)return this;"string"===e&&(e=y.exec(c))&&(c=k+parseFloat(e[2])*("+"===e[1]?1:-1));h[b.idx]=c;return this[f](h)})})});h.hook=function(a){a=a.split(" ");k(a,function(a,c){g.cssHooks[c]={set:function(a,b){var e,j="";if("transparent"!==b&&("string"!==g.type(b)||(e=u(b)))){b=h(e||b);if(!v.rgba&&1!==b._rgba[3]){for(e="backgroundColor"===c?a.parentNode:a;(""===j||"transparent"===j)&&e&&e.style;)try{j=g.css(e,"backgroundColor"),e=e.parentNode}catch(k){}b= b.blend(j&&"transparent"!==j?j:"_default")}b=b.toRgbaString()}try{a.style[c]=b}catch(l){}}};g.fx.step[c]=function(a){a.colorInit||(a.start=h(a.elem,c),a.end=h(a.end),a.colorInit=!0);g.cssHooks[c].set(a.elem,a.start.transition(a.end,a.pos))}})};h.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor");g.cssHooks.borderColor={expand:function(a){var b={};k(["Top","Right","Bottom","Left"],function(c, d){b["border"+d+"Color"]=a});return b}};q=g.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}})(jQuery);

			
jQuery(document).ready(function() {
	//TOP BAR MENU DROPDOWN
	$('#top-bar ul').ddDropDown(true);

	//SEARCH BOX
	$('#search-box').searchBox();
	//$('#search-box').ajaxSearch('#/themes/ultrasharp');				
	//gallery
	//$('.ddGallery').each(function() { jQuery(this).ddGallery(); });
	
	//replaces our select, radios and checkbox
	$('select:not(#select-preview-color)').each(function() { $(this).ddReplaceSelect(); });
	$('input[type="radio"]').each(function() { $(this).ddReplaceRadio(); });
	$('input[type="checkbox"]').each(function() { $(this).ddReplaceCheckbox(); });

    //jQuery('.image-hover').each(function() { jQuery(this).ddImageHover('.55'); });
	
});

$(window).load(function() {
	//fades out slightly on hover
	//jQuery('.ddFromTheBlog a img, .ddGallery li img, .flickr-widget img').ddFadeOnHover(.7);
	//jQuery('.post-thumb img, #related-posts img, #portfolio-slider-thumbs li img').ddFadeOnHover(.8);

});

/*jQuery(window).load(function() {
    jQuery('.tooltip').each(function() { jQuery(this).ddTooltip(); });
});*/
