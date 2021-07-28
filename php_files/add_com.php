<?php
$id_avtor=$_POST['id_av'];
$text=$_POST['text'];
$id_zad=$_POST['id_zad'];

$datum = new DateTime();
$startTime = $datum->format('Y-m-d H:i:s');

include('../config.php');
$query = 'INSERT INTO `cooment_zad` SET `id_zad`="'.$id_zad.'",
        `id_user`="'.$id_avtor.'",
        `text`="'.$text.'",
        `dat`="'.$startTime.'"
        ';
        //echo $query;
      $st=mysqli_query($link, $query);
      if ($st==1){
        echo 1;
      }else{
        echo 0;
      }
 ?>
