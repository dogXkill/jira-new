<?php
$id_zad=$_POST['zad_id'];
include("../config.php");
$result_zad_1 = mysqli_query($link,"SELECT * FROM `zadach` WHERE `id`='".$id_zad."' ");
  if (mysqli_num_rows($result_zad_1) != 0) {
        $row = mysqli_fetch_assoc($result_zad_1);
      // while( $row = mysqli_fetch_assoc($result_zad_1) ){
        $id_pr=$row['id_pr'];
        $name=$row['name'];
        $opis=$row['opis'];
        $prior=$row['prior'];
        $tag=$row['tag'];
        $avtor_id=$row['avtor_id'];
        $dat=$row['date'];
        $status=$row['status'];
        //
        $result_pr = mysqli_query($link,"SELECT * FROM `project` WHERE `id`='".$id_pr."'");
        $project = mysqli_fetch_assoc($result_pr);
        if (!empty($project)) {
          $project_text=' <span style="color:black;">'.$project['name'].'</span>';
        }else{
          $project_text=' <span style="color:black;">None</span>';
        }
        //
        $result_pr_ac = mysqli_query($link,"SELECT * FROM `account` WHERE `id`='".$avtor_id."'");
        $user = mysqli_fetch_assoc($result_pr_ac);
        if (!empty($user)) {
          $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">'.$user['name'].'</span>';
        }else{
          $user_text='<i class="fas fa-user-tie"></i> <span style="color:black;">None</span>';
        }
        $tag_m=explode(",",$tag);
        foreach ( $tag_m as $key => $value ) {
          // echo "<dt>$key:</dt>";
          // echo "<dd>$value</dd>";
          // if ($key>=1){
          //     $tags=$tags.",".$value;
          //     // echo $i.":".$tag[i][0];
          //
          //   }else{
              $tags.='<li class="tag_row">
              <button class="tag">
              <span class="value-text">'.$value.'</span></button><em class="item-delete"></em></li>';
            // }
        }
        //
        switch ($prior) {
          case 1:
            $prior_text="Срочно";
            break;
            case 2:
              $prior_text="Средне";
              break;
              case 3:
                $prior_text="Несрочно";
                break;
          default:
            $prior_text="None";
            break;
        }
        //
        switch ($status) {
          case 1:
            $status_text="В работе";
            break;
            case 2:
              $status_text="Выполнено";
              break;
              case 3:
                $status_text="Невыполнено";
                break;
                case 4:
                $status_text="Отмена";
                break;
          default:
            $status_text="None";
            break;
        }
        //
        $mas_dan = array();
        //array_push($mas_dan, 'id_p'=>$id_pr,
         // $name,
         // $opis,
         // $prior,
         // $tag,
         // $avtor_id,
         // $dat,
         // $status,
         // $project_text,
         // $user_text,
         // $prior_text,
         // $status_text);
        $mas_dan=[
          'id_zad'=>$id_zad,
          'id_p'=>$id_pr,
          'name'=>$name,
          'opis'=>$opis,
          'prior'=>$prior,
          'tag'=>$tag,
          'tags'=>$tags,
          'avtor_id'=>$avtor_id,
          'dat'=>$dat,
          'status'=>$status,
          'project_text'=>$project_text,
          'user_text'=>$user_text,
          'prior_text'=>$prior_text,
          'status_text'=>$status_text,
        ];
        echo json_encode($mas_dan);
        die();
      // }
    }

 ?>
