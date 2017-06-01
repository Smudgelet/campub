<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();

if (empty($_POST)=== FALSE){
	$required_fields = array('current_password', 'password', 'password_again');
	foreach ($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === TRUE) {
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	if(md5($_POST['current_password']) === $user_data['password']){
	//if(password_verify($_POST['current_password'], $user_data['password'])){
		if(strlen($_POST[password]) < 6) {
			$errors[] = 'Your password must be at least 6 characters';
		}
		if($_POST[password] !== $_POST[password_again]) {
			$errors[] = 'Your new passwords do not match';
		}
	} else {
		$errors[] = 'Your current password is incorrect';
	}
}
	
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
?>
<div id="content">
	<h1>Change Password</h1>
	
	<?php
	if(isset($_GET['success']) == TRUE && empty($_GET['success']) == TRUE) {
		echo 'your password has been successfully changed.';
	}
	else{
		if (isset($_GET['force']) == TRUE && empty($_GET['force']) == TRUE) {
			echo '<p> You must change your password because you carried out a password recovery.</p>';
		}
		if (empty($_POST) === FALSE && empty($errors) === TRUE) {
			change_password($session_user_id, $_POST['password']);
			header('Location: /changepassword?success');
			exit();
		}
		else if(empty ($errors) === FALSE) {
			echo output_errors($errors);
		}
	?>
	
	
	<form action="" method="post">
		<ul>
			<li>
				Current Password*<br>
				<input type="password" name="current_password">
			</li>
			<li>
				New password*<br>
				<input type="password" name="password">
			</li>
			<li>
				New password again*<br>
				<input type="password" name="password_again">
			</li>
			<li>
				<input type="submit" value="Change password">
			</li>
		</ul>
	</form>
	
	
</div>
<?php
	}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");