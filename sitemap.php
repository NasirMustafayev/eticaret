<?php header('Content-type: application/xml; charset="utf8"',true);
date_default_timezone_set('Asia/Baku'); ?>

<urlset
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:example="http://www.example.com/schemas/example_schema"> <!-- namespace extension -->
<?php
include'admin/config/connect.php';
include'admin/function/seo-function.php';
?>
<url>
	<loc>http://<?php echo $_SERVER['HTTP_HOST']; ?>/categories </loc>
	<lastmod><?php echo date("Y-m-d");?></lastmod>
	<changefreq>daily</changefreq>
	<priority>1.00</priority>
</url>

<?php

$productquery=$db->prepare("SELECT * FROM products where product_status=:status");
$productquery->execute(array('status' => 1));

while($showproduct=$productquery->fetch(PDO::FETCH_ASSOC)){?>
	<url>
		<loc>http://<?php echo $_SERVER['HTTP_HOST']."/eticaret/". "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?> </loc>
		<lastmod><?php echo $showproduct['product_time']; ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.9</priority>
	</url>
<?php }
?>

</urlset>