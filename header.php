<!DOCTYPE html>
<?php
ob_start();
session_start();
require_once'admin/config/connect.php';
include'admin/function/seo-function.php';
//error_reporting(0);


//Parametrlər
$query=$db->prepare("SELECT * FROM parametr where parametr_id=:id");
$query->execute(array('id' => 0));
$show=$query->fetch(PDO::FETCH_ASSOC);

//İstifadəçi məlumatları
$userquery=$db->prepare("SELECT * FROM users where user_mail=:mail");
$userquery->execute(array('mail' => $_SESSION['otheruser_mail']));
$showuser=$userquery->fetch(PDO::FETCH_ASSOC);
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $show['parametr_description']; ?>">
	<meta name="keywords" content="<?php echo $show['parametr_keywords']; ?>">
	<meta name="author" content="<?php echo $show['parametr_author']; ?>">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='font-awesome\css\font-awesome.css' rel="stylesheet" type="text/css">
	<!-- Bootstrap -->
	<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
	
	<!-- Main Style -->
	<link rel="stylesheet" href="style.css">
	
	<!-- owl Style -->
	<link rel="stylesheet" href="css\owl.carousel.css">
	<link rel="stylesheet" href="css\owl.transitions.css">

	<!-- Animate -->
	<link rel="stylesheet" href="css/animate.css">

	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	<div id="wrapper">
		<div class="header"><!--Header -->
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-md-4 main-logo">
						<a href="index"><img src="<?php echo $show['parametr_logo']; ?>" alt="logo" style="width: 200px" class="logo img-responsive"></a>
					</div>
					<div class="col-md-8">
						<div class="pushright">
							<div class="top">
								<?php
								if (isset($_SESSION['otheruser_mail'])) { ?>
									<a href="logout" id="logout" class="btn btn-default btn-dark">Çıxış</a>
								<?php }
								else{
									?>
									<a href="#" id="reg" class="btn btn-default btn-dark">Daxil ol<span>və ya</span>Qeydiyyatdan keç</a>
									<div class="regwrap">
										<div class="row">
											<div class="col-md-6 regform">
												<div class="title-widget-bg">
													<div class="title-widget">Daxil ol</div>
												</div>

												<form action="process/login" method="post" role="form">
													<div class="form-group">
														<input type="text" name="email" class="form-control" id="username" placeholder="Email adresi">
													</div>
													<div class="form-group">
														<input type="password" name="password" class="form-control" id="password" placeholder="Şifrə">
														<a href="forgot-password">Şifrənizi unutmusunuz?</a>
													</div>
													<div class="form-group">
														<button type="submit" name="login" class="btn btn-default btn-red btn-sm">Daxil ol</button>
													</div>
												</form>

											</div>
											<div class="col-md-6">
												<div class="title-widget-bg">
													<div class="title-widget">Qeydiyyatdan keçin</div>
												</div>
												<p>
													Yeni istifadəçisiniz? Sürətli bir şəkildə qeydiyyatdan keçib elə indi alış-verişə başlaya bilərsiniz...
												</p>
												<a href="registration"><button class="btn btn-default btn-yellow">İndi qeyd ol</button></a>
											</div>
										</div>
									</div>
									<?php
								}
								?>
								<div class="srch-wrap">
									<a href="#" id="srch" class="btn btn-default btn-search"><i class="fa fa-search"></i></a>
								</div>
								<div class="srchwrap">
									<div class="row">
										<div class="col-md-12">
											<form action="search" method="post" class="form-horizontal" role="form">
												<div class="form-group">
													<input type="submit" name="search" value="Axtar" class="btn btn-default btn-xs control-label">
													<div class="col-sm-10">
														<input type="text" name="searchtext" minlength="3" class="form-control" id="search" required="">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dashed"></div>
		</div><!--Header -->
		<div class="main-nav"><!--end main-nav -->
			<div class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li><a href="index.php" class="active">Ana səhifə</a><div class="curve"></div></li>

									<?php
									//SLİDER
									$menuquery=$db->prepare("SELECT * FROM menus where menu_status=:status order by menu_row ASC limit 5");
									$menuquery->execute(array('status' => 1));

									while ($showmenu=$menuquery->fetch(PDO::FETCH_ASSOC)) {
										?>
										<li>
											<a href="<?php if (!empty($showmenu['menu_url'])) { 
												echo $showmenu['menu_url']; }
												else{
													echo "page-".seo($showmenu['menu_name']); }
													?>"><?php echo $showmenu['menu_name']; ?></a></li>
												<?php }

												$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
												$cartquery->execute(array('user_id' => $showuser['user_id']));
												while($showcarttotal=$cartquery->fetch(PDO::FETCH_ASSOC)){
													$carttotal+=$showcarttotal['cart_total'];
												}
												?>
											</ul>
										</div>
									</div>

									<div class="col-md-2 machart">
										<button id="popcart" class="btn btn-default btn-chart btn-sm" <?php if (empty($_SESSION['otheruser_mail'])) {?>disabled <?php }?>><span class="mychart">Səbət</span>|<span class="allprice">₼<?php echo $carttotal;?></span></button>
										<div class="popcart">
											<table class="table table-condensed popcart-inner">
												<tbody>
													<?php
													$cartquery=$db->prepare("SELECT * FROM cart where user_id=:user_id");
													$cartquery->execute(array('user_id' => $showuser['user_id']));
													$count=$cartquery->rowCount();

													if ($count==0) {

														echo "<h4 style='color:black'>Səbətiniz hələki boşdur.</h4>";
													}

													else{

														while ($showcart=$cartquery->fetch(PDO::FETCH_ASSOC)) {

															$productquery=$db->prepare("SELECT * FROM products where product_id=:product_id");
															$productquery->execute(array('product_id' => $showcart['product_id']));
															$showproduct=$productquery->fetch(PDO::FETCH_ASSOC);

															$productphotosquery=$db->prepare("SELECT * FROM productphotos where product_id=:id");
															$productphotosquery->execute(array('id' => $showcart['product_id']));
															$count=$productphotosquery->rowCount();
															$showproductphotos=$productphotosquery->fetch(PDO::FETCH_ASSOC);
															?>
															<tr>
																<td>
																	<a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><img src="<?php if($count==0){?>images/no-image.png <?php }else{ echo $showproductphotos['product_photo']; }?>" alt="" class="img-responsive"></a>
																</td>
																<td><a href="<?php echo "product-".seo($showproduct['product_name'])."-".$showproduct['product_id'] ?>"><?php echo $showproduct['product_name']; ?></a></td>
																<td><?php echo $showcart['product_qty']; ?>X</td>
																<td><?php echo "₼".$showproduct['product_price']; ?></td>
																<td><a href="process/cart.php?p=3&cart_id=<?php echo $showcart['cart_id']?>&user_id=<?php echo $showcart['user_id'];?>"><i class="fa fa-times-circle fa-2x"></i></a></td>
															</tr>
														<?php } } ?>
													</tbody>
												</table>
												<br>
												<div class="btn-popcart">
													<a href="checkout" class="btn btn-default btn-red btn-sm">Sifarişi tamamla</a>
													<a href="cart" class="btn btn-default btn-red btn-sm">Səbətim</a>
												</div>
												<div class="popcart-tot">
													<p>
														Cəmi<br>
														<span><?php echo"₼". $carttotal; ?></span>
													</p>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div><!--end main-nav -->
						<div class="container">
							<?php
							if (isset($_SESSION['otheruser_mail'])) { ?>

								<ul class="small-menu">
									<li style="color: black">Xoş gəldin,<?php echo $showuser['user_name']." ".$showuser['user_lastname']; ?></li>
									<li><a href="account" class="myacc">Hesabım</a></li>
									<li><a href="cart" class="myshop">Səbətim</a></li>
									<li><a href="orders" class="mycheck">Sifarişlərim</a></li>
								</ul>
								<div class="clearfix"></div>
								<div class="lines"></div>
							<?php } ?>
						</div>