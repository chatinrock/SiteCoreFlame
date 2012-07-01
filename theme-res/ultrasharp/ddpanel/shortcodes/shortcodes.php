<?php

	///////////////////////////////////////////
	///////////////////////////////////////////
	//// THIS FILE HANDLES OUR SHORTCODES
	//// FUNCTIONS AND STYLES
	//// DVP. BY GUILHERME SALUM - DDSTUDIOS
	//// DO NOT DISTRIBUTE, MODIFY OR REUSE
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	
	////////////////////////////////////
	// LOADS OUR JS SCRIPT
	////////////////////////////////////
	
	//init hook
	add_action('init', 'ddShortIncludeJs');
	
	//our include js function
	function ddShortIncludeJs() {
		
		if(!is_admin()) {
			
			//shortcodes.js
			wp_register_script('ddshortcodes', get_template_directory_uri().'/ddpanel/shortcodes/js/shortcodes.js');
			
			//HTML5 VIDEO & AUDIO
			wp_register_script('ddshortcodes_audiovideo', get_template_directory_uri().'/ddpanel/shortcodes/js/audioandvideo/mediaelement-and-player.min.js');
			
			//HTML5 VIDEO & AUDIO
			wp_register_script('dd_prettyPhoto', get_template_directory_uri().'/ddpanel/shortcodes/js/prettyPhoto/jquery.prettyPhoto.js');
			
			//Enqueue our script
			wp_enqueue_script('jquery');
			wp_enqueue_script('ddshortcodes');
			wp_enqueue_script('ddshortcodes_audiovideo');
			wp_enqueue_script('dd_prettyPhoto');
			
		}
		
	}
	
	
	
	////////////////////////////////////
	// LOADS OUR CSS FILES
	////////////////////////////////////
	
	//Let's now include our .css file
	add_action('wp_head', 'ddShortIncludeCss');
	
	//let's include the necessary file
	function ddShortIncludeCss() {
		
		//builds our CSS tag
		$output = '<link rel="stylesheet" href="'.get_template_directory_uri().'/ddpanel/shortcodes/css/shortcodes.css" media="screen" />';
		$output .= '<link rel="stylesheet" href="'.get_template_directory_uri().'/ddpanel/shortcodes/css/prettyPhoto.css" media="screen" />';
		
		echo $output;
		
	}
	
	
	
	////////////////////////////////////
	// OUR jQUERY ACTIVATORS
	////////////////////////////////////
	
	//Let's now include our .css file
	add_action('wp_head', 'ddShortIncludeJsActivators');
	
	//let's include the necessary file
	function ddShortIncludeJsActivators() {
		
		//builds our CSS tag
		$output = "
		<script type=\"text/javascript\">
		
			jQuery(document).ready(function() {
				
				jQuery('.toggled > h6, .notification, .boxed > h6').ddFadeOnHover(.85);
				jQuery('.blog-widget-post a img').ddFadeOnHover(.8);
				jQuery('.button, .big-button').ddFadeOnHover(.9);
				jQuery('.ddflickr_widget li').ddFadeOthersOnHover(.6);
				jQuery('.dribbble-shots li').ddFadeOthersOnHover(.8);
				
				//// PRELOAD IMAGES
				jQuery('.imagePreload').each( function() { jQuery(this).ddImagePreload(); });
				
				//// IMAGE SLIDERS
				jQuery('.dd-image-slider').each( function() { jQuery(this).ddImageSlider(); });
				
				//// TABBED CONTENT
				jQuery('.dd-tab').each( function() { jQuery(this).ddTabs(); });
				
				//// TABBED CONTENT
				jQuery('.ddpricing').each( function() { jQuery(this).ddPricing(); });
				
				//// SLOGAN SLIDER
				jQuery('.ddslogan_slider').each( function() { jQuery(this).ddSloganSlider(); });
				
				//// CONTACT FORM
				jQuery('.ddcontact_form').each( function() { jQuery(this).ddContact(); });
				
				jQuery(\"a[rel^='prettyPhoto'], a[rel^='lightbox']\").prettyPhoto({
					
					theme: 'timeless',
					show_title: false,
					social_tools: ''
					
				});
				
				// IMAGE HOVER
				jQuery('.image-hover').each(function() { jQuery(this).ddImageHover('.55'); });
				
			});
			
			jQuery(window).load(function() {
				
				jQuery('.tooltip').each(function() { jQuery(this).ddTooltip(); });
				
			});
		
		</script>";
		
		echo $output;
		
	}
	
	
	
	////////////////////////////////////
	// NOW OUR SHORTCODES
	////////////////////////////////////
	
	//COLUMN TEMPLATE
	include('functions/columns/columns.php');
	
	//ROUNDED BUTTONS
	include('functions/buttons/buttons.php');
	
	//NOTIFICATIONS
	include('functions/notifications/notifications.php');
	
	//NOTIFICATIONS
	include('functions/boxed/boxed.php');
	
	//TOGGLE
	include('functions/toggle/toggle.php');
	
	//TOOLTIPS
	include('functions/tooltips/tooltips.php');
	
	//TOGGLE
	include('functions/tabs/tabs.php');
	
	//TOOLTIPS
	include('functions/frames/frames.php');
	
	//IMAGE SLIDER
	include('functions/slider/slider.php');
	
	//AUDIO & VIDEO
	include('functions/audioandvideo/audioandvideo.php');
	
	//SHARE
	include('functions/share/share.php');
	
	//LISTS
	include('functions/lists/lists.php');
	
	//PRICE TABLE
	include('functions/pricing/pricing.php');
	
	//TABLES
	include('functions/tables/tables.php');
	
	//Contact
	include('functions/contact/contact.php');
	
	//Contact
	include('functions/widgets/widgets.php');
	
	//TYPE
	include('functions/type/type.php');
	
	//GENERATOR
	include('functions/generator/functions.php');
	
	//let's trick tinymce into thnking its a new version to clean up the cache
	function my_refresh_mce($ver) {
		
	  $ver += 3;
	  return $ver;
	  
	}
	
	//tricks tinyMCE
	//add_filter( 'tiny_mce_version', 'my_refresh_mce');
	
	//// REMOVES TINYMCE WPAUTOP AND SHOWS THE TAGS IN THE EDITOR
	//remove_filter('the_content', 'wpautop');
	
	//// ADDS THE APPLY_SOURCE_FOMARTTING
	if ( ! function_exists('tadv_mce_options') ) {
		
		function tadv_mce_options($init) {
			
			global $tadv_hidden_row;
			$tadv_options = get_option('tadv_options', array());
			
			$init['apply_source_formatting'] = true;
			
			return $init;
			
		}
		
		add_filter( 'tiny_mce_before_init', 'tadv_mce_options' );
		
	}
	
	//// LETS SHOW THE SNIPPET TO SHOW OUR P AND BR TAGS
	//add_action( 'after_wp_tiny_mce', 'tmce_replace' );
	
	if ( ! function_exists('tmce_replace') ) {
		
		function tmce_replace() {
			
			$tadv_options = get_option('tadv_options', array());
			$tadv_plugins = get_option('tadv_plugins', array());
	
			if ( isset($tadv_options['no_autop']) && $tadv_options['no_autop'] == 1 ) { ?>

				<script type="text/javascript">
                if ( typeof(jQuery) != 'undefined' ) {
                  jQuery('body').bind('afterPreWpautop', function(e, o){
                    o.data = o.unfiltered
                    .replace(/caption\]\[caption/g, 'caption] [caption')
                    .replace(/<object[\s\S]+?<\/object>/g, function(a) {
                      return a.replace(/[\r\n]+/g, ' ');
                    })
					.replace(/<\/p>/g, '</p>\n')
					.replace(/<\/h1>/g, '</h1>\n')
					.replace(/<\/h2>/g, '</h2>\n')
					.replace(/<\/h3>/g, '</h3>\n')
					.replace(/<\/h4>/g, '</h4>\n')
					.replace(/<\/h5>/g, '</h5>\n')
					.replace(/<\/h6>/g, '</h6>\n');
					
                  }).bind('afterWpautop', function(e, o){
                    o.data = o.unfiltered;
                  });
                }
                </script>
                
<?php
                    }
                }	
			}

?>