<?php include("prov_login.php");
$id_ac=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>Профиль</title>
        <!--стили и прочее-->
        <?php include("head_file.php");?>

    </head>
    <body>
      <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
          <span class='sr-only'>Loading...</span>
        </div>
      </div>
      <div class="page-container">
        <div class="page-header">
          <!-- шапка -->
            <?php include("header.php");?>
          </div>
          <div class="page-sidebar">
            <ul class="list-unstyled accordion-menu">
              <!-- меню(слева) -->
              <?php include("menu.php");
              include("config.php");
              ?>
            </ul>
          </div>
          <div class="page-content">
              <div class="main-wrapper">
                <div class="row">
                  <div class="col-xl-12">
                      <div class="profile-cover"></div>
                      <div class="profile-header">
                        <style>
                        #user_online{
                          font-size: 0.6em;
                        }
                        </style>
                        <?php
                        function num_decline( $number, $titles, $show_number = 1 ){
                        	if( is_string( $titles ) )
                        		$titles = preg_split( '/, */', $titles );
                        	// когда указано 2 элемента
                        	if( empty( $titles[2] ) )
                        		$titles[2] = $titles[1];
                        	$cases = [ 2, 0, 1, 1, 1, 2 ];
                        	$intnum = abs( (int) strip_tags( $number ) );
                        	$title_index = ( $intnum % 100 > 4 && $intnum % 100 < 20 )
                        		? 2
                        		: $cases[ min( $intnum % 10, 5 ) ];
                        	return ( $show_number ? "$number " : '' ) . $titles[ $title_index ];
                        }

                        //echo num_decline(5, 'минуту , минуты  , минут');
                        function load_dat($tim){
                          $a=$tim;
                          $date = new DateTime($a); // получаем объект datetime
                          $interval = $date->diff(date_create('now'));
                          $years   = $interval->y; // 4 года
                          $months  = $interval->m; // 5 месяцев
                          $days    = $interval->d; // 4 дня
                          $hours   = $interval->h; // 10 часов
                          $minutes = $interval->i; // 11 минут
                          $seconds = $interval->s; // 38 секунд
                          //
                          $years   = $interval->y; // 4 года
                          $months  = $years * 12 + $interval->m; // 53 месяца
                          $days    = $interval->days; // 1618 дней
                          $hours   = $days * 24 + $interval->h; // 38842 часов
                          $minutes = $hours * 60 + $interval->i;
                          if ($years<=0){
                            //то меньше года
                            if ($months<=0){
                              //меньше месяца
                              if ($days<=0){
                                //то меньше дня
                                if ($hours<=0){
                                  //меньше часа
                                  $tims=num_decline($minutes, 'минуту , минуты  , минут').' назад';
                                  //$tims=$minutes." минут(у) назад";
                                }else{
                                  //больше часа
                                  // $tims=$hours." ч. назад";
                                  $tims=num_decline($hours, 'час , часа  , часов').' назад';
                                }
                              }else{
                                //больше дня
                                  $tims=num_decline($days, 'день , дня  , дней').' назад';
                                //$tims=$days." дня(ей) назад";
                              }
                            }else{
                              //больше месяца
                              $tims=$months." месяц(а) назад";
                            }
                          }
                          return $tims;
                        }
                        function times_in($dat){
                          $interval = $dat->diff(date_create('now'));
                          $years   = $interval->y; // 4 года
                          $months  = $years * 12 + $interval->m; // 53 месяца
                          $days    = $interval->days; // 1618 дней
                          $hours   = $days * 24 + $interval->h; // 38842 часов
                          $minutes = $hours * 60 + $interval->i;
                          return $minutes;
                        }
                        $result_acc = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
                        $acc = mysqli_fetch_assoc($result_acc);
                        if (!empty($acc)) {
                          $name=$acc['name'];
                          //онлайн
                          $data = mysqli_query($link,"SELECT * FROM `online` WHERE `id_ac` = '".$id_ac."' ");
                          $user_online = mysqli_fetch_assoc($data);
                            if (!empty($user_online)) {
                              $a=$user_online['date_time'];
                              $date = new DateTime($a); // получаем объект datetime
                              //$interval = $date->diff(date_create('now')); // получаем интервал
                              //$minutes = $interval->i;
                              $d=load_dat($a);
                              $m=times_in($date);
                              //echo $m;
                              if ($m>2){
                                $online_text="Offline Был в сети: $d";
                              }else{
                                $online_text="Online";
                              }
                            }else{
                              $online_text="Offline";
                            }
                          //end
                          ?>
                          <div class="profile-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="">
                          </div>
                          <div class="profile-name">
                              <h3><?php echo $name;?> <span id="user_online"><?php echo $online_text;?></span></h3>
                          </div>
                          <div class="profile-header-menu">
                              <ul class="list-unstyled">
                                  <li><a href="#" class="active">Проекты</a></li>
                                  <!-- <li><a href="#">About</a></li>
                                  <li><a href="#">Friends</a></li>
                                  <li><a href="#">Photos</a></li>
                                  <li><a href="#">Videos</a></li>
                                  <li><a href="#">Music</a></li> -->
                              </ul>
                          </div>
                          <?php
                        }else if (trim($_SESSION['id'])){
                          //выводим свой профиль
                          $id_ac=$_SESSION['id'];
                          $result_acc = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
                          $acc = mysqli_fetch_assoc($result_acc);
                          $name=$acc['name'];
                          //онлайн
                          $data = mysqli_query($link,"SELECT * FROM `online` WHERE `id_ac` = '".$id_ac."' ");
                          $user_online = mysqli_fetch_assoc($data);
                            if (!empty($user_online)) {
                              $a=$user_online['date_time'];
                              $date = new DateTime($a); // получаем объект datetime
                              //$interval = $date->diff(date_create('now')); // получаем интервал
                              //$minutes = $interval->i;
                              $d=load_dat($a);
                              $m=times_in($date);
                              if ($m>2){
                                $online_text="Offline Был в сети: $d";
                              }else{
                                $online_text="Online";
                              }
                            }else{
                              $online_text="Offline";
                            }
                          //end
                          ?>
                          <div class="profile-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="">
                          </div>
                          <div class="profile-name">
                              <h3><?php echo $name;?> <span id="user_online"><?php echo $online_text;?></span></h3>
                          </div>
                          <div class="profile-header-menu">
                              <ul class="list-unstyled">
                                  <li><a href="#" class="active">Проекты</a></li>
                                  <!-- <li><a href="#">About</a></li>
                                  <li><a href="#">Friends</a></li>
                                  <li><a href="#">Photos</a></li>
                                  <li><a href="#">Videos</a></li>
                                  <li><a href="#">Music</a></li> -->
                              </ul>
                          </div>
                          <?php

                        }else{
                          echo 'Пользователь не найден';
                        }
                         ?>

                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include("footer.php");?>
        </body>
        </html>
