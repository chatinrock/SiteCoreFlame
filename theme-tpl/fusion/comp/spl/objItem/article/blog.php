<?
$categoryUrlTpl = self::get('categoryUrlTpl');
$infoData = self::get('infoData');
?>

<div class="frame"><img src="<?=$infoData['prevImgUrl']?>" alt="<?= $infoData['caption'] ?>"/></div>
                        <div class="content">
                            <div class="date">
                                <span class="day">31</span>
                                <span class="year">2012</span>
                                <span class="month">dec</span>
                            </div>
							
                            <ul class="info">
                                <li>Козленко В.Л.</li>
                                <li><a href="#comments">Нет коментариев</a></li>
                                <li>
									<a href="<?= vsprintf($categoryUrlTpl, $infoData['seoName']) ?>" title="Все посты в <?= $infoData['category'] ?>" rel="category tag">
									<?= $infoData['category'] ?>
									</a>
								</li>
                            </ul>
	<div class="clear"></div>
	<div class="twelve columns alpha omega">
		<h1>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</h1>
		<article>	
			<? if ( $infoData['isCloaking'] ){
				self::loadFile(self::get('dir') . 'cloak.txt');
			}else{
				self::loadFile(self::get('dir') . 'kat.txt');
				self::loadFile(self::get('dir') . 'data.txt');
			}?>
		</article>
	</div>
	<div class="clear"></div>
                        </div>      
					