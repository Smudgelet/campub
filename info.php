<?php
$stored_password = password_hash('password', PASSWORD_BCRYPT, array('cost' => 10));


if(password_verify('password', $stored_password)) {
	echo "You're in";
} else {
	echo "Try again!";
}
echo ("<br>" . $stored_password);