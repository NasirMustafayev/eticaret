<?php 
include'../config/connect.php';
include'../function/seo-function.php';
ob_start();
session_start();

if (isset($_GET['p'])) {

//INSERT MENU
	if ($_GET['p']==1) {
		if (isset($_POST['insertmenu'])) {

			$seourl=seo($_POST['name']);

			$insert=$db->prepare("INSERT INTO menus SET 
				menu_name=:name,
				menu_detail=:detail,
				menu_url=:url,
				menu_seourl=:seourl,
				menu_status=:status,
				menu_row=:row");

			$save=$insert-> execute(array(
				'name'=> $_POST['name'] ,
				'detail'=> $_POST['detail'] ,
				'url' => $_POST['url'],
				'seourl' => $seourl,
				'status' => $_POST['status'],
				'row' => $_POST['row']));

			if (!$save) {

				header("location:../menus.php?res=no");
			}
			else {
				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 1,
					'process_name'=>"Yeni menyu əlavəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']
				));
				header("location:../menus.php?res=ok");
			}
		}
	}

//UPDATE MENU
	if ($_GET['p']==2) {
		if (isset($_POST['editmenu'])) {

			$seourl=seo($_POST['name']);
			$menu_id=$_POST['id'];

			$update=$db->prepare("UPDATE menus SET 
				menu_name=:name,
				menu_detail=:detail,
				menu_url=:url,
				menu_seourl=:seourl,
				menu_status=:status,
				menu_row=:row
				where menu_id=:id");

			$save=$update-> execute(array(
				'name'=> $_POST['name'] ,
				'detail'=> $_POST['detail'] ,
				'url' => $_POST['url'],
				'seourl' => $seourl,
				'status' => $_POST['status'],
				'row' => $_POST['row'],
				'id' => $_POST['id']));

			if (!$save) {

				header("location:../edit-menu.php?id=$menu_id&res=no");
			}
			else {
				$insertinlog=$db->prepare("INSERT INTO logs SET
					log_no=:no,
					process_name=:process_name,
					process_summary=:process_summary,
					process_author=:author");
				$insertinlog->execute(array(
					'no'=> 2,
					'process_name'=>"Menyu redaktəsi",
					'process_summary'=> $_POST['name'],
					'author'=>$_SESSION['user_mail']

				));
				header("location:../edit-menu.php?id=$menu_id&res=ok");
			}
		}
	}

//UPDATE STATUS shortcut
	if ($_GET['p']==3) {
		if (isset($_GET['status'])) {

			$update=$db->prepare("UPDATE menus SET
				menu_status=:status
				where menu_id=:id");

			$save=$update-> execute(array(
				'status'=> $_GET['status'],
				'id'=> $_GET['id']));

			if (!$save) {

				header("location:../menus.php?res=no");
			}
			else {

				header("location:../menus.php?res=ok");
			}
		}
	}
}