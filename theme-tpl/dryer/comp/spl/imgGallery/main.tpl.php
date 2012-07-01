<?
$imgHref = self::get('href');
$dataList = self::get('list');
foreach( $dataList as $item ){
    /*
        $item = ['file' => '{filename}', 'capt' => '{caption}'];
    */
    echo '<div>'.$item['capt'].'</div>';
    echo '<div><img src="'.$imgHref.'s-'.$item['file'].'" alt="'.$item['capt'].'" /></div>';
} // foreach