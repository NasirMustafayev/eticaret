<?php 
include'../admin/config/connect.php';
ob_start();
session_start();

$userquery=$db->prepare("SELECT * FROM users where user_mail=:mail");
$userquery->execute(array('mail' => $_SESSION['otheruser_mail']));
$showuser=$userquery->fetch(PDO::FETCH_ASSOC);

$cartquery=$db->prepare("SELECT * FROM cart where cart_id=:cart_id");
$cartquery->execute(array('cart_id' => $_POST['cart_id']));
$showcart=$cartquery->fetch(PDO::FETCH_ASSOC);

$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
if ($_GET['p']==2) {
	$productquery->execute(array('product_id' => $showcart['product_id']));
}
else{
	$productquery->execute(array('product_id' => $_POST['product_id']));
}
$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);



$producturl=$_POST['purl'];

if (isset($_GET['p'])) {

//INSERT cart
	if ($_GET['p']==1) {
		if (isset($_POST['addcart'])) {

			if ($showuser['user_id']!=$_POST['user_id']) {

				header("Location:../logout.php");
			}
			else{

				$insert=$db->prepare("INSERT INTO cart SET 
					user_id=:user_id,
					product_id=:product_id,
					product_qty=:qty,
					cart_total=:total");

				$save=$insert-> execute(array(
					'user_id'=> $_POST['user_id'] ,
					'product_id'=> $_POST['product_id'] ,
					'qty' => $_POST['qty'],
					'total' => $_POST['qty']*$showproduct['product_price']));

				if (!$save) {

					header("location:$producturl?res=no");
				}
				else {

					header("location:$producturl?res=ok");
				}
			}
		}
	}

//UPDATE cart QTY
	if ($_GET['p']==2) {
		if (isset($_POST['addqty'])) {

			$update=$db->prepare("UPDATE cart SET 
				product_qty=:qty,
				cart_total=:total
				where cart_id=:cart_id");

			$save=$update-> execute(array(
				'qty'=> $_POST['qty'],
				'total'=> $_POST['qty']*$showproduct['product_price'],
				'cart_id' => $_POST['cart_id']));

			if (!$save) {

				header("location:../cart.php?res=no");
			}
			else {

				header("location:../cart.php?res=ok");
			}
		}
	}

//DELETE cart
	if ($_GET['p']==3) {

		if ($_GET['user_id']!=$showuser['user_id']) {

			header("Location:../index?res=block");
		}

		$cartquery=$db->prepare("SELECT * FROM cart where cart_id=:cart_id");
		$cartquery->execute(array('cart_id'=>$_GET['cart_id']));
		$showcart=$cartquery->fetch(PDO::FETCH_ASSOC);

		if ($showcart['user_id']!=$showuser['user_id']) {

			header("Location:../index?res=block");

		}


		else{

			$delete=$db->prepare("DELETE FROM cart where cart_id=:cart_id");
			$save=$delete->execute(array('cart_id'=> $_GET['cart_id']));

			if (!$save) {

				header("location:../cart?res=no");
			}
			else {

				header("location:../cart?res=ok");
			}
		}
	}
}