<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
	<head>
        <meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?= $this->block('head') ?>
        <meta name="viewport" content="width=device-width" />
		<link rel="shortcut icon" href="/res/favicon.ico" />
        <link rel="alternate" type="application/rss+xml" title="Rss лента" href="/res/main.rss" />
		<meta name="generator" content="Flame 2.4" />

        <link rel="stylesheet" type="text/css" media="all" href="http://theme.codecampus.ru/ultrasharp/css/style.css" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/colors/blue.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/shortcodes.css" media="screen" />
        <link rel="stylesheet" href="http://theme.codecampus.ru/ultrasharp/css/fixed.css" media="screen" />  
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
		<script type='text/javascript' src='http://theme.codecampus.ru/ultrasharp/js/scripts.js?ver=3.4'></script>
<style type="text/css">
.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
</style>
<style type="text/css">
    	h1, h2, h3, h4, h5, h6 { color: #505050 !important; }
		.page-title { color: #111111 !important; }
		
    	.page-slogan { color: #999999 !important; }
		
		h1, .page-title { font-size: 32px; line-height: 36px; }
		h2 { font-size: 26px; line-height: 30px; }
		h3 { font-size: 22px; line-height: 26px; }
		h4 { font-size: 16px; line-height: 20px; }
		h5 { font-size: 14px; line-height: 18px; }
		h6 { font-size: 11px; line-height: 15px; }
    
    	#footer h1, #footer h2, #footer h3, 
		#footer h4, #footer h5, #footer h6 { color: #ffffff !important; }
 </style>
<style type="text/css">
    	h1, h2, h3, h4, h5, h6 { font-family: Helvetica, Arial, sans-serif !important; font-style: normal !important; font-weight: bold !important; }
		
    	.page-slogan { font-family: Georgia, "Times New Roman", serif !important; font-style: italic !important; font-weight: normal !important; }
		
		h1 { font-size: 32px; line-height: 36px; }
		h2 { font-size: 26px; line-height: 30px; }
		h3 { font-size: 22px; line-height: 26px; }
		h4 { font-size: 16px; line-height: 20px; }
		h5 { font-size: 14px; line-height: 18px; }
		h6 { font-size: 11px; line-height: 15px; }
		.page-title { font-size: 40px; line-height: 44px; }
		
		a { color: #2d8fd2; }
		a:hover { color: #156ca8; }
</style>   
<script type="text/javascript">
			jQuery(document).ready(function() {
				//TOP BAR MENU DROPDOWN
				$('#top-bar ul').ddDropDown(true);
				
				//SEARCH BOX
				//$('#search-box').searchBox();
				//$('#search-box').ajaxSearch('#/themes/ultrasharp');				
				//gallery
				//$('.ddGallery').each(function() { jQuery(this).ddGallery(); });
				
				//replaces our select, radios and checkbox
				$('select:not(#select-preview-color)').each(function() { $(this).ddReplaceSelect(); });
				$('input[type="radio"]').each(function() { $(this).ddReplaceRadio(); });
				$('input[type="checkbox"]').each(function() { $(this).ddReplaceCheckbox(); });
				
			});
			
			$(window).load(function() {
				//fades out slightly on hover
				//jQuery('.ddFromTheBlog a img, .ddGallery li img, .flickr-widget img').ddFadeOnHover(.7);
				//jQuery('.post-thumb img, #related-posts img, #portfolio-slider-thumbs li img').ddFadeOnHover(.8);
				
				//animates our menu
				jQuery('#main-bar').mainBar('227dbd');
		
			});
</script> 
</head>
<body class="home blog fixed-page">
<?= $this->block('header') ?>
<?= $this->block('precontent') ?>
<?= $this->block('content') ?>
<?= $this->block('footer') ?>
<?= $this->block('copyright') ?>
<? $this->block('scriptStatic') ?>
<? $this->block('scriptDyn') ?>
</body>
</html>