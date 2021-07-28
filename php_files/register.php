<?php
$name="Майкал";
$login="Mike";
$pas="qwerty123";
$rol=0;//0-админ
function generateSalt()
	{
		$salt = '';
		$saltLength = 8; //длина соли
		for($i=0; $i<$saltLength; $i++) {
			$salt .= chr(mt_rand(33,126)); //символ из ASCII-table
		}
		return $salt;
	}
  include("../config.php");
  $salt = generateSalt(); //генерируем соль
	$saltedPassword = md5($pas.$salt); //соленый пароль
  $query = 'INSERT INTO `account` SET `login`="'.$login.'",
					`pas`="'.$saltedPassword.'", `salt`="'.$salt.'",
          `status`="1", `rol`="'.$rol.'", `name`="'.$name.'"';
				// mysqli_query($link, $query);
        echo $query;
 ?>
