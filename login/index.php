<?php 
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
logged_in_redirect();
if(empty($_POST) === FALSE) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) === TRUE || empty($password) === TRUE) {
		$errors[] = 'You need to enter a username and password';
	} else if (user_exists($username) === FALSE) {
		$errors[] = 'We can\'t find that username, have you registered?';
	} else if (user_active($username) === FALSE) {
		$errors[] = 'You haven\'t activated your account';
	} else {
		
		if(strlen($password) > 32) {
			$errors[] = 'Password too long';
		}
		
		$login = login($username, $password);
		if($login === FALSE) {
			$errors[] = 'That username/password is incorrect';
		} else {
			$_SESSION['user_id'] = $login;
            header('Location: /');
            exit();
		}
	}
} else {
	header('Location: /');
}

include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
if (empty($errors) === FALSE) {
?>
<h2>We tried to log you in but... </h2>
<?php	
	echo output_errors($errors);
}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");