<div id="aside">
	<?php 
	if(logged_in() === TRUE) {
        include("$_SERVER[DOCUMENT_ROOT]/includes/widgets/loggedin.php");
	} else {
		include("$_SERVER[DOCUMENT_ROOT]/includes/widgets/login.php");
	}
	include("$_SERVER[DOCUMENT_ROOT]/includes/widgets/user_count.php");
	?>
</div>