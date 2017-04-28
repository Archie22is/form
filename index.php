<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Form</title>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<?php include_once 'config.php' ?>
		<form id="contact-form" method="post" action="form/send.php" enctype="multipart/form-data">
			<fieldset>
				<label>Name</label>
				<input type="text" name="name" class="name" placeholder="Your full name" />
			</fieldset>
			<fieldset>
				<label>Email</label>
				<input type="email" name="email" class="email" placeholder="you@yourmail.com" />
			</fieldset>
			<fieldset>
				<label>Message</label>
				<textarea name="message" class="message" placeholder="Enter your message"></textarea>
			</fieldset>
			<fieldset>
				<label>File Upload</label>
				<input type="file" name="uploaded_file" id="uploaded_file" />
			</fieldset>
			<fieldset>
				<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site_key; ?>"></div>
			</fieldset>
			<button type="submit">Send</button>
		</form>
	</body>
</html>
