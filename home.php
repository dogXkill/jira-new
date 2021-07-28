<?php include("prov_login.php");?>
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
        <title>Главная</title>
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
                <!--  -->
                <div class="row">
                  <div class="col-sm-6 col-xl-8">
                    <!--  -->
                    <div class="row">
                      <div class="col-md-6 col-xl-4">
                        <div class="card stat-widget">
                          <div class="card-body">
                            <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">новые клиенты</font></font></h5>
                            <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">132</font></font></h2>
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">С прошлой недели</font></font></p>
                            <div class="progress">
                              <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-4">
                        <div class="card stat-widget">
                          <div class="card-body">
                            <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Заказы</font></font></h5>
                            <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">287</font></font></h2>
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Заказы в списке ожидания</font></font></p>
                            <div class="progress">
                              <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-4">
                        <div class="card stat-widget">
                          <div class="card-body">
                            <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ежемесячная прибыль</font></font></h5>
                            <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7,4 тыс.</font></font></h2>
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">За последние 30 дней</font></font></p>
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--  -->
                    <div class="card">
                      <div class="card-body" style="position: relative;">
                        <h5 class="card-title">Задачи <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" class="btn btn-outline-info m-b-xs" style="float:right;">Создать</button></h5>
                      </div>
                    </div>
                    <!--  -->
                    <div class="row" id="cont_zad">
                    <div class="col-md-6 col-xl-4">
                      <div class="card">
                        <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:red;">Срочные</h4></font></font></li>
                        <ul class="list-group list-group-flush" style="max-height:365px;overflow-y:auto;">
                          <?php
                          $id_ac_osn=$_SESSION['id'];
                          function load_zad($tip_zad,$link){
                            $id_ac_osn=$_SESSION['id'];
                            $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `visible`='1' OR `id_avtor`='".$id_ac_osn."'");
                            if (mysqli_num_rows($result_pr) != 0) {
                              while( $row_pr = mysqli_fetch_assoc($result_pr) ){
                                $id_pr=$row_pr['id'];
                                $name_pr=$row_pr['name'];
                                $id_avtor_pr=$row_pr['id_avtor'];
                                $project_text=' <span style="color:black;">'.$name_pr.'</span>';
                                  $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_avtor_pr."'");
                                  $user = mysqli_fetch_assoc($result_pr_ac);
                                  if (!empty($user)) {
                                    $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
                                  }else{
                                    $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
                                  }
                                $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE  `id_pr`='".$id_pr."' AND `status`='1' AND `prior`='".$tip_zad."'");
                                if (mysqli_num_rows($result_zad) != 0) {
                                  while( $row_zad = mysqli_fetch_assoc($result_zad) ){
                                    $name_zad=$row_zad['name'];
                                    $dat=$row_zad['date'];
                                    $id_z=$row_zad['id'];
                                    //
                                            echo '<li class="list-group-item">
                                            <a class="open_zadach" href="#" id="z_'.$id_z.'" data-bs-target="#exampleModalScrollable1" data-bs-toggle="modal">
                                            <font style="vertical-align: inherit;">
                                              <font style="vertical-align: inherit;">
                                                '.$name_zad.'
                                              </font>
                                            </font>
                                            </a>
                                            <p>'.$project_text.'
                                              <span style="float:right;">'.$user_text.'</span>
                                            </p>
                                            <p>
                                            <i class="fas fa-clock"></i> Сдача до : '.$dat.'
                                            </p>
                                            </li>';
                                    //
                                  }
                                }
                              }
                            }

                          }//end function

                          // $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE  `prior`='1'");//`avtor_id`='".$id_ac."' AND
                          //   if (mysqli_num_rows($result_zad) != 0) {
                          //       while( $row_zad = mysqli_fetch_assoc($result_zad) ){
                          //         $name_zad=$row_zad['name'];
                          //         $dat=$row_zad['date'];
                          //         $id_z=$row_zad['id'];
                          //         //
                          //         $id_pr=$row_zad['id_pr'];
                          //         $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."' AND `id_avtor`='".$id_ac_osn."' OR `visible`='1'");
                          //         // echo "SELECT * FROM `project` WHERE `id`='".$id_pr."' AND `avtor_id`='".$id_ac."' OR `visible`='1'";
                          //         $project = mysqli_fetch_assoc($result_pr);
                          //         if (!empty($project)) {
                          //           $project_text=' <span style="color:black;">'.$project['name'].'</span>';
                          //         }else{
                          //           $project_text=' <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         $id_ac=$row_zad['avtor_id'];
                          //         $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
                          //         $user = mysqli_fetch_assoc($result_pr_ac);
                          //         if (!empty($user)) {
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
                          //         }else{
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         echo '<li class="list-group-item">
                          //         <a class="open_zadach" href="#" id="z_'.$id_z.'" data-bs-target="#exampleModalScrollable1" data-bs-toggle="modal">
                          //         <font style="vertical-align: inherit;">
                          //           <font style="vertical-align: inherit;">
                          //             '.$name_zad.'
                          //           </font>
                          //         </font>
                          //         </a>
                          //         <p>'.$project_text.'
                          //           <span style="float:right;">'.$user_text.'</span>
                          //         </p>
                          //         <p>
                          //         <i class="fas fa-clock"></i> Сдача до : '.$dat.'
                          //         </p>
                          //         </li>';
                          //       }
                          //     }
                          load_zad(1,$link);
                           ?>
                          <!-- <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Второй предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li> -->
                        </ul>
                      </div>
                    </div>
                    <!--  -->
                    <div class="col-md-6 col-xl-4">
                      <div class="card">
                        <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:#ff6a00;">Средне</h4></font></font></li>
                        <ul class="list-group list-group-flush" style="max-height:365px;overflow-y:auto;">
                          <?php

                          // $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE `prior`='2'");//`avtor_id`='".$id_ac."' AND
                          //   if (mysqli_num_rows($result_zad) != 0) {
                          //       while( $row_zad = mysqli_fetch_assoc($result_zad) ){
                          //         $name_zad=$row_zad['name'];
                          //         $dat=$row_zad['date'];
                          //         $id_z=$row_zad['id'];
                          //         //
                          //         $id_pr=$row_zad['id_pr'];
                          //         $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."' AND `id_avtor`='".$id_ac_osn."' OR `visible`='1'");
                          //         $project = mysqli_fetch_assoc($result_pr);
                          //         if (!empty($project)) {
                          //           $project_text=' <span style="color:black;">'.$project['name'].'</span>';
                          //         }else{
                          //           $project_text=' <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         $id_ac=$row_zad['avtor_id'];
                          //         $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
                          //         $user = mysqli_fetch_assoc($result_pr_ac);
                          //         if (!empty($user)) {
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
                          //         }else{
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         echo '<li class="list-group-item">
                          //         <a class="open_zadach" href="#" id="z_'.$id_z.'" data-bs-target="#exampleModalScrollable1" data-bs-toggle="modal">
                          //         <font style="vertical-align: inherit;">
                          //           <font style="vertical-align: inherit;">
                          //             '.$name_zad.'
                          //           </font>
                          //         </font>
                          //         </a>
                          //         <p>'.$project_text.'
                          //           <span style="float:right;">'.$user_text.'</span>
                          //         </p>
                          //         <p>
                          //         <i class="fas fa-clock"></i> Сдача до : '.$dat.'
                          //         </p>
                          //         </li>';
                          //       }
                          //     }
                          load_zad(2,$link);
                           ?>
                          <!-- <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Второй предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li> -->
                        </ul>
                      </div>
                    </div>
                    <!--  -->
                    <div class="col-md-6 col-xl-4">
                      <div class="card">
                        <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:#4c940a;">Несрочно</h4></font></font></li>
                        <ul class="list-group list-group-flush" style="max-height:365px;overflow-y:auto;">
                          <?php
                          load_zad(3,$link);
                          // $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE `prior`='3'");
                          //   if (mysqli_num_rows($result_zad) != 0) {
                          //       while( $row_zad = mysqli_fetch_assoc($result_zad) ){
                          //         $name_zad=$row_zad['name'];
                          //         $dat=$row_zad['date'];
                          //         $id_z=$row_zad['id'];
                          //         //
                          //         $id_pr=$row_zad['id_pr'];
                          //         $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."' AND (`id_avtor`='".$id_ac_osn."' OR `visible`='1')");
                          //         $project = mysqli_fetch_assoc($result_pr);
                          //         if (!empty($project)) {
                          //           $project_text=' <span style="color:black;">'.$project['name'].'</span>';
                          //         }else{
                          //           $project_text=' <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         $id_ac=$row_zad['avtor_id'];
                          //         $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
                          //         $user = mysqli_fetch_assoc($result_pr_ac);
                          //         if (!empty($user)) {
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
                          //         }else{
                          //           $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
                          //         }
                          //         //
                          //         echo '<li class="list-group-item">
                          //         <a class="open_zadach" href="#" id="z_'.$id_z.'" data-bs-target="#exampleModalScrollable1" data-bs-toggle="modal">
                          //         <font style="vertical-align: inherit;">
                          //           <font style="vertical-align: inherit;">
                          //             '.$name_zad.'
                          //           </font>
                          //         </font>
                          //         </a>
                          //         <p>'.$project_text.'
                          //           <span style="float:right;">'.$user_text.'</span>
                          //         </p>
                          //         <p>
                          //         <i class="fas fa-clock"></i> Сдача до : '.$dat.'
                          //         </p>
                          //         </li>';
                          //       }
                          //     }
                           ?>
                          <!-- <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Второй предмет</font></font></li>
                          <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
                        </ul> -->
                      </div>
                    </div>
                    </div>
                    <!--  -->
                  </div>
                  <div class="col-sm-6 col-xl-4">
                    <div class="card stat-widget">
                      <div class="card-body">
                        <h5 class="card-title">Чат(Alfa Test)</h5>
                        <?php include("chat.php");?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать задачу</font></font></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрывать"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect" aria-label="Пример выбора плавающей метки">
            <!-- <option selected=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Показать проекты</font></font></option> -->
            <?php

            $av_id=$_SESSION['id'];
            $result_pr_1 = mysqli_query($link,"SELECT * FROM `project` WHERE `id_avtor`='".$av_id."' OR `visible`='1'");
              if (mysqli_num_rows($result_pr_1) != 0) {
                  while( $row = mysqli_fetch_assoc($result_pr_1) ){
                    $id_pr=$row['id'];
                    $name_pr=$row['name'];
                    echo '<option value="'.$id_pr.'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$name_pr.'</font></font></option>';
                  }
                }
             ?>

            <!-- <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Один</font></font></option>
            <option value="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Два</font></font></option>
            <option value="3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Три</font></font></option> -->
          </select>
          <label for="floatingSelect"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выбор проекта</font></font></label>
        </div>
        <!--  -->
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="far fa-edit m-r-xxs"></i></span>
          <input type="text" class="form-control" placeholder="краткое название" aria-label="краткое название" aria-describedby="basic-addon1" id="name">
        </div>
        <!--  -->
        <div class="input-group mb-3">
          <span class="input-group-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Описание</font></font></span>
          <textarea class="form-control" aria-label="Описание" id="opis"></textarea>
        </div>
        <!--  -->
        <div class="form-floating mb-3">
          <select class="form-select" id="floatingSelect_prior" aria-label="Приоритет">
            <option selected=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выбрать приоритет</font></font></option>
            <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Срочно</font></font></option>
            <option value="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Средне</font></font></option>
            <option value="3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Несрочно</font></font></option>
          </select>
          <label for="floatingSelect"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выбор приоритета</font></font></label>
        </div>
        <!--  -->
        <div class="input-group mb-3">
          <span class="input-group-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Теги</font></font></span>
          <!-- <textarea id="text_tag" class="form-control" aria-label="теги"></textarea> -->
          <input type="text" id="text_tag" class="form-control" aria-label="теги" placeholder="для добавления тегов нажмите Enter">
        </div>
        <div class="input-group mb-1">
          <p id="mas_tag"></p>
        </div>
        <!--  -->
        <div class="input-group mb-3" id="name_ac">
          <span class="input-group-text" id="basic-addon1"><i class="far fa-user m-r-xxs"></i></span>
          <input type="text" value="<?php echo $_SESSION['name'];?>"  class="form-control" placeholder="Автор" aria-label="Автор" aria-describedby="basic-addon1" disabled>
          <input type="hidden"  value="<?php echo $_SESSION['id'];?>" >
        </div>
        <!--  -->
        <div class="input-group ">
          <label for="date_sd" class="form-label">дата окончания:</label>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon2"><i class="far fa-calendar m-r-xxs"></i></span>
          <input type="date"  id="date_sd" class="form-control" placeholder="Дата окончания" aria-label="дата окончания" aria-describedby="basic-addon1">
            <input type="time"  id="time_sd" class="form-control" placeholder="Время окончания" aria-label="время окончания" aria-describedby="basic-addon1">
        </div>
        <!--  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="cre_zadach" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать</font></font></button>
        <button type="button" class="btn btn-link m-b-xs" data-bs-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Отмена</font></font></button>
      </div>
    </div>
  </div>
</div>
<!--  -->
<style>
@media (min-width: 576px)
{
#modal_zad_2{
  max-width: 1000px;
}}
</style>

<div class="modal fade" id="exampleModalScrollable1" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" id="modal_zad_2">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Задача <span id="title_zadach_1"></span></font></font></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрывать"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 col-xl-8 " style="overflow-y:auto;max-height:400px;">
            <h3 id="name_zadach"></h3>
            <p class="card-description"><span id="pr_name"></span><span style="display:none;" id="pr_id"></span></p>
            <span style="display:none" id="zad_id"></span>
            <p class="card-description" style="margin-bottom:2px;">Описание</p>
            <div class="input-group mb-3">
              <textarea id="zad_opis" class="form-control"></textarea>
            </div>
            <p class="card-description" style="margin-bottom:2px;">Теги:</p>
            <div class="input-group mb-3" id="zad_tags">

            </div>
            <hr>
            <p class="card-description"><b>Комментарии:</b></p>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon0"><i class="far fa-edit m-r-xxs"></i></span>
              <input type="text" class="form-control" placeholder="Добавить комментарий" aria-label="Добавить комментарий" aria-describedby="basic-addon0" id="vvod_com">
                <button class="btn btn-primary" id="btn_vvod_com">отправить</button>
            </div>


            <div class="form-floating " style="margin-bottom:2px;" id="comment_block">
              <!-- <div class="row">
                <div class="col-sm-1 col-xl-1">
                  <img src="https://i0.wp.com/avatar-management--avatars.us-west-2.prod.public.atl-paas.net/initials/S-4.png?ssl=1" style="max-width:32px;">
                </div>
                <div class="col-sm-11 col-xl-11">
                  <p style="margin-bottom: 0px;"><b>Slava</b> <span style="font-size:0.8em"> 10 минут назад</span></p>
                  <p>TEXT</p>
                </div>
              </div> -->
              <?php //for ($i=0;$i<30;$i++){
                //echo "1</br>";
                ?>
                <!-- <div class="row">
                  <div class="col-sm-1 col-xl-1">
                    <img src="https://i0.wp.com/avatar-management--avatars.us-west-2.prod.public.atl-paas.net/initials/S-4.png?ssl=1" style="max-width:32px;">
                  </div>
                  <div class="col-sm-11 col-xl-11">
                    <p style="margin-bottom: 0px;"><b>Slava</b> <span style="font-size:0.8em"> 10 минут назад</span></p>
                    <p>TEXT</p>
                  </div>
                </div> -->
                <?php
              //}?>
            </div>
          </div>
          <div class="col-sm-6 col-xl-4 ">
            <div class="form-floating mb-3">
              <select class="form-select" id="zad_status" aria-label="Floating label select example">
                <option value="1">В работе</option>
                <option value="2">Выполнено</option>
                <option value="3">Невыполнено</option>
                <option value="4">Отмена</option>
                </select>
              <label for="zad_status">Статус задачи</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" id="zad_prior" aria-label="Floating label select example">
                <option value="1" style="background: #fad7dd; color: #ee6e83;">Срочно</option>
                <option value="2" style="background: #fff5e0; color: #ffaf0f;">Средне</option>
                <option value="3" style="background: #d3fbf9; color: #6bcac2;">Несрочно</option>
                </select>
              <label for="zad_prior">Приоритет</label>
            </div>
            <div class="form-floating mb-3">
              <p>Автор: <span id="zad_avtor"></span><span style="display:none;" id="zad_av_id"></span></p>
            </div>
            <div class="form-floating mb-3">
              <p>Дата окончания: <span id="zad_dat"></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="izm_zadach" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Изменить</font></font></button>
        <button type="button" class="btn btn-link m-b-xs" data-bs-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Закрыть</font></font></button>
      </div>
    </div>
  </div>
</div>
<!--  -->
      <?php include("footer.php");?>
      <!-- <link rel="stylesheet" href="assets/css/selectric.css">
      <script src="assets/js/jquery.selectric.min.js"></script> -->

    </body>
</html>
<script>
$(document).ready(function()
{
//   $(function() {
//   $('#zad_prior').selectric();
// });
  mas_tag_ob=[];
  $('#text_tag').keydown(function(e) {
 if(e.keyCode == 13) {
   console.log($(this).val());
   mas_tag_ob.push($(this).val());
   var mas_tag=$("#mas_tag").html();
   if (mas_tag!=""){
     $("#mas_tag").html();
     $("#mas_tag").html(mas_tag+" "+"<li class='tag_row'><button class='tag'><span class='value-text'>"+$(this).val()+"</span> </button><em class='item-delete' aria-label=' ' original-title=''></em></li>");
   }else{
     $("#mas_tag").html("<li class='tag_row'><button class='tag'><span class='value-text'>"+$(this).val()+"</span></button><em class='item-delete' aria-label=' ' original-title=''></em></li>");
   }
   $('#text_tag').val("");
 }
  });
  $("#cre_zadach").click(function(e){
    console.log("Проект:"+$("#floatingSelect").val());
    console.log("краткое название:"+$("#name").val());
    console.log("описание:"+$("#opis").val());
    console.log("Приоритет:"+$("#floatingSelect_prior").val());
    console.log("Тэги:"+mas_tag_ob);
    console.log("ID_ac:"+$("#name_ac input[type='hidden']").val());
    console.log("data time:"+$("#date_sd").val()+' '+$("#time_sd").val());
    mas_dan_zad=[];
    mas_dan_zad[0]=$("#floatingSelect").val();
    mas_dan_zad[1]=$("#name").val();
    mas_dan_zad[2]=$("#opis").val();
    mas_dan_zad[3]=$("#floatingSelect_prior").val();
    mas_dan_zad[4]=mas_tag_ob;
    mas_dan_zad[5]=$("#name_ac input[type='hidden']").val();
    mas_dan_zad[6]=$("#date_sd").val()+' '+$("#time_sd").val();
    $.ajax({
    url: "php_files/cr_zad.php",
    type: "POST",
    data: {mas:mas_dan_zad},
    cache: false,
    success: function(html){
      if (html==1){
        //ok
        alert("Добавлено");

      }else{
      alert("Ошибка");
      // console.log(html);
    }
    },error:function(html){
      alert("Ошибка");
      // console.log(html);
    }
    });
  });
  //
  function obn_com(id_z){
    $.ajax({
    url: "php_files/obn_com.php",
    type: "POST",
    data: {id_zad:id_z},
    cache: false,
    success: function(html){
      $("#comment_block").html(html);
    },error:function(html){
      $("#comment_block").html(html);
    }
    });
  }
  //
  $(".open_zadach").click(function(e){
    //console.log($(this).attr("id").split("_"));
    zad_number_id=$(this).attr("id").split("_");
    zad_number_id=zad_number_id[1];
    //
    $.ajax({
    url: "php_files/open_zadach.php",
    type: "POST",
    dataType: 'json',
    data: {zad_id:zad_number_id},
    cache: false,
    success: function(html){
      //mas_res=html;
      //console.log(html.id_pr);
      $("#pr_name").html(html.project_text);
      $("#pr_id").html(html.id_p);
      $("#title_zadach_1").html(html.name);
      $("#name_zadach").html(html.name);
      $("#zad_id").html(html.id_zad);
      $("#zad_opis").html(html.opis);
      $('#zad_status option[value='+html.status+']').prop('selected', true);
      $('#zad_prior option[value='+html.prior+']').prop('selected', true);
      $('#zad_tags').html(html.tags);
      $("#zad_avtor").html(html.user_text);
      $("#zad_av_id").html(html.avtor_id);//
      $("#zad_dat").html(html.dat);
      //$("#zad_id").html(html.id_zad);
      //$("#zad_id").html(html.id_zad);
      obn_com(html.id_zad);

    },error:function(html){
      //mas_res=html;
      //console.log(mas_res);

      // console.log(html);
    }
    });
    //
  });
  //
  function load_zad(){
    $("#cont_zad").html("");
    $.ajax({
    url: "php_files/load_zad_home.php",
    type: "POST",
    //dataType: 'json',

    cache: false,
    success: function(html){
      $("#cont_zad").html(html);
    }});
  }
  //
  $("#izm_zadach").click(function(e){
    var id_zad=$("#zad_id").text();
    var zad_opis=$("#zad_opis").val();
    var zad_status=$("#zad_status").val();
    var zad_prior=$('#zad_prior').val();
    //
    $.ajax({
    url: "php_files/izm_zad.php",
    type: "POST",
    dataType: 'json',
    data: {id_zad:id_zad,opis:zad_opis,status:zad_status,prior:zad_prior},
    cache: false,
    success: function(html){

    }
    });
    //
      load_zad();
  });
  //
  $("#btn_vvod_com").click(function(e){
    var text=$("#vvod_com").val();
    var id_av=$("#zad_av_id").text();
    var id_zad=$("#zad_id").text();
    $.ajax({
    url: "php_files/add_com.php",
    type: "POST",
    data: {id_av:id_av,text:text,id_zad:id_zad},
    cache: false,
    success: function(html){
      if (html==1){
        //ok
        //alert("Добавлено");
        $("#vvod_com").val("");
        obn_com(id_zad);
      }else{
      //alert("Ошибка");
      // console.log(html);
    }
    },error:function(html){
      //alert("Ошибка");
      // console.log(html);
    }
    });
  });
  //
});
</script>
