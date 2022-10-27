<?php
require_once'header.php';

$orderdetailquery=$db->prepare("SELECT * FROM orderdetails where order_id=:order_id");
$orderdetailquery->execute(array('order_id' => $_GET['order']));
$count=$orderdetailquery->rowCount();

$orderquery=$db->prepare("SELECT * FROM orders where order_id=:order_id");
$orderquery->execute(array('order_id' =>  $_GET['order']));
$showorder=$orderquery->fetch(PDO::FETCH_ASSOC);
?>
<head>
	<title>Sifariş detalları -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="title-bg">
		<div class="title">Sifariş no: <?php echo $_GET['order']; ?></div>
	</div>
	<?php
	if ($count==0) {

		header("Location:orders");
	}
	else{
		if ($showorder['user_id']!=$showuser['user_id']) {

			echo"<h3>Sizin belə bir sifarişiniz yoxdur</h3>";
		}
		else{
			?>
			<div class="table-responsive">
				<table class="table table-borderdetailed chart">
					<thead>
						<tr>
							<th>Məhsul kodu</th>
							<th>Məhsul adı</th>
							<th>Məbləğ</th>
							<th>Vahid</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($showorderdetail=$orderdetailquery->fetch(PDO::FETCH_ASSOC)) {

							$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
							$productquery->execute(array('product_id' => $showorderdetail['product_id']));
							$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);
							?>
							<tr>
								<td><?php echo $showorderdetail['product_id'];?></td>
								<td><?php echo $showproduct['product_name'];?></td>
								<td><?php echo"₼". $showorderdetail['product_price']; ?></td>
								<td><?php echo $showorderdetail['product_qty'];?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php }} ?>
		<div class="spacer"></div>
	</div>

	<?php
	include'footer.php';
	?>