<?php require_once 'bootstrap.php'; ?>
<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php for ($i = 0; $i < count($about_carousel); $i++ ) : ?>
			<li data-target="#myCarousel" data-slide-to="<?= $i; ?>" <?= ($i == 0) ? 'class="active"' : ''; ?>></li>
		<?php endfor; ?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item">
			<div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
			<div class="carousel-caption">
				<h2>Caption 2</h2>
			</div>
		</div>
		<div class="item">
			<div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
			<div class="carousel-caption">
				<h2>Caption 3</h2>
			</div>
		</div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="icon-next"></span>
	</a>
</header>