<?php
require_once'header.php';

$productphotoquery=$db->prepare("SELECT * FROM productphotos  where product_id=:id");
$productphotoquery->execute(array('id'=> $_GET['product_id']));
$count=$productphotoquery->rowCount();

$productquery=$db->prepare("SELECT * FROM products where product_id=:id");
$productquery->execute(array('id'=> $_GET['product_id']));
$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

?>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
	<!--
	Ümumi parametrlər
-->
<div class="x_panel">
	<div class="x_title">
		<h2><?php echo $showproduct['product_name']; ?>-məhsuluna aid fotolar
			<?php
			if (isset($_GET['res'])) {
				if ($_GET['res']=='ok') { ?>
					<small style="color: green"><b>Dəyişiklik qeyd edildi</b></small>
					<?
				}
				else{ ?>
					<small style="color: red"><b>Səhv baş verdi!</b></small>
					<?
				}
			}
			?></h2>
			<ul class="nav navbar-right panel_toolbox">
				<a href="upload-product-photo?product_id=<?php echo $_GET['product_id'];?>"><button class="btn btn-round btn-success btn-xs"><i class="fa fa-plus"></i>Foto artır</button></ul></a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php
				if ($count==0) {?>
					Bu məhsula aid foto yoxdur
				<?php }
				else{
					while ($showproductphoto=$productphotoquery->fetch(PDO::FETCH_ASSOC)) {
						?>
						<!-------Content thumbail start------->
						<div class="col-md-3">
							<div class="thumbnail">
								<div class="image view view-first">
									<img style="width: 100%;height: 100%" src="<?php echo"../".$showproductphoto['product_photo']; ?>" alt="image"/>
									<div class="mask">
										<div class="tools tools-bottom">
											<?php echo $showproduct['product_name']; ?>
											<br>
											<a href="process/delete-process?del=productphoto&id=<?php echo $showproductphoto["productphoto_id"]; ?>&un=<?php echo $showproductphoto['product_photo'] ?>&product_id=<?php echo $showproduct["product_id"]; ?>"><i class="fa fa-times"></i></a>
										</div>
									</div>
								</div>
								<div class="caption">
									<?php echo $showproduct['product_name']; ?>

								</div>
							</div>
						</div>
						<!-------Content thumbail end------->
					<?php }
				} ?>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<?php
include'footer.php';
?>