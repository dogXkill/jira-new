<?php
session_start();
function generateSalt()
	{
		$salt = '';
		$saltLength = 8; //длина соли
		for($i=0; $i<$saltLength; $i++) {
			$salt .= chr(mt_rand(33,126)); //символ из ASCII-table
		}
		return $salt;
	}
  $password=$_POST['pas'];
  $login=$_POST['login'];
  include("../config.php");
  $login=mysqli_real_escape_string($link, trim($_POST['login']));
	$password= mysqli_real_escape_string($link, trim($_POST['pas']));
     if(!empty($login) && !empty($password)) {

          $data = mysqli_query($link,"SELECT * FROM `account` WHERE `login` = '".$login."' ");
          $user = mysqli_fetch_assoc($data);
          if (!empty($user)) {
      			//Получим соль:
      			$salt = $user['salt'];

      			//Посолим пароль из формы:
      			$saltedPassword = md5($password.$salt);
            //Если соленый пароль из базы совпадает с соленым паролем из формы...
      			if ($user['pas'] == $saltedPassword) {
      				//Стартуем сессию:
      				session_start();
              $_SESSION['login']=1;//авторизация успешна
              $_SESSION['id']=$user['id'];
              $_SESSION['name']=$user['name'];
              $_SESSION['rol']=$user['rol'];
              echo "1";//всё гуд
            }
            else{
              echo "0";//ошибка пароля
              //$passs=$user['pas'];
              //echo "//ошибка пароля \n pas:$saltedPassword - $passs";
            }
          }else{
            echo "0";//ошибка (аккаунт не найден)
            //$passs=$user['pas'];
            //echo "ошибка (аккаунт не найден) \n pas:$saltedPassword - $passs";
          }

     }



 ?>
