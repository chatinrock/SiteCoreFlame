(function($){ 

    $.fn.extend({
		
		bpanelSelectChange: function() {
			
			jQuery(this).parent().children('.select-selected').text(jQuery(this).children('option:selected').text());
			
		},
		
		bpanelUpdateSlide: function() {
			
			//// CHECK IF ITS A NUMBER
			if(!isNaN(parseInt(jQuery(this).val()))) {
				//// CHECK IF IT'S GREATER THAN MAXIMUM
				var thisClasses = jQuery(this).attr('class').split(' ');
				var minVal = thisClasses[1].split('-');
				var maxVal = thisClasses[2].split('-');
				
				//// IF ITS GREATER THAN MAXIMUM
				if(parseInt(jQuery(this).val()) <= maxVal[1] && parseInt(jQuery(this).val()) >= minVal[1]) {
					
					var slideId = jQuery(this).parent().children('.range-slider').attr('id');
					jQuery('#'+slideId).slider('value', jQuery(this).val());
					jQuery(this).siblings('.old-val').html(parseInt(jQuery(this).val()));
					
				} else {
				
					//NAN
					bpanelError('Please select a value between '+minVal[1]+' and '+maxVal[1], jQuery(this));
					
					var oldVal = jQuery(this).siblings('.old-val').html();
					jQuery(this).val(oldVal);
					
				}
				
			} else {
				
				//NAN
				bpanelError('Please insert numbers only', jQuery(this));
				
				var oldVal = jQuery(this).siblings('.old-val').html();
				jQuery(this).val(oldVal);
				
			}
			
		},
		
		bpanelCheckReplace: function() {
			
			//// MAIN VARS
			var inputCont = this;
			var labelCont = this.parent().siblings('.field-label').children('label');
			
			//// LET'S START BY ADDING OUR CHECKBOX MARKUP
			inputCont.after('<div class="bpanel-check-wrapper"><span class="bpanel-check-handler"></span><span class="bpanel-check-active"></span></div>');
			
			//// IF CHECKBOX IS CHECKED
			var iphoneCheckCont = inputCont.siblings('.bpanel-check-wrapper');
			
			//// IF IT'S CHECKED
			if(inputCont.is(':checked')) { 
				iphoneCheckCont.children('.bpanel-check-active').show();
				iphoneCheckCont.children('.bpanel-check-handler').css({ left: '41px' });
			}
			
			//// NOW WHEN WE CLICK THE CHECK BUTTON
			iphoneCheckCont.click(function() {
				
				//// CHECK STATUS
				if(inputCont.is(':checked')) { 
				
					//// ANIMATE AND CHANGE CHECK STATUS
					iphoneCheckCont.children('.bpanel-check-active').fadeOut(200);
					iphoneCheckCont.children('.bpanel-check-handler').animate({ left: '11px' }, 150);
					inputCont.removeAttr('checked');
					
				} else {
				
					//// ANIMATE AND CHANGE CHECK STATUS
					iphoneCheckCont.children('.bpanel-check-active').fadeIn(200);
					iphoneCheckCont.children('.bpanel-check-handler').animate({ left: '41px' }, 150);
					inputCont.attr('checked', 'checked');
					
				}
				
			});
			
			//// NOW WHEN WE CLICK THE LABEL
			labelCont.click(function() {
				
				//// CHECK STATUS
				if(inputCont.is(':checked')) { 
				
					//// ANIMATE AND CHANGE CHECK STATUS
					iphoneCheckCont.children('.bpanel-check-active').fadeOut(200);
					iphoneCheckCont.children('.bpanel-check-handler').animate({ left: '11px' }, 150);
					inputCont.removeAttr('checked');
					
				} else {
				
					//// ANIMATE AND CHANGE CHECK STATUS
					iphoneCheckCont.children('.bpanel-check-active').fadeIn(200);
					iphoneCheckCont.children('.bpanel-check-handler').animate({ left: '41px' }, 150);
					inputCont.attr('checked', 'checked');
					
				}
				
			});
			
			
		}
		
	});
	
})(jQuery);

function sectionClickHandler() {
	
	//// LET"S CHECK THE STATE OF THE SECTIONS
	var iSec = 1;
	jQuery('#bpanel-sidebar > ul > li').each(function() {
		
		//// IF COOKIE ISN'T SET
		if(jQuery.cookie('bpanel_section_'+iSec) == null) {
			
			//// SET COOKIED
			if(iSec > 1) {
				if(jQuery(this).attr('class') == 'close') { jQuery.cookie('bpanel_section_'+iSec, 'close', { expires: 14 }); }
				else { jQuery.cookie('bpanel_section_'+iSec, 'open', { expires: 14 }); }
			} else { jQuery.cookie('bpanel_section_'+iSec, 'open', { expires: 14 }); }
			
		}
		
		//// CHECK COOKIE AND SET SECTION STATE
		if(jQuery.cookie('bpanel_section_'+iSec) == 'close') {
			
			jQuery(this).children('ul').hide();
			
			//// CHANGE CLASS
			jQuery(this).attr('class', 'close');
			
		} else {
			
			jQuery(this).children('ul').show();
			
			//// CHANGE CLASS
			jQuery(this).attr('class', 'open');
			
		}
		
		iSec++;
		
	});
	
	
	//// WHEN USER CLICKS A LI
	jQuery('#bpanel-sidebar > ul > li .click-area').click(function() {
		
		/// FINDS OUT WHETHER IT'S CLOSED OR OPEN
		if(jQuery(this).parent().attr('class').indexOf('open') != -1) {
			
			//// IT'S OPEN
			//// CLOSE UL
			jQuery(this).parent().children('ul').slideUp(200);
			
			//// CHANGE CLASS
			jQuery(this).parent().attr('class', 'close');
			
			//// CHANGE COOKIE
			var cookieID = parseInt(jQuery(this).parent().index())+1;
			jQuery.cookie('bpanel_section_'+cookieID, 'close', { expires: 14 });
			
		} else {
			
			//// IT'S CLOSED
			//// OPEN UL
			jQuery(this).parent().children('ul').slideDown(200);
			
			//// CHANGE CLASS
			jQuery(this).parent().attr('class', 'open');
			
			//// CHANGE COOKIE
			var cookieID = parseInt(jQuery(this).parent().index())+1;
			jQuery.cookie('bpanel_section_'+cookieID, 'open', { expires: 14 });
			
		}
		
	});
	
}

function bpanelInit() {
	
	//// LET'S OPEN THE FIRST SECTION AND ADD THE CURRENT TO THE FIRST TAB
	jQuery('#bpanel-sidebar > ul > li:first > ul:first > li:first').addClass('current');
	
	//// LET'S FIX OUR LAYOUT
	var totalAreaHeight = (jQuery('#wpwrap').outerHeight() - jQuery('#wpadminbar').outerHeight() - jQuery('#footer').outerHeight() - jQuery('#bpanel-header').outerHeight());
	jQuery('#bpanel-sidebar').css({ height: totalAreaHeight+'px' });
	
	var wrapperWidth = jQuery('#bpanel-body').width();
	jQuery('#bpanel-content').css({ width: (wrapperWidth - 231)+'px' });
	jQuery(window).resize(function() {
		
			var wrapperWidth = jQuery('#bpanel-body').width();
			jQuery('#bpanel-content').css({ width: (wrapperWidth - 231)+'px' });	
		
	});
	
	//// SHOW FIRST SECTION
	//openbpanelTab(0);
	jQuery('#bpanel-tabs > li:first').css({ display: 'block', opacity: '0' });
	jQuery('#bpanel-tabs').css({ height: jQuery('#bpanel-tabs > li:first').outerHeight()+'px' });
	jQuery('#bpanel-tabs > li:first').addClass('current').animate({ opacity: 1 }, 150);
	
	//// WHEN USER CLICKS A TAB
	jQuery('#bpanel-sidebar > ul li li').click(function() {
		
		//// LET'S FIND OUT THE INDEX OF THIS LI
		var finalIndex = 0;
		var parentIndex = jQuery(this).parent().parent().index();
		var relativeIndex = jQuery(this).index();
		var currentUlIndex = 0;
		jQuery('#bpanel-sidebar > ul > li').each(function() {
			
			/// LET'S LOOP THIS UL's LIs
			var thisUl = jQuery(this);
			jQuery(this).children('ul').children('li').each(function() {
				
				//// IF ITS THIS UL AND THIS LI WE BREAK THE LOOP
				if(currentUlIndex == parentIndex && jQuery(this).index() == relativeIndex) { return false; }
				finalIndex++;
				
			});
			
			if(currentUlIndex == parentIndex) { return false; }
			currentUlIndex++;
			
		});
		
		//// CALL OUR TAB
		if(jQuery(this).attr('class').indexOf('current') == -1) { openbpanelTab(finalIndex); }
		
		//// ADDS THE CURRENT STATE TO OUR LI
		jQuery('#bpanel-sidebar > ul li ul').find('li.current').removeClass('current');
		jQuery(this).addClass('current');
		jQuery('#tab-info').html(jQuery(this).children('.tab-info').text() + '<div class="clear"></div>');
		
	});
	
	
}

function openbpanelTab(liIndex) {
	
	//// LET'S GET THE WIDTH OF THE OUR WRAPPER
	var wrapperWidth = jQuery('#bpanel-wrapper').width();
	var infoCont = jQuery('#tab-info');
	
	//// LET'S SET THE CSS OF OUR NEW CURRENT TAB AND THE HEIGHT OF OUR CONTAINER
	jQuery('#bpanel-tabs').css({ overflow: 'hidden' });
	jQuery('#bpanel-tabs li:eq('+liIndex+')').addClass('current-next').css({ display: 'block', left: wrapperWidth+'px', position: 'absolute' });
	jQuery('#bpanel-tabs').animate({ height: jQuery('#bpanel-tabs li:eq('+liIndex+')').outerHeight()+'px' }, 200);
	jQuery('#bpanel-tabs li:eq('+liIndex+')').animate({ left: 0 }, 250, function() {
		
		jQuery('#bpanel-tabs > .current').hide().removeClass('current');
		jQuery(this).attr('class', 'current').css({ position: 'relative' });
		jQuery('#bpanel-tabs').css({ overflow: 'visible' });
		
	});
	
}

function descriptionDelimiters() {
	
	jQuery('.field-desc').each(function() {
		
		if(jQuery(this).children('.full-desc').text().length > 45) {
		
		var thisFullDesc= jQuery(this).children('.full-desc').text();
		
		jQuery(this).children('.short-desc').html(thisFullDesc.substr(0, 45)+'... — <span class="desc-more">more</span>');
		
		jQuery(this).click(function() {
			
			// IF SHORT IS OPEN
			if(jQuery(this).children('.short-desc').css('display') == 'inline' || jQuery(this).children('.short-desc').css('display') == 'block') {
				
				jQuery(this).children('.short-desc').hide();
				jQuery(this).children('.full-desc').show();
				
			} else {
				
				jQuery(this).children('.short-desc').show();
				jQuery(this).children('.full-desc').hide();
				
			}
			
			//// FIXES UL HEIGHT
			jQuery('#bpanel-tabs').css({ height: jQuery(this).parent().parent().outerHeight() })
			
		});
		
		} else {jQuery(this).children('.full-desc').show();  }
		
	});
	
}

function bpanelSelectReplacers(){
	
	jQuery('.select-field').each(function() {
		
		var curCont = jQuery(this).children('.field-input').children('.select-selected');
		var selCont = jQuery(this).children('.field-input').children('select');
		var selOption = jQuery(this).children('.field-input').children('select').children('option:selected');
		
		//// LET'S UPDATE THE SELECTED CONTAINER
		curCont.text(selOption.text());
		
		//// SHOW THE SELECT OVER IT
		selCont.css({ display: 'block', opacity: 0, height: '30px', top: 0 });
		
		/// WHEN WE CLICK THE SELECTED CONTAINER, SIMULATE CLICK ON SELEC
		curCont.click(function() { selCont.mousedown(); });
		
	});
	
}

function bpanelImageFieldHover() {
	
	jQuery('.image-field').each(function() {
		
		jQuery(this).children('.field-input').children('input').hover(function() {
			
			//// UPDATES THE SRC IN THE TOOLTIP
			var fieldImage = jQuery(this).parent().children('input').val();
			jQuery(this).parent().children('.image-tooltip').children('img').attr('src', fieldImage);
			jQuery(this).parent().children('.image-tooltip').fadeIn(150);
			
		}, function() {
			
			jQuery(this).parent().children('.image-tooltip').fadeOut(150);
			
		});
		
	});
	
}

function bpanelColorPicker() {
	
	jQuery('.color-input-picker').each(function() {
		
		/// vars
		var pickerBtn = jQuery(this).siblings('.color-input-picker-button');
		var pickerCont = jQuery(this);
		var inputCont = jQuery(this).siblings('input');
		var previewCont = jQuery(this).siblings('.color-input-preview');
		
		//// WHEN WE CLICK BUTTON
		pickerBtn.click(function() {
			
			//// IF IT'S HIDDEN
			if(pickerCont.css('display') == 'none') {
				
				pickerCont.fadeIn(200);
				
			} else {
				
				pickerCont.fadeOut(200);
				
			}
			
		});
		
		jQuery(this).farbtastic(function(color) {
			
			inputCont.val(color.toUpperCase());
			previewCont.css({ 'background-color': color });
			
		});
		
		inputCont.change(function() {
			
			previewCont.css({ 'background-color': inputCont.val() });
			
		});
		
	});	
	
}

function colorPickerChange(color) {
	
	
}

function bpanelError(message, fieldId) {
	
	jQuery('#bpanel-error').html('<span></span>'+message).slideDown(150);
	fieldId.parent().append('<span class="bpanel-error-pop-up"></span>');
	fieldId.siblings('.bpanel-error-pop-up').fadeIn(200);
	
	errorMessageFadeOut = setTimeout(function() {
		
		jQuery('#bpanel-error').slideUp(150);
		
	}, 5000);
	
	errorPopUpMessageFadeOut = setTimeout(function() {
		
		fieldId.siblings('.bpanel-error-pop-up').fadeOut(200, function() { jQuery(this).remove(); });
		
	}, 8000);
	
}

function bpanelInfo(message) {
	
	jQuery('#bpanel-info').html('<span></span>'+message).slideDown(150);
	
	errorMessageFadeOut = setTimeout(function() {
		
		jQuery('#bpanel-info').slideUp(150);
		
	}, 5000);
	
}


/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function(jQuery) {
    jQuery.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = jQuery.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);