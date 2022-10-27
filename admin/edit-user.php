<?php
require_once'header.php';

$userquery=$db->prepare("SELECT * FROM users where user_id=:id");
$userquery->execute(array('id' => $_GET['id']));
$showuserup=$userquery->fetch(PDO::FETCH_ASSOC);

$time=explode(" ", $showuserup['user_time']);

if ($showuser['user_authorization']<5) {

  header("Location:index");
  exit;
}
?>

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>İstifadəçi düzəlişi
              <?php
              if (isset($_GET['res'])) {
                if ($_GET['res']=='ok') { ?>
                  <script type="text/javascript">
                    swal("Dəyişiklik qeyd edildi", "", "success");
                  </script>
                  <?
                }
                else{ ?>
                  <script type="text/javascript">
                    swal("Səhv baş verdi", "", "error");
                  </script>
                  <?
                }
              }
              ?></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="process/edit-user-process.php" method="post" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name"  value="<?php echo $showuserup['user_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Soyad
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?php echo $showuserup['user_lastname']; ?>" name="lastname" id="lastname" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email adresi
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="email" value="<?php echo $showuserup['user_mail']; ?>" id="email"  required="required" disabled class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Ünvan
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="address" value="<?php echo $showuserup['user_address']; ?>" id="address"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefon
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="tel" value="<?php echo $showuserup['user_gsm']; ?>" id="tel"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Qeydiyyat tarixi
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="date" name="time" value="<?php echo $time[0]; ?>" id="time" disabled required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php echo $showuserup['user_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                      <option value="0" <?php echo $showuserup['user_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Səlahiyyət
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="authorization" required>
                      <option value="5" <?php echo $showuserup['user_authorization'] == '5' ? 'selected=""' : '';?>>Admin</option>
                      <option value="4" <?php echo $showuserup['user_authorization'] == '4' ? 'selected=""' : '';?>>Müavin</option>
                      <option value="3" <?php echo $showuserup['user_authorization'] == '3' ? 'selected=""' : '';?>>Müdür</option>
                      <option value="2" <?php echo $showuserup['user_authorization'] == '2' ? 'selected=""' : '';?>>Moderator</option>
                      <option value="1" <?php echo $showuserup['user_authorization'] == '1' ? 'selected=""' : '';?>>İşçi</option>
                      <option value="0" <?php echo $showuserup['user_authorization'] == '0' ? 'selected=""' : '';?>>Adi istifadəçi</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $showuserup['user_id']; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="edituser" class="btn btn-success">Yenilə</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include'footer.php';
  ?>