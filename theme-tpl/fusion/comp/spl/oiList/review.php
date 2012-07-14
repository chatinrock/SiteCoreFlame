<?$oiListData=self::get('oiListData')?>
            		<div class="sixteen columns _portfolio function">

                    <div id="portfolio" class="portfolio-3">
                        <ul class="portfolio-list">
                            <?
							$previewCount = count($oiListData);
							for($i=0; $i < $previewCount; $i++){
								$class = $i==0 ? 'alpha' : 'omega';
							?>
                            <li class="one-third column item all webdesign <?=$class?>">
                                <div class="img">
									<img class="portfolio-overlay-item" src="<?=$oiListData[$i]['prevImgUrl']?>" width="300" height="200" alt="Смотреть" rel="#"/>
								</div>
                                <div class="info">
                                    <h4><?=$oiListData[$i]['caption']?></h4>
                                    <p><?=$oiListData[$i]['text']?></p>
                                </div>
                            </li>
							<?}?>
                        </ul>
                        <div class="clear"></div>
                    </div>
            		</div>
