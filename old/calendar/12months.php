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

if (!isset($_REQUEST["year"])) {
	$_REQUEST["year"] = date("Y");
};

$nextYear = $_REQUEST["year"] + 1;
$prevYear = $_REQUEST["year"] - 1;

$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." WHERE id='".$_REQUEST["cid"]."'";
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
$CALENDAR = mysql_fetch_assoc($sql_result);
$OPTIONS = unserialize($CALENDAR["options"]);
$height = ceil($OPTIONS["width"] * 5 / 6);

?>
<html>
<head>
<style>
TD  {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	
};
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="middle"><a href="12months.php?year=<?php echo $prevYear; ?>&cid=<?php echo $_REQUEST["cid"]; ?>">Previous Year</a></td>
    <td align="center" valign="middle"><?php echo $_REQUEST["year"]; ?></td>
    <td align="center" valign="middle"><a href="12months.php?year=<?php echo $nextYear; ?>&cid=<?php echo $_REQUEST["cid"]; ?>">Next Year</a></td>
  </tr>
  <tr>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=0";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
          <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
        </object>
    </td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=1";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		  </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=2";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		  </embed>
      </object></td>
  </tr>
  <tr>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=3";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" /><embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		  </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=4";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" /><embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=5";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" /><embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
  </tr>
  <tr>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=6";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=7";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=8";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
  </tr>
  <tr>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=9";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=10";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
          </embed>
      </object></td>
    <td align="center" valign="top"><?php $open = "&openyear=".$_REQUEST["year"]."&openmonth=11";
?>
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
          <param name="allowScriptAccess" value="sameDomain" />
          <param name="movie" value="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
          <param name="quality" value="high" />
		  <embed src="http://<?php echo $SETTINGS["installURL"]; ?>calendar1.swf?phpURL=<?php echo $SETTINGS["installURL"]; ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
          </embed>
      </object></td>
  </tr>
</table>
</body>
</html>