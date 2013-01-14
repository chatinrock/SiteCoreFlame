(function($) {
$.fn.scrollbar = function( parameters ){


	//SCROLL TYPE
	var type = "scrollbar"; //scrollbar || mousePosition || dragAndDrop
	
	//ALL
	var heightPar = 300;
	var widthPar = "auto";
	var scrollerEase = 7;
	var downBtnBool = false;
	var downBtn;
	var downBtnActive = true;
	
	var upBtnBool = false;
	var upBtn;
	var upBtnActive = true;
	
	var topBtnBool = false;
	var topBtn;
	var topBtnActive = true;
	
	var leftBtnBool = false;
	var leftBtn;
	var leftBtnActive = true;
	
	var rightBtnBool = false;
	var rightBtn;
	var rightBtnActive = true;
	
	var buttonsDisabledAlpha = 0.4;
	var buttonsScrollSpeed = 10;
	
	var dragVertical = true;
	var dragHorizontal = true;
	
	//EXCLUSIVE SCROLLBAR PARAMETERS
	var barWidth = 10;
	var draggerVerticalSize = "auto";
	var draggerHorizontalSize = "auto";
	var roundCorners = 0;
	var distanceFromBar = 5;
	var mouseWheel = true;
	var mouseWheelOrientation = "vertical";
	var mouseWheelSpeed = 13;
	var draggerColor = "#111111";
	var draggerOverColor = "#a1dc13";
	var barColor = "#E6E6E6";
	var barOverColor = "#CCCCCC";
	
	//EXCLUSIVE MOUSE POSITION PARAMETERS
	var lockToPosition = false;
	var lockToAlignVertical = "middle"; //middle || top || bottom
	var lockToAlignHorizontal = "middle"; //middle || top || bottom
	var topAndBottomSpace = 20;
	var leftAndRightSpace = 20;

	//EXCLUSIVE DRAG AND DROP PARAMETERS
	
	//PARSE PARAMETERS
	if ( parameters.type != undefined )
		type = parameters.type;
		
	if ( parameters.height != undefined )
		heightPar = parameters.height;
	if ( parameters.width != undefined )
		widthPar = parameters.width;
	if ( parameters.scrollerEase != undefined )
		scrollerEase = parameters.scrollerEase;
	if ( parameters.downBtn != undefined){
		downBtnBool = true;
		downBtn = parameters.downBtn;	
	}
	if (parameters.upBtn != undefined){
		upBtnBool = true;
		upBtn = parameters.upBtn;
	}
	if (parameters.topBtn != undefined){
		topBtnBool = true;
		topBtn = parameters.topBtn;
	}
	if (parameters.rightBtn != undefined){
		rightBtnBool = true;
		rightBtn = parameters.rightBtn;
	}
	if (parameters.leftBtn != undefined){
		leftBtnBool = true;
		leftBtn = parameters.leftBtn;
	}
	if ( parameters.dragVertical != undefined )
		dragVertical = parameters.dragVertical;
	if ( parameters.dragHorizontal != undefined )
		dragHorizontal = parameters.dragHorizontal;
	if ( parameters.buttonsDisabledAlpha != undefined )
		buttonsDisabledAlpha = parameters.buttonsDisabledAlpha;
	if ( parameters.buttonsScrollSpeed != undefined )
		buttonsScrollSpeed = parameters.buttonsScrollSpeed;
	if ( parameters.barWidth != undefined )
		barWidth = parameters.barWidth;
	if ( parameters.draggerVerticalSize != undefined )
		draggerVerticalSize = parameters.draggerVerticalSize;
	if ( parameters.roundCorners != undefined )
		roundCorners = parameters.roundCorners;
	if ( parameters.distanceFromBar != undefined )
		distanceFromBar = parameters.distanceFromBar;
	if ( parameters.mouseWheel != undefined )
		mouseWheel = parameters.mouseWheel;
	if ( parameters.mouseWheelOrientation != undefined )
		mouseWheelOrientation = parameters.mouseWheelOrientation;
	if ( parameters.mouseWheelSpeed != undefined )
		mouseWheelSpeed = parameters.mouseWheelSpeed;
	if ( parameters.draggerColor != undefined )
		draggerColor = parameters.draggerColor;
	if ( parameters.draggerOverColor != undefined )
		draggerOverColor = parameters.draggerOverColor;
	if ( parameters.barColor != undefined )
		barColor = parameters.barColor;
	if ( parameters.barOverColor != undefined )
		barOverColor = parameters.barOverColor;
		
	if ( parameters.lockToPosition != undefined )
		lockToPosition = parameters.lockToPosition;
	if ( parameters.lockToAlignVertical != undefined )
		lockToAlignVertical = parameters.lockToAlignVertical;
	if ( parameters.lockToAlignHorizontal != undefined )
		lockToAlignHorizontal = parameters.lockToAlignHorizontal;
	if ( parameters.topAndBottomSpace != undefined )
		topAndBottomSpace = parameters.topAndBottomSpace;
	if ( parameters.leftAndRightSpace != undefined )
		leftAndRightSpace = parameters.leftAndRightSpace;
	
	
	$(this).each(function() {
		var height = heightPar;
		
		//ROOT
		var $root = $(this);
		$root.css("height", height+'px');
		
		$.fn.scrollbar.goto = function(param){
			var offsetVertical = param.v;// - вверх, + вниз
		
			contentVerticalPositionTo = offsetVertical;
			contentVerticalPosition = offsetVertical;
			updateContent();
			// scrollBackHeight, scrollDraggerHeight
			draggerVerticalPosition = Math.abs(offsetVertical / contentHeight) * scrollBackHeight;
			
			// Мы вышли за верхнюю границу
			if(draggerVerticalPosition<0){
				draggerVerticalPosition=0;
			}
			// Мы вышли за нижнюю границу
			if(draggerVerticalPosition>(scrollBackHeight-scrollDraggerHeight)){
				draggerVerticalPosition=(scrollBackHeight-scrollDraggerHeight);
			}
			
			$dragger_vertical.css("top", draggerVerticalPosition+"px");
		} // func. $.fn.scrollbar.goto
		
		
		//MASK
		var width = $root.width();
		var $mask = $(".scrollbar", $root);
		$mask.css("width", width);
		$mask.css("height", height);
		
		//CONTENT
		var $content = $(".content", $root);
		var contentVerticalPosition=0;
		var contentVerticalPositionTo=0;
		var contentHorizontalPosition=0;
		var contentHorizontalPositionTo=0;
		var contentHeight = $content.height();
		var contentWidth = $content.width();
		
		if(widthPar !="auto"){
			$content.css("width", widthPar+"px");
			contentWidth = widthPar;
		}
	
	
		//OTHER
		var timer;
		var positionClicked;
		var positionIn;
		var dragging=false;
		var draggingVertical=false;
		var draggingHorizontal=false;
		var refreshRate = 30;
		
		var updatedraggersSize = function(){
			if(dragVertical){
				if(contentHeight<height){
					$dragger_vertical.css("opacity", 0);
					$back_vertical.css("opacity", 0);
				}
				else{
					if(draggerVerticalSize=="auto")
						scrollDraggerHeight=height/(contentHeight/height);
					else
						scrollDraggerHeight=draggerVerticalSize;
				
					$dragger_vertical.css("height", scrollDraggerHeight+'px');
					$dragger_vertical.css("opacity", 1);
					$back_vertical.css("opacity", 1);
				}
			}
			if(dragHorizontal){
				if(contentWidth<width){
					$dragger_horizontal.css("opacity", 0);
					$back_horizontal.css("opacity", 0);
				}
				else{
					if(draggerHorizontalSize=="auto")
						scrollDraggerWidth=width/(contentWidth/width);
					else
						scrollDraggerWidth=draggerHorizontalSize;
					
					$dragger_horizontal.css("width", scrollDraggerWidth+'px');
					$dragger_horizontal.css("opacity", 1);
					$back_horizontal.css("opacity", 1);
				}
			}
			
		}
		
		//IF IS SCROLLBAR TYPE
		if(type == "scrollbar" && dragVertical){
			$root.append('<div class="scrollbar_dragger vertical"><div class="back"></div><div class="dragger"></div></div>');
			$mask.css("margin-right", barWidth+'px');
			
			width -= (barWidth+distanceFromBar);
			$mask.css("width", width+"px");
			if(!dragHorizontal)
			$content.css("width", width+"px");
		
			//SCROLLER
			$(".scrollbar_dragger.vertical", $root).css("width", barWidth+"px");
			var scrollDraggerHeight;
			var scrollBackHeight = height;
			
			//SCROLLER DRAGGER
			var $dragger_vertical = $(".scrollbar_dragger.vertical .dragger", $root);
			var draggerVerticalPosition=0;
			$dragger_vertical.css("top", 0+"px");
			$dragger_vertical.css("width", barWidth+'px');
			$dragger_vertical.css("background-color", draggerColor);
			
			
			if(roundCorners>0){
				$dragger_vertical.css("-moz-border-radius", roundCorners+'px');
				$dragger_vertical.css("-webkit-border-radius", roundCorners+'px');
				$dragger_vertical.css("-khtml-border-radius", roundCorners+'px');
				$dragger_vertical.css("border-radius", roundCorners+'px');
			}
			
			//SCROLLER BACK
			var $back_vertical = $(".scrollbar_dragger.vertical .back");
			$back_vertical.css("width", barWidth+'px');
			$back_vertical.css("height", height+'px');
			$back_vertical.css("background-color", barColor);
			if(roundCorners>0){
				$back_vertical.css("-moz-border-radius", roundCorners+'px');
				$back_vertical.css("-webkit-border-radius", roundCorners+'px');
				$back_vertical.css("-khtml-border-radius", roundCorners+'px');
				$back_vertical.css("border-radius", roundCorners+'px');
			}
			
			if(!dragHorizontal)
			updatedraggersSize();
		}
		if(type == "scrollbar" && dragHorizontal){
			$root.append('<div class="scrollbar_dragger horizontal"><div class="back"></div><div class="dragger"></div></div>');
			$mask.css("margin-bottom", barWidth+'px');
			
			height -= (barWidth+distanceFromBar);
			
			if(dragVertical)
				$back_vertical.css("height", height+'px');
				
			$mask.css("height", height+"px");
			if(!dragVertical)
			$content.css("height", height+"px");
		
			//SCROLLER
			$(".scrollbar_dragger.horizontal", $root).css("height", barWidth+"px");
			$(".scrollbar_dragger.horizontal", $root).css("width", width+barWidth+distanceFromBar+"px");
			$(".scrollbar_dragger.horizontal", $root).css("top", height+distanceFromBar+"px");
			var scrollBackWidth = width;
			var scrollDraggerWidth;
			
			//SCROLLER DRAGGER
			var $dragger_horizontal = $(".scrollbar_dragger.horizontal .dragger", $root);
			var draggerHorizontalPosition=0;
			$dragger_horizontal.css("height", barWidth+'px');
			$dragger_horizontal.css("width", width+'px');
			$dragger_horizontal.css("background-color", draggerColor);
			$dragger_horizontal.css("left", 0+"px");
			
			if(roundCorners>0){
				$dragger_horizontal.css("-moz-border-radius", roundCorners+'px');
				$dragger_horizontal.css("-webkit-border-radius", roundCorners+'px');
				$dragger_horizontal.css("-khtml-border-radius", roundCorners+'px');
				$dragger_horizontal.css("border-radius", roundCorners+'px');
			}
			
			//SCROLLER BACK
			var $back_horizontal = $(".scrollbar_dragger.horizontal .back");
			$back_horizontal.css("height", barWidth+'px');
			$back_horizontal.css("width", width+'px');
			$back_horizontal.css("background-color", barColor);
			if(roundCorners>0){
				$back_horizontal.css("-moz-border-radius", roundCorners+'px');
				$back_horizontal.css("-webkit-border-radius", roundCorners+'px');
				$back_horizontal.css("-khtml-border-radius", roundCorners+'px');
				$back_horizontal.css("border-radius", roundCorners+'px');
			}
			
			updatedraggersSize();
		}
		
		
		
		$(".content", $root).resize(function() {
			$content = $(".content", $root);
			contentHeight = $content.height();
			contentWidth = $content.width();
			if(widthPar !="auto"){
				$content.css("width", widthPar+"px");
				contentWidth = widthPar;
			}
			
			if(type == "scrollbar")
				updatedraggersSize();
		});
		
		//CONTENT SCROLLING
		var updateContent = function(){
			if(topBtnBool){
				if(contentVerticalPositionTo >= 0 && topBtnActive){
					topBtnActive=false;
					topBtn.fadeTo(300, buttonsDisabledAlpha);
					topBtn.addClass('disabled');
				}
				else if(contentVerticalPositionTo<0 && !topBtnActive){
					topBtnActive=true;
					topBtn.fadeTo(300, 1);	
					topBtn.removeClass('disabled');
				}
			}
			if(upBtnBool){
				if(contentVerticalPositionTo >= 0 && upBtnActive){
					upBtnActive= false;
					upBtn.fadeTo(300, buttonsDisabledAlpha);
					upBtn.addClass('disabled');
				}
				else if(contentVerticalPositionTo<0 && !upBtnActive){
					upBtnActive=true;
					upBtn.fadeTo(300, 1);
					upBtn.removeClass('disabled');	
				}
			}
			if(downBtnBool){
				if(contentVerticalPositionTo <= (-(contentHeight-height)) && downBtnActive){
					downBtnActive= false;
					downBtn.fadeTo(300, buttonsDisabledAlpha);
					downBtn.addClass('disabled');
				}
				else if(contentVerticalPositionTo>(-(contentHeight-height)) && !downBtnActive){
					downBtnActive=true;
					downBtn.fadeTo(300, 1);	
					downBtn.removeClass('disabled');
				}
			}
			if(leftBtnBool){
				if(contentHorizontalPositionTo >= 0 && leftBtnActive){
					leftBtnActive= false;
					leftBtn.fadeTo(300, buttonsDisabledAlpha);
					leftBtn.addClass('disabled');
				}
				else if(contentHorizontalPositionTo<0 && !leftBtnActive){
					leftBtnActive=true;
					leftBtn.fadeTo(300, 1);	
					leftBtn.removeClass('disabled');
				}
			}
			if(rightBtnBool){
				if(contentHorizontalPositionTo <= (-(contentWidth-width)) && rightBtnActive){
					rightBtnActive= false;
					rightBtn.fadeTo(300, buttonsDisabledAlpha);
					rightBtn.addClass('disabled');
				}
				else if(contentHorizontalPositionTo>(-(contentWidth-width)) && !rightBtnActive){
					rightBtnActive=true;
					rightBtn.fadeTo(300, 1);	
					rightBtn.removeClass('disabled');
				}
			}
			
			if(dragVertical){
				var mover = Math.round(((contentVerticalPositionTo-contentVerticalPosition)/scrollerEase));
				contentVerticalPosition += mover;
				$content.css('top', contentVerticalPosition+"px");
			}
			if(dragHorizontal){
				var mover = Math.round(((contentHorizontalPositionTo-contentHorizontalPosition)/scrollerEase));
				contentHorizontalPosition += mover;
				$content.css('left', contentHorizontalPosition+"px");
			}
			
			timer = setTimeout(updateContent, refreshRate);
		}
		timer = setTimeout(updateContent, refreshRate);
		
		
		
		//SCROLLBAR FUNCTIONS
		if(type == "scrollbar"){
			var changeDraggerPosition = function(dir){
				//$content = $(".content", $root);
				//contentHeight = $content.height();
				
				if(dir == "vertical"){
				
					// Мы вышли за верхнюю границу
					if(draggerVerticalPosition<0){
						draggerVerticalPosition=0;
					}
					// Мы вышли за нижнюю границу
					if(draggerVerticalPosition>(scrollBackHeight-scrollDraggerHeight)){
						draggerVerticalPosition=(scrollBackHeight-scrollDraggerHeight);
					}
					var perc =  draggerVerticalPosition/(scrollBackHeight-scrollDraggerHeight);
					contentVerticalPositionTo = -(contentHeight-height)*perc;
					
					$dragger_vertical.css("top", draggerVerticalPosition+"px");
				}
				else if(dir == "horizontal"){
					if(draggerHorizontalPosition<0)draggerHorizontalPosition=0;
					if(draggerHorizontalPosition>(scrollBackWidth-scrollDraggerWidth))draggerHorizontalPosition=(scrollBackWidth-scrollDraggerWidth);
					
					var perc =  draggerHorizontalPosition/(scrollBackWidth-scrollDraggerWidth);
					contentHorizontalPositionTo = -(contentWidth-width)*perc;
					
					$dragger_horizontal.css("left", draggerHorizontalPosition+"px");
				}
			}
			
			var drag = function(e){
				var currentPosition;
				var direction = "vertical";
				var dif;
				
				if(draggingVertical){
					currentPosition = e.pageY;
					dif = currentPosition-positionClicked;
					draggerVerticalPosition = (positionIni+dif);
				}
				else{
					currentPosition = e.pageX;
					direction= "horizontal";
					dif = currentPosition-positionClicked;
					draggerHorizontalPosition = (positionIni+dif);
				}
				
				changeDraggerPosition(direction);
			}
			
			if(dragVertical){
				$dragger_vertical.mouseover(function(){$dragger_vertical.css("background-color", draggerOverColor); });
				$dragger_vertical.mouseout(function(){ if(!draggingVertical)$dragger_vertical.css("background-color", draggerColor); });
			
				$back_vertical.mouseover(function(){ $back_vertical.css("background-color", barOverColor); });
				$back_vertical.mouseout(function(){ $back_vertical.css("background-color", barColor); });
				
				$dragger_vertical.mousedown( function(e) {
					if(contentHeight>height){
						positionClicked = e.pageY;
						positionIni = parseInt( $dragger_vertical.css("top") , 10);
						draggingVertical=true;
						
						$(document).bind('mousemove', drag);	
						$(document).mouseup( function(){ 
								$(document).unbind('mousemove');
								draggingVertical=false;
								$dragger_vertical.css("background-color", draggerColor);
						});		
					}
						
					return false;
				});
				
				$back_vertical.click( function(e) {
					var offset = $back_vertical.offset();
					draggerVerticalPosition = 	e.pageY-offset.top	;
					
					changeDraggerPosition("vertical");
					return false;
				});
			}
			if(dragHorizontal){
				$dragger_horizontal.mouseover(function(){$dragger_horizontal.css("background-color", draggerOverColor); });
				$dragger_horizontal.mouseout(function(){ if(!dragging)$dragger_horizontal.css("background-color", draggerColor); });
				
				$back_horizontal.mouseover(function(){ $back_horizontal.css("background-color", barOverColor); });
				$back_horizontal.mouseout(function(){ $back_horizontal.css("background-color", barColor); });
				
				$dragger_horizontal.mousedown( function(e) {
					positionClicked = e.pageX;
					positionIni = parseInt( $dragger_horizontal.css("left") , 10);
					
					draggingHorizontal=true;
					
					$(document).bind('mousemove', drag);	
					$(document).mouseup( function(){ 
							$(document).unbind('mousemove');
							draggingHorizontal=false;
							$dragger_horizontal.css("background-color", draggerColor);
					});		
						
					return false;
				});
				
				$back_horizontal.click( function(e) {
					var offset = $back_horizontal.offset();
					draggerHorizontalPosition = 	e.pageX-offset.left	;
					
					changeDraggerPosition("horizontal");
					return false;
				});
			}
			
			
			
		
			if(mouseWheel){
				$root.mousewheel(function(event, delta) {
					if(mouseWheelOrientation=="vertical"){
						if(contentHeight>height){
							draggerVerticalPosition-=delta*13;
							changeDraggerPosition("vertical");
						}
					}
					else{
						draggerHorizontalPosition-=delta*13;
						changeDraggerPosition("horizontal");
					}
					
					return false;
				});
			}
		}
		
		
		//MOUSE POSITION FUNCTIONS
		if(type == "mousePosition"){
			if(!dragVertical)
			$content.css("height", height+"px");
			if(!dragHorizontal)
			$content.css("width", width+"px");
			
			var offset1 = $mask.offset();
			$mask.mousemove(function(e){ 
				offset1 = $mask.offset();	
				if(contentHeight > height){
					if(dragVertical){
						var distanceDifference = (contentHeight+topAndBottomSpace*2)-height;						  				
						var percentagePosition = (e.pageY - offset1.top)/height;
						var position = topAndBottomSpace-distanceDifference*percentagePosition;
						
						contentVerticalPositionTo=position;	
					}
					if(dragHorizontal){
						var distanceDifference = (contentWidth+leftAndRightSpace*2)-width;						  				
						var percentagePosition = (e.pageX - offset1.left)/width;
						var position = leftAndRightSpace-distanceDifference*percentagePosition;
						
						contentHorizontalPositionTo=position;
					}
				}
			});
			if(lockToPosition)
				$root.mouseout(function(){
					if(dragVertical){
						var distanceDifference = (contentHeight+topAndBottomSpace*2)-height;
						
						if(	lockToAlignVertical == "middle")
							contentVerticalPositionTo = topAndBottomSpace-distanceDifference*0.5;
						else if(lockToAlignVertical == "bottom")
							contentVerticalPositionTo = topAndBottomSpace-distanceDifference;
						else
							contentVerticalPositionTo=0;
					}
					if(dragHorizontal){
						var distanceDifference = (contentWidth+leftAndRightSpace*2)-width;
						
						if(	lockToAlignHorizontal == "middle")
							contentHorizontalPositionTo = leftAndRightSpace-distanceDifference*0.5;
						else if(lockToAlignHorizontal == "right")
							contentHorizontalPositionTo = leftAndRightSpace-distanceDifference;
						else
							contentHorizontalPositionTo=0;
					}
				});
		}
		
		
		
		//DRAG AND DROP FUNCTIONS
		if(type == "dragAndDrop"){
			if (jQuery.browser.msie) {
				  $content.get(0).onselectstart = function () { return false; };
			    } 
			    else {
				   $content.get(0).onmousedown = function(e){e.preventDefault();};
			    }  
			
			if(!dragVertical)
			$content.css("height", height+"px");
			if(!dragHorizontal )
			$content.css("width", width+"px");
			
			var previousDifY = 0;
			var previousDifX = 0;
			var speedVertical = 0;
			var speedHorizontal = 0;
			var positionIniVertical;
			var positionIniHorizontal;
			var positionClickedY;
			var positionClickedX;
			
			var drag = function(e){
				if(dragVertical){
					var currentPositionY = e.pageY;
					var difY = currentPositionY-positionClickedY;
					contentVerticalPositionTo = (positionIniVertical+difY);
					speedVertical = difY-previousDifY;
					previousDifY=difY;
				}
				if(dragHorizontal){
					var currentPositionX = e.pageX;
					var difX = currentPositionX-positionClickedX;
					contentHorizontalPositionTo = (positionIniHorizontal+difX);
					speedHorizontal = difX-previousDifX;
					previousDifX=difX;
				}
				
			}
			
			$mask.addClass("grab");
			$root.mousemove(function(e){ 
			    e.preventDefault();
			});
			
			$mask.mousedown( function(e){
				//alert(e.touches[0].pageY);
				$mask.removeClass("grab");
				$mask.addClass("grabbing");
				
				if (e.preventDefault)
				   e.preventDefault();
				else
				   e.returnValue= false;
				 
				//scrollerEase=1;
			
				if(dragVertical){
					positionClickedY = e.pageY;
					contentVerticalPositionTo=contentVerticalPosition;
					positionIniVertical = contentVerticalPositionTo;
				}
				if(dragHorizontal){
					positionClickedX = e.pageX;	
					contentHorizontalPositionTo=contentHorizontalPosition;
					positionIniHorizontal = contentHorizontalPositionTo;
				}
				
				dragging=true;
				
				$(document).bind('mousemove', drag);	
				$(document).mouseup( function(e){ 
					
					$mask.addClass("grab");
					$mask.removeClass("grabbing");
					
					$(document).unbind('mousemove', drag);
					dragging=false;
					//scrollerEase=scrollEaseBuf;
					
					if(dragVertical){
						var difVert = contentHeight-height;
						contentVerticalPositionTo+=speedVertical*30;
						
						if(contentVerticalPositionTo > 0)
							contentVerticalPositionTo=0;
						else if(contentVerticalPositionTo < -difVert)
							contentVerticalPositionTo=-difVert;
						
						speedVertical = 0;
					}
					if(dragHorizontal){
						var difHor = contentWidth-width;
						contentHorizontalPositionTo+=speedHorizontal*30;
						
						if(contentHorizontalPositionTo > 0)
							contentHorizontalPositionTo=0;
						else if(contentHorizontalPositionTo < -difHor)
							contentHorizontalPositionTo=-difHor;
						
						speedHorizontal = 0;
					}
					
					
					return false;
				});		
				
				return false;
			});
		}
		
		if(topBtnBool){
			topBtn.click(function(){
				contentVerticalPositionTo=0;
				return false;				  
			});
		}
		
		if(downBtnBool){
			var buttonTimer;
			downBtn.mousedown(function(){
				var updatePos = function(){
					contentVerticalPositionTo-=buttonsScrollSpeed;
					if(contentVerticalPositionTo<(-(contentHeight-height)))contentVerticalPositionTo=(-(contentHeight-height));
				}
				buttonTimer = setInterval(updatePos, 30);
				
				$(document).mouseup(function(){clearInterval(buttonTimer);});
				return false;				  
			});
		}
		
		if(upBtnBool){
			var buttonTimer;
			upBtn.mousedown(function(){
				var updatePos = function(){
					contentVerticalPositionTo+=buttonsScrollSpeed;
					if(contentVerticalPositionTo>0)contentVerticalPositionTo=0;
				}
				buttonTimer = setInterval(updatePos, refreshRate);
				
				$(document).mouseup(function(){clearInterval(buttonTimer);});
				
				return false;				  
			});
		}
		if(leftBtnBool){
			var buttonTimer;
			leftBtn.mousedown(function(){
				var updatePos = function(){
					contentHorizontalPositionTo+=buttonsScrollSpeed;
					if(contentHorizontalPositionTo>0)contentHorizontalPositionTo=0;
				}
				buttonTimer = setInterval(updatePos, refreshRate);
				
				$(document).mouseup(function(){clearInterval(buttonTimer);});
				
				return false;				  
			});
		}
		if(rightBtnBool){
			var buttonTimer;
			rightBtn.mousedown(function(){
				var updatePos = function(){
					contentHorizontalPositionTo-=buttonsScrollSpeed;
					if(contentHorizontalPositionTo<(-(contentWidth-width)))contentHorizontalPositionTo=(-(contentWidth-width));
				}
				buttonTimer = setInterval(updatePos, refreshRate);
				
				$(document).mouseup(function(){clearInterval(buttonTimer);});
				
				return false;				  
			});
		}
	});
};
}(jQuery));