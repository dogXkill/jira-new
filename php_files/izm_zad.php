<?php
$id=$_POST['id_zad'];
$opis=$_POST['opis'];
$status=$_POST['status'];
$prior=$_POST['prior'];
include("../config.php");
$query = 'UPDATE `zadach` SET
`opis`= "'.$opis.'",
`status`= "'.$status.'",
`prior`= "'.$prior.'"
 WHERE `id` = "'.$id.'"';
      $st=mysqli_query($link, $query);
      echo $query;
 ?>
