<?php
include'../config/connect.php';
$orderdetailquery=$db->prepare("SELECT * FROM orderdetails where order_id=:order_id");
$orderdetailquery->execute(array('order_id' => $_GET['id']));

if (isset($_GET['p'])) {
	if ($_GET['p']==1) {

		$update=$db->prepare("UPDATE orders SET 
			order_status=:status
			where order_id=:order_id");

		$save=$update-> execute(array(
			'status'=> 1,
			'order_id' => $_GET['id']));

		if (!$save) {

			header("location:../orders?res=no");
		}
		else {

			while($showorderdetail=$orderdetailquery->fetch(PDO::FETCH_ASSOC)){
				$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
				$productquery->execute(array('product_id' => $showorderdetail['product_id']));
				$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

				$orderdetailquerypr=$db->prepare("SELECT * FROM orderdetails where order_id=:order_id and product_id=:product_id");
				$orderdetailquerypr->execute(array(
					'order_id' => $_GET['id'],
					'product_id'=>$showorderdetail['product_id']));
				$showorderdetailpr=$orderdetailquerypr->fetch(PDO::FETCH_ASSOC);

				$stock=$showproduct['product_stock']-$showorderdetailpr['product_qty'];

				$productquery=$db->prepare("UPDATE products SET
					product_stock=:stock 
					where product_id=:product_id");
				$productquery->execute(array(
					'stock'=>$stock,
					'product_id' => $showorderdetail['product_id']));
			}
			header("location:../orders?res=ok");
		}
	}
}
?>