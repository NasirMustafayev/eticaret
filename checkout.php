<?php
require_once'header.php';

$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
$cartquery->execute(array('user_id' => $showuser['user_id']));
$count=$cartquery->rowCount();

$bankquery=$db->prepare("SELECT * FROM bank");
$bankquery->execute();

if (empty($_SESSION['otheruser_mail'])) {
	header("Location:index");
}
?>
<head>
	<title>Ödəmə -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="title-bg">
		<div class="title">Sifarişi Təsdiqləyin</div>
	</div>
	<?php
	if ($count==0) {
		
		echo "<h3>Sizin səbət boşdur. Alış-veriş edərək doldurun :))</h3>";
	}

	else{
		?>
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Məhsul</th>
						<th>Məhsul no.</th>
						<th>Ədəd(miqdar)</th>
						<th>Vahid qiyməti</th>
						<th>Ümumi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while ($showcart=$cartquery->fetch(PDO::FETCH_ASSOC)) {

						$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
						$productquery->execute(array('product_id' => $showcart['product_id']));
						$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

						$total+=$showcart['cart_total'];
						?>
						<tr>
							<td><?php echo $showproduct['product_name']; ?></td>
							<td><?php echo $showproduct['product_id']; ?></td>
							<td><?php echo $showcart['product_qty']; ?></td>
							<td><?php echo "₼". $showproduct['product_price'];?></td>
							<td><?php echo "₼". $showproduct['product_price']* $showcart['product_qty']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<div class="subtotal-wrap">
					<div class="total">Toplam : <span class="bigprice"><?php echo"₼".$total; ?></span></div>
					<div class="clearfix"></div>
					<a href="cart" class="btn btn-default btn-yellow">Alış-verişə davam et</a>
				</div>
			</div>
		</div>
		<div class="title-bg">
			<div class="title">Ödəmə üsulunu seçin</div>
		</div>
		<div class="tab-review">
			<ul id="myTab" class="nav nav-tabs shop-tab">
				<li class="active"><a href="#desc" data-toggle="tab"><i class="fa fa-credit-card"></i> Kredit Kartı</a></li>
				<li class=""><a href="#rev" data-toggle="tab"><i class="fa fa-exchange"></i> Bank transferi</a></li>
			</ul>

			<div id="myTabContent" class="tab-content shop-tab-ct">

				<div class="tab-pane fade active in" id="desc">
					<h4>KREDİT KARTI</h4>
				</div>

				<div class="tab-pane fade" id="rev">
					<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

					<h4>Bank seçin</h4>
					<form action="process/order?p=1&uid=<?php echo $showuser['user_id'];?>" method="post">
						<?php
						while ($showbank=$bankquery->fetch(PDO::FETCH_ASSOC)) { ?>
							<div class="radio">
								<label>
									<input type="radio" name="bank" value="<?php echo $showbank['bank_name']; ?>" required="">
									<b><?php echo $showbank['bank_name']; ?></b><br>
									IBAN: <?php echo $showbank['bank_iban']; ?>
								</label>
							</div>
						<?php } ?> 
						<input type="hidden" name="product_qty" value="<?php echo $showcart['product_qty']; ?>">
						<button type="submit" name="addbanktypeorder" class="btn btn-success btn-sm">Sifariş ver</button>
					</form>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="spacer"></div>
</div>
<?php 
include'footer.php';
?>
