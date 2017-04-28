<?php $error = $_GET['e']; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<h2>Message Not Sent</h2>
		<?php if ($error == '1') {
			echo '<p>You have not passed the "I\'m not a robot" test. Please go back and make sure you ticked the box.</p>';
		} else {
			echo '<p>We are very sorry but something seems to have gone wrong. Please try again. or contact us at chrissonia@tiscali.co.uk</p>';
		} ?>
	</body>
</html>
