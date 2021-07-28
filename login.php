<?php
session_start();
if (isset ($_SESSION['login'])){
header("Location: home.php");
 exit;
}
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
        <title>Вход</title>

        <?php include("head_file_login.php");?>
    </head>
    <body class="login-page">
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
              <span class='sr-only'>Loading...</span>
            </div>
          </div>
        <div class="container">
          <div class="page-sidebar" style="    display: none;"></div>
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            <div class="authent-logo">
                                <img src="../../assets/images/logo@2x.png" alt="">
                            </div>
                            <div class="authent-text">
                                <p>Welcome to admin panel</p>
                                <p>Please Sign-in to your account.</p>
                            </div>

                            <form>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="login">
                                        <label for="floatingInput">Login</label>
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                      </div>
                                </div>
                                <!-- <div class="mb-3 form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> -->
                                <div class="d-grid">
                                <button class="btn btn-info m-b-xs" id="btn_vxod">Sign In</button>
                                <!-- <button class="btn btn-primary">Facebook</button> -->
                            </div>
                              </form>
                              <div class="authent-reg">
                                  <!-- <p>Not registered? <a href="register.html">Create an account</a></p> -->
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
$('#btn_vxod').on( 'click', function(e){
  e.preventDefault();
  var login=$("#floatingInput").val();
  var pas=$("#floatingPassword").val();
  $.ajax({
    url: "php_files/login.php",
    type: "POST",
    data: {login:login,pas:pas},
    cache: false,
    success: function(html){
      if (html==1){
        //ok
        window.location.href = "home.php";

      }else{
      $(".authent-reg").html("Ошибка авторизации");
    }
  },error:function(html){
    $(".authent-reg").html("Ошибка запроса");
  }
  });
});
  </script>
    </body>
</html>
