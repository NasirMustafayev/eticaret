<?php
require_once'header.php';

$bankquery=$db->prepare("SELECT * FROM bank order by bank_id ASC");
$bankquery->execute();

if ($showuser['user_authorization']<3) {
	
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
						<h2><i class="fa fa-bank"></i> Bank hesabları
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
								<button type="button" class="btn btn-round btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i>Əlavə et</button></ul>
								
								<!-------------------------------------------MODAL --------------------------------------->

								<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">

											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
												</button>
												<h4 class="modal-title" id="myModalLabel">Bir bank hesabı əlavə edin</h4>
											</div>
											<div class="modal-body">
												<form action="process/bank-process.php?p=1" method="post" class="form-horizontal form-label-left" novalidate>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank adı</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="name" placeholder="Bank adını daxil edin" id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" required="required" >
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">IBAN(International Bank Account Number)
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="iban" placeholder="IBAN nömrəsi daxil edin" id="row"  required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12" for="row">Hesab adı
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input type="text" name="account" placeholder="Hesab adı daxil edin" id="row"  required="required" class="form-control col-md-7 col-xs-12">
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Status
														</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<select class="form-control" name="status" required>
																<option value="1" <?php echo $showbank['bank_status'] == '1' ? 'selected=""' : '';?>>Aktiv</option>
																<option value="0" <?php echo $showbank['bank_status'] == '0' ? 'selected=""' : '';?>>Passiv</option>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Ləğv et</button>
													<button id="send" type="submit" name="insertbank" class="btn btn-success">Əlavə et</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!---------------------------------------------MODAL END--------------------------------------------->

								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="width: 15px"></th>
											<th>Bank adı</th>
											<th>İban</th>
											<th>Hesab adı</th>
											<th style="width: 50px">Status</th>
											<th style="width: 50px"></th>
											<th style="width: 20px"></th>
										</tr>
									</thead>
									<tbody>

										<?php
										$row=0;
										while ($showbank=$bankquery->fetch(PDO::FETCH_ASSOC))
										{
											$row++;
											?>
											<tr>
												<td><?php echo $row; ?></td>
												<td><?php echo $showbank['bank_name']; ?></td>
												<td><?php echo $showbank['bank_iban']; ?></td>
												<td><?php echo $showbank['bank_account']; ?></td>

												<td>
													<center>
														<?php
														if ($showbank['bank_status']==1) {
															?>
															<a href="process/bank-process?p=3&id=<?php echo $showbank['bank_id'] ?>&status=0">
																<button class="btn btn-success btn-xs">Aktiv</button></a>
																<?php
															}
															else{
																?>
																<a href="process/bank-process?p=3&id=<?php echo $showbank['bank_id'] ?>&status=1">
																	<button class="btn btn-danger btn-xs">Passiv</button></a>
																	<?php
																}
																?>
															</center>
														</td>

														<td><center><a href="edit-bank.php?id=<?php echo $showbank['bank_id']; ?>"><button class="btn btn-primary btn-xs">Düzəliş et</button></a></center></td>
														<td><center><a href="process/delete-process.php?del=bank&id=<?php echo $showbank['bank_id'];?>"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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