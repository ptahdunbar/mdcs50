<?php require_once 'header.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contact
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">

	            <?php if ( isset($_POST['contact']) ) : ?>

					<?php if ( $contact_form_submitted ) : ?>
		            <div id="success">
			            <div class="alert alert-success">
				            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Your message has been sent!</strong>
			            </div>
		            </div>
		            <?php endif; ?>

		            <?php if ( ! empty($contact_form_error_msg) ) : ?>
			            <div id="success">
				            <div class="alert alert-danger">
					            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					            Your message was not sent. Please fix the following errors:
					            <ul>
						            <?php foreach ($contact_form_error_msg as $error_msg) : ?>
							            <li><strong><?= $error_msg; ?></strong></li>
						            <?php endforeach; ?>
					            </ul>
				            </div>
			            </div>
		            <?php endif; ?>

	            <?php endif; ?>

                <h3>Send us a Message</h3>

	            <form method="POST">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" name="contact[name]" value="<?= $name; ?>" placeholder="Enter your name please...">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" name="contact[phone]" value="<?= $phone; ?>" placeholder="(555) 555-5555">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" name="contact[email]" value="<?= $email; ?>" placeholder="johndoe@smith.net">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>How likely are you going to take CS50 again?</label>
	                        <input id="skill" type="range" min="1" max="1000" value="1000" value="<?= $rating; ?>" name="contact[rating]">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea placeholder="What do you think about this website?" name="contact[message]" rows="10" cols="100" class="form-control" id="message" maxlength="999" style="resize:none"><?= $message; ?></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

            </div>

	        <!-- Contact Details Column -->
	        <div class="col-md-4">
		        <h3>Contact Details</h3>
		        <p>
			        3481 Melrose Place<br>Beverly Hills, CA 90210<br>
		        </p>
		        <p><i class="fa fa-phone"></i>
			        <abbr title="Phone">P</abbr>: (123) 456-7890</p>
		        <p><i class="fa fa-envelope-o"></i>
			        <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
		        </p>
		        <p><i class="fa fa-clock-o"></i>
			        <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
		        <ul class="list-unstyled list-inline list-social-icons">
			        <li>
				        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
			        </li>
			        <li>
				        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
			        </li>
			        <li>
				        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
			        </li>
			        <li>
				        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
			        </li>
		        </ul>
	        </div>
        </div>
        <!-- /.row -->

<?php require_once 'footer.php'; ?>