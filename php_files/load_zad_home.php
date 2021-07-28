<?php
session_start();
include("../config.php");
$id_ac=$_SESSION['id'];
?>
<div class="col-md-6 col-xl-4">
  <div class="card">
    <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h4 style="color:red;">Срочные</h4></font></font></li>
    <ul class="list-group list-group-flush" style="max-height:365px;overflow-y:auto;">
      <?php
      $id_ac=$_SESSION['id'];
      $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE `avtor_id`='".$id_ac."' AND `prior`='1'");
        if (mysqli_num_rows($result_zad) != 0) {
            while( $row_zad = mysqli_fetch_assoc($result_zad) ){
              $name_zad=$row_zad['name'];
              $dat=$row_zad['date'];
              $id_z=$row_zad['id'];
              //
              $id_pr=$row_zad['id_pr'];
              $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."'");
              $project = mysqli_fetch_assoc($result_pr);
              if (!empty($project)) {
                $project_text=' <span style="color:black;">'.$project['name'].'</span>';
              }else{
                $project_text=' <span style="color:black;">None</span>';
              }
              //
              $id_ac=$row_zad['avtor_id'];
              $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
              $user = mysqli_fetch_assoc($result_pr_ac);
              if (!empty($user)) {
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
              }else{
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
              }
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
            }
          }

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

      $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE `avtor_id`='".$id_ac."' AND `prior`='2'");
        if (mysqli_num_rows($result_zad) != 0) {
            while( $row_zad = mysqli_fetch_assoc($result_zad) ){
              $name_zad=$row_zad['name'];
              $dat=$row_zad['date'];
              $id_z=$row_zad['id'];
              //
              $id_pr=$row_zad['id_pr'];
              $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."'");
              $project = mysqli_fetch_assoc($result_pr);
              if (!empty($project)) {
                $project_text=' <span style="color:black;">'.$project['name'].'</span>';
              }else{
                $project_text=' <span style="color:black;">None</span>';
              }
              //
              $id_ac=$row_zad['avtor_id'];
              $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
              $user = mysqli_fetch_assoc($result_pr_ac);
              if (!empty($user)) {
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
              }else{
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
              }
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
            }
          }
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

      $result_zad = mysqli_query($link,"SELECT * FROM `zadach` WHERE `avtor_id`='".$id_ac."' AND `prior`='3'");
        if (mysqli_num_rows($result_zad) != 0) {
            while( $row_zad = mysqli_fetch_assoc($result_zad) ){
              $name_zad=$row_zad['name'];
              $dat=$row_zad['date'];
              $id_z=$row_zad['id'];
              //
              $id_pr=$row_zad['id_pr'];
              $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."'");
              $project = mysqli_fetch_assoc($result_pr);
              if (!empty($project)) {
                $project_text=' <span style="color:black;">'.$project['name'].'</span>';
              }else{
                $project_text=' <span style="color:black;">None</span>';
              }
              //
              $id_ac=$row_zad['avtor_id'];
              $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_ac."'");
              $user = mysqli_fetch_assoc($result_pr_ac);
              if (!empty($user)) {
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
              }else{
                $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
              }
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
            }
          }
       ?>
      <!-- <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Второй предмет</font></font></li>
      <li class="list-group-item"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Третий предмет</font></font></li>
    </ul> -->
  </div>
</div>
</div>
<script>
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
</script>
