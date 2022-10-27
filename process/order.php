<?php 
include'../admin/config/connect.php';
ob_start();
session_start();

$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
$cartquery->execute(array('user_id' => $_GET['uid']));

if (isset($_GET['p'])) {

//INSERT order
	if ($_GET['p']==1) {
		if (isset($_POST['addbanktypeorder'])) {

			while ($showcart=$cartquery->fetch(PDO::FETCH_ASSOC)) {
				
				$total+=$showcart['cart_total'];
			}
			//$total=base64_decode($_GET['t']);
			$insert=$db->prepare("INSERT INTO orders SET 
				user_id=:user_id,
				order_type=:type,
				order_bank=:bank,
				order_total=:total");

			$save=$insert-> execute(array(
				'user_id'=> $_GET['uid'] ,
				'type'=> 'Bank Transfer' ,
				'bank' => $_POST['bank'],
				'total' => $total));

			if (!$save) {

				header("location:../orders?res=no");
			}
			else {

//INSERT order detail
				$order_id=$db->lastInsertId();

				$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
				$cartquery->execute(array('user_id' => $_GET['uid']));

				while ($showcart=$cartquery->fetch(PDO::FETCH_ASSOC)) {

					$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
					$productquery->execute(array('product_id' => $showcart['product_id']));
					$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

					$insert=$db->prepare("INSERT INTO orderdetails SET 
						order_id=:order_id,
						product_id=:product_id,
						product_price=:product_price,
						product_qty=:product_qty");

					$saveorderdetails=$insert-> execute(array(
						'order_id'=> $order_id,
						'product_id'=> $showcart['product_id'],
						'product_price' =>$showproduct['product_price'],
						'product_qty'=> $showcart['product_qty']));

				}

				if ($saveorderdetails) {
					$delete=$db->prepare("DELETE FROM cart where user_id=:user_id");
					$save=$delete->execute(array('user_id'=>$_GET['uid']));

					header("Location:../orders?res=ok");

				}
			}
		}
	}

//UPDATE order QTY
	if ($_GET['p']==2) {
		if (isset($_POST['addqty'])) {

			$update=$db->prepare("UPDATE order SET 
				product_qty=:qty
				where order_id=:order_id");

			$save=$update-> execute(array(
				'qty'=> $_POST['qty'],
				'order_id' => $_POST['order_id']));

			if (!$save) {

				header("location:../order.php?res=no");
			}
			else {

				header("location:../order.php?res=ok");
			}
		}
	}

//DELETE order
	if ($_GET['p']==3) {

		if ($_GET['user_id']!=$showuser['user_id']) {

			header("Location:../index?res=block");
		}

		$orderquery=$db->prepare("SELECT * FROM order where order_id=:order_id");
		$orderquery->execute(array('order_id'=>$_GET['order_id']));
		$showorder=$orderquery->fetch(PDO::FETCH_ASSOC);

		if ($showorder['user_id']!=$showuser['user_id']) {

			header("Location:../index?res=block");

		}


		else{

			$delete=$db->prepare("DELETE FROM order where order_id=:order_id");
			$save=$delete->execute(array('order_id'=> $_GET['order_id']));

			if (!$save) {

				header("location:../order?res=no");
			}
			else {

				header("location:../order?res=ok");
			}
		}
	}
}