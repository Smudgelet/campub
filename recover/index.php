<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
logged_in_redirect();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

echo '<h1>Recover ' . $_GET['mode'] . '</h1>';
if (isset($_GET['success']) === TRUE && empty($_GET['success']) === TRUE) {
	echo 'Thanks, we\'ve emailed you';
}else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === TRUE && in_array($_GET['mode'], $mode_allowed) ===TRUE) {
		if(isset($_POST['email']) === TRUE && empty($_POST['email']) === FALSE) {
			if (email_exists($_POST['email']) === TRUE)  {
				recover($_GET['mode'], $_POST['email']);
				header('Location: /recover?success');
				exit();
			} else {
				echo '<p>Oops, we couldn\'t find that email address.</p>';
			}
		}
	?>
	<form action="" method="post">
		<ul>
			<li>
				Please enter your email address:<br>
				<input type="text" name="email" placeholder="email">
			</li>
			<li><input type="submit" value="Recover"></li>
		</ul>
	</form>
	<?php
	}else {
		header('Location: /');
		exit();
	}
}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");