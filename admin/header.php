<?php
require_once'config/connect.php';
ob_start();
session_start();
//error_reporting(0);

$loginquery=$db->prepare("SELECT * FROM users where user_mail=:mail");
$loginquery->execute(array('mail' => $_SESSION['user_mail']));
$showuser=$loginquery->fetch(PDO::FETCH_ASSOC);
$count=$loginquery->rowCount();

if ($showuser['user_authorization']==0) {

  header("Location:logout");
  exit;
}
if (!$count==1) {

  header('Location:login.php?res=block');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>N|SECS Control Panel</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <script src="ckeditor/ckeditor.js"></script>
  <!-- bootstrap-progressbar -->
  <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- PNotify -->
  <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
  <!-- jQuery custom content scroller -->
  <link href="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
  <!-- Sweetalert -->
  <script src="js/sweetalert.min.js"></script>
  
</head>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>N|SECS CP</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img <?php if(empty($showuser['user_picture'])){?>src="images/default.png"<?php }else{ ?>src="<?php echo $showuser['user_picture']; ?>" <?php } ?> alt="..." style="height: 55px" class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Xoş gəldin,</span>
              <h2><?php echo $showuser['user_name']." ".$showuser['user_lastname']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />
          <?php
          include'sidebar.php';
          ?>

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" href="parameters" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="openFullscreen();">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" href="logout" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img <?php if(empty($showuser['user_picture'])){?>src="images/default.png"<?php }else{ ?>src="<?php echo $showuser['user_picture']; ?>" <?php } ?> alt=""><?php echo $showuser['user_name']." ".$showuser['user_lastname']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="profile"> Profilim</a></li>
                  <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Çıxış</a></li>
                </ul>
              </li>

              <!--<li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            -->
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->
