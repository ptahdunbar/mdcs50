<?php require_once 'bootstrap.php'; ?>
<hr>

<!-- Footer -->
<footer>
	<div class="row">
		<div class="col-lg-12">
			<p><?= sprintf($website_settings['copyright'], date('Y')); ?></p>
		</div>
	</div>
</footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
	jQuery('.carousel').carousel({
		interval: 5000 //changes the speed
	})
</script>

</body>

</html>