<?php
session_start();
ob_start();

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
end($current_file);
$current_file = prev($current_file);

if(logged_in() === TRUE) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'forename', 'surname', 'email', 'password_recover', 'type', 'allow_email', 'profile');
	
	if (user_active($user_data['username']) === FALSE) {
		session_destroy();
		header('location: /');
		exit();
	}
	if ($current_file !== 'changepassword' && $current_file !== 'logout' && $user_data['password_recover'] == 1) {
		header('Location: /changepassword?force');
		exit();
	}
}
$errors = array();