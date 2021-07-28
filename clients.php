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
        <title>Клиенты</title>
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
                              <h5 class="card-title">Клиенты</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Статус</th>
                                    <!-- <th scope="col">Роль</th>
                                    <th scope="col">Активность</th> -->
                                    <!-- <th scope="col">Status</th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  //
                                  $id_ac=$_SESSION['id'];
                                  $result_ac = mysqli_query($link,"SELECT * FROM `clients` WHERE  `id_ac_av`='".$id_ac."'");
                                    if (mysqli_num_rows($result_ac) != 0) {
                                        while( $row = mysqli_fetch_assoc($result_ac) ){
                                          $nik=$row['name_client'];
                                          $status=$row['status'];
                                          $id_cl=$row['id'];
                                          if ($status==1){
                                            //активный
                                            $st_text='<span class="badge bg-success">Активный</span>';
                                          }else{
                                            //выкл.
                                            $st_text='<span class="badge bg-danger">Выкл.</span>';
                                          }
                                          echo '<tr>
                                            <td>'.$nik.'</td>
                                            <td>'.$st_text.'</td>
                                          </tr>';
                                        }
                                      }else{
                                        echo "<h3>Клиентов не найдено.</h3>";
                                      }
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
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
