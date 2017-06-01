<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
logged_in_redirect();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

if (empty($_POST)=== FALSE){
	$required_fields = array('username', 'password', 'password_again', 'forename', 'surname', 'email');
	foreach ($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === TRUE) {
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	
	if(empty($errors) ===TRUE) {
		if ((new DateTime($_POST['d_of_b']))->diff(new DateTime)->y < 18) {
		//if($_POST[d_of_b] > date("Y-m-d", strtotime("-18 Years"))) {
			$errors[] = 'Sorry, you\'re not old enough to use this site yet, please come back when you\'re 18.';
		}
		if(user_exists($_POST[username]) === TRUE) {
			$errors[] = 'Sorry, the username \'' . $_POST[username] . '\' is already taken.';
		}
		if(preg_match("/\\s/", $_POST[username]) == TRUE) {
			$errors[] = 'Your username must not contain any spaces';
		}
		if(strlen($_POST[password]) < 8) {
			$errors[] = 'Your password must be at least 8 characters';
		}
		if($_POST[password] !== $_POST[password_again]) {
			$errors[] = 'Your passwords do not match';
		}
		if(filter_var($_POST[email], FILTER_VALIDATE_EMAIL) === FALSE) {
			$errors[] = 'A valid email address is required';
		}
		if (email_exists($_POST[email]) === TRUE) {
			$errors[] = 'Sorry, the email \'' . $_POST[email] . '\' is already in use';
		}
	}
}

?>
<div id="content">
	<h1>Register</h1>
	
	<?php
	if(isset($_GET['success']) && empty($_GET['success'])) {
		echo 'you\'ve been registered sucessfully, please check your e-mail to activate your account.';
	}
	else{
		if(empty($_POST) === FALSE && empty($errors) === TRUE) {
			$register_data = array(
				'username' => $_POST['username'],
				'password' => $_POST['password'],
				'forename' => $_POST['forename'],
				'surname' => $_POST['surname'],
				'email' => $_POST['email'],
				'email_code' => md5($_POST['username'] + microtime()),
				'registered' => date('Y-m-d H:i:s'),
				'd_of_b' => $_POST['d_of_b'],
				'postcode' => $_POST['postcode'],
			);
			register_user($register_data);
			header('Location: /register?success');
			exit();
		}
		else if(empty ($errors) === FALSE) {
			echo output_errors($errors);
		}
	?>
	
	<form action="" method="post">
		<ul>
			<li>
				<label>Username*:</label><br>
				<input type="text" name="username" placeholder="Username">
			</li>
			<li>
				<label>Password*:</label><br>
				<input type="password" name="password" placeholder="Password">				
			</li>
			<li>
				<label>Password again*:</label><br>
				<input type="password" name="password_again" placeholder="Password">				
			</li>
			<li>
				<label>Forename*:</label><br>
				<input type="text" name="forename" placeholder="Forename">
			</li>
			<li>
				<label>Surname*:</label><br>
				<input type="text" name="surname" placeholder="Surname">
			</li>
			<li>
				<label>Date of Birth (yyyy/mm/dd):</label><br>
				<input type="date" name="d_of_b" placeholder="yyyy/mm/dd">
			</li>
			<li>
				<label>Postcode:</label><br>
				<input type="text" name="postcode" placeholder="Postcode">
			</li>
			<li>
				<label>Email*:</label><br>
				<input type="text" name="email" placeholder="E-mail">
			</li>
			<li>
				<input type="submit" value="Register">
			</li>
		</ul>
	</form>
</div>
<?php 
	}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");