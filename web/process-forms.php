<?php

$contact_form_submitted = false;
$contact_form_error_msg = [];

$name = '';
$phone = '';
$email = '';
$rating = '';
$message = '';


if ( ! empty($_POST) ) {

	if ( isset($_POST['contact']) ) {

		// Step 1: Validation
		$name = clean_input($_POST['contact']['name']);
		$phone = clean_input($_POST['contact']['phone']);
		$rating = (int) clean_input($_POST['contact']['rating']);
		$email = clean_input($_POST['contact']['email']);
		$message = clean_input($_POST['contact']['message']);


		// Step 2: Validation
		if ( empty($name) ) {
			$contact_form_error_msg[] = 'Please fill out your full name.';
		}

		if ( empty($phone) ) {
			$contact_form_error_msg[] = 'Phone number is required.';
		} else if ( strlen($phone) > 50 ) {
			$contact_form_error_msg[] = 'Phone number is too long.';
		}

		if ( ! $rating || $rating > 1000 ) {
			$contact_form_error_msg[] = 'Rating isn\'t valid.';
		}

		if ( empty($email) ) {
			$contact_form_error_msg[] = 'Email is missing.';
		}

		// Step 3: Submission
		if ( empty($contact_form_error_msg) ) {
			try {

				$sql = "INSERT INTO contact_form (name, phone, email, rating, message) VALUES(:name, :phone, :email, :rating, :message)";

				$db = $db->prepare($sql);
				$db->bindParam(':name', $name);
				$db->bindParam(':phone', $phone);
				$db->bindParam(':email', $email);
				$db->bindParam(':rating', $rating);
				$db->bindParam(':message', $message);

				$db->execute();

				// Success!
				$contact_form_submitted = true;

				// Alert the administrator
				$result = mail(
					$config['admin_email']
					, sprintf($config['contact_submission_subject'], $name)
					, wordwrap(sprintf(
						$config['contact_submission_message'],
						$name,
						$email,
						$phone,
						$rating,
						$message
					))
				);

				// Reset form
				$name = '';
				$phone = '';
				$email = '';
				$rating = '';
				$message = '';

			} catch (PDOException $e) {
				$contact_form_error_msg[] = $e->getMessage();
			}
		}
	}
}