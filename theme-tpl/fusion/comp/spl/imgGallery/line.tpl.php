<style>
			#imgGallary{
				background: white; 	
				margin-top: 15px;
				padding: 18px 0 18px;
			}
			
			#imgGallary img{
				width: 150px;
				height: 100px;
				margin-left: 5px;
			}
			
			div.objList {             
				position:relative;
				left: -50%;
				float: left;
			}
			
			div.objCenterCont {
				float: left;   
				position:relative;
				left: 50%;                
			}
		</style>
		
<div id="imgGallary">
	<div class="container">
		<h3>Наши клиенты</h3>
		<div class="objCenterCont">
		<div class="objList">
		<?
		// $imgHref = self::get('hrefResize');
		$imgHref = self::get('hrefDist');
		$dataList = self::get('list');
		foreach( $dataList as $item ){
			/*
				$item = ['file' => '{filename}', 'capt' => '{caption}'];
			*/
			$caption = $item['capt'];
			$imgSrc = $imgHref.$item['file'];
			echo '<img src="'.$imgSrc.'" alt="'.$caption.'" title="'.$caption.'"/>';
		} // foreach
		?>
		</div>
	</div>
	</div>
</div>