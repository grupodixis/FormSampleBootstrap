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
header("Content-type: text/xml; charset=UTF-8"); 
$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." WHERE id='".$_REQUEST["cid"]."'";
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
$CALENDAR = mysql_fetch_assoc($sql_result);
$OPTIONS = unserialize($CALENDAR["options"]);
?>
<calendar>
	<settings>
		<monthColor>0x<?php echo $OPTIONS["monthColor"]; ?></monthColor>
		<monthText>0x<?php echo $OPTIONS["monthText"]; ?></monthText>
		<dayBackground>0x<?php echo $OPTIONS["dayBackground"]; ?></dayBackground>
		<dayColor>0x<?php echo $OPTIONS["dayColor"]; ?></dayColor>
		<dayNumbers>0x<?php echo $OPTIONS["dayNumbers"]; ?></dayNumbers>
		<dayComment>0x<?php echo $OPTIONS["dayComment"]; ?></dayComment>
		<dayNoComment>0x<?php echo $OPTIONS["dayNoComment"]; ?></dayNoComment>
		<arrowCircle>0x<?php echo $OPTIONS["arrowCircle"]; ?></arrowCircle>
		<arrowColor>0x<?php echo $OPTIONS["arrowColor"]; ?></arrowColor>
		<fontused><?php echo $OPTIONS["font"]; ?></fontused>
    <dayNames startMonday="<?php echo $OPTIONS["startMonday"]; ?>">
			<name long="Sunday"><?php  echo stripslashes(($OPTIONS["Sunday"])); ?></name>
			<name long="Monday"><?php  echo stripslashes(($OPTIONS["Monday"])); ?></name>
			<name long="Tuesday"><?php echo stripslashes(($OPTIONS["Tuesday"])); ?></name>
			<name long="Wendesday"><?php echo stripslashes(($OPTIONS["Wendesday"])); ?></name>
			<name long="Thursday"><?php echo stripslashes(($OPTIONS["Thursday"])); ?></name>
			<name long="Friday"><?php   echo stripslashes(($OPTIONS["Friday"])); ?></name>
			<name long="Saturday"><?php echo stripslashes(($OPTIONS["Saturday"])); ?></name>
		</dayNames>
		<monthNames>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Jan"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Feb"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Mar"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Apr"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["May"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Jun"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Jul"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Aug"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Sep"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Oct"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Nov"])); ?></name>
			<name><?php echo stripslashes(str_replace('"','&quot;',$OPTIONS["Dec"])); ?></name>
		</monthNames>
	</settings>
<?php
	$dMonth = $_REQUEST["month"];
	$dYear  = $_REQUEST["year"];
	if ($dMonth<10) $dMonth = '0'.$dMonth;
	$bDate = $dYear . "-" . $dMonth . "-" . "01"; 
	$eDate = $dYear . "-" . $dMonth . "-" . "31";
	$sql = "SELECT * FROM ".$TABLES["EVENTS"]." 
          WHERE dt between '$bDate' AND '$eDate' 
          AND calendar_id='".$_REQUEST["cid"]."' 
          ORDER BY dt";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		if ($row["description"]<>'') {
			list($yy, $mm, $dd) = split("-",$row["dt"]);
			if ($dd[0]=="0") $dd=$dd[1];
			echo "\t\t\t".'<day day="'.$dd.'">'.nl2br(stripslashes(utf8_decode($row["description"]))).'</day>'."\n";
		};
	};
	echo "\t\t\t".'<day day="99">finish</day>'."\n";
?>

</calendar>
