<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();
admin_protect();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
?>
<div id="content">
	<h1>Email all users</h1>
	
	<?php
	if(isset($_GET['success']) === TRUE && empty($_GET['success']) === TRUE) {
	?>
	<p>Email has been sent</p>
	<?php
	} else {
		if (empty($_POST) === FALSE) {
			if (empty($_POST['subject']) === TRUE) {
				$errors[] = 'Subject is required';
			}
			if (empty($_POST['body']) === TRUE) {
				$errors[] = 'Body is required';
			}
			if(empty($errors) === FALSE) {
				echo output_errors($errors);
			} else {
				mail_users($_POST['subject'], $_POST['body']);
				header('Location: /mail?success');
				exit();
			}
		}
		?>

		<form action="" method="post">
			<ul>
				<li>
					Subject*:<br>
					<input type="text" name="subject">
				</li>
				<li>
					Body*:<br>
					<textarea name="body"></textarea>
				</li>
				<li>
					<input type="submit" value="Send">
				</li>
			</ul>
		</form>
	</div>
<?php
	}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");