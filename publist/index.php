<?php
session_start();
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
protect_page();
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
?>
<div id="content">
    <?php
	$db=connect();
	$first = mysql_real_escape_string($_GET['firstletter']);
	$city = mysql_real_escape_string($_GET['city']);
    include("$_SERVER[DOCUMENT_ROOT]/includes/overall/lettersearch.php");
	$result = mysql_query("SELECT * FROM pubs WHERE PubName LIKE '$first%' ORDER BY PubName",$db);
	if ($result === FALSE) {
		die('no permissions');
	}
	echo "<TABLE>";
		echo"<TR><TD><B>Pub Name</B><TD><B>Address</B></TR>";
		while ($myrow = mysql_fetch_array($result)){
			echo "<TR><TD>";
			if (empty($myrow['Web'])) {
				echo $myrow["PubName"];
			}else {
				echo "<a href='".$myrow['Web']."' target=_blank>".$myrow['PubName']."</a>";
			}
			echo "<TD>";
			echo $myrow["BuildingStreet"] . "<br/>" . $myrow["TownCity"] . "<br/>" . $myrow["County"] . "<br/>" . $myrow["Postcode"];
		}
        echo "</TABLE>";
    include("$_SERVER[DOCUMENT_ROOT]/includes/overall/lettersearch.php");
    ?>
</div>
<?php
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");