<div class="sidebar-item">
	<h5>Популярные:</h5>
	<ul class="tabbed-posts-recent"><?
                $list = self::get('list');
                $iCount = count($list);
                for( $i = 0; $i < $iCount; $i++ ){
					$caption = $list[$i]['caption'];
					$url = $list[$i]['url'];
					$prevImgUrl = $list[$i]['prevImgUrl'];
					$dateAdd = $list[$i]['dateAdd'];
                    ?><li>
							<a href="<?=$url?>" title="<?=$caption?>">
								<?if ($prevImgUrl){?><img src="<?=$prevImgUrl?>" title="<?=$caption?>" alt="<?=$caption?>" width="50" height="50"/><?}?>
								<span class="title"><?=$caption?></span>
								<span class="date"><?=$dateAdd?></span>
								<div class="clear"></div>
							</a>
					</li><?
                } // for
            ?></ul>
</div>