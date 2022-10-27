<?php
include'../config/connect.php';
ob_start();
session_start();

if(empty($_SESSION['user_mail'])){

	header("Location:../login?res=block");
	exit;
}
if (isset($_GET['del'])) {

//DELETE USER
	if ($_GET['del']=='user') {
		$delete=$db->prepare("DELETE FROM users where user_id=:id"); }

	//DELETE MENU
		if ($_GET['del']=='menu') {
			$delete=$db->prepare("DELETE FROM menus where menu_id=:id"); }

		//DELETE SLIDER
			if ($_GET['del']=='slider') {
				$delete=$db->prepare("DELETE FROM sliders where slider_id=:id"); }

			//DELETE CATEGORY
				if ($_GET['del']=='category') {
					$delete=$db->prepare("DELETE FROM categories where category_id=:id"); }

				//DELETE PRODUCT
					if ($_GET['del']=='product') {
						$delete=$db->prepare("DELETE FROM products where product_id=:id");
						$deleteproductcomments=$db->prepare("DELETE FROM comments where product_id=:id"); }
						
					//DELETE COMMENT
						if ($_GET['del']=='comment') {
							$delete=$db->prepare("DELETE FROM comments where comment_id=:id"); }

						//DELETE BANK
							if ($_GET['del']=='bank') {
								$delete=$db->prepare("DELETE FROM bank where bank_id=:id"); }

							//DELETE PRODUCT PHOTO
								if ($_GET['del']=='productphoto') {
									$delete=$db->prepare("DELETE FROM productphotos where productphoto_id=:id"); }

///////////////////////////////////////////////////////////////////////////////
									$save=$delete->execute(array('id' =>$_GET['id']));
									if ($_GET['del']=='product') {
										$savedeleteproductcomments=$deleteproductcomments->execute(array('id' =>$_GET['id']));
									}
//////////////////////////////////////////////////////////////////////////////

									if (!$save) {

				//ERROR report USER

										if ($_GET['del']=='user'){
											header("Location:../users.php?dres=no");}

				//ERROR report MENU

											if ($_GET['del']=='menu'){
												header("Location:../menus.php?dres=no");}

					//ERROR report SLIDER

												if ($_GET['del']=='slider'){
													header("Location:../sliders.php?dres=no");}

						//ERROR report CATEGORY

													if ($_GET['del']=='category'){
														header("Location:../categories.php?dres=no");}

							//ERROR report PRODUCT

														if ($_GET['del']=='product'){
															header("Location:../products.php?dres=no");}

								//ERROR report COMMENT

															if ($_GET['del']=='comment'){
																header("Location:../comments.php?dres=no");}

									//ERROR report BANK

																if ($_GET['del']=='bank'){
																	header("Location:../bank.php?dres=no");}

										//ERROR report PRODUCT PHOTO

																	if ($_GET['del']=='productphoto'){
																		header("Location:../product-gallery.php?dres=no");}

																	}
/////////////////////////////////////////////////////////////////////////////
																	else{

							//SUCCESFUL report USER
																		if ($_GET['del']=='user'){
																			header("Location:../users.php?dres=ok");}

								//SUCCESFULL report MENU
																			if ($_GET['del']=='menu'){
																				$insertinlog=$db->prepare("INSERT INTO logs SET
																					log_no=:no,
																					process_name=:process_name,
																					process_summary=:process_summary,
																					process_author=:author");
																				$insertinlog->execute(array(
																					'no'=> 3,
																					'process_name'=>"Silinmə prosesi",
																					'process_summary'=> "Menyu silindi",
																					'author'=>$_SESSION['user_mail']
																				));
																				header("Location:../menus.php?dres=ok");}

									//SUCCESFULL report SLIDER
																				if ($_GET['del']=='slider'){
																					$insertinlog=$db->prepare("INSERT INTO logs SET
																						log_no=:no,
																						process_name=:process_name,
																						process_summary=:process_summary,
																						process_author=:author");
																					$insertinlog->execute(array(
																						'no'=> 3,
																						'process_name'=>"Silinmə prosesi",
																						'process_summary'=> "Slayd silindi",
																						'author'=>$_SESSION['user_mail']
																					));
																					$delimg=$_GET['un'];
																					unlink("../../$delimg");

																					header("Location:../sliders.php?dres=ok");}

										//SUCCESFULL report CATEGORY
																					if ($_GET['del']=='category'){
																						$insertinlog=$db->prepare("INSERT INTO logs SET
																							log_no=:no,
																							process_name=:process_name,
																							process_summary=:process_summary,
																							process_author=:author");
																						$insertinlog->execute(array(
																							'no'=> 3,
																							'process_name'=>"Silinmə prosesi",
																							'process_summary'=> "Kateqoriya silindi",
																							'author'=>$_SESSION['user_mail']
																						));
																						header("Location:../categories.php?dres=ok");}

											//SUCCESFULL report PRODUCT
																						if ($_GET['del']=='product'){
																							$insertinlog=$db->prepare("INSERT INTO logs SET
																								log_no=:no,
																								process_name=:process_name,
																								process_summary=:process_summary,
																								process_author=:author");
																							$insertinlog->execute(array(
																								'no'=> 3,
																								'process_name'=>"Silinmə prosesi",
																								'process_summary'=> "Məhsul silindi",
																								'author'=>$_SESSION['user_mail']
																							));
																							header("Location:../products.php?dres=ok");}

												//SUCCESFULL report COMMENT
																							if ($_GET['del']=='comment'){
																								header("Location:../comments.php?dres=ok");}

														//SUCCESFULL report BANK
																								if ($_GET['del']=='bank'){
																									$insertinlog=$db->prepare("INSERT INTO logs SET
																										log_no=:no,
																										process_name=:process_name,
																										process_summary=:process_summary,
																										process_author=:author");
																									$insertinlog->execute(array(
																										'no'=> 3,
																										'process_name'=>"Silinmə prosesi",
																										'process_summary'=> "Bank heasabı silindi",
																										'author'=>$_SESSION['user_mail']
																									));
																									header("Location:../bank.php?dres=ok");}


																//SUCCESFULL report PRODUCT PHOTO
																									if ($_GET['del']=='productphoto'){

																										$product_id=$_GET['product_id'];
																										$delimg=$_GET['un'];
																										unlink("../../$delimg");

																										header("Location:../product-gallery.php?product_id=$product_id&dres=ok");}

																									}


																								}	
																								?>