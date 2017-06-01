<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();
admin_protect();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
echo '<div id="content">';
	echo '<h1>Admin</h1>';
	echo '<p>Admin page</p>';
echo '</div>';
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");