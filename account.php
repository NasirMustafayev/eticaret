<?php
require_once'header.php';
?>
<head>
	<title>Hesabım -Nasir | Startup eCommerce Script</title>
</head>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-4">
							<div class="bigtitle">Hesab məlumatları</div>
						</div>
					</div>
				</div>
			</div>
			<?php

			if (isset($_GET['res'])) {
				
				if ($_GET['res']=='ok') { ?>
					<div class="alert alert-success">
						Dəyişiklik uğurla həyata keçrildi
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<form  action="process/editaccount" method="post" class="form-horizontal checkout" role="form">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-4">
			<div class="title-bg">
				<div class="title">Şəxsi məlumatlar</div>
			</div>
			<div class="form-group dob">
				<div class="col-sm-6">
					Ad
					<input type="text" class="form-control" value="<?php echo $showuser['user_name'] ?>" name="name" id="name" placeholder="Ad" required>
				</div>
				<div class="col-sm-6">
					Soyad
					<input type="text" class="form-control" value="<?php echo $showuser['user_lastname'] ?>" name="lastname" id="lastname"  placeholder="Soyad" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					Email
					<input type="email" class="form-control" value="<?php echo $showuser['user_mail'] ?>" id="email" name="email" placeholder="Email" required>
				</div>
			</div>
			<div class="form-group dob">
				<div class="col-sm-6">
					Address
					<input type="text" class="form-control" value="<?php echo $showuser['user_address'] ?>" name="address" id="address" placeholder="Address" required>
				</div>
				<div class="col-sm-6">
					Telefon
					<input type="text" class="form-control" value="<?php echo $showuser['user_gsm'] ?>" name="gsm" id="gsm"  placeholder="Telefon" required>
				</div>
			</div>
			<button class="btn btn-default btn-red" type="submit" name="editaccountinformation">Yadda saxla</button>
		</div>
	</form>

	<div class="col-md-4">
		<div class="title-bg">
			<div class="title">Şifrəni dəyişdir</div>
		</div>

		<!--Problem xeberdarliqi -->
		<?php
		if (isset($_GET['res'])) {
			if ($_GET['res']=='1') { ?>
				<div class="alert alert-danger">
					Şifrələr fərqlidir! Yenidən cəhd edin
				</div>
				<?php
			}
			if ($_GET['res']=='2') { ?>
				<div class="alert alert-danger">
					Şifrə ən az 6 simvoldan ibarət olmalıdır
				</div>
			<?php }
			if ($_GET['res']=='3') { ?>
				<div class="alert alert-danger">
					Köhnə şifrə yalnışdır.Yenidən cəhd edin
				</div>
			<?php }
		}
		?>

		<!-- Xeberdarliq son-->
		<form action="process/editaccount?p=2" method="post" class="form-horizontal checkout" role="form">
			<div class="form-group">
				<div class="col-sm-12">
					Köhnə şifrə
					<input type="password" class="form-control" id="lastpass" name="lastpassword" placeholder="Köhnə şifrəni daxil edin">
					<input type="hidden" value="<?php echo $showuser['user_password'] ?>" name="lp">
				</div>
			</div>
			<div class="form-group dob">
				<div class="col-sm-6">
					Yeni şifrə
					<input type="password" class="form-control" id="pass" name="password" placeholder="Yeni şifrəni daxil edin">
				</div>
				<div class="col-sm-6">
					Şifrəni təkrarlayın
					<input type="password" class="form-control" id="rpass" name="rpassword" placeholder="Şifrəni təkrar daxil edin">
				</div>
			</div>
			<button class="btn btn-default btn-red" type="submit" name="editaccountpassword">Dəyişdir</button>
		</form>
	</div>
</div>
<div class="spacer"></div>
</div>
<?php
include'footer.php';
?>
