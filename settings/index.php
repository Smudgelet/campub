<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

if(empty($_POST) === FALSE) {
	$required_fields = array('forename', 'surname', 'email');
	foreach ($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) === TRUE) {
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	
	if(empty($errors) === TRUE) {
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === FALSE) {
			$errors[] = 'A valid email address is required';
		} elseif(email_exists($_POST['email']) === TRUE && $user_data['email'] !== $_POST['email']) {
			$errors[] = 'sorry, the email\'' . $_POST['email'] . '\' is already in use';
		}
	}
}
?>
<div id="content">
    <h1>Settings</h1>

    <?php
    if(isset($_GET['success']) && empty($_GET['success'])) {
        echo 'your details have sucessfully been updated.';
    } else {
            if (empty($_POST) === FALSE && empty($errors) === TRUE) {

                    $update_data = array(
                            'forename' => $_POST['forename'],
                            'surname' => $_POST['surname'],
                            'email' => $_POST['email'],
                            'allow_email' => ($_POST['allow_email'] == 'on') ? 1 : 0,
                    );

                    update_user($session_user_id, $update_data);
                    header('Location: /settings?success');
                    exit();

            } else if (empty($errors) === FALSE) {
                    echo output_errors($errors);
            }
    ?>

    <form action="" method="post">
            <ul>
                    <li>
                            Forename*:<br>
                            <input type="text" name="forename" value="<?php echo $user_data['forename']; ?>">
                    </li>
                    <li>
                            Surname*:<br>
                            <input type="text" name="surname" value="<?php echo $user_data['surname']; ?>">
                    </li>
                    <li>
                            Email*:<br>
                            <input type="text" name="email" value="<?php echo $user_data['email']; ?>">
                    </li>
                    <li>
                            <input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1) {echo'checked="checked"';}?>> Would you like to recieve email from us?
                    </li>
                    <li>
                            <input type="submit" value="Update">
                    </li>
            </ul>
    </form>

    <?php
    if(isset($_FILES['profile']) === TRUE) {
            if (empty($_FILES['profile']['name']) === TRUE) {
                    echo 'Please choose a file';
            } else {
                    $allowed = array('jpg', 'jpeg', 'gif', 'png');
                    $file_name = $_FILES['profile']['name'];
                    $file_extn = strtolower(end((explode('.', $file_name))));
                    $file_temp = $_FILES['profile']['tmp_name'];
                    $file_size = $_FILES['profile']['size'];
                    $maxsize = 2097152;
                    $errors = array();

                    if ($file_size >= $maxsize) {
                            $errors[] = 'File too large, profile pictures must be less than 2 megabytes.';
                    }
                    if (!in_array($file_extn, $allowed)) {
                            $errors[] = 'Incorrect file type, only ' . implode(', ', $allowed) . ' types are accepted';
                    }
            }
            if(count($errors) === 0) {
                    change_profile_image($session_user_id, $file_temp, $file_extn);	
                    header('Location: /' . $current_file);
            } else if(empty ($errors) === FALSE) {
                            echo output_errors($errors);
            }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="profile">
            <input type="submit" value="Submit">
    </form>
</div>
<?php
}
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");