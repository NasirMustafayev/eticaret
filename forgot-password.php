<?php
require_once'header.php';

if (isset($_SESSION['otheruser_mail'])) {
	
	header("Location:index");
}
?>
<head>
	<title>Şifrə bərpası -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<center>
						<div class="row">
							<div class="bigtitle">Şifrə bərpası</div>
							<br>
						</div>
						<form  action="process/registration" method="post" class="form-horizontal checkout" role="form">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-8">
									<!--Problem xeberdarliqi -->
									<?php
									if (isset($_GET['res'])) {
										?>
										<div class="alert alert-danger">
											<strong><?php
											if ($_GET['res']=='1') { echo "Şifrələr fərqlidir! Yenidən cəhd edin";}
											if ($_GET['res']=='2') { echo "Şifrə ən az 6 simvoldan ibarət olmalıdır";}
											if ($_GET['res']=='3') { echo "Bu mail adresi ilə artıq Şifrə bərpasıdan keçilib";}
											?></strong>
										</div>
										<?php
									}
									?>

									<!-- Xeberdarliq son-->

									<div class="form-group">
										<div class="col-sm-12">
											Qeydiyyatdan keçdiyiniz email addressini daxil edin
											<input type="email" class="form-control btn-red" style="color: white" id="email" name="email" placeholder="Email" required>
										</div>
									</div>
									<button class="btn btn-default btn-red" type="submit" name="registration">Göndər</button>
								</div>
							</div>
						</form>
					</center>
				</div>
			</div>
		</div>
	</div>
	<div class="spacer"></div>
</div>
<?php
include'footer.php';
?>
