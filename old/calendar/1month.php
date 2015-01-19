<?php
/*
#4.0.0 2009 02 09
# 
#################################################################################################
## Copright (c) 2008 - PHPjabbers.com - webmasters tools and help http://www.phpjabbers.com/   ##
## Not for resale                   										                   ##
## info@phpjabbers.com                                                                		   ##
#################################################################################################
##        Custom Web Development - Dynamic Content - Website scripts                           ##
##                          www.phpjabbers.com                                                 ##
#################################################################################################
## This code is protected by international copyright.                                          ##
## DO NOT POST or distribute portions of code on any site / forum etc.                         ##
#################################################################################################
#
# */
error_reporting(0);
include("options.php");

$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." WHERE id='".$_REQUEST["cid"]."'";
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
$CALENDAR = mysql_fetch_assoc($sql_result);
$OPTIONS = unserialize($CALENDAR["options"]);
$height = ceil($OPTIONS["width"] * 5 / 6);

?>
<html>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" />
<param name="quality" value="high" />
<embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</body>
</html>