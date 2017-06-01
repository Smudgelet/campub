<?php

include "core/database/connect.php";
$db=connect();
    
	function parseToXML($htmlStr)
	{
		$xmlStr=str_replace('<','&lt;',$htmlStr);
		$xmlStr=str_replace('>','&gt;',$xmlStr);
		$xmlStr=str_replace('"','&quot;',$xmlStr);
		$xmlStr=str_replace("'",'&#39;',$xmlStr);
		$xmlStr=str_replace("&",'&amp;',$xmlStr);
		return $xmlStr;
	}

	// Select all the rows in the markers table
	$query = "SELECT * FROM pubs WHERE 1";
	$result = mysql_query($query);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	header("Content-type: text/xml");

	// Start XML file, echo parent node
	echo '<markers>';

	// Iterate through the rows, printing XML nodes for each
	while ($row = @mysql_fetch_assoc($result)){
        // Add to XML document node
        echo '<marker ';
        echo 'id="' . $row['id'] . '" ';
        echo 'name="' . parseToXML($row['PubName']) . '" ';
        echo 'address="' . parseToXML($row['BuildingStreet']) . ', ' . parseToXML($row['TownCity']) . ', ' . parseToXML($row['County']) . ', ' . parseToXML($row['Postcode']) . '" ';
        echo 'web="' . $row['Web'] . '" ';
        echo 'lat="' . $row['Lat'] . '" ';
        echo 'lng="' . $row['Long'] . '" ';
        echo 'type="' . $row['Type'] . '" ';
        echo '/>';
	}

	// End XML file
	echo '</markers>';
?>