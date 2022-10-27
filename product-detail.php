<?php
require_once'header.php';

$productquery=$db->prepare("SELECT * FROM products where product_id=:id");
$productquery->execute(array('id' => $_GET['id']));
$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

//Gələn məhsul adının bazadakı seo urlsinə bərabər olmaması
if ($showproduct['product_seourl']!=$_GET['product']) {

	header("Location:index");
}

if ($productquery->rowCount()==0) {
	
	header("Location:index");
}
if ($_GET['comres']==ok) { ?>
	<script type="text/javascript">
		alert("Təşəkkür edirik.Rəyiniz təsdiqləndikdən sonra göstəriləcəkdir.");
	</script>
<?php }
?>
<head>
	<title><?php echo $showproduct['product_name']; ?>-Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $showproduct['product_name'] ; ?></div>
			</div>
			<?php 
			if ($_GET['res']==ok) {
				?>
				<div class="alert alert-success">
					<i class="fa fa-check-circle"></i> Məhsul səbətinizə əlavə edildi
				</div>
			<?php } ?>
			<div class="row">
				<div class="col-md-6">
					<div class="dt-img">
						<div class="detpricetag"><div class="inner"><?php echo"₼". $showproduct['product_price'] ; ?></div></div>

						<?php
						$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id order by productphoto_id ASC limit 4");
						$productphotosquery->execute(array('id' => $_GET['id']));
						$count=$productphotosquery->rowCount();
						$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
						?>
						<a class="fancybox" href="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" data-fancybox-group="gallery" title="<?php echo $showproduct['product_name']; ?>"><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></a>
					</div>
					<?php
					while ($showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC)) {
						?>
						<div class="thumb-img">
							<a class="fancybox" href="<?php echo $showproductphotos['product_photo'] ?>" data-fancybox-group="gallery" title="<?php echo $showproduct['product_name']; ?>"><img src="<?php echo $showproductphotos['product_photo'] ?>" alt="" class="img-responsive"></a>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Məhsul kodu <span><?php echo $showproduct['product_id'] ; ?></span></div>
						<div class="infospan">İstehsalçı <span><?php
						if (strlen($showproduct['product_manufacturer'])>0){
							echo $showproduct['product_manufacturer'] ; }
							else{
								echo 'İstənilən';
							}
							?></span></div>
							<div class="clearfix"></div>
							<div class="lines"></div>
							<form action="process/cart?p=1" method="post" class="form-horizontal ava" role="form">
								<div class="form-group">
									<label for="qty" class="col-sm-2 control-label">Ədəd</label>
									<div class="col-sm-4">
										<input type="number" style="width: 60px" class="form-control" value="1" name="qty">
									</div>
									<div class="col-sm-4">
										<input type="hidden" value="<?php echo $showuser['user_id'] ?>" name="user_id">
										<input type="hidden" value="<?php echo $showproduct['product_id'] ?>" name="product_id">
										<input type="hidden" name="purl" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";?>">
										<button type="submit" name="addcart" class="btn btn-default btn-red btn-sm"<?php if (empty($_SESSION['otheruser_mail'])) {?>disabled <?php } ?> ><span class="addchart">Səbətə əlavə et</span></button>
									</div>
								</form>
								<div class="clearfix"></div>
								<?php if (empty($_SESSION['otheruser_mail'])) {?><span style="color: orange"><i class="fa fa-exclamation-circle"></i></span> Alış veriş etmək üçün əvvəlcə daxil olmalısınız. <?php }?> 
							</div>
						</form>
						<div class="sharing">
							<?php
							if ($showproduct['product_stock']>0) { ?>
								<div class="avatock"><span>Anbarda var: <?php echo $showproduct['product_stock']." ədəd"; ?></span></div>

								<?php
							}
							else{
								?>
								<div class="avatock"><span>Anbarda yoxdur</span></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">

					<li <?php
					if (empty($_GET['comres'])) {?>
						class="active"
						<? }?>><a href="#desc" data-toggle="tab">Açıqlama</a></li>

						<li
						<?php
						if (isset($_GET['comres'])) {?>
							class="active"
						<? }
						$commentquery=$db->prepare("SELECT * FROM comments where product_id=:product_id and comment_confirmation=:confirmation");
						$commentquery->execute(array(
							'product_id' => $showproduct['product_id'],
							'confirmation' => 1));
						$count=$commentquery->rowCount();
						?>><a href="#rev" data-toggle="tab">Rəylər (<?php echo $count; ?>)</a></li>

					</ul>

					<div id="myTabContent" class="tab-content shop-tab-ct">
						<div class="tab-pane fade
						<?php 
						if (empty($_GET['comres'])) {?>
							active in
							<? }?>" id="desc">

							<?php
							if (empty($showproduct['product_detail'])) {

								echo "<p>Bu məhsul haqqında açıqlama yazılmayıb.</p>";
							}
							else{
								echo $showproduct['product_detail'];

							}?>
						</div>

						<div class="tab-pane fade <?php 
						if (isset($_GET['comres'])) {?> active in <? }?>"id="rev">

						<!--Məhsula aid kommentlərin göstərilməsi-->
						<?php

						while($showcomment=$commentquery->fetch(PDO::FETCH_ASSOC)) {

							$commentauthorquery=$db->prepare("SELECT * FROM users where user_id=:user_id");
							$commentauthorquery->execute(array('user_id' => $showcomment['user_id']));
							$showcommentauthor=$commentauthorquery->fetch(PDO::FETCH_ASSOC);

							$time=explode(" ", $showcomment['comment_time']);

							?>
							<span><?php echo $showcommentauthor['user_name']; ?></span>| <?php echo $time[0];

							if($showcommentauthor['user_id']==$showuser['user_id']){ ?>

								<form action="process/comment?p=3" method="post">
									<input type="hidden" name="commentauthor_id" value="<?php echo $showcomment['user_id']?>">
									<input type="hidden" name="purl" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";?>">
									<button type="submit"  name="comment_id" class="btn btn-default btn-red btn-xs" value="<?php echo $showcomment['comment_id']?>">Sil</button>
								</form>

								<?php
							}
							?><br>
							<p class="dash">
								<?php echo $showcomment['comment'] ?>
							</p>
						<?php } ?>
						<!--Məhsula aid kommentlərin gğstərilməsi-->

						<h4>Rəyinizi bildirin</h4>
						<?php 
						if (empty($_SESSION['otheruser_mail'])) { ?>

							Yalnız sayt istifadəçiləri rəy bildirə bilər.Əgər bir hesabınız yoxdursa <a href="registration" color="blue">buradan </a>qeydiyyatdan keçə bilərsiniz.
						<?php }

						else{
							?>
							<form action="process/comment?p=1" method="post" role="form">
								<div class="form-group">
									<textarea name="comment" class="form-control" id="text"></textarea>
								</div>
								<input type="hidden" value="<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";?>" name="producturl">
								<input type="hidden" value="<?php echo $showuser['user_id'] ?>" name="user_id">
								<input type="hidden" value="<?php echo $showproduct['product_id'] ?>" name="product_id">
								<button name="sendcomment" type="submit" class="btn btn-default btn-red btn-sm">Göndər</button>
							</form>
						<?php } ?>
					</div>
				</div>
			</div>

			<div id="title-bg">
				<div class="title">Əlaqəli Məhsullar</div>
			</div>
			<div class="row prdct"><!--Products-->
				<?php
				$relatedproductquery=$db->prepare("SELECT * FROM products where category_id=:id order by RAND() limit 3");
				$relatedproductquery->execute(array('id' => $showproduct['category_id']));

				while ($showrelatedproduct=$relatedproductquery->fetch(PDO::FETCH_ASSOC)) {

					$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id order by productphoto_id ASC");
					$productphotosquery->execute(array('id' => $showrelatedproduct['product_id']));
					$count=$productphotosquery->rowCount();
					$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="<?php echo "product-".seo($showrelatedproduct['product_name'])."-".$showrelatedproduct['product_id'] ?>"><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $showrelatedproduct['product_price']*1.3 ?></span><?php echo '₼'. $showrelatedproduct['product_price']; ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="<?php echo "product-".seo($showrelatedproduct['product_name'])."-".$showrelatedproduct['product_id'] ?>"><?php echo $showrelatedproduct['product_name']; ?></a></span>
							<span class="smalldesc">Məhsul kodu.: <?php echo $showrelatedproduct['product_id']; ?></span>
						</div>
					</div>
				<?php } ?>

			</div><!--Products-->
			<div class="spacer"></div>
		</div><!--Main content-->
		<?php include'sidebar.php'; ?>
	</div>
</div>
<?php
include'footer.php';
?>
