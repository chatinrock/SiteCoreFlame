(function($){ 

    $.fn.extend({
		
		ddDropDown: function(anim) {
			
			//main vars
			var mainCont = this;
			
			//when user hovers a li
			mainCont.children('li').hover(function() {
				
				//finds the next ul and either shows or animates it
				if(anim == true && jQuery(this).children('ul:first').length > 0) {
					
					//animates and adds the hovered class
					jQuery(this).addClass('hovered').find('ul:first').fadeIn(150);
					
				} else if(jQuery(this).children('ul:first').length > 0) {
					
					//shows and adds the hovered class
					jQuery(this).addClass('hovered').find('ul:first').show();
					
				}
				
			}, function() {
				
				//fades out the dropdown
				if(anim == true && jQuery(this).children('ul:first').length > 0) {
					
					//animates and adds the hovered class
					jQuery(this).find('ul:first').fadeOut(100, function() {
						
						//removes hovered class
						jQuery(this).parent().removeClass('hovered');
						
					});
					
				} else if(jQuery(this).children('ul:first').length > 0) {
					
					//shows and adds the hovered class
					jQuery(this).removeClass('hovered').find('ul:first').hide();
					
				}
				
			});
			
		},
		
		searchBox: function() {
			
			//main vars
			var mainCont = this;
			searchHover = 0;
			
			//when user hovers it
			mainCont.hover(function() {
				
				//open up search box
				mainCont.find('.pop-up').fadeIn(150);
				searchHover = 1;
				
			}, function() {
				
				
				//hides it only if we're not focusing the field
				if(mainCont.find('#s-input').is(':focus')) {
					
					mainCont.find('#s-input').focusout(function() {
						
						mainCont.find('.pop-up').fadeOut(100);
						jQuery('#ajax-search').fadeOut(100);
						
					});
					
				} else {
					
					mainCont.find('.pop-up').fadeOut(100);
					jQuery('#ajax-search').hide();
					searchHover = 0;
				
				}
				
			});
			
			//in case out user clicks the search input
			jQuery('#s-input').stretchInput();
			
		},
		
		ajaxSearch: function(formURL) {
			
			//// OUR MAIN VARIABLES
			var maincont = this;
			var inputcont = this.find('#s-input');
			var resultscont = this.find('#ajax-search');
			
			//// WHEN USER FOCUS ON THE FIELD
			inputcont.keyup(function(e) {
				
				//// IF OUR GLOBAL IS SET WE NEED TO ABORT THE ONGOING REQUESTS.
				if(typeof searchAjaxGlobal != 'undefined') { searchAjaxGlobal.abort(); }
				
				//// ONLY IF USER HAS CLICKED AN ALPHABETICAL KEY
				if(	e.which == 32 ||
					e.which == 8 ||
					e.which == 48 ||
					e.which == 49 ||
					e.which == 96 ||
					e.which == 106 ||
					(e.which >= 50 && e.which <= 57) || 
					(e.which >= 65 && e.which <= 90) || 
					(e.which >= 186 && e.which <= 192) || 
					(e.which >= 219 && e.which <= 222)) {
						
					//// LET'S PUT OUR LOADING UP
					resultscont.show();
					resultscont.html('<div id="search-loading"></div>');
					
					//// OUR SEARCH STRING
					var searchString = inputcont.val();
					
					//// IF OUR STRING ISN'T EMPTY
					if(searchString != '') {
					
						//// NOW LET'S START OUR AJAX REQUEST
						searchAjaxGlobal = jQuery.ajax({
							
							type:		'POST',
							url: 		formURL+'/includes/backend/php/ajax-search.php',
							dataType: 	'json',
							data: {
								
								postSearchString: searchString
								
							},
							success: function(data) {
								
								//// IF OUR RESULTS COUNT IS MORE THAN 0, DISPLAY RESULTS
								if(data.count > 0) {
									
									resultscont.html(data.output);
									resultscont.show();
									
								} else {
									
									resultscont.html('<span class="no-results">No results found.</span>');
									
								}
								
							}
							
						});
						
					} else {
						
						resultscont.hide();
						
					}
					
				}
				
			});
			
		},
		
		stretchInput: function() {
			
			//main vars
			var mainCont = this.parent().parent();
			var inputCont = this;
			
			//when user focuses on it
			inputCont.focus(function() {
				
				inputCont.stop().animate({ width: 180+'px' }, 150);
				mainCont.stop().animate({ width: 284+'px' }, 150);
				
			});
			
		},
		
		mainBar: function(colorTo) {
			
			//main vars
			var ulCont = this.children('ul');
			var logoCont = this.children('#logo');
			var ulWidth = ulCont.width();
			var logoWidth = logoCont.width();
			
			//animates our menu so it stays full width
			/// IF FULL MENU
			if(ulCont.attr('class') == 'left') {
				
				var newPadding = (980 - (ulWidth + logoWidth)) + 19;
				logoCont.children('a').animate({ 'padding-left': newPadding+'px' }, 250);
				
			} else {
				
				//// LETS CALCULATE THE SIZE OF THE LOGO
				var logoWidth = jQuery('#logo-float').width();
				var newPadding = (980 - (ulWidth + (logoWidth+25)));
				jQuery('#complete-main-bar-menu').children('a').animate({ 'padding-left': newPadding+'px' }, 250);
				
			}
			
			//when user hovers Menu
			ulCont.children('li').hover(function() {
				
				jQuery(this).stop().animate({ backgroundColor: '#'+colorTo }, 100, function() {
					
					//sees if we find any submenus
					jQuery(this).find('ul:first').fadeIn(200, function() {
						
						jQuery(this).children('li').hover(function() { jQuery(this).find('ul:first').fadeIn(200); }, function() { jQuery(this).find('ul:first').fadeOut(200) });
						
					});
					
				});
				
			}, function() {
				jQuery(this).find('ul:first').fadeOut(200);
				jQuery(this).stop().animate({ backgroundColor: 'transparent' }, 200);
				
			});
			
			//when user hovers Logo
			jQuery('#logo').hover(function() {
				
				jQuery(this).stop().animate({ backgroundColor: '#'+colorTo }, 100);
				
			}, function() {
				
				jQuery(this).stop().animate({ 'backgroundColor': 'transparent' }, 200);
				
			});
			
		},
		
		ddUltraSharpSlider: function(waitTime) {
			
			//main vars
			var mainCont = this;
			var sliderCont = jQuery('#slider-content');
			var selCont = jQuery('#slider-selector');
			ultraSharpPlaying = 0;
			
			//sets up the Ids for our slide and adds it to the selector
			var i = 1;
			sliderCont.children('li').each(function() {
				
				//adds a unique id
				jQuery(this).attr('id', 'slide_'+i);
				
				//adds the selector for it
				selCont.append('<li id="sel_'+i+'"></li>');
				
				i++;
				
			});
			
			//sets up our first slide
			sliderCont.children('li:first').addClass('current').css({ opacity: 0 }).animate({ opacity: 1 }, 500);
			selCont.children('li:first').addClass('current');
			
			//shows our slider and selector
			sliderCont.removeClass('loading');
			selCont.fadeIn(500);
			
			//if its not playing
				
			var thisInt = setInterval(function() {
				
				if(ultraSharpPlaying === 0) { mainCont.nextUltraSharpSlider(); }
				
			}, waitTime);
			
			
				
			selCont.children('li').click(function() {
			
				//if it's not the current one
				if(jQuery(this).attr('class') == undefined || jQuery(this).attr('class') == '') {
					
					//gets selector ID
					var clickedID = jQuery(this).attr('id').split('_');
					 if(ultraSharpPlaying === 0) { mainCont.callUltraSharpSlider(clickedID[1]); }
					
				}
				
			});
			
		},
		
		nextUltraSharpSlider: function() {
			
			//main vars
			ultraSharpPlaying = 1;
			var mainCont = this;
			var sliderCont = jQuery('#slider-content');
			var selCont = jQuery('#slider-selector');
			
			var currentSlide = sliderCont.children('li.current');
			var nextSlide = sliderCont.children('li.current').next();
			
			if(nextSlide.length > 0) {  } else { var nextSlide = sliderCont.children('li:first'); }
			
			var nextSlideId = nextSlide.attr('id').split('_');
			
			//plays the next slide
			selCont.children('li.current').removeClass('current');
			selCont.children('li#sel_'+nextSlideId[1]).addClass('current');
			nextSlide.addClass('nextSlide').css({ opacity: 0 }).animate({ opacity: 1 }, 400, function() {
				
				//removes current
				currentSlide.removeClass('current');
				nextSlide.removeClass('nextSlide').addClass('current');
				ultraSharpPlaying = 0;
				
			});
			
		},
		
		callUltraSharpSlider: function(id) {
			
			//main vars
			ultraSharpPlaying = 1;
			var mainCont = this;
			var sliderCont = jQuery('#slider-content');
			var selCont = jQuery('#slider-selector');
			
			var currentSlide = sliderCont.children('li.current');
			var nextSlide = sliderCont.children('li#slide_'+id);
			
			var nextSlideId = nextSlide.attr('id').split('_');
			
			//plays the next slide
			selCont.children('li.current').removeClass('current');
			selCont.children('li#sel_'+nextSlideId[1]).addClass('current');
			nextSlide.addClass('nextSlide').css({ opacity: 0 }).animate({ opacity: 1 }, 400, function() {
				
				//removes current
				currentSlide.removeClass('current');
				nextSlide.removeClass('nextSlide').addClass('current');
				ultraSharpPlaying = 0;
				
			});
			
		},
		
		ddGallery: function() {
			
			//main vars
			var wrapCont = this;
			var mainCont = this.children('.ddGallery-full');
			var listCont = this.children('.ddGallery-list');
			isGalleryplaying = 0;
			
			//loads our thumbs
			listCont.children('li').each(function() {
				
				//this lis image url
				var thisImage = jQuery(this).children('span.thumb').text();
				var thisLi = jQuery(this);
				
				//creates oru thumb object
				var thisThumb = new Image();
				jQuery(thisThumb).attr('src', thisImage);
				
				//loads our image
				jQuery(thisThumb).load(function(e) {
					
					//appends the image to the li
					thisLi.append(jQuery(this));
					
					//fades it In
					thisLi.children('img').fadeIn(500, function() {
						
						//removes loading
						jQuery(this).parent().removeClass('loading');
						
					});
					
				});
				
			});
			
			//loads first big image
			wrapCont.ddGalleryCall(0);
			listCont.children('li:eq(0)').addClass('current');
			
			//when suers clicks a gallery
			listCont.children('li').click(function() {
				
				//if gallery isn't playing
				if(isGalleryPlaying === 0) {
					
					isGalleryPlaying = 1;
					var clickedItem = jQuery(this).index();
					listCont.children('li.current').removeClass('current');
					jQuery(this).addClass('current');
					
					//removes current content
					mainCont.addClass('loading');
					mainCont.children('a').children('img').fadeOut(400, function() {
						
						mainCont.children('a').children('img').remove();
						wrapCont.ddGalleryCall(clickedItem);
						
					});
				
				}
				
			});
			
			//hover effect
			listCont.children('li').hover(function() {
				
				jQuery(this).children('img').stop().animate({ opacity: .7 }, 200);
				
			}, function() {
				
				jQuery(this).children('img').stop().animate({ opacity: 1 }, 200);
				
			});
			
			mainCont.children('a').hover(function() {
				
				if(isGalleryPlaying === 0) {
				
					//fades it out and shows title
					jQuery(this).children('h4').css({ opacity: 0, display: 'block' }).stop().animate({ opacity: 1 }, 300);
					jQuery(this).children('img').stop().animate({ opacity: .1 }, 300);
				
				}
				
			}, function() {
				
				//fades it out and shows title
				jQuery(this).children('h4').stop().animate({ opacity:0 }, 300, function() { jQuery(this).hide(); });
				jQuery(this).children('img').stop().animate({ opacity: 1 }, 300);
				
			});
			
		},
		
		ddGalleryCall: function(liIndex) {
			
			//main vars
			var wrapCont = this;
			var mainCont = this.children('.ddGallery-full');
			var listCont = this.children('.ddGallery-list');
			var titleCont = mainCont.children('a').children('h4').children('span');
			
			//removes current class and adds it to the clicked item
			var newCurrent = listCont.children('li:eq('+liIndex+')');
			
			//creates full image  object
			var fullImage = new Image();
			jQuery(fullImage).attr('src', newCurrent.children('span.full').text());
			
			//lighboxlink
			var fullLink = newCurrent.children('span.link').text();
			if(fullLink == '') { fullLink = '#'; }
			var itemTitle = newCurrent.children('span.title').text();
			
			jQuery(fullImage).load(function() {
				
				mainCont.removeClass('loading');
				
				//appends image to the full thing
				mainCont.children('a').attr('href', fullLink).attr('title', itemTitle).append(jQuery(this));;
				
				//updates our image title
				titleCont.text(itemTitle);
				
				//fades image In
				mainCont.children('a').children('img').fadeIn(500, function() { isGalleryPlaying = 0; })
				
			});
			
			
		},
		
		ddTwitterBar: function(waitTime) {
			
			//main vars
			var mainCont = this;
			var ulCont = this.children('ul');
			
			//sets up first item
			ulCont.children('li:first').addClass('current').fadeIn(300);
			
			var twitterInt = setInterval(function() {
				
				//finds next
				var nextFeed = ulCont.children('li.current').next();
				if(nextFeed.length > 0) {  } else { var nextFeed = ulCont.children('li:first').next(); }
				
				//fades out current
				ulCont.children('li.current').removeClass('current').animate({ top: 70+'px' }, 300, function() { jQuery(this).hide(); });
				nextFeed.addClass('current').css({ top: '-70px', display: 'block' }).animate({ top: 0 }, 300);
				
				
			}, waitTime);
			
		},
		
		ddPreloadImage: function() {
			
			//main vars
			var mainCont = this;
			var imageUrl = mainCont.children('span').text();
			
			//creates image object
			var newImage = new Image();
			jQuery(newImage).attr('src', imageUrl);
			
			//loads image
			jQuery(newImage).load(function() {
				
				//apprends image
				mainCont.append(jQuery(this));
				
				//removes span and fades image in
				mainCont.children('span').remove();
				mainCont.children('img').fadeIn(500, function() {
					
					mainCont.removeClass('imagePreload');
					
				});
				
			});
			
		},
		
		fullWidthSlider: function() {
			
			//main vars
			var mainCont = this;
			
			///centers it
			mainCont.centerFullWidthSlide();
			
			/// IN CASE OF RESIE
			jQuery(window).resize(function() { mainCont.centerFullWidthSlide(); });
			
		},
		
		centerFullWidthSlide: function() {
			
			//main vars
			var mainCont = this;
			var ulCont = this.children('ul');
			
			/// CENTERS THE BG-BOX DIV
			ulCont.children('li').each(function() {
				
				/// OUR BG BOX DIV
				var thisChildDiv = jQuery(this).children('div.bg-box');
				
				/// IF IT EXISTS
				if(thisChildDiv.length > 0) {
					
					/// CENTERS IT
					var divWidth = thisChildDiv.width();
					if(divWidth >= jQuery(window).width()) { var newLeft = ((divWidth - jQuery(window).width()) / 2); }	
					else { var newLeft = ((jQuery(window).width() - divWidth) / 2); }
					
					/// UPDATES THE CSS
					thisChildDiv.css({ left: newLeft+'px' });
					
				}
				
			});
			
		},
		
		scrollToTop: function(duration) {
			
			this.click(function() {
				
				jQuery('html, body').stop().animate({ scrollTop: 0 }, duration);
				
			});
			
		},
		
		ddReplaceSelect: function() {
			
			//main var
			var mainCont = this;
			var selectedContent = mainCont.children('option:selected').val();
			mainCont.css({ opacity: 0 }).wrap(function() {
				
				return '<span class="select-container"></span>';
				
			});
			mainCont.after('<span>'+selectedContent+'<span></span></span>');
			var parentCont = mainCont.parent();
			
			//when select changes
			mainCont.change(function() {
				
				//updates outer container
				var newSelectedItem = mainCont.children('option:selected').val();
				parentCont.children('span').html(newSelectedItem+'<span></span>');
				
			});
			
		},
		
		ddReplaceRadio: function() {
			
			//main vars
			var mainCont = this;
			var nameAttr = this.attr('name');
			
			//hides it
			mainCont.hide();
			if(this.is(':checked')) {
				
				mainCont.wrap(function() { return '<span class="radio-container radio-checked" title="'+nameAttr+'"></span>'; });
				
			} else {
				
				mainCont.wrap(function() { return '<span class="radio-container" title="'+nameAttr+'"></span>'; });
				
			}
			
			//when user clicks it
			mainCont.parent().click(function() {
				
				//make all unchecked
				jQuery('span[title="'+nameAttr+'"]').each(function() {
					
					jQuery(this).children('input').removeAttr('checked');
					
				});
				
				//checks the clicked
				jQuery(this).children('input').attr('checked', 'checked');
				
				//redoes the checked containers
				
				//make all unchecked
				jQuery('span[title="'+nameAttr+'"]').each(function() {
				
					if(jQuery(this).children('input').is(':checked')) {
						
						jQuery(this).addClass('radio-checked');
						
					} else {
						
						jQuery(this).removeClass('radio-checked')
						
					}
					
				});
				
			});
			
		},
		
		ddReplaceCheckbox: function() {
			
			//main vars
			var mainCont = this;
			var nameAttr = this.attr('name');
			
			//hides it
			mainCont.hide();
			if(this.is(':checked')) {
				
				mainCont.wrap(function() { return '<span class="check-container check-checked" title="'+nameAttr+'"></span>'; });
				
			} else {
				
				mainCont.wrap(function() { return '<span class="check-container" title="'+nameAttr+'"></span>'; });
				
			}
			
			//when user clicks it
			mainCont.parent().click(function() {
				
				if(jQuery(this).children('input').is(':checked')) {
					
					jQuery(this).children('input').removeAttr('checked');
					jQuery(this).removeClass('check-checked');
					
				} else {
					
					jQuery(this).children('input').attr('checked', 'checked');
					jQuery(this).addClass('check-checked');
					
				}
				
			});
			
		},
		
		ddPortfolioSlider: function() {
			
			//// MAIN VARS
			var maincont = this;
			var mainImage = this.children('#portfolio-slider-main').children('a');
			var thumbscont = this.children('ul');
			
			//// NOW WE CALL THE FIRST THUMBNAIL
			var nextSlide = thumbscont.children('li:first');
			
			maincont.ddPortfolioSliderCallSlide(nextSlide);
			
			//// WHEN THE USER CLICKS AN ITEM
			thumbscont.children('li').click(function() {
				
				//// CHECK TO SEE IF IT HAS A CURRENT CLASS
				if(jQuery(this).attr('class').indexOf('current') == -1) {
					
					//// LOADS THE NEW IMAGE
					maincont.ddPortfolioSliderCallSlide(jQuery(this));
					
				}
				
			});
			
		},
		
		ddPortfolioSliderCallSlide: function(nextSlide) {
			
			
			//// MAIN VARS
			var maincont = this;
			var mainImage = this.children('#portfolio-slider-main').children('a');
			var thumbscont = this.children('ul');
			
			//// LET'S FADEOUT ANY IMAGES THAT ARE ALREADY THERE
			mainImage.children('img').fadeOut(200, function() {
				
				jQuery(this).remove();
			
				//// ADDS THE CURRENT TO THE ITEM
				thumbscont.children('.current').removeClass('current');
				nextSlide.addClass('current');
				
				//// LET'S LOAD THE IMAGE
				var fullImage = nextSlide.children('.portfolio-slider-full').text();
				var linkImage = nextSlide.children('.portfolio-slider-lightbox').text();
				
				//// IMAGE ATTRIBUTES
				var newSlideImage = new Image();
				jQuery(newSlideImage).attr('src', fullImage);
				
				//// LOADS THE IMAGE
				jQuery(newSlideImage).load(function() {
					
					//// LET'S APPEND IT AND FIND OUT THE HEIGHT OF THE IMAGE
					mainImage.attr('href', linkImage).append(newSlideImage);
					mainImage.children('img').css({ display: 'block', opacity: 0 });
					var imageHeight = mainImage.children('img').height();
					
					//// NOW WE ANIMATE THE CONTAINER TO FIT THE IMAGE
					mainImage.stop().animate({ height: imageHeight+'px' }, 200, function() {
						
						//// FADES IN THE IMAGE
						mainImage.children('img').stop().animate({ opacity: 1 }, 200, function() {
							
							//// REMOVESTHE LOADING
							//mainImage.removeClass('loading');
							
						});
						
					});
				
				});
				
			});
			
		},
		
		ddPortfolioPostSlider: function() {
			
			//main vars
			portfolioPostSlidePlaying = 0;
			var maincont = this;
			var ulcont = this.children('ul.main-image');
			
			//shows our first image and removes loading gif
			ulcont.children('li:first').addClass('currentImage').fadeIn(250);
			
			//IF IT HAS MORE THAN ONE IMAGE, ACTIVATE SLIDER
			maincont.hover(function() {
				
				if(ulcont.children('li:not(.inner-shadow)').length > 1 && portfolioPostSlidePlaying === 0) {
					
					//// PLAYS THE FIRST ON HOVER
					var currentimage = ulcont.children('li.currentImage');
					var nextimage = ulcont.children('li.currentImage').next(':not(.inner-shadow)');
					if(nextimage.length > 0) {  } else { nextimage = ulcont.children('li:first'); }
					
					//fades out currentimage
					currentimage.removeClass('currentImage').fadeOut(300);
					nextimage.addClass('currentImage').fadeIn(200);
						
					portfolioPostSlidePlaying = 1;
					
					thisPortfolioInterval = setInterval(function() {
						
						//let's get next image
						var currentimage = ulcont.children('li.currentImage');
						var nextimage = ulcont.children('li.currentImage').next(':not(.inner-shadow)');
						if(nextimage.length > 0) {  } else { nextimage = ulcont.children('li:first'); }
						
						//fades out currentimage
						currentimage.removeClass('currentImage').fadeOut(300);
						nextimage.addClass('currentImage').fadeIn(200);
						
					}, 2000);
					
				}
				
			}, function() {
				
				clearInterval(thisPortfolioInterval);
				
				//check the current image and sees if it's the first
				var currentIndex = ulcont.children('li.currentImage').index();
				if(currentIndex > 0) {
					
					var currentimage = ulcont.children('li.currentImage');
					var nextimage = ulcont.children('li:first');
						
					//fades out currentimage
					currentimage.removeClass('currentImage').fadeOut(300);
					nextimage.addClass('currentImage').fadeIn(200);
					
				}
					
				portfolioPostSlidePlaying = 0;
				
			});
			
		},
		
		showCategoryDropdown: function() {
			
			//main vars
			var maincont = this.parent();
			var selectedcont = this;
			var ulcont = maincont.children('ul');
			
			//// LET'S FIND OUT WHETHER IT'S OPEN OR CLOSED
			//// IT'S CLOSED
			if(ulcont.css('display') == 'none') {
				
				//// REMOVES THE ARROW
				selectedcont.children('span').removeClass('open');
				
				//// SHOWS OUR UL
				ulcont.slideDown(100);
				
			} else {
				
				//// ADDS THE ARROW
				selectedcont.children('span').addClass('open');
				
				//// HIDES OUR UL
				ulcont.slideUp(100);
				
			}
			
			/// LET'S ADD THE CLICK EVENT FOR OUR MENU
			ulcont.find('a').click(function() {
				
				//// LET'S HIDE THE UL AND CHANGE THE SELECTED TEXT
				var selText = jQuery(this).text();
				selectedcont.text(selText);
				
				//// ADDS THE ARROW
				selectedcont.append('<span class="open"></span>');
				
				//// HIDES OUR UL
				ulcont.slideUp(100);
				
			});
			
			//// LET'S ALSO ADD THE UNHOVER EVENT
			maincont.hover(function() {  }, function() {
				
				//// ADDS THE ARROW
				selectedcont.append('<span class="open"></span>');
				
				//// HIDES OUR UL
				ulcont.slideUp(100);
				
			});
			
		},
		
		tabbedPosts: function() {
			
			// main vars
			var maincont = this;
			var tabscont = this.children('.tabbed-posts-tabs');
			var tabbedcont = this.children('.tabbed-posts-tabbed');
			isTabbedPlaying = 0;
			
			// LET'S SET THE FIRST ONE AS INITIAL AND REMOVE THE LAST BORDERS
			tabscont.children('li:first').addClass('current');
			tabbedcont.children('li:first').addClass('current');
			tabbedcont.children('li').each(function() { jQuery(this).children('ul').children('li:last').children('a').css({ 'border-bottom': 'none' }); });
			
			// when user clicks a tab
			tabscont.children('li').click(function() {
				
				//// CHECK IF ITS NOT CURRENT
				if(jQuery(this).attr('class').indexOf('current') == -1 && isTabbedPlaying === 0) {
					
					// LET'S FADE OUT THE CURRENT ONE AND FADE IN THE NEW ONE
					isTabbedPlaying = 1;
					
					var thisIndex = jQuery(this).index();
					
					/// CHANGES CURRENT TAB
					tabscont.children('li.current').removeClass('current');
					jQuery(this).addClass('current');
					
					//// FADES OUT AND FADES IN TAB
					tabbedcont.children('li.current').fadeOut(200, function() {
						
						jQuery(this).removeClass('current');
						tabbedcont.children('li:eq('+thisIndex+')').fadeIn(200, function() {
							
							jQuery(this).addClass('current');
							isTabbedPlaying = 0;
							
						});
						
					});
					
					
				}
				
			});
			
		}
		
	});
	
})(jQuery);