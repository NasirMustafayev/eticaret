<?php
require_once'header.php';

$parameterquery=$db->prepare("SELECT * FROM parametr where parametr_id=:id");
$parameterquery->execute(array('id' => 0));
$showparameter=$parameterquery->fetch(PDO::FETCH_ASSOC);

if ($showuser['user_authorization']<5) {
	
	header("Location:index");
	exit;
}

?>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<!--
					Ümumi parametrlər
				-->
				<div class="x_panel">
					<div class="x_title">
						<h2>Ümumi parametrlər
							<?php
							if (isset($_GET['pres'])) {
								if ($_GET['pres']=='ok') { ?>
									<script type="text/javascript">
										swal("Dəyişiklik qeyd edildi", "", "success");
									</script>
									<?
								}
								if ($_GET['pres']=='largesize') { ?>
									<script type="text/javascript">
										swal("Şəkil həcmi çox böyükdür", "Şəklin həcmi maksimum 1 mb ola bilər", "warning");
									</script>
									<?
								}
								if ($_GET['pres']=='invalidtype') { ?>
									<script type="text/javascript">
										swal("Fayl tipi dəstəklənmir", "Fayl yalnız jpg, jpeg, png, gif, bmp tipində ola bilər", "error");
									</script>
									<?
								}
								elseif($_GET['pres']=='no'){ ?>
									<script type="text/javascript">
										swal("Səhv baş verdi", "", "error");
									</script>
									<?
								}
							}
							?></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div 
						<?php
						if ($_GET['p']=='conf')
							{ ?>
								style="display:block;"
							<?php }
							else {?>
								style="display: none;"
							<?php } ?>
							class="x_content">
							<form action="process/all-param-process.php?p=logo" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Loqotip
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<?php
										if (!empty($showparameter['parametr_logo'])) {
											?>
											<img src="<?php echo '../'.$showparameter['parametr_logo']; ?>" style="max-height: 250px;max-width: 250px" class="img-responsive avatar-view">
											<?php
										}else{?>
											<img src="../images/no-image.png" class="img-responsive avatar-view">
											<?php
										}
										?>
										<br>
										<input type="file" name="logo" id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
										max : 1MB (<u>jpg, jpeg, png, gif, bmp</u>)
									</div>
								</div>
								<div class="col-md-6 col-md-offset-3" align="right">
									<input type="hidden" value="<?php echo $showparameter['parametr_logo']; ?>" name="lastlogo">
									<button id="send" type="submit" name="logoyenile" class="btn btn-primary">Dəyiş</button>
								</div>
							</form>

							<form action="process/all-param-process.php" method="post" class="form-horizontal form-label-left" novalidate>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sayt başlığı</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="title"  value="<?php echo $showparameter['parametr_title']; ?>" id="title" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Açar sözlər
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" value="<?php echo $showparameter['parametr_keywords']; ?>" name="keywords" id="keywords" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Sayt açıqlaması
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="description" value="<?php echo $showparameter['parametr_description']; ?>" id="description"  required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Sayt müəllifi
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" name="author" value="<?php echo $showparameter['parametr_author']; ?>" id="author"  required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<input type="hidden" name="id" value="<?php echo $showparameter['parametr_id']; ?>">
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-3" align="right">
										<button id="send" type="submit" name="paramyenile" class="btn btn-success">Yenilə</button>
									</div>
								</div>
							</form>
						</div>
					</div>
						<!--
							Əlaqə məlumatları
						-->
						<div class="x_panel">
							<div class="x_title">
								<h2>Əlaqə məlumatları
									<?php
									if (isset($_GET['infores'])) {
										if ($_GET['infores']=='ok') { ?>
											<script type="text/javascript">
												swal("Dəyişiklik qeyd edildi", "", "success");
											</script>
											<?
										}
										else{ ?>
											<script type="text/javascript">
												swal("Səhv baş verdi", "", "error");
											</script>
											<?
										}
									}
									?></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul> 
									<div class="clearfix"></div>
								</div>
								<div 
								<?php
								if ($_GET['p']=='contact-info')
									{ ?>
										style="display:block;"
									<?php }
									else {?>
										style="display: none;"
									<?php } ?>
									class="x_content">

									<form action="process/contact-info-process.php" method="post" class="form-horizontal form-label-left" novalidate>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Telefon</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="tel"  value="<?php echo $showparameter['parametr_tel']; ?>" id="tel" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Telefon (GSM)
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" value="<?php echo $showparameter['parametr_gsm']; ?>" name="gsm" id="gsm" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Faks
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="fax" value="<?php echo $showparameter['parametr_fax']; ?>" id="fax"  required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-poçt
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="email" value="<?php echo $showparameter['parametr_mail']; ?>" id="mail"  required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Address
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="address" value="<?php echo $showparameter['parametr_address']; ?>" id="address"  required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<input type="hidden" name="id" value="<?php echo $showparameter['parametr_id']; ?>">
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-6 col-md-offset-3" align="right">
												<button id="send" type="submit" name="infoyenile" class="btn btn-success">Yenilə</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						<!-- 
							Api Paramatrləri 
						-->
						<div class="x_panel">
							<div class="x_title">
								<h2>Api parametrləri
									<?php
									if (isset($_GET['apires'])) {
										if ($_GET['apires']=='ok') { ?>
											<script type="text/javascript">
												swal("Dəyişiklik qeyd edildi", "", "success");
											</script>
											<?
										}
										else{ ?>
											<script type="text/javascript">
												swal("Səhv baş verdi", "", "error");
											</script>
											<?
										}
									}
									?></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div 
								<?php
								if ($_GET['p']=='api')
									{ ?>
										style="display:block;"
									<?php }
									else {?>
										style="display: none;"
									<?php } ?>
									class="x_content">

									<form action="process/api-param-process.php" method="post" class="form-horizontal form-label-left" novalidate>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Xəritə</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="maps"  value="<?php echo $showparameter['parametr_maps']; ?>" id="maps" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Analystic
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" value="<?php echo $showparameter['parametr_analystic']; ?>" name="analystic" id="analystic" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Zopim
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="zopim" value="<?php echo $showparameter['parametr_zopim']; ?>" id="zopim"  required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<input type="hidden" name="id" value="<?php echo $showparameter['parametr_id']; ?>">
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-6 col-md-offset-3" align="right">
												<button id="send" type="submit" name="apiyenile" class="btn btn-success">Yenilə</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						<!--
							Mail parametrləri
						-->
						<div class="x_panel">
							<div class="x_title">
								<h2>Mail parametrləri
									<?php
									if (isset($_GET['mailres'])) {
										if ($_GET['mailres']=='ok') { ?>
											<script type="text/javascript">
												swal("Dəyişiklik qeyd edildi", "", "success");
											</script>
											<?
										}
										else{ ?>
											<script type="text/javascript">
												swal("Səhv baş verdi", "", "error");
											</script>	
											<?
										}
									}
									?></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div 
								<?php
								if ($_GET['p']=='mail')
									{ ?>
										style="display:block;"
									<?php }
									else {?>
										style="display: none;"
									<?php } ?>
									class="x_content">

									<form action="process/mail-param-process.php" method="post" class="form-horizontal form-label-left" novalidate>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Smtp host</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="host"  value="<?php echo $showparameter['parametr_smtphost']; ?>" id="host" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Smtp user</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="user"  value="<?php echo $showparameter['parametr_smtpuser']; ?>" id="user" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Smtp password
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" value="<?php echo $showparameter['parametr_smtppass']; ?>" name="pass" id="pass" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Smtp port
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="port" value="<?php echo $showparameter['parametr_smtpport']; ?>" id="port"  required="required" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<input type="hidden" name="id" value="<?php echo $showparameter['parametr_id']; ?>">
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-6 col-md-offset-3" align="right">
												<button id="send" type="submit" name="mailyenile" class="btn btn-success">Yenilə</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include'footer.php';
			?>