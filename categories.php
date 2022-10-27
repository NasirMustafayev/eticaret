<?php
require_once'header.php';

          			///////PAGINATION START////////

$productnum=20;

$productpagequery=$db->prepare("SELECT * FROM products");
$productpagequery->execute();

$countpage=$productpagequery->rowCount();

$allpages=ceil($countpage / $productnum);

$pages=isset($_GET['page']) ? (int) $_GET['page'] : 1;

if($pages < 1) $pages = 1;

if($pages > $allpages) $pages=$allpages;

$limit=($pages - 1)*$productnum;

                    ///////PAGINATION END////////
if (isset($_GET['category'])) {

	$categoryquery=$db->prepare("SELECT * FROM categories where category_seourl=:category");
	$categoryquery->execute(array('category' => $_GET['category']));
	$showcategory=$categoryquery->fetch(PDO::FETCH_ASSOC);

	if ($showcategory['category_status']!=1) {
		
		header("Location:index");
	}
	if ($showcategory['category_top']==0) {
		$productquery=$db->prepare("SELECT * FROM products where category_id=:id order by product_time ASC limit $limit,$productnum");
		$productquery->execute(array('id' => $showcategory['category_id']));

		$count=$productquery->rowCount();
	}
	else{

		$productquery=$db->prepare("SELECT * FROM products where category_top_id=:id order by product_time ASC limit $limit,$productnum");
		$productquery->execute(array('id' => $showcategory['category_id']));

		$count=$productquery->rowCount();

	}
}
else{

	$productquery=$db->prepare("SELECT * FROM products where product_status=:status order by product_time DESC  limit $limit,$productnum");
	$productquery->execute(array('status'=> 1));
}
$categoryquery=$db->prepare("SELECT * FROM categories");
$categoryquery->execute();
?>
<head>
	<title><?php echo $showcategory['category_name']; ?>-Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="page-title-wrap">
		<div class="page-title-inner">
			<div class="row">
				<div class="col-md-8">
					<big>Kateqoriyalar:</big><br>
					<?php
					while($showallcategory=$categoryquery->fetch(PDO::FETCH_ASSOC)){ ?>
						<a href="<?php echo "category-".seo($showallcategory['category_seourl']) ?>"><?php echo $showallcategory['category_name']; ?></a>,
					<?php }
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="title-bg">
		<div class="title"><?php if (isset($_GET['category']))
		{ 
			echo $showcategory['category_name'];
		} 
		else{ 
			echo"Məhsullar"; 
		}?></div>
	</div>
	<div class="row prdct"><!--Products-->
		<?php
		if (isset($_GET['category'])) {
			if ($count==0) {
				echo '<h3>Bu kateqoriyada məhsul tapılmadı</h3>';
			}
		}

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
		<?php } ?>
	</div><!--Products-->
	<ul class="pagination shop-pag"><!--pagination-->
		<?php 
		$page=0;

		while ($page<$allpages) {

			$page++; ?>
			<li><a href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
		<?php } ?>
	</ul><!--pagination-->

	<div class="spacer"></div>
</div>

<?php
include'footer.php';
?>
