<?php
require_once'header.php';

$productquery=$db->prepare("SELECT * FROM products where product_id=:id");
$productquery->execute(array('id' => $_GET['id']));
$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

$categoryquery=$db->prepare("SELECT * FROM categories where category_top=:top order by category_row");
$categoryquery->execute(array('top' => 0));
?>

<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Məhsulda düzəliş
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
              <form action="process/product-process.php?p=2" method="post" class="form-horizontal form-label-left" novalidate>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Kateqoriya
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="category" required>
                      <?php
                      while ($showcategory=$categoryquery->fetch(PDO::FETCH_ASSOC))
                      {
                        ?>
                        <option <?php echo $showcategory['category_id'] == $showproduct['category_id'] ? 'selected=""' : '';?> value="<?php echo $showcategory['category_id']; ?>" ><?php echo $showcategory['category_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Alt kateqoriya
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="category_top" required>
                      <?php
                      $categorytopquery=$db->prepare("SELECT * FROM categories where category_top=:top");
                      $categorytopquery->execute(array('top'=> $showproduct['category_id']));

                      while($showcategorytop=$categorytopquery->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $showcategorytop['category_id'] ?>" <?php echo $showcategorytop['category_id'] == $showproduct['category_top_id'] ? 'selected=""' : '';?>><?php echo  $showcategorytop['category_name']; ?></option>
                      <?php } ?>
                      <option value="0" <?php echo $showproduct['category_top_id'] == '0' ? 'selected=""' : '';?>>Yoxdur</option>

                    </select>
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ad</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name"  value="<?php echo $showproduct['product_name']; ?>" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detail">Detal
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <body>
                      <textarea name="detail" id="editor1" rows="10" cols="80">
                        <?php echo $showproduct['product_detail']; ?>
                      </textarea>
                      <script>
                        CKEDITOR.replace( 'editor1' );
                      </script>
                    </body>
                  </div>
                </div>

                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Qiymət
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" value="<?php echo $showproduct['product_price']; ?>" name="price" id="url" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Seourl
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" value="product-<?php echo $showproduct['product_seourl']; ?>"  disabled name="seourl" id="seourl" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">İnventar
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" name="stock" value="<?php echo $showproduct['product_stock']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">İstehsalçı</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="manufacturer" value="<?php echo $showproduct['product_manufacturer']; ?>" id="manufacturer" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Açar sözlər
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="keyword" value="<?php echo $showproduct['product_keyword']; ?>" id="row"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tövsiyyə et
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="checkbox">
                    <label>
                     <input type="checkbox" class="flat" value="1" name="featured" <?php echo $showproduct['product_featured'] == '1' ? 'checked=""' : '';?>
                   </label>
                 </div>
               </div>
             </div>
             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="status" required>
                  <option value="1" <?php echo $showproduct['product_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
                  <option value="0" <?php echo $showproduct['product_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
                </select>
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $showproduct['product_id']; ?>">
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3" align="right">
                <button id="send" type="submit" name="editproduct" class="btn btn-success">Yenilə</button>
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