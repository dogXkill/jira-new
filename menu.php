<?php
include("config.php");
echo "<li class='sidebar-title'>Заработано:10 000 $value</li>";
$result_cat_1 = mysqli_query($link,"SELECT * FROM `menu` WHERE `status`='1'");
  if (mysqli_num_rows($result_cat_1) != 0) {
      while( $row = mysqli_fetch_assoc($result_cat_1) ){
        $url=$row['url'];
        $name=$row['name'];

        if ($row['vid_ic']==0){
            $icon="<i data-feather='".$row['icon']."'></i>";

        }else{
          $icon=$row['icon'];
        }
        echo "<li><a href='$url'>$icon $name</a></li>";
      }
    }

 ?>
