<?php
require_once'header.php';

$userquery=$db->prepare("SELECT * FROM users");
$userquery->execute();
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
						<h2><i class="fa fa-user"></i> İstifadəçilər
							<?php
							if (isset($_GET['res'])) {
								if ($_GET['res']=='ok') { ?>
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
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Settings 1</a>
										</li>
										<li><a href="#">Settings 2</a>
										</li>
									</ul>
								</li>
								<li><a class="close-link"><i class="fa fa-close"></i></a>
								</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Ad</th>
										<th>Soyad</th>
										<th>Email adresi</th>
										<th>Ünvan</th>
										<th>Telefon</th>
										<th>Qeydiyyat tarixi</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>

									<?php while ($showuser=$userquery->fetch(PDO::FETCH_ASSOC))
									{
										?>
										<tr>
											<td><?php echo $showuser['user_name']; ?></td>
											<td><?php echo $showuser['user_lastname']; ?></td>
											<td><?php echo $showuser['user_mail']; ?></td>
											<td><?php echo $showuser['user_address']; ?></td>
											<td><?php echo $showuser['user_gsm']; ?></td>
											<td><?php echo $showuser['user_time']; ?></td>
											<td><a href="edit-user.php?id=<?php echo $showuser['user_id']; ?>"><button class="btn btn-primary btn-xs">Düzəliş et</button></a></td>
											<td><a href="process/delete-process.php?del=user&id=<?php echo $showuser['user_id'];?>"><button class="btn btn-danger btn-xs">Sil</button></a></td>
										</tr>
										<?php 
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include'footer.php';
	?>