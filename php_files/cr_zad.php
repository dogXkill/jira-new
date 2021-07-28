<?php
include("../config.php");
$mas_dan=$_POST['mas'];
// print_r($mas_dan);
$id_pr=$mas_dan[0];
$name=$mas_dan[1];
$opis=$mas_dan[2];
$prior=$mas_dan[3];
$tag=$mas_dan[4];
$avtor_id=$mas_dan[5];
$dat=$mas_dan[6];
if ((trim($id_pr)) && (trim($name))&& (trim($avtor_id))&& (trim($dat)) && (trim($opis)) && (trim($prior))){
if (count($tag)>=1){
  foreach ( $tag as $key => $value ) {
    // echo "<dt>$key:</dt>";
    // echo "<dd>$value</dd>";
    if ($key>=1){
        $tags=$tags.",".$value;
        // echo $i.":".$tag[i][0];

      }else{
        $tags=$value;
      }
  }
}else{
  $tags="-";
}



$query = 'INSERT INTO `zadach` SET `id_pr`="'.$id_pr.'",
        `name`="'.$name.'",`opis`="'.$opis.'",
        `prior`="'.$prior.'",`tag`="'.$tags.'",
        `avtor_id`="'.$avtor_id.'",`date`="'.$dat.'",`status`="1"';
        //echo $query;
      $st=mysqli_query($link, $query);
      if ($st==1){
        echo 1;
      }else{
        echo 0;
      }
    }else{echo 0;}
 ?>
