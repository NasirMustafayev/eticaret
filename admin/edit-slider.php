<?php
require_once'header.php';

$sliderquery=$db->prepare("SELECT * FROM sliders where slider_id=:id");
$sliderquery->execute(array('id' => $_GET['id']));
$showslider=$sliderquery->fetch(PDO::FETCH_ASSOC);

if ($showuser['user_authorization']<2) {

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
            <h2>Slayd düzəlişi
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
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form action="process/slider-process.php?p=2" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Slayd
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    if (!empty($showslider['slider_img'])) {
                      ?>
                      <img src="<?php echo '../'.$showslider['slider_img']; ?>" style="max-height: 250px;max-width: 250px" class="img-responsive avatar-view">
                      <?php
                    }else{?>
                      <img src="images/no-img.svg" class="img-responsive avatar-view">
                      <?php
                    }
                    ?>
                    <br>
                    <input type="file" name="img" id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name"  value="<?php echo $showslider['slider_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Link
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?php echo $showslider['slider_link']; ?>" name="link" id="link" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Sıra
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="row" value="<?php echo $showslider['slider_row']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php echo $showslider['slider_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                      <option value="0" <?php echo $showslider['slider_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $showslider['slider_id']; ?>">
                <input type="hidden" name="lastslider" value="<?php echo $showslider["slider_img"]; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="editslider" class="btn btn-success">Yenilə</button>
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