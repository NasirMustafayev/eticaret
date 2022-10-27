<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
			_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
			$.src="<?php echo $show['parametr_zopim']; ?>";z.t=+new Date;$.
			type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		</script>
		<!--End of Zendesk Chat Script-->
		<div class="f-widget"><!--footer Widget-->
			<div class="container">
				<div class="row">
					<div class="col-md-6"><!--footer newsletter widget-->
						<div class="title-widget-bg">
							<div class="title-widget">Yeniliklərdən xəbərdar olun</div>
						</div>
						<div class="newsletter">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
							</p>
							<form role="form">
								<div class="form-group">
									<label>Email addressiniz</label>
									<input type="email" class="form-control newstler-input" id="exampleInputEmail1" placeholder="Email daxil edin">
									<button class="btn btn-default btn-red btn-sm">Abunə ol</button>
								</div>
							</form>
						</div>
					</div><!--footer newsletter widget-->
					<div class="col-md-6"><!--footer contact widget-->
						<div class="title-widget-bg">
							<div class="title-widget">Əlaqə</div>
						</div>
						<ul class="contact-widget">
							<li class="fphone"><?php echo $show['parametr_tel']; ?> <br><?php echo $show['parametr_fax']; ?></li>
							<li class="fmobile"><?php echo $show['parametr_gsm']; ?></li>
							<li class="fmail lastone"><?php echo $show['parametr_mail']; ?></li>
						</ul>
					</div><!--footer contact widget-->
				</div>
				<div class="spacer"></div>
			</div>
		</div><!--footer Widget-->
		<div class="footer"><!--footer-->
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<ul class="footermenu"><!--footer nav-->
							<li><a href="index">Ana səhifə</a></li>
							<li><a href="cart">Səbətim</a></li>
							<li><a href="checkout">Ödəmə</a></li>
							<li><a href="orders">Sifarişlərim</a></li>
							<li><a href="contact">Əlaqə</a></li>
						</ul><!--footer nav-->
						<div class="f-credit">&copy;All rights reserved by <a href="/eticaret"><?php echo $show['parametr_author']; ?></a></div>
						<a href=""><div class="payment visa"></div></a>
						<a href=""><div class="payment paypal"></div></a>
						<a href=""><div class="payment mc"></div></a>
						<a href=""><div class="payment nh"></div></a>
					</div>
					<div class="col-md-3"><!--footer Share-->
						<div class="followon">Follow us on</div>
						<div class="fsoc">
							<a href="http://twitter.com/minimalthemes" class="ftwitter">twitter</a>
							<a href="http://www.facebook.com/pages/Minimal-Themes/264056723661265" class="ffacebook">facebook</a>
							<a href="#" class="fflickr">flickr</a>
							<a href="#" class="ffeed">feed</a>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!--footer Share-->
				</div>
			</div>
		</div><!--footer-->


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="bootstrap\js\bootstrap.min.js"></script>

		<!-- map -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
		<script type="text/javascript" src="js\jquery.ui.map.js"></script>
		<script type="text/javascript" src="js\demo.js"></script>

		<!-- owl carousel -->
		<script src="js\owl.carousel.min.js"></script>

		<!-- rating -->
		<script src="js\rate\jquery.raty.js"></script>
		<script src="js\labs.js" type="text/javascript"></script>

		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="js\product\lib\jquery.mousewheel-3.0.6.pack.js"></script>

		<!-- fancybox -->
		<script type="text/javascript" src="js\product\jquery.fancybox.js?v=2.1.5"></script>

		<!-- custom js -->
		<script src="js\shop.js"></script>

		<!--Sweetalert-->
		<script src="js\sweetalert.min.js"></script>
	</div>
</body>
</html>
