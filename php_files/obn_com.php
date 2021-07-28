<?php
$id_zad=$_POST['id_zad'];
include("../config.php");
$result_zad_1 = mysqli_query($link,"SELECT * FROM `cooment_zad` WHERE `id_zad`='".$id_zad."' ");
  if (mysqli_num_rows($result_zad_1) != 0) {
        while( $row = mysqli_fetch_assoc($result_zad_1) ){
          // echo '';
          $id_av=$row['id_user'];
          $dat=$row['dat'];
          $text=$row['text'];
          //
          $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$id_av."'");
          $user = mysqli_fetch_assoc($result_pr_ac);
          if (!empty($user)) {
            $user_name=$user['name'];
            //$user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
          }else{
            $user_name="None";
            //$user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
          }
          //
          ?>
          <div class="row">
            <div class="col-sm-1 col-xl-1">
              <img src="https://i0.wp.com/avatar-management--avatars.us-west-2.prod.public.atl-paas.net/initials/S-4.png?ssl=1" style="max-width:32px;">
            </div>
            <div class="col-sm-11 col-xl-11">
              <p style="margin-bottom: 0px;"><b><?php echo $user_name;?></b> <span style="font-size:0.8em"> <?php echo $dat;?></span></p>
              <p><?php echo $text;?></p>
            </div>
          </div>
          <?php
        }
      }else{echo "Комментариев нету.";}
 ?>
