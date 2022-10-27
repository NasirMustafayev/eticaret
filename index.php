<?php
require_once'header.php';
include'slider.php';
?>
<head>
	<title><?php echo $show['parametr_title']; ?></title>
</head>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Tövsiyyə olunan məhsullar</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>
		<div id="product-carousel" class="owl-carousel owl-theme">
			
			<?php
			$featuredproductquery=$db->prepare("SELECT * FROM products where product_status=:status and product_featured=:featured order by RAND()");
			$featuredproductquery->execute(array(
				'featured' => 1,
				'status' => 1));

			while($showfeaturedproduct=$featuredproductquery->fetch(PDO::FETCH_ASSOC)) {
				$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id");
				$productphotosquery->execute(array('id' => $showfeaturedproduct['product_id']));
				$count=$productphotosquery->rowCount();
				$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
				?>
				<div class="item animated slideInRight">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="<?php echo "product-".seo($showfeaturedproduct['product_name'])."-".$showfeaturedproduct['product_id'] ?>"><center><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></center></a>
							<div class="pricetag blue"><div class="inner"><span><?php echo "₼" .$showfeaturedproduct['product_price']; ?></span></div></div>
						</div>
						<span class="smalltitle"><a href="<?php echo "product-".seo($showfeaturedproduct['product_name'])."-".$showfeaturedproduct['product_id'] ?>"><?php echo substr($showfeaturedproduct['product_name'],0,18); ?></a></span>
						<span class="smalldesc">Məhsul kodu: <?php echo $showfeaturedproduct['product_id']; ?></span>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title">Yeni Məhsullar</div>
			</div>
			<div class="row prdct"><!--Products-->
				<?php

				$productquery=$db->prepare("SELECT * FROM products where product_status=:status order by product_id DESC limit 9");
				$productquery->execute(array('status' => 1));

				while ($showproduct=$productquery->fetch(PDO::FETCH_ASSOC))
				{
					$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id");
					$productphotosquery->execute(array('id' => $showproduct['product_id']));
					$count=$productphotosquery->rowCount();
					$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
					?>
					<div class="col-md-4">
						<div class="productwrap animated fadeIn">
							<div class="pr-img">
								<a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><center><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></center></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo '₼'. $showproduct['product_price']*1.3 ?></span><?php echo '₼'. $showproduct['product_price']; ?></span></div></div>
							</div>
							<span class="smalltitle"><a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><?php echo substr($showproduct['product_name'],0,18); ?></a></span>
							<span class="smalldesc">Məhsul no.: <?php echo $showproduct['product_id']; ?></span>
						</div>
					</div>
				<?php } ?>
			</div><!--Products-->
			<div class="spacer"></div>
		</div><!--Main content-->
		<?php
		include'sidebar.php';
		?>
	</div>
	<?php
	include'footer.php';
	?>