<?
/*
RSS
https://3dnews.ru/community
*/
$mas_rss=['gadgets'=>'https://3dnews.ru/gadgets/rss/'
,'soft'=>'https://3dnews.ru/software-news/rss/'
,'hard'=>'https://3dnews.ru/hardware-news/rss'
,'game'=>'https://3dnews.ru/games/rss/'
,'cpu'=>'https://3dnews.ru/cpu/rss/'
,'mat-plata'=>'https://3dnews.ru/motherboard/rss/'
,''];
$url = 'https://3dnews.ru/gadgets/rss/'; //

$rss = simplexml_load_file($url); //Функция интерпретирует XML-файл в объект

//цикл для считывания всей RSS ленты
foreach ($rss->channel->item as $item) {

echo '<h1>'.$item->title.'</h1>'; //выводим на экран заголовок статьи

echo $item->description; //выводим на экран текст статьи

echo '</br></br>';

}
//парсинг - >
//либо js-mediator-article 
//entry-body-> p1
?>
