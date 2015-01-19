<?php 
error_reporting(0);


$SETTINGS["useCookie"]=true;
//////////////////
//////////////////
//////////////////
////////////////// DO NOT CHANGE BELOW
//////////////////
//////////////////
$SETTINGS["version"] = '4.0';
$SETTINGS["scriptid"] = '4';


$TABLES["CALENDARS"] = 'availability_calendars';
$TABLES["EVENTS"] = 'availability_dates';

if ($install != '1') {
$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('request "Unable to connect to MySQL server."');
$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
};

$monthnames_arr = Array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$fonts_arr = Array("Arial", "Century", "Courier New", "Serif", "Tahoma", "Times New Roman", "Verdana");
?>
