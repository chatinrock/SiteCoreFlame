;(function($) {
    $.swfPlayerApi = {version: '1.0.1', author: 'Vitaliy Kozlenko'};

    jQuery.fn.swfPlayerApi = function(arg) {
        var options = $.extend({},$.fn.swfPlayerApi.defaults,arg);
        var $elem;
		// ������������� �� ��� ���� � ������ ������
        var isPlay = false;
        var timeSliderMoving = false;
		// ������ ���������
        var timeBarWidth;

        var currentTime;
		// ������ �����
        var duration;

        function _init(elem) {
            $elem = $(elem);
            $elem.addClass('spa-container').append("<p>�������� ������</p>");
            _buildPlayer();
            // func. _init
        };

		/**
		* ����� ��������� �������� �������� ����
		*/
        function _dropTimeSlider() {
            var timeBox = $elem.find('.spa-time');
            if(!timeBox.data('hover')) {
                $elem.find('.spa-time').stop().animate({opacity: 0, top: -40}, 200);
            }

            if($elem.find('.spa-loading-bar').width() == 0) { return false };
            timeSliderMoving = false;

            $(document).unbind('mousemove', _onTimeSliderMove);
            $(document).unbind('mouseup', _dropTimeSlider);

            /*paused ? player.pause() : player.resume();
            if(player.duration == player.position) {
                _onFinish();
            }*/
			// func. _dropTimeSlider
        };
		
		/**
		* ����� ������ ��������� �������� ����
		*/
		function _onTimeSliderMove(evt) {
            if($elem.find('.spa-loading-bar').width() == 0) { return false };
            timeSliderMoving = true;

            //calculate min and max range
            var minX = -6;
            var maxX = $elem.find('.spa-loading-bar').width()+minX;
            var mouseX = evt.pageX-$elem.find('.spa-progress-bar').offset().left-6;
            if(mouseX < minX) {
                mouseX = minX;
            }
            if(mouseX > maxX) {
                mouseX = maxX;
            }
            //calculate progress(0-1)
            var progress = (mouseX+6)/timeBarWidth;
			
			
			_setMainButtonIcon('pause');
			isPlay = true;
			options.onSetPosition(progress * duration);
			
            _setSliderPosition(progress);
			// func. _onTimeSliderMove
        };

        function _setVolume(value){
            var volumeStateBackgroundHeight = $elem.find('.spa-volume-state-background').height();
            $elem.find('.spa-volume-slider').css('top', (volumeStateBackgroundHeight-4) * value);
            $elem.find('.spa-volume-state').css('height', volumeStateBackgroundHeight * value);
            // func. _setVolume
        }

        function _onVolumeSliderMove(evt) {
            //calculate min and max range
            var minY = 0;
            var maxY = $elem.find('.spa-volume-state-background').height()-4;
            var mouseY = evt.pageY-$elem.find('.spa-volume-state-background').offset().top;
            var progress = (mouseY+4)/44;
            if(mouseY < minY) {
                mouseY = minY;
                progress = 0;
            }
            if(mouseY > maxY) {
                mouseY = maxY;
                progress = 1;
            }

            options.onVolume(progress);
            _setVolume(progress);
        };

        //will be called when the drag slider will be released
        function _dropVolumeSlider() {
            $(document).unbind('mousemove', _onVolumeSliderMove);
            $(document).unbind('mouseup', _dropVolumeSlider);
        };


        $.swfPlayerApi.setLoading = function (objPos) {
            $elem.find('.spa-loading-bar').width(( objPos.bytesLoaded / objPos.bytesTotal) * timeBarWidth);
        };

        function _setSliderPosition(posProc) {
            $elem.find('.spa-time').css('left', (posProc * timeBarWidth)-13);
            $elem.find('.spa-time-slider').css('left', (posProc * timeBarWidth)-6);
            $elem.find('.spa-progress-bar').width(posProc * timeBarWidth);
			$.swfPlayerApi.setTime( duration * posProc / 1000);
        };

        function _buildPlayer(){
            // ������� �������������
            $elem.find('p:first, div').remove();

            // ������ ������� ������
            $elem.append('<div class="clearfix"><a href="#" class="spa-previous-button spa-previous-button-normal"><div class="spa-previous"></div></a><a href="#" class="spa-pp-button spa-play-button-normal"><div class="spa-play"></div></a><a href="#" class="spa-next-button spa-next-button-normal"><div class="spa-next"></div></a><div class="spa-time-bar"><div class="spa-time"><span></span><div class="spa-time-arrow-border"></div><div class="spa-time-arrow"></div></div><div class="spa-loading-bar"></div><div class="spa-progress-bar"></div><div class="spa-time-slider"></div></div></div>');

            // �������� ������ ������� ����
            timeBarWidth = $elem.find('.spa-time-bar').width();

            $elem.find('.spa-time').css({opacity: 0, top: -40});

            if(!$.support.leadingWhitespace) {
                //hide time arrows in IE-6-8
                $elem.find('.spa-time').children('.spa-time-arrow-border, .spa-time-arrow').hide();
            }
            // ������ �������� ����������
            $elem.find("div:first").append('<div class="spa-sound-control"><div class="spa-volume-button spa-button-normal"></div><div class="spa-volume-bar"><div class="spa-volume-arrow-border"></div><div class="spa-volume-arrow"></div><div class="spa-volume-slider"></div><div class="spa-volume-state-background"><div class="spa-volume-state"></div></div></div></div>');
            // ������ ������, ��� ����� ���������� �������� �����
            $elem.append('<div class="spa-tracks-container clearfix"><span class="spa-current-title"></span></div>');


            // ������ ����� �� ������ ������/�����

            $elem.find('.spa-previous-button').hover(
                    function() {
                        var $this = $(this);
                        $this.removeClass('spa-previous-button-normal').addClass('spa-previous-button-hover').children('div').stop().fadeTo(500, 1);
                    },
                    function() {
                        var $this = $(this);
                        $this.removeClass('spa-previous-button-hover spa-previous-button-press').addClass('spa-previous-button-normal').children('div').stop().fadeTo(400, 0.8);
                    }
            ).children('div').fadeTo(0, 0.8);

            $elem.find('.spa-next-button').hover(
                    function() {
                        var $this = $(this);
                        $this.removeClass('spa-next-button-normal').addClass('spa-next-button-hover').children('div').stop().fadeTo(500, 1);
                    },
                    function() {
                        var $this = $(this);
                        $this.removeClass('spa-next-button-hover spa-next-button-press').addClass('spa-next-button-normal').children('div').stop().fadeTo(400, 0.8);
                    }
            ).children('div').fadeTo(0, 0.8);

            $elem.find('.spa-time-slider').hover(
                    function() {
                        //if(tracks.length > 0) {
                            var timeBox = $elem.find('.spa-time').data('hover', true);
                            if(!timeSliderMoving) {
                                timeBox.stop().css({opacity: 0, top: -40}).animate({opacity: 1, top: -30}, 300);
                            }
                       // }
                    },
                    function() {
                       // if(tracks.length > 0) {
                            var timeBox = $elem.find('.spa-time').data('hover', false);
                            if(!timeSliderMoving) {
                                timeBox.stop().animate({opacity: 0, top: -40}, 200);
                            }
                    //    }
                    }
            );

            // Mouse UP �� ������ Prev
            $(".spa-previous-button").mouseup(
                    function(){
                        $(this).removeClass('spa-previous-button-press');
                    }).mousedown(
                    function(){
                        $(this).addClass('spa-previous-button-press');
                    });

            /// Mouse UP �� ������ Next
            $(".spa-next-button").mouseup(
                    function(){
                        $(this).removeClass('spa-next-button-press');;
                    }).mousedown(
                    function(){
                        $(this).addClass('spa-next-button-press');
                    });

            //play previous track
            $elem.find('.spa-previous-button').click(function() {
                options.onPrev();
                return false;
            });

            //play next track
            $elem.find('.spa-next-button').click(function() {
                options.onNext();
                return false;
            });

            //toggle play/pause
            $elem.find('.spa-pp-button').click(mainButtonClick);

            //start dragging time slider
            $elem.find('.spa-time-slider').live('mousedown', function(evt) {
                $(document).bind('mouseup', _dropTimeSlider);
                $(document).bind('mousemove', _onTimeSliderMove);
            });

            //toggle volume slider
            $elem.find('.spa-volume-button').click(function() {
                if(!$elem.find('.spa-volume-bar').is(':animated')) {
                    var $this = $(this);
                    if($this.hasClass('spa-button-active')) { $this.removeClass('spa-button-active').addClass('spa-button-normal') }
                    else { $this.removeClass('spa-button-normal').addClass('spa-button-active') };
                    $elem.find('.spa-volume-bar').slideToggle(200);
                }
            });

            //start dragging volume slider
            $elem.find('.spa-volume-slider').live('mousedown', function(evt) {
                $(document).bind('mouseup', _dropVolumeSlider);
                $(document).bind('mousemove', _onVolumeSliderMove);
            }).dblclick(function() {
                        if($elem.find('.spa-volume-slider').position().top == 0) {
                            options.onVolume(1);
                            _setVolume(1);
                        }
                        else {
                            options.onVolume(0);
                            _setVolume(0);
                        }
                    });

            //toggle slide of playlist
            $elem.find('.spa-playlist-button').click(function() {
                var $this = $(this);
                if(!$elem.find('.spa-playlist-container').is(':animated')) {
                    if($this.hasClass('spa-button-active')) { $this.removeClass('spa-button-active').addClass('spa-button-normal') }
                    else { $this.removeClass('spa-button-normal').addClass('spa-button-active') };
                    $elem.find('.spa-playlist-container').slideToggle(500);
                }
            });

            //delete track from playlist
            $elem.find('.spa-playlist li .spa-delete-track').live('click', function() {
                var $this = $(this),
                        index = $elem.find('.spa-playlist li').index($this.parent());
                tracks.splice(index, 1);
                titles.splice(index, 1);
                urls.splice(index, 1);
                $this.parent().remove();

                //rename upcoming titles
                for(var i=index; i < $elem.find('.spa-playlist li').length; ++i) {
                    $elem.find('.spa-playlist li').eq(i).children('span').text((i+1)+'- '+titles[i]+'');
                }
            });

            function _convertTime(second) {
                second = Math.abs(second);
                var val = new Array();
                val[0] = Math.floor(second/3600%24);//hours
                val[1] = Math.floor(second/60%60);//mins
                val[2] = Math.floor(second%60);//secs
                var stopage = options.showHours;
                var cutIndex  = -1;
                for(var i = 0; i < val.length; i++) {
                    if(val[i] < 10) val[i] = "0" + val[i];
                    if( val[i] == "00" && i < (val.length - 2) && !stopage) cutIndex = i;
                    else stopage = true;
                }
                val.splice(0, cutIndex + 1);
                return val.join(':');
            };

            $.swfPlayerApi.setDuration = function(pDuration){
                duration = pDuration;
				$.swfPlayerApi.setTime(0);
				// func. $.swfPlayerApi.setDuration
            }

            $.swfPlayerApi.setSliderPosition = function(posSec){
				// �� ������� �� �� ��������
				if ( posSec * 1000 > duration ){
					return;
				}
				_setSliderPosition( posSec / ( duration / 1000 ) );
				// func. setSliderPosition
			}

            $.swfPlayerApi.setTime = function(posSec) {
                var time = _convertTime(posSec);
                $elem.find('.spa-time span').text(time);
            };
			
			$.swfPlayerApi.soundComplete = function(pos) {
                _setSliderPosition(0);
				_setMainButtonIcon('play');
            };

            options.onReady();
            // func. _buildPlayer
        }
		
		function mainButtonClick() {
			isPlay = !isPlay;
			if ( isPlay ){
				options.onPlay();
				_setMainButtonIcon('pause');
			}else{
				options.onPause();
				_setMainButtonIcon('play');
			}
			return false;
			// func. mainButtonClick
        }
		
		function _setMainButtonIcon(icon){
			var antiicon = icon == 'pause' ? 'play' : 'pause';
			$elem.find('.spa-pp-button div').removeClass().addClass('spa-'+icon);
            $elem.find('.spa-pp-button').removeClass('spa-'+antiicon+'-button-normal').addClass('spa-'+icon+'-button-normal');
			// func. _setMainButtonIcon
		}


        return this.each(function() {_init(this)});
    };

    //OPTIONS
    $.fn.swfPlayerApi.defaults = {
        onReady: function(){},
        onPlay: function(){},
        onPause: function(){},
        onPrev: function(){},
        onNext: function(){}
    };
})(jQuery);