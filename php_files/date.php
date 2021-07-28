<?php
$a = '2021-07-05 11:11:09';
// $b = new \DateTime;
$date = new DateTime($a); // получаем объект datetime
$interval = $date->diff(date_create('now')); // получаем интервал
// сколько прошло времени
$years   = $interval->y; // 4 года
$months  = $interval->m; // 5 месяцев
$days    = $interval->d; // 4 дня
$hours   = $interval->h; // 10 часов
$minutes = $interval->i; // 11 минут
$seconds = $interval->s; // 38 секунд

// сколько прошло времени суммарно
$years   = $interval->y; // 4 года
$months  = $years * 12 + $interval->m; // 53 месяца
$days    = $interval->days; // 1618 дней
$hours   = $days * 24 + $interval->h; // 38842 часов
$minutes = $hours * 60 + $interval->i; // 2330531 минут
$seconds = $minutes * 60 + $interval->s; // 139831898 секунд
echo $minutes;
//echo $a->diff($b)->i; // => 1
 ?>
