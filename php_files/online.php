<?php
session_start();
if (isset ($_SESSION['login'])){
  include("../config.php");
  $datum = new DateTime();
  $startTime = $datum->format('Y-m-d H:i:s');
  $id=$_SESSION['id'];
  $data = mysqli_query($link,"SELECT * FROM `online` WHERE `id_ac` = '".$id."' ");
  $user = mysqli_fetch_assoc($data);
    if (!empty($user)) {
      //запись есть,обновляем
      $query = 'UPDATE `online` SET `date_time`= "'.$startTime.'" WHERE `id_ac` = "'.$id.'"';
    				mysqli_query($link, $query);
            //echo $query;
    }else{
      $query = 'INSERT INTO `online` SET `id_ac`="'.$id.'",
              `date_time`="'.$startTime.'"';
    				mysqli_query($link, $query);
            //echo $query;
    }

        //echo $query;
}
 ?>
