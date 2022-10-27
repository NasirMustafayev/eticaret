<?php
require_once'header.php';

if (isset($_SESSION['otheruser_mail'])) {
	
	header("Location:index");
}
?>
<head>
	<title>Qeydiyyat -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Qeydiyyat</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<form  action="process/registration" method="post" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="title-bg">
					<div class="title">Şəxsi məlumatlar</div>
				</div>

				<!--Problem xeberdarliqi -->
				<?php
				if (isset($_GET['res'])) {
					?>
					<div class="alert alert-danger">
						<strong><?php
						if ($_GET['res']=='1') { echo "Şifrələr fərqlidir! Yenidən cəhd edin";}
						if ($_GET['res']=='2') { echo "Şifrə ən az 6 simvoldan ibarət olmalıdır";}
						if ($_GET['res']=='3') { echo "Bu mail adresi ilə artıq qeydiyyatdan keçilib";}
						?></strong>
					</div>
					<?php
				}
				?>

				<!-- Xeberdarliq son-->

				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="text" class="form-control" name="name" id="name" placeholder="Ad" required>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Soyad" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group dob">
					<div class="col-sm-6">
						<input type="password" class="form-control" id="pass" name="password" placeholder="Şifrə" required>
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="rpass" name="rpassword" placeholder="Təkrar şifrə" required>
					</div>
				</div>
				<button class="btn btn-default btn-red" type="submit" name="registration">Qeydiyyatdan keç</button>
			</div>
		</div>
	</form>
	<div class="spacer"></div>
</div>
<?php
include'footer.php';
?>
