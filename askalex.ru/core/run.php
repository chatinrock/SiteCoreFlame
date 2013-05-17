<?
$dataTpl = '{"email":"%email%","file":"sender/sender.json","subject":"%name%, не путайте Facebook и feedback","vars":{"name":"%name%","emailId":"%emailId%","senderNum":"%senderNum%"}}';

$senderNum = 1;

$fr = fopen('db.txt', 'r');
while(!feof($fr)){
    $text = trim(fgets($fr));
    if ( !$text){
        continue;
    }
    $manData = explode("\t", $text);

    $mailId = $manData[0];
    $name = $manData[2];

    $mailData = str_replace("%email%", $manData[1], $dataTpl);
    $mailData = str_replace("%name%", $name, $mailData);
    $mailData = str_replace("%senderNum%", $senderNum, $mailData);
    $mailData = str_replace("%emailId%", $mailId, $mailData);

    //echo $mailData.PHP_EOL;
    file_put_contents('test/mail_'.$mailId, $mailData);
} // while


fclose($fr);





/*
$mailId = 23;
$mailData = str_replace("%email%", 'alex@askalex.ru', $dataTpl);
$mailData = str_replace("%name%", 'Александр', $mailData);
$mailData = str_replace("%senderNum%", $senderNum, $mailData);
$mailData = str_replace("%mailId%", 23, $mailData);


file_put_contents('test/mail_'.$mailId, $mailData);
*/

