<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
logged_in_redirect();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

if(isset($_GET['success']) === TRUE && empty($_GET['success']) === TRUE) {
?>
	<h2>Thanks, We've activated your account...</h2>
	<p>You're free to log in!</p>
<?php
}
else if(isset($_GET['email'], $_GET['email_code']) === true) {
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	if(email_exists($email) ===FALSE) {
		$errors[] = 'Oops, something went wrong, we couldn\'t find that email address';
	} else if (activate($email, $email_code) === FALSE) {
		$errors[] = 'We had problems activating your account';
	}
	if (empty($errors) === FALSE) {
	?>
		<h2>Oops...</h2>
	<?php
	echo output_errors($errors);
	} else {
	header('Location: /activate?success');
	exit();
}
}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");