<?php
require_once'header.php';

$categoryquery=$db->prepare("SELECT * FROM categories where category_id=:id");
$categoryquery->execute(array('id' => $_GET['id']));
$showcategory=$categoryquery->fetch(PDO::FETCH_ASSOC);
?>

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kateqoriya düzəlişi
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
              <form action="process/category-process.php?p=2" method="post" class="form-horizontal form-label-left" novalidate>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name"  value="<?php echo $showcategory['category_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Seo linki
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="category-<?php echo $showcategory['category_seourl']; ?>"  disabled name="seourl" id="seourl" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Sıra
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" name="row" value="<?php echo $showcategory['category_row']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Alt kateqoriyasıdır
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="top" required>
                      <?php
                      $categorytopquery=$db->prepare("SELECT * FROM categories");
                      $categorytopquery->execute();

                      while($showcategorytop=$categorytopquery->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $showcategorytop['category_id'] ?>" <?php echo $showcategory['category_top'] == $showcategorytop['category_id'] ? 'selected=""' : '';?>><?php echo  $showcategorytop['category_name']; ?></option>
                      <?php } ?>
                      <option value="0" <?php echo $showcategory['category_top'] == '0' ? 'selected=""' : '';?>>Yoxdur</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="status" required>
                      <option value="1" <?php echo $showcategory['category_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                      <option value="0" <?php echo $showcategory['category_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $showcategory['category_id']; ?>">
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3" align="right">
                    <button id="send" type="submit" name="editcategory" class="btn btn-success">Yenilə</button>
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