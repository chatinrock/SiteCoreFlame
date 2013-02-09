<?php
	
	///////////////////////////////////
	///////////////////////////////////
	//// THIS WILL HANDLE THE SHORTCODES
	//// FOR TOOLTIPS
	///////////////////////////////////
	///////////////////////////////////
	
	//Our hook
	add_shortcode('flickr_widget', 'ddshort_flickr_widget');
	add_shortcode('twitter_widget', 'ddshort_twitter_widget');
	add_shortcode('dribbble_widget', 'ddshort_dribbble_widget');
	add_shortcode('blog_widget', 'ddshort_blog_widget');
		
		//// INCLUDE THE DRIBBBLE API
		include('api/dribbble.php');
	
	//// FLICKR
	function ddshort_flickr_widget($atts, $content = null) {
		
		extract(shortcode_atts(array(
		
			'user' => 'envato',
			'count' => '10',
			'size' => '50',
			'order' => 'latest',
		
		), $atts));
		
		//// LETS GET THE FEED
		$api = '041fcb112c0312b75598d6ff4abb0925';
		$url = 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$user.'&format=php&lang=en-us';
		eval("?>".file_get_contents($url)."<?php ");
		$photos = $feed;
		if($order == 'random') { shuffle($photos['items']); }
		
		if($photos) {
			
			//// STARTS OUR OUTPUT
			$output = '<ul class="ddflickr_widget">';
			
			//// LOPPS THROUGH OUR PHOTOS
			$i = 1;
			foreach($photos['items'] as $key => $value) {
				
				//// LETS GET THE PHOTO URL
				if($i > $count) { break; }
							
				ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
				$photo_url = str_replace("_m.jpg", "_s.jpg", $regs[1]);
				$photo_tooltip = str_replace("_s.jpg", "_m.jpg", $regs[1]);
				
				$output .= '<li><a href="'.$value["url"].'" target="_blank"><img src="'.$photo_url.'" alt="'.$value["title"].'" width="'.$size.'" /></a></li>';
				
				$i++;
				
			}
			
			//// CLOSES OUR OUTPU
			$output .= '</ul>';
			
			return $output;
				
		}
		
	}
	
	function ddshort_twitter_widget($atts, $content = null) {
		
		extract(shortcode_atts(array(
		
			'user' => 'envato',
			'count' => '4'
		
		), $atts));
		
		//// STARTS OUR OUTPUT
		$output = '<ul class="ddtwitter_widget">';
		
			//// LET'S GET OUR FEED
			$limit = $count;
			$tweet_array = array();
			$i = 1;
			
			if($twitter_xml = twitter_status($user, $count)) {
			
				//// LOOPS THE TWEETS
				foreach($twitter_xml->status as $tweet) {
			
					//Get the date it was posted
					$pubdate = strtotime($tweet->created_at); 
					$propertime = gmdate('M jS. (h:ia)', $pubdate);  //Customize this to your liking
			
					//Store tweet and time into the array
					$tweet_item = array(
						 'desc' => $tweet->text,
						 'date' => $propertime,
					);
					
					array_push($tweet_array, $tweet_item);
					
					if($i == $limit) { break; }
					
					$i++;
					
				}
		
			//// LET's LOOP THROUGH OUR TWEETS AND ADD THEM TO OUR OUTPUT
			foreach($tweet_array as $tweet) {
				
				$output .= '<li><span class="date">'.$tweet['date'].'</span>'.$tweet['desc'].'</li>';
				
			}
			
			} else { $output .= '<li>Twitter seems to be unavailable at the moment.</li>'; }
		
		//// CLOSES OUR OUTPUT
		$output .= '</ul>';
		
		//// RETURNS OUTPUT
		return $output;
		
	}
	
	//// DRIBBBLE
	function ddshort_dribbble_widget($atts, $content = null) {
		
		extract(shortcode_atts(array(
			
			'user' => 'salumguilherme',
			'count' => '6',
			'titles' => 'true',
			'info' => 'true',
			'shot_width' => '158',
		
		), $atts));
		
		//// STARTS OUR OUTPUT
		$output = '';
		
		//// LET'S GET OUR SHOTS
		$dribbble = new Dribbble();  
		$this_shots = $dribbble->get_player_shots($user);
		
		//// STARTS OUR UL OUTPUT
		$output .= '<ul class="dribbble-shots">';
		
		//// LOOPS OUR SHOTS
		$shotsI = 1;
		foreach($this_shots->shots as $shot) {
			
			////SHOTS COUNT
			if($shotsI <= $count) {
				
				//// STARTS OUR LI
				$output .= '<li>';
				
				////SHOT WRAPPER
				$output .= '<div class="shot">';
				
					//// OUR IMAGE
					$output .= '<a href="'.$shot->url.'" target="_blank"><img src="'.ddTimthumb($shot->image_url, $shot_width).'" alt="'.$shot->title.'" title="'.$shot->title.'" />';
					
					//// IF USER WANTS TITLE
					if($titles != 'false') { $height = round(($shot_width/4)*3); $output .= '<span class="shot-title" style="width: '.($shot_width-30).'px; height: '.($height-60).'px;">'.$shot->title.'</span>'; }
					
					//// CLOSES OUR LINK TAG
					$output .= '</a>';
					
					//// OUR INFO - IF USER WANTS IT
					if($info != 'false') { $output .= '<span class="shot-info"><span class="shot-views">'.$shot->views_count.'</span><span class="shot-comments">'.$shot->comments_count.'</span><span class="shot-likes">'.$shot->likes_count.'</span></span>'; }
				
				//// CLOSES SHOW WRAPPER
				$output .= '</div>';
				
				//// CLOSES OUR LI
				$output .= '</li>';
				
			} else { break; }
			
			$shotsI++;
			
		}
		
		//// CLOSES UL
		$output .= '</ul>';
		
		//// RETURNS OUTPUT
		return $output;
		
	}
	
	//// BLOG
	function ddshort_blog_widget($atts, $content = null) {
		
		extract(shortcode_atts(array(
			
			'cat' => 'all',
			'count' => '4',
			'columns' => '4',
			'width' => '188',
			'height' => '130',
			'info' => 'true',
			'thumbs' => 'true',
			'read_more' => 'true',
		
		), $atts));
		
		//// STARTS OUR OUTPUT
		$output = '';
		
		//// STARTS OUR UL OUTPUT
		$output .= '<ul class="blog-widget">';
		
		//// LET'S QUERY OUR POSTS
		$args = array(
		
			'post_type' => 'post',
			'posts_per_page' => $count
		
		); if($cat != 'all') { $args['cat'] = $cat; } //// IF THERE'S A SPECIFIC CATEGORY
		
		//// WP OBJECT
		$blogWidgetQuery = new WP_Query($args);
		
		//// LOOPS OUR POSTS
		$columnsI = 1;
		if($blogWidgetQuery->have_posts()) { while($blogWidgetQuery->have_posts()) { $blogWidgetQuery->the_post();
		
			//// OPENS OUR LI
			$output .= '<li id="blog-widget-'.get_the_ID().'" class="blog-widget-post';
			if($columnsI % $columns == 0) { $output .= ' last'; }
			$output .= '" style="width: '.($width+10).'px;">';
			
			//// STARTS WITH OUR THUMBNAIL
			if($thumbs != 'false') { 
			
				$thumb = ddGetFeaturedImage(get_the_ID());
				$output .= '<a href="'.get_permalink().'" class="blog-widget-thumbnail"><img src="'.ddTimthumb($thumb[0], $width, $height).'" alt="'.get_the_title().'" title="'.get_the_title().'" /></a>';
			
			}
			
			//// POST INFO
			if($info != 'false') { 
			
				$output .= '<div class="blog-widget-info"><span class="date">'.get_the_time(get_option('date_format')).'</span><a class="comments" href="'.get_permalink().'#comments">'.get_comments_number(get_the_ID()).' comment';
				
				if(get_comments_number(get_the_ID()) > 1 || get_comments_number(get_the_ID()) == 0) { $output .= 's'; }
				
				$output .= '</a></div>';
			
			}
			
			//// TITLE
			$output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
			
			//// READ MORE
			if($read_more != 'false') { $output .= '<p><a href="'.get_permalink().'" class="button white">'.__('Read more', 'ultrasharp').'</a></p>'; }
			
			//// CLOSES OUR LI
			$output .= '</li>';
			
			$columnsI++;
		
		} }
		
		//// CLOSES UL
		$output .= '</ul>';
		
		//// RETURNS OUTPUT
		return $output;
		
	}
	
	//include('tinyMCE.php');

?>