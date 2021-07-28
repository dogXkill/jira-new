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
        <title>Баги и Исправления</title>
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

                  </div>
                </div>
              </div>
          </div>
        </div>
        <?php include("footer.php");?>
      </body>
      </html>
