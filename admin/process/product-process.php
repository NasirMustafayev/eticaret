<?php 
include'../config/connect.php';
include'../function/seo-function.php';
ob_start();
session_start();

if (isset($_GET['p'])) {

//INSERT product
	if ($_GET['p']==1) {
		if (isset($_POST['insertproduct'])) {

			$seourl=seo($_POST['name']);

			$insert=$db->prepare("INSERT INTO products SET 
				product_name=:name,
				category_id=:category,
				product_detail=:detail,
				product_seourl=:seourl,
				product_price=:price,
				product_stock=:stock,
				product_manufacturer=:manufacturer,
				product_keyword=:keyword,
				product_status=:status");

			$save=$insert-> execute(array(
				'name'=> $_POST['name'],
				'category'=> $_POST['category'],
				'detail'=> $_POST['detail'],
				'seourl'=> $seourl,
				'price'=> $_POST['price'],
				'stock'=> $_POST['stock'],
				'manufacturer'=> $_POST['manufacturer'],
				'keyword'=> $_POST['keyword'],
				'status'=> $_POST['status']));

			if (!$save) {

				header("location:../products.php?res=no");
			}
			else {

				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 1,
					'process_name'=>"Yeni məhsul əlavəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../products.php?res=ok");
			}
		}
	}

//UPDATE product
	if ($_GET['p']==2) {
		if (isset($_POST['editproduct'])) {

			$seourl=seo($_POST['name']);
			$product_id=$_POST['id'];

			$update=$db->prepare("UPDATE products SET 
				product_name=:name,
				category_id=:category,
				category_top_id=:category_top,
				product_detail=:detail,
				product_seourl=:seourl,
				product_price=:price,
				product_stock=:stock,
				product_manufacturer=:manufacturer,
				product_featured=:featured,
				product_keyword=:keyword,
				product_status=:status
				where product_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'],
				'category'=> $_POST['category'],
				'category_top'=> $_POST['category_top'],
				'detail'=> $_POST['detail'],
				'seourl'=> $seourl,
				'price'=> $_POST['price'],
				'stock'=> $_POST['stock'],
				'manufacturer'=> $_POST['manufacturer'],
				'featured'=> $_POST['featured'],
				'keyword'=> $_POST['keyword'],
				'status'=> $_POST['status'],
				'id'=> $_POST['id']));

			if (!$save) {

				header("location:../edit-product.php?id=$product_id&res=no");
			}
			else {

				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 2,
					'process_name'=>"Məhsul redaktəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../edit-product.php?id=$product_id&res=ok");
			}
		}
	}

//UPDATE FEATURED and STATUS shortcut
	if ($_GET['p']==3) {
		if (isset($_GET['featured'])) {

			$update=$db->prepare("UPDATE products SET
				product_featured=:featured
				where product_id=:id");

			$save=$update-> execute(array(
				'featured'=> $_GET['featured'],
				'id'=> $_GET['id']));
		}

		if (isset($_GET['status'])) {

			$update=$db->prepare("UPDATE products SET
				product_status=:status
				where product_id=:id");

			$save=$update-> execute(array(
				'status'=> $_GET['status'],
				'id'=> $_GET['id']));
		}

		if (!$save) {

			header("location:../products.php?res=no");
		}
		else {

			header("location:../products.php?res=ok");
		}
	}
}