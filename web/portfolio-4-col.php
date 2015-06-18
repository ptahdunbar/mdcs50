<?php require_once 'header.php'; ?>

	<!-- Page Content -->
	<div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $website_settings['page_title']; ?>
                    <small><?= $website_settings['page_description']; ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><?= $website_settings['page_title']; ?></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
	        <?php

	        foreach ( $portfolio_collection as $portfolio_item ) {
		        ?>
		        <div class="<?= $portfolio_item['container_class']; ?>">
			        <a href="<?= $portfolio_item['img_link']; ?>">
				        <img class="<?= $portfolio_item['img_class']; ?>" src="<?= $portfolio_item['img_link']; ?>" alt="">
			        </a>
		        </div>
	            <?php
	        }

	        ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

<?php require_once 'footer.php'; ?>