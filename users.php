<?php include("prov_login.php");

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
                    <!--  -->
                    <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Пользователи</h5>
                              <?php
                              $id_ac=$_SESSION['id'];
                              $data = mysqli_query($link,"SELECT * FROM `account` WHERE `id` = '".$id_ac."' ");
                              $user = mysqli_fetch_assoc($data);
                              if (!empty($user)) {
                              $rol=$user['rol'];
                              if ($rol==0){
                               ?>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Никнейм</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Роль</th>
                                    <th scope="col">Активность</th>
                                    <!-- <th scope="col">Status</th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  //
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
                                    //
                                    //echo $years."|".$days."|".$hours."||";
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
                                  //
                                  $result_ac = mysqli_query($link,"SELECT * FROM `account`");
                                    if (mysqli_num_rows($result_ac) != 0) {
                                        while( $row = mysqli_fetch_assoc($result_ac) ){
                                          $nik=$row['name'];
                                          $status=$row['status'];
                                          $id_ac=$row['id'];
                                          if ($status==1){
                                            //активный
                                            $st_text='<span class="badge bg-success">Активный</span>';
                                          }else{
                                            //выкл.
                                            $st_text='<span class="badge bg-danger">Выкл.</span>';
                                          }
                                          $rol_ac=$row['rol'];
                                          if ($rol_ac==0){
                                            $rol_text="Гл.Администратор";
                                          }else if ($rol_ac==1){
                                            $rol_text="Администратор";
                                          }else{
                                            $rol_text="Пользователь";
                                          }
                                          //
                                          $data = mysqli_query($link,"SELECT * FROM `online` WHERE `id_ac` = '".$id_ac."' ");
                                          $user_online = mysqli_fetch_assoc($data);
                                            if (!empty($user_online)) {
                                              $a=$user_online['date_time'];
                                              $date = new DateTime($a); // получаем объект datetime
                                              // $interval = $date->diff(date_create('now')); // получаем интервал
                                              // $minutes = $interval->i;
                                              $d=load_dat($a);
                                              $m=times_in($date);
                                              //echo $m;
                                              if ($m>2){
                                                $online_text="<span style='font-style:italic;font-weight:900;color:#EE6E83'>Offline</span>  Был в сети: $d";
                                              }else{
                                                $online_text="<span style='font-style:italic;font-weight:900;color:#6bcac2;'>Online</span>";
                                              }
                                            }else{
                                              $online_text="<span style='font-style:italic;font-weight:900;color:#EE6E83'>Offline</span>";
                                            }
                                            //
                                          echo '<tr>
                                            <td>'.$nik.'</td>
                                            <td>'.$st_text.'</td>
                                            <td>'.$rol_text.'</td>
                                            <td>'.$online_text.'</td>
                                          </tr>';
                                        }
                                      }
                                   ?>
                                  <!-- <tr>
                                    <th scope="row"><img src="../../assets/images/avatars/profile-image.png" alt="">Anna Doe</th>
                                    <td>Modern</td>
                                    <td>#53327</td>
                                    <td>$20</td>
                                    <td><span class="badge bg-info">Shipped</span></td>
                                  </tr>
                                  <tr>
                                    <th scope="row"><img src="../../assets/images/avatars/profile-image.png" alt="">John Doe</th>
                                    <td>Alpha</td>
                                    <td>#13328</td>
                                    <td>$25</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                  </tr>
                                  <tr>
                                    <th scope="row"><img src="../../assets/images/avatars/profile-image.png" alt="">Anna Doe</th>
                                    <td>Lime</td>
                                    <td>#35313</td>
                                    <td>$20</td>
                                    <td><span class="badge bg-danger">Pending</span></td>
                                  </tr>
                                  <tr>
                                    <th scope="row"><img src="../../assets/images/avatars/profile-image.png" alt="">John Doe</th>
                                    <td>Circl Admin</td>
                                    <td>#73423</td>
                                    <td>$23</td>
                                    <td><span class="badge bg-primary">Shipped</span></td>
                                  </tr>
                                  <tr>
                                    <th scope="row"><img src="../../assets/images/avatars/profile-image.png" alt="">Nina Doe</th>
                                    <td>Space</td>
                                    <td>#54773</td>
                                    <td>$20</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                  </tr> -->
                                </tbody>
                              </table>
                            </div>
                              <?php
                            }else{
                              echo '<h4>У вас нет доступа к этому разделу';
                            }
                          }

                              ?>
                          </div>
                      </div>
                    <!--  -->
                  </div>
                </div>
              </div>
          </div>
        </div>
        <?php include("footer.php");?>
      </body>
      </html>
