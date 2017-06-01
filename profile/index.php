<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

if(isset($_GET['username']) === TRUE && empty($_GET['username']) === FALSE) {
	$username = $_GET['username'];
	
	if(user_exists($username) === TRUE) {
	$user_id = user_id_from_username($username);
	
	$profile_data = user_data($user_id, 'forename', 'surname', 'email');
	
	echo '<h1>' . $profile_data['forename'] . '\'s Profile </h1>';
	echo '<p>' . $profile_data['email'] . '</p>';
	}else {
		echo 'Sorry, that user doesn\'t exist.';
	}
} else {
	header('Location: /');
	exit();
}

include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");