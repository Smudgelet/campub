<?php
session_start();
error_reporting();

include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");

?>
<div id="content">
	<h1>Sorry you need to be logged in to do that!</h1>
	<p>Please register or log in.</p>
</div>
<?php 
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");