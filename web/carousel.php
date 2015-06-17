<?php require_once 'bootstrap.php'; ?>
<?php $carousel = getCarousel(getCurrentPage()); ?>
<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php $carousel_length = count($carousel) - 1;  ?>
		<?php for ($index = $carousel_length ; $index >= 0; $index--) : ?>
			<li data-target="#myCarousel" data-slide-to="<?= $index; ?>" <?= ($index == $carousel_length) ? 'class="active"' : ''; ?>></li>
		<?php endfor; ?>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php for ( $index = $carousel_length ; $index >= 0; $index-- ) : ?>
			<div class="item<?= ($index == $carousel_length) ? ' active' : ''; ?>">
				<div class="fill" style="background-image:url('<?= $carousel[$index]['img_url'] ?>');"></div>
				<div class="carousel-caption">
					<h2><?= $carousel[$index]['caption'] ?></h2>
				</div>
			</div>
		<?php endfor; ?>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="icon-next"></span>
	</a>
</header>