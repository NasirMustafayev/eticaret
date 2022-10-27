<?php
require_once'header.php';

$orderquery=$db->prepare("SELECT * FROM orders where user_id=:user_id");
$orderquery->execute(array('user_id' => $showuser['user_id']));
$count=$orderquery->rowCount();
if (empty($_SESSION['otheruser_mail'])) {
	header("Location:index");
}
?>
<head>
	<title>Sifarişlərim -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="title-bg">
		<div class="title">Sifarişlərim</div>
	</div>
	<?php
	if ($count==0) {

		echo "<h3>Siz hələki məhsul sifariş etməmisiniz</h3>";
	}
	else{
		if (isset($_GET['res'])) {

			if ($_GET['res']=='ok') { ?>
				<div class="alert alert-success">
					Sifariş uğurla tamamlandı.Paneldən sifarişlərinizin vəziyyətini təqib edə bilərsiniz.
				</div>
				<?php
			}
		}
		?>
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Sifariş NO</th>
						<th>Sifariş tarixi</th>
						<th>Məbləğ</th>
						<th>Ödəmə tipi</th>
						<th>Status</th>
						<th>Detallar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($showorder=$orderquery->fetch(PDO::FETCH_ASSOC)) {

						$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
						$productquery->execute(array('product_id' => $showorder['product_id']));
						$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);
						?>
						<tr>
							<td><?php echo $showorder['order_id'];?></td>
							<td><?php echo $showorder['order_time'];?></td>
							<td><?php echo"₼". $showorder['order_total']; ?></td>
							<td><?php echo $showorder['order_type'];?></td>
							<td>
								<?php
								if ($showorder['order_status']==1) { ?>

									<span style="color: green">Tamamlanıb</span>
								<?php }
								else{ ?>

									<span style="color: red">Tamamlanmayıb</span>
								<?php }
								?>
							</td>
							<td><a href="order-detail.php?order=<?php echo $showorder['order_id'];?>"><i class="fa fa-eye"></i>Sifariş detalı</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	<?php } ?>
	<div class="spacer"></div>
</div>

<?php
include'footer.php';
?>