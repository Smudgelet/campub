<?php
//set array of letters (A to Z)
if (!isset($elements)) {
$alphas = range('A', 'Z');
$url =  'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

foreach ($alphas as $letter) {
	$elements[] = "<a href=$url?firstletter=$letter>$letter</a>";
}}
echo implode(', ', $elements);