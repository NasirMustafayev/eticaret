<?php
$categoryquery=$db->prepare("SELECT * FROM categories where category_status=:status order by category_row ASC");
$categoryquery->execute(array('status'=>1));

$adsquery=$db->prepare("SELECT * FROM ads where ads_id=:id and ads_status=:status");
$adsquery->execute(array('id'=> 0,'status'=>1));
$showads=$adsquery->fetch(PDO::FETCH_ASSOC);
?>
<div class="col-md-3"><!--sidebar-->
	<div class="title-bg">
		<div class="title">Kateqoriyalar</div>
	</div>

	<div class="categorybox">
		
		<ul>
			
			<?php 

			$allsubcategorynum = $categoryquery->rowCount();
			$showcategory = $categoryquery->fetchAll(); 
			$subcategorynum = 0;

			for ($i = 0; $i < $allsubcategorynum; $i++) {
				if ($showcategory[$i]['category_top'] == "0") {
					$subcategorynum++;
				}
			}

			for ($i = 0; $i < $allsubcategorynum; $i++) {
				if ($showcategory[$i]['category_top'] == "0") {
					category($showcategory[$i]['category_id'], $showcategory[$i]['category_name'], $showcategory[$i]['category_top']);}
				}

				function category($category_id, $category_name, $category_top) {
					global $showcategory;
					global $allsubcategorynum;

					$subcategorynum = 0;
					for ($i = 0; $i < $allsubcategorynum; $i++) {
						if ($showcategory[$i]['category_top'] == $category_id) {
							$subcategorynum++;
						}
					}?>
					<li>

						<a href="category-<?=seo($category_name) ?>"><?php echo $category_name ?></a>
						<?php 
						if ($subcategorynum > 0) {
							echo "( $subcategorynum )";
						}
						?>
						</a>
					<?php

					if ($subcategorynum > 0) {
						
						for ($i = 0; $i < $allsubcategorynum; $i++) {

							if ($showcategory[$i]['category_top'] == $category_id)
							{
								category($showcategory[$i]['category_id'], $showcategory[$i]['category_name'], $showcategory[$i]['category_top']);
							}
						}
					}
					?>
				</li> 
				<?php 
			}
			?>
		</ul>
	</div>
	<?php
	if ($showads['ads_status']!=1) {
	}
	else{
		?>
		<div class="ads" style="background: white">
			<a href="process/adsclick?id=0"><img src="<?php echo $showads['ads_img']; ?>" class="img-responsive" alt="<?php echo $showads['ads_name']; ?>"><br>
				<?php echo $showads['ads_name']; ?></a>
			</div>
		<?php } ?>
	</div>
</div>