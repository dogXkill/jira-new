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
              <?php include("menu.php");?>
            </ul>
          </div>
          <div class="page-content">
            <div class="main-wrapper">
              <div class="row">
                <div class="col-sm-12 col-xl-8">
                  <div class="card stat-widget">
                    <div class="card-body">
                      <h5 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Проекты<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable1" class="btn btn-outline-info m-b-xs" style="float:right;">Создать</button></font></font></h5>
                        <?php
                          include("config.php");
                          $id_ac=$_SESSION['id'];
                          $result_pr_1 = mysqli_query($link,"SELECT * FROM `project` WHERE `id_avtor`='".$id_ac."' OR `visible`='1'");
                            if (mysqli_num_rows($result_pr_1) != 0) {
                                while( $row = mysqli_fetch_assoc($result_pr_1) ){
                                  $id_avtor=$row['id_avtor'];
                                  $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_avtor."'");
                                  $user = mysqli_fetch_assoc($result_pr_ac);
                                  if (!empty($user)) {
                                    $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
                                  }else{
                                    $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
                                  }
                                  $name=$row['name'];
                                  $status=$row['status'];
                                  $visible=$row['visible'];
                                  $date_start=$row['date_start'];
                                  $img=$row['img'];
                                  if ($visible==1){
                                    //публичный
                                    $text_visible='<i class="far fa-eye m-r-xxs" title="Публичный"></i>';
                                  }else{
                                    //приват
                                    $text_visible='<i class="fas fa-key m-r-xxs" title="Приватный"></i>';
                                  }
                                  echo '<div class="transactions-list">
                                  <div class="tr-item"><div class="tr-company-name">
                                  ';
                                  echo '<div class="tr-icon tr-card-icon tr-card-bg-primary text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                  </div>';//img
                                  echo '<div class="tr-text">
                                    <h4><font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                    '.$name.'</font></font> '.$text_visible.'</h4>
                                    <p><font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                    '.$user_text.'  '.$date_start.'</font></font></p>
                                  </div>';
                                  echo '</div></div></div>';

                                }
                              }
                         ?>
                        <!-- <div class="transactions-list">
                          <div class="tr-item">
                            <div class="tr-company-name">
                              <div class="tr-icon tr-card-icon tr-card-bg-primary text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                              </div>
                              <div class="tr-text">
                                <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Новый пост получил более 7 тысяч лайков</font></font></h4>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">02 марта</font></font></p>
                              </div>
                            </div>
                          </div>
                          </div> -->
                          <!-- <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-info text-info">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitch"><path d="M21 2H3v16h5v4l4-4h5l4-4V2zm-10 9V7m5 4V7"></path></svg>
                                </div>
                                <div class="tr-text">
                                  <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Разработчик AMA уже запущен</font></font></h4>
                                  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">01 марта</font></font></p>
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <!-- <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-danger text-danger">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                </div>
                                <div class="tr-text">
                                  <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">52 непрочитанных сообщения</font></font></h4>
                                  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">23 февраля</font></font></p>
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <!-- <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-warning text-warning">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                </div>
                                <div class="tr-text">
                                  <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2 новых заказа со страницы магазина</font></font></h4>
                                  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">17 февраля</font></font></p>
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <!-- <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-info text-info">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                </div>
                                <div class="tr-text">
                                  <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Хештег #circl в тренде</font></font></h4>
                                  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">03 февраля</font></font></p>
                                </div>
                              </div>
                            </div>
                          </div> -->
                      </div>
                    </div>
                  </div>
                  <!--  -->
                  <div class="col-sm-6 col-xl-4">
                    <div class="card stat-widget">
                      <div class="card-body">
                        <h5 class="card-title">Чат(Alfa Test)</h5>
                        <?php include("chat.php");?>
                      </div>
                    </div>
                  </div>
                  <!--  -->
                </div>
              </div>
            </div>
          </div>
          <?php include("footer.php");?>

          <div class="modal fade" id="exampleModalScrollable1" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" id="modal_zad_2">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создание проекта </font></font></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрывать"></button>
                </div>
                <div class="modal-body">
                  <span style="display:none" id="avt_id"><?php echo $_SESSION['id'];?></span>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="name_pr"><i class="far fa-edit m-r-xxs"></i></span>
                    <input type="text" class="form-control" placeholder="Название" aria-label="Название" aria-describedby="basic-addon1" id="name_pr_vvod">
                  </div>
                  <div class="form-floating mb-3">
                    <select class="form-select" id="status_pr" aria-label="Пример выбора плавающей метки">
                      <!-- <option selected=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Показать проекты</font></font></option> -->
                      <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Публичный</font></font></option>
                      <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Приватный</font></font></option>
                      <!-- <option value="3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Три</font></font></option> -->
                    </select>
                    <label for="status_pr"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Видимость проекта</font></font></label>
                  </div>
                  <div class="form-floating mb-3">
                    <select class="form-select" id="client_pr" aria-label="Выбор Клиента">
                      <!-- <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Публичный</font></font></option> -->
                      <?php
                      $id_av=$_SESSION['id'];
                      $result_pr_1 = mysqli_query($link,"SELECT * FROM `clients` WHERE `id_ac_av`='".$id_av."'");
                        if (mysqli_num_rows($result_pr_1) != 0) {
                            while( $row = mysqli_fetch_assoc($result_pr_1) ){
                              $id_cl=$row['id'];
                              $name_cl=$row['name_client'];
                              echo '<option value="'.$id_cl.'"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$name_cl.'</font></font></option>';
                            }
                          }
                       ?>
                    </select>
                    <label for="client_pr"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Выбор клиента</font></font></label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="cr_project" ><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Создать</font></font></button>
                  <button type="button" class="btn btn-link m-b-xs" data-bs-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Закрыть</font></font></button>
                </div>
              </div>
      </body>
    </html>
<script>
$(document).ready(function()
{
  $("#cr_project").click(function(e){
    var name_pr=$("#name_pr_vvod").val();
    var status_pr=$("#status_pr").val();
    var id_client=$("#client_pr").val();
    var id_av=$("#avt_id").text();
    $.ajax({
    url: "php_files/cr_project.php",
    type: "POST",
    data: {name_pr:name_pr,status_pr:status_pr,id_av:id_av,id_client:id_client},
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
});
</script>
