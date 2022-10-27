<?php 
include'../config/connect.php';
include'../function/seo-function.php';
ob_start();
session_start();

if (isset($_GET['p'])) {

//INSERT category
	if ($_GET['p']==1) {
		if (isset($_POST['insertcategory'])) {

			$seourl=seo($_POST['name']);

			$insert=$db->prepare("INSERT INTO categories SET 
				category_name=:name,
				category_seourl=:seourl,
				category_status=:status,
				category_row=:row,
				category_top=:top");

			$save=$insert-> execute(array(
				'name'=> $_POST['name'] ,
				'seourl' => $seourl,
				'status' => $_POST['status'],
				'row' => $_POST['row'],
				'top' => $_POST['top']));

			if (!$save) {

				header("location:../categories.php?res=no");
			}
			else {
				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 1,
					'process_name'=>"Yeni kateqoriya əlavəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../categories.php?res=ok");
			}
		}
	}

//UPDATE category
	if ($_GET['p']==2) {
		if (isset($_POST['editcategory'])) {

			$seourl=seo($_POST['name']);
			$category_id=$_POST['id'];

			$update=$db->prepare("UPDATE categories SET 
				category_name=:name,
				category_seourl=:seourl,
				category_status=:status,
				category_row=:row,
				category_top=:top
				where category_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'seourl' => $seourl,
				'status' => $_POST['status'],
				'row' => $_POST['row'],
				'top' => $_POST['top'],
				'id' => $_POST['id']));

			if (!$save) {

				header("location:../edit-category.php?id=$category_id&res=no");
			}
			else {
				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 2,
					'process_name'=>"Kateqoriya redaktəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../edit-category.php?id=$category_id&res=ok");
			}
		}
	}

//UPDATE STATUS shortcut
	if ($_GET['p']==3) {
		if (isset($_GET['status'])) {

			$update=$db->prepare("UPDATE categories SET
				category_status=:status
				where category_id=:id");

			$save=$update-> execute(array(
				'status'=> $_GET['status'],
				'id'=> $_GET['id']));

			if (!$save) {

				header("location:../categories.php?res=no");
			}
			else {

				header("location:../categories.php?res=ok");
			}
		}
	}
}