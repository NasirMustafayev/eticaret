<?php
require_once'header.php';

if (isset($_POST['search'])) {

	$searchtext=$_POST['searchtext'];
	$productquery= $db->query("SELECT * FROM products WHERE product_name LIKE '%$searchtext%' OR product_seourl LIKE '%$searchtext%'");
	$count=$productquery->rowCount();
	?>
	<head>
		<title>Axtarış -Nasir | Startup eCommerce Script</title>
	</head>
	<div class="container">
		<div class="title-bg">
			<div class="title">Məhsullar</div>
		</div>
		<?php

		if ($count==0) {

			echo "<h3>Sizin axtarışınıza uyğun nəticə tapılmadı</h3>";
		}
		elseif ($count>0) {
			echo "Axtarışınıza uyğun <u>".$count."</u> məhsul tapıldı";
		}
		?>
		<div class="row prdct"><!--Products-->
			<?php
			while ($showproduct=$productquery->fetch(PDO::FETCH_ASSOC))
			{
				$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id");
				$productphotosquery->execute(array('id' => $showproduct['product_id']));
				$count=$productphotosquery->rowCount();
				$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
				?>
				<div class="col-md-3">
					<div class="productwrap">
						<div class="pr-img">
							<a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></a>
							<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo '₼'. $showproduct['product_price']*1.3 ?></span><?php echo '₼'. $showproduct['product_price']; ?></span></div></div>
						</div>
						<span class="smalltitle"><a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><?php echo substr($showproduct['product_name'],0,18); ?></a></span>
						<span class="smalldesc">Məhsul no.: <?php echo $showproduct['product_id']; ?></span>
					</div>
				</div>	
			<?php }
		}
		else{

			header("Location:index");
		} ?>
	</div><!--Products-->
	<ul class="pagination shop-pag"><!--pagination-->
		<li><a href="#"><i class="fa fa-caret-left"></i></a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
	</ul><!--pagination-->

	<div class="spacer"></div>
</div>

<?php
include'footer.php';
?>
