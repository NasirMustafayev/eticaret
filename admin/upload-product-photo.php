<?php
require_once'header.php';
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Məhsula aid bir foto yükləyin</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="product-gallery?product_id=<?php echo $_GET['product_id']; ?>"><button class="btn btn-primary btn-xs">Yüklənən fotolar</button></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
            <form action="process/product-photo-process" class="dropzone">
              <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
            </form>
            max : 1MB  (<u>jpg, jpeg, png, gif, bmp</u>)
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
<?php
include'footer.php';
?>