<?php
function email($to, $subject, $body) {
	mail($to, $subject, $body, 'FROM: Cambridge Pub Database<hello@campub.co.uk>');
}
function logged_in_redirect() {
	if (logged_in() === TRUE) {
		header('Location: /');
		exit();
	}
}
function protect_page() {
	if (logged_in() === FALSE) {
		header('Location: /protected');
		exit();
	}
}
function admin_protect() {
	global $user_data;
	if(has_access($user_data[user_id], 1) === FALSE) {
		header('Location: /');
		exit();
	}
}
function array_sanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}
function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
function output_errors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}