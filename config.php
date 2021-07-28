<?php
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'jira-new');
define('DB_PORT', '3306');
$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD,DB_DATABASE)
    or die("Ошибка " . mysqli_error($link));
  $link->set_charset("utf8");
$value="&#8381;";//валюта
  //для PDO
  $charset = 'utf8';
$host=DB_HOSTNAME;
$db=DB_DATABASE;
$user=DB_USERNAME;
$pass=DB_PASSWORD;

   $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
   $opt = [
       PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES   => 0,
   ];
   $pdo = new PDO($dsn, $user, $pass, $opt);

 ?>
