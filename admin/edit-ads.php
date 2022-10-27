<?php
require_once'header.php';

$adsquery=$db->prepare("SELECT * FROM ads where ads_id=:id");
$adsquery->execute(array('id' => $_GET['id']));
$showads=$adsquery->fetch(PDO::FETCH_ASSOC);

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
            <h2>Reklam düzəlişi
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
              <form action="process/ads-process.php?p=2" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reklam şəkili
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    if (!empty($showads['ads_img'])) {
                      ?>
                      <img src="<?php echo '../'.$showads['ads_img']; ?>" style="max-height: 250px;max-width: 250px" class="img-responsive avatar-view">
                      <?php
                    }else{?>
                      <img src="../images/no-image.png"  class="img-responsive avatar-view">
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
                    <input type="text" name="name"  value="<?php echo $showads['ads_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Link
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?php echo $showads['ads_link']; ?>" name="link" id="link" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php echo $showads['ads_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                      <option value="0" <?php echo $showads['ads_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $showads['ads_id']; ?>">
                <input type="hidden" name="lastads" value="<?php echo $showads["ads_img"]; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="editads" class="btn btn-success source">Yenilə</button>
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


  <!--<button class="btn btn-default source" onclick="new PNotify({
    title: 'Regular Success',
    text: 'That thing that you were trying to do worked!',
    type: 'success',
    styling: 'bootstrap3'
  });">Success</button>-->