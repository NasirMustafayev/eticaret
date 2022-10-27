<?php
$sliderquery=$db->prepare("SELECT * FROM sliders where slider_status=:status order by slider_row ASC");
$sliderquery->execute(array('status' => 1));
?>
<div class="container">
	<div class="main-slide">
		<div id="sync1" class="owl-carousel">

			<?php 
			while ($showslider=$sliderquery->fetch(PDO::FETCH_ASSOC)) {
				?>
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1><?php echo $showslider['slider_name']; ?></h1>
							<p>
								Nunc non fermentum nunc. Sed ut ante eget leo tempor consequat sit amet eu orci. Donec dignissim dolor eget..
							</p>
						</div>
					</div>
					<div class="slide-type-1">
						<a href="<?php echo $showslider['slider_link'] ?>"><img src="<?php echo $showslider['slider_img'] ?>" alt="" class="img-responsive"></a>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>