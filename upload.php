<?php include("prov_login.php");
$id_ac=$_GET['id'];
?>
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
        <title>Выгрузка задач с CSV</title>
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
              <?php include("menu.php");
              include("config.php");
              ?>
            </ul>
          </div>
          <div class="page-content">
              <div class="main-wrapper">
                <div class="row">
                  <div class="col-xl-12">
                    <!--  -->
                    <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Задачи для выгрузки (файл <b>zad.csv</b>)</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Номер</th>
                                    <th scope="col">Текст</th>
                                    <th scope="col">Срочость</th>
                                    <th scope="col">Статус</th>
                                    <!-- <th scope="col">Роль</th>
                                    <th scope="col">Активность</th> -->
                                    <!-- <th scope="col">Status</th> -->
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  //
                                  $id_ac=$_SESSION['id'];
                                  $data = mysqli_query($link,"SELECT * FROM `account` WHERE `id` = '".$id_ac."' ");
                                  $user = mysqli_fetch_assoc($data);
                                  if (!empty($user)) {
                                  $rol=$user['rol'];
                                  if ($rol==0){
                                    ///
                                    ## Читает CSV файл и возвращает данные в виде массива.
                                    ## @param string $file_path Путь до csv файла.
                                    ## string $col_delimiter Разделитель колонки (по умолчанию автоопределине)
                                    ## string $row_delimiter Разделитель строки (по умолчанию автоопределине)
                                    ## ver 6
                                    function kama_parse_csv_file( $file_path, $file_encodings = ['cp1251','UTF-8'], $col_delimiter = '', $row_delimiter = "" ){

                                    	if( ! file_exists($file_path) )
                                    		return false;

                                    	$cont = trim( file_get_contents( $file_path ) );

                                    	$encoded_cont = mb_convert_encoding( $cont, 'UTF-8', mb_detect_encoding($cont, $file_encodings) );

                                    	unset( $cont );

                                    	// определим разделитель
                                    	if( ! $row_delimiter ){
                                    		$row_delimiter = "\r\n";
                                    		if( false === strpos($encoded_cont, "\r\n") )
                                    			$row_delimiter = "\n";
                                    	}

                                    	$lines = explode( $row_delimiter, trim($encoded_cont) );
                                    	$lines = array_filter( $lines );
                                    	$lines = array_map( 'trim', $lines );

                                    	// авто-определим разделитель из двух возможных: ';' или ','.
                                    	// для расчета берем не больше 30 строк
                                    	if( ! $col_delimiter ){
                                    		$lines10 = array_slice( $lines, 0, 30 );

                                    		// если в строке нет одного из разделителей, то значит другой точно он...
                                    		foreach( $lines10 as $line ){
                                    			if( ! strpos( $line, ',') ) $col_delimiter = ';';
                                    			if( ! strpos( $line, ';') ) $col_delimiter = ',';

                                    			if( $col_delimiter ) break;
                                    		}

                                    		// если первый способ не дал результатов, то погружаемся в задачу и считаем кол разделителей в каждой строке.
                                    		// где больше одинаковых количеств найденного разделителя, тот и разделитель...
                                    		if( ! $col_delimiter ){
                                    			$delim_counts = array( ';'=>array(), ','=>array() );
                                    			foreach( $lines10 as $line ){
                                    				$delim_counts[','][] = substr_count( $line, ',' );
                                    				$delim_counts[';'][] = substr_count( $line, ';' );
                                    			}

                                    			$delim_counts = array_map( 'array_filter', $delim_counts ); // уберем нули

                                    			// кол-во одинаковых значений массива - это потенциальный разделитель
                                    			$delim_counts = array_map( 'array_count_values', $delim_counts );

                                    			$delim_counts = array_map( 'max', $delim_counts ); // берем только макс. значения вхождений

                                    			if( $delim_counts[';'] === $delim_counts[','] )
                                    				return array('Не удалось определить разделитель колонок.');

                                    			$col_delimiter = array_search( max($delim_counts), $delim_counts );
                                    		}

                                    	}

                                    	$data = [];
                                    	foreach( $lines as $key => $line ){
                                    		$data[] = str_getcsv( $line, $col_delimiter ); // linedata
                                    		unset( $lines[$key] );
                                    	}

                                    	return $data;
                                    }
                                    //

                                      ?>
                                    </tbody>
                                  </table>
                                  <?php
                                  $data = kama_parse_csv_file( 'uploads/zad.csv' );
                                  // echo "<pre>";
                                  // print_r( $data );
                                  // echo "</pre>";
                                  foreach ($data as &$value) {
                                      //if ($value[0]!=" " && $value[0]!="" && $value[0]!=null ){$data1[]=$value;}
                                      if (ctype_digit($value[0])){
                                        //echo "<pre>";
                                        //print_r($value);
                                        //echo $value[0];
                                        //echo "</pre>";
                                        $data1[]=$value;}
                                  }
                                  function func_obr($text){

                                    return str_replace('"', "'", substr($text,0, 25));
                                  }
                                  echo "<pre>";
                                  print_r( $data1 );
                                  echo "</pre>";
                                  for ($i=1;$i<count($data1);$i++){
                                    //echo $data[$i][0]."</br>";
                                    //0- номер записи в списке
                                    //1-text
                                    //2-срочность
                                    //3-статус
                                    //клиент тут
                                    $id_cl=3;
                                    $id_pr=9;

                                    // if ($data1[$i][2]!=""){
                                      switch ($data1[$i][2]) {
                                        case 'важно':
                                        $prior=1;
                                        echo $prior."/".$data1[$i][2];
                                        // $prior="важно";
                                        break;
                                        case 'средне':
                                        $prior=2;
                                        echo $prior."/".$data1[$i][2];
                                        break;
                                        case 'Неважно':
                                        $prior=3;
                                        echo $prior."/".$data1[$i][2];
                                        break;
                                        default:
                                          $prior=0;
                                          break;
                                      }
                                    // }else{
                                    //   $prior=0;
                                    // }
                                    //
                                    if ($data1[$i][3]!=""){
                                      switch ($data1[$i][2]) {
                                        case 'исправлено':
                                        $status=2;
                                        break;
                                        case 'в разработке':
                                        $status=1;
                                        break;
                                        case '-':
                                        $status=1;
                                        break;
                                        default:
                                        $status=1;
                                        break;
                                      }
                                    }else{
                                      $status=0;
                                    }
                                    $name_zad=func_obr($data[$i][1]);
                                    $datum = new DateTime();
                                    $startTime = $datum->format('Y-m-d H:i:s');
                                    $opis=str_replace('"', "'", $data[$i][1]);
                                    $query = 'INSERT INTO `zadach` SET `id_pr`="'.$id_pr.'",
                                            `name`="'.$name_zad.'",
                                            `opis`="'.$opis.'",
                                            `prior`="'.$prior.'",
                                            `tag`="-",
                                            `avtor_id`="'.$id_ac.'",
                                            `date`="'.$startTime.'",
                                            `status`="'.$status.'"
                                            ';
                                          //echo $query."</br>";
                                          echo $query."</br>";
                                            // $st=mysqli_query($link, $query);
                                            // if ($st==1){
                                            //   echo 1;
                                            // }else{
                                            //   echo 0;
                                            //     echo $query."</br>";
                                            // }

                                  }
                                  //echo "<pre>";
                                  //print_r($data1);

                                  //echo "</pre>";
                                }else{
                                  echo "<h2>Доступ запрещён</h2>";
                                }
                              }else{
                                echo "<h2>Доступ запрещён</h2>";
                              } ?>
                                </div>
                              </div>
                          </div>
                        <!--  -->
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <?php include("footer.php");?>
          </body>
          </html>
