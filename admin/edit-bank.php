<?php
require_once'header.php';

$bankquery=$db->prepare("SELECT * FROM bank where bank_id=:id");
$bankquery->execute(array('id' => $_GET['id']));
$showbank=$bankquery->fetch(PDO::FETCH_ASSOC);

if ($showuser['user_authorization']<3) {

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
            <h2>Bank hesabı düzəlişi
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
              <form action="process/bank-process.php?p=2" method="post" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank adı</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name"  value="<?php echo $showbank['bank_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">IBAN(International Bank Account Number)
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="<?php echo $showbank['bank_iban']; ?>"  name="iban" id="seourl" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Hesab adı
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="account" value="<?php echo $showbank['bank_account']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php echo $showbank['bank_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                      <option value="0" <?php echo $showbank['bank_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $showbank['bank_id']; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="editbank" class="btn btn-success">Yenilə</button>
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