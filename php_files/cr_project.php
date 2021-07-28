<?php
include("../config.php");

// print_r($mas_dan);
$id_av=$_POST['id_av'];
$status=$_POST['status_pr'];
$name=$_POST['name_pr'];
$id_cl=$_POST['id_client'];
$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');
$query = 'INSERT INTO `project` SET `id_avtor`="'.$id_av.'",
        `name`="'.$name.'",`status`="1",
        `visible`="'.$status.'",`date_start`="'.$startTime.'",
        `img`="-",`id_client`="'.$id_cl.'"';
        //echo $query;
      $st=mysqli_query($link, $query);
      //echo $query;
      if ($st==1){
        echo 1;
      }else{
        echo 0;
      }
 ?>
