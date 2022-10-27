<?php
require_once'header.php';

$orderquery=$db->prepare("SELECT * FROM orders order by order_time ASC");
$orderquery->execute();

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
						<h2><i class="fa fa-ellipsis-v"></i> Sifarişlər
							<?php
							if (isset($_GET['res'])) {
								if ($_GET['res']=='ok') { ?>
									<small style="color: green"><b>Dəyişiklik qeyd edildi</b></small>
									<?
								}
								else{ ?>
									<small style="color: red"><b>Səhv baş verdi!</b></small>
									<?
								}
							}
							?></h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="width: 15px"></th>
										<th>Sifariş no</th>
										<th>Sifariş tarixi</th>
										<th>Məbləğ</th>
										<th>Ödəmə tipi</th>
										<th>Bank</th>
										<th style="width: 50px;text-align: center">Status</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$row=0;
									while ($showorder=$orderquery->fetch(PDO::FETCH_ASSOC))
									{
										$row++;
										?>
										<tr>
											<td><?php echo $row; ?></td>
											<td><?php echo $showorder['order_id']; ?></td>
											<td><?php echo $showorder['order_time']; ?></td>
											<td><?php echo $showorder['order_total']; ?></td>
											<td><?php echo $showorder['order_type']; ?></td>
											<td><?php echo $showorder['order_bank']; ?></td>
											<td>
												<center>
													<?php
													if ($showorder['order_status']==1) {
														?>
														<button class="btn btn-success btn-xs">Tamamlandı</button>
														<?php
													}
													else{
														?>
														<a href="process/order-process?p=1&id=<?php echo $showorder['order_id'] ?>">
															<button class="btn btn-danger btn-xs">Tamamla</button></a>
															<?php
														}
														?>
													</center>
												</td>
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