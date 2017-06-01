<?php
session_start();
error_reporting(-1);
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
?>
<div id="content">
    <h3>Cambridge Pub Map</h3>
    <?php
    include("$_SERVER[DOCUMENT_ROOT]/includes/map.php");
    ?>
</div>
<?php
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");