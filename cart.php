<?php
require_once'header.php';

$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
$cartquery->execute(array('user_id' => $showuser['user_id']));
$count=$cartquery->rowCount();

if (empty($_SESSION['otheruser_mail'])) {
	header("Location:index");
}?>
<head>
	<title>Səbətim -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="title-bg">
		<div class="title">Alış-veriş səbətim</div>
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
						<th>Çıxart</th>
						<th>Foto</th>
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

						$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id");
						$productphotosquery->execute(array('id' => $showcart['product_id']));
						$count=$productphotosquery->rowCount();
						$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);

						$total+=$showcart['cart_total'];
						?>
						<tr>
							<td><br><a href="process/cart.php?p=3&cart_id=<?php echo $showcart['cart_id']?>&user_id=<?php echo $showcart['user_id'];?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
							<td><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" width="100" alt=""></td>
							<td><?php echo $showproduct['product_name']; ?></td>
							<td><?php echo $showproduct['product_id']; ?></td>
							<td><form method="post" action="process/cart?p=2">
								<input type="number" value="<?php echo $showcart['product_qty']; ?>" name="qty" class="form-control quantity">
								<input type="hidden" value="<?php echo $showcart['cart_id'] ?>" name="cart_id">
								<button type="submit" name="addqty" class="btn btn-default btn-red btn-xs" ><i style="color: white" class="fa fa-refresh"></i></button>
							</form></td>
							<td><?php echo "₼". $showproduct['product_price'];?></td>
							<td><?php echo "₼". $showproduct['product_price']* $showcart['product_qty']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-6">
				<div class="subtotal-wrap">
					<div class="total">Toplam : <span class="bigprice"><?php echo"₼".$total; ?></span></div>
					<!--<a href="" class="btn btn-default btn-red btn-sm">Yenilə</a>
						<a href="" class="btn btn-default btn-red btn-sm">Səbətdən çıxar</a>-->
						<div class="clearfix"></div>
						<a href="checkout" class="btn btn-default btn-yellow">Sifarişi tamamla</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php } ?>
		<div class="spacer"></div>
	</div>

	<?php
	include'footer.php';
	?>
