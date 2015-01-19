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
session_start();
include("options.php");

if(isset($_REQUEST["ac"])) {
  if ($_REQUEST["ac"]=='logout') {
		if( $SETTINGS["useCookie"] == false ){
			$_SESSION["AvailabilityCalendar"] = "";
			unset($_SESSION["AvailabilityCalendar"]);
		}
		else{
			setCookie("AvailabilityCalendar", "", 0);
			$_COOKIE["AvailabilityCalendar"] = "";
		}
 } elseif ($_REQUEST["ac"]=='login') {
  	if ($_REQUEST["user"] == $SETTINGS["admin_username"] and $_REQUEST["pass"] == $SETTINGS["admin_password"]) {
  	$md_sum=md5($SETTINGS["admin_username"].$SETTINGS["admin_password"]);
		$sess_id=$md_sum.strtotime("+1 hour");
		if( $SETTINGS["useCookie"] == false )
			$_SESSION["AvailabilityCalendar"] = $sess_id;
		else{
			setCookie("AvailabilityCalendar", $sess_id, time()+3600);
			$_COOKIE["AvailabilityCalendar"] = $sess_id;
		}
 		$_REQUEST["ac"]='calendars';
	} else {
		$message = '<strong style="color:#FF0000; font-family:Verdana, Geneva, sans-serif; font-size:12px;">Incorrect login details.</strong><br /><br />';
	};
  };
};  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Availability Calendar - Administration</title>

<script language="javascript" >
function highlightrow(id,columns) {
	for (i=1; i<=columns; i++) {
		document.getElementById("c"+i+"-"+id).style.backgroundColor = '#ececec';
	};
};

function outhighlightrow(id,columns) {
	for (i=1; i<=columns; i++) {
		document.getElementById("c"+i+"-"+id).style.backgroundColor = '';
	};
};

function getAnchorPosition(anchorname){var useWindow=false;var coordinates=new Object();var x=0,y=0;var use_gebi=false, use_css=false, use_layers=false;if(document.getElementById){use_gebi=true;}else if(document.all){use_css=true;}else if(document.layers){use_layers=true;}if(use_gebi && document.all){x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_gebi){var o=document.getElementById(anchorname);x=AnchorPosition_getPageOffsetLeft(o);y=AnchorPosition_getPageOffsetTop(o);}else if(use_css){x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_layers){var found=0;for(var i=0;i<document.anchors.length;i++){if(document.anchors[i].name==anchorname){found=1;break;}}if(found==0){coordinates.x=0;coordinates.y=0;return coordinates;}x=document.anchors[i].x;y=document.anchors[i].y;}else{coordinates.x=0;coordinates.y=0;return coordinates;}coordinates.x=x;coordinates.y=y;return coordinates;}
function getAnchorWindowPosition(anchorname){var coordinates=getAnchorPosition(anchorname);var x=0;var y=0;if(document.getElementById){if(isNaN(window.screenX)){x=coordinates.x-document.body.scrollLeft+window.screenLeft;y=coordinates.y-document.body.scrollTop+window.screenTop;}else{x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;}}else if(document.all){x=coordinates.x-document.body.scrollLeft+window.screenLeft;y=coordinates.y-document.body.scrollTop+window.screenTop;}else if(document.layers){x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;}coordinates.x=x;coordinates.y=y;return coordinates;}
function AnchorPosition_getPageOffsetLeft(el){var ol=el.offsetLeft;while((el=el.offsetParent) != null){ol += el.offsetLeft;}return ol;}
function AnchorPosition_getWindowOffsetLeft(el){return AnchorPosition_getPageOffsetLeft(el)-document.body.scrollLeft;}
function AnchorPosition_getPageOffsetTop(el){var ot=el.offsetTop;while((el=el.offsetParent) != null){ot += el.offsetTop;}return ot;}
function AnchorPosition_getWindowOffsetTop(el){return AnchorPosition_getPageOffsetTop(el)-document.body.scrollTop;}
function PopupWindow_getXYPosition(anchorname){var coordinates;if(this.type == "WINDOW"){coordinates = getAnchorWindowPosition(anchorname);}else{coordinates = getAnchorPosition(anchorname);}this.x = coordinates.x;this.y = coordinates.y;}
function PopupWindow_setSize(width,height){this.width = width;this.height = height;}
function PopupWindow_populate(contents){this.contents = contents;this.populated = false;}
function PopupWindow_setUrl(url){this.url = url;}
function PopupWindow_setWindowProperties(props){this.windowProperties = props;}
function PopupWindow_refresh(){if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).innerHTML = this.contents;}else if(this.use_css){document.all[this.divName].innerHTML = this.contents;}else if(this.use_layers){var d = document.layers[this.divName];d.document.open();d.document.writeln(this.contents);d.document.close();}}else{if(this.popupWindow != null && !this.popupWindow.closed){if(this.url!=""){this.popupWindow.location.href=this.url;}else{this.popupWindow.document.open();this.popupWindow.document.writeln(this.contents);this.popupWindow.document.close();}this.popupWindow.focus();}}}
function PopupWindow_showPopup(anchorname){this.getXYPosition(anchorname);this.x += this.offsetX;this.y += this.offsetY;if(!this.populated &&(this.contents != "")){this.populated = true;this.refresh();}if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).style.left = this.x + "px";document.getElementById(this.divName).style.top = this.y;document.getElementById(this.divName).style.visibility = "visible";}else if(this.use_css){document.all[this.divName].style.left = this.x;document.all[this.divName].style.top = this.y;document.all[this.divName].style.visibility = "visible";}else if(this.use_layers){document.layers[this.divName].left = this.x;document.layers[this.divName].top = this.y;document.layers[this.divName].visibility = "visible";}}else{if(this.popupWindow == null || this.popupWindow.closed){if(this.x<0){this.x=0;}if(this.y<0){this.y=0;}if(screen && screen.availHeight){if((this.y + this.height) > screen.availHeight){this.y = screen.availHeight - this.height;}}if(screen && screen.availWidth){if((this.x + this.width) > screen.availWidth){this.x = screen.availWidth - this.width;}}var avoidAboutBlank = window.opera ||( document.layers && !navigator.mimeTypes['*']) || navigator.vendor == 'KDE' ||( document.childNodes && !document.all && !navigator.taintEnabled);this.popupWindow = window.open(avoidAboutBlank?"":"about:blank","window_"+anchorname,this.windowProperties+",width="+this.width+",height="+this.height+",screenX="+this.x+",left="+this.x+",screenY="+this.y+",top="+this.y+"");}this.refresh();}}
function PopupWindow_hidePopup(){if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).style.visibility = "hidden";}else if(this.use_css){document.all[this.divName].style.visibility = "hidden";}else if(this.use_layers){document.layers[this.divName].visibility = "hidden";}}else{if(this.popupWindow && !this.popupWindow.closed){this.popupWindow.close();this.popupWindow = null;}}}
function PopupWindow_isClicked(e){if(this.divName != null){if(this.use_layers){var clickX = e.pageX;var clickY = e.pageY;var t = document.layers[this.divName];if((clickX > t.left) &&(clickX < t.left+t.clip.width) &&(clickY > t.top) &&(clickY < t.top+t.clip.height)){return true;}else{return false;}}else if(document.all){var t = window.event.srcElement;while(t.parentElement != null){if(t.id==this.divName){return true;}t = t.parentElement;}return false;}else if(this.use_gebi && e){var t = e.originalTarget;while(t.parentNode != null){if(t.id==this.divName){return true;}t = t.parentNode;}return false;}return false;}return false;}
function PopupWindow_hideIfNotClicked(e){if(this.autoHideEnabled && !this.isClicked(e)){this.hidePopup();}}
function PopupWindow_autoHide(){this.autoHideEnabled = true;}
function PopupWindow_hidePopupWindows(e){for(var i=0;i<popupWindowObjects.length;i++){if(popupWindowObjects[i] != null){var p = popupWindowObjects[i];p.hideIfNotClicked(e);}}}
function PopupWindow_attachListener(){if(document.layers){document.captureEvents(Event.MOUSEUP);}window.popupWindowOldEventListener = document.onmouseup;if(window.popupWindowOldEventListener != null){document.onmouseup = new Function("window.popupWindowOldEventListener();PopupWindow_hidePopupWindows();");}else{document.onmouseup = PopupWindow_hidePopupWindows;}}
function PopupWindow(){if(!window.popupWindowIndex){window.popupWindowIndex = 0;}if(!window.popupWindowObjects){window.popupWindowObjects = new Array();}if(!window.listenerAttached){window.listenerAttached = true;PopupWindow_attachListener();}this.index = popupWindowIndex++;popupWindowObjects[this.index] = this;this.divName = null;this.popupWindow = null;this.width=0;this.height=0;this.populated = false;this.visible = false;this.autoHideEnabled = false;this.contents = "";this.url="";this.windowProperties="toolbar=no,location=no,status=no,menubar=no,scrollbars=auto,resizable,alwaysRaised,dependent,titlebar=no";if(arguments.length>0){this.type="DIV";this.divName = arguments[0];}else{this.type="WINDOW";}this.use_gebi = false;this.use_css = false;this.use_layers = false;if(document.getElementById){this.use_gebi = true;}else if(document.all){this.use_css = true;}else if(document.layers){this.use_layers = true;}else{this.type = "WINDOW";}this.offsetX = 0;this.offsetY = 0;this.getXYPosition = PopupWindow_getXYPosition;this.populate = PopupWindow_populate;this.setUrl = PopupWindow_setUrl;this.setWindowProperties = PopupWindow_setWindowProperties;this.refresh = PopupWindow_refresh;this.showPopup = PopupWindow_showPopup;this.hidePopup = PopupWindow_hidePopup;this.setSize = PopupWindow_setSize;this.isClicked = PopupWindow_isClicked;this.autoHide = PopupWindow_autoHide;this.hideIfNotClicked = PopupWindow_hideIfNotClicked;}
ColorPicker_targetInput = null;
function ColorPicker_writeDiv(){document.writeln("<DIV ID=\"colorPickerDiv\" STYLE=\"position:absolute;visibility:hidden;\"> </DIV>");}
function ColorPicker_show(anchorname){this.showPopup(anchorname);}
function ColorPicker_pickColor(color,obj){obj.hidePopup();pickColor(color);}
function pickColor(color){if(ColorPicker_targetInput==null){alert("Target Input is null, which means you either didn't use the 'select' function or you have no defined your own 'pickColor' function to handle the picked color!");return;}ColorPicker_targetInput.value = color;}
function ColorPicker_select(inputobj,linkname){if(inputobj.type!="text" && inputobj.type!="hidden" && inputobj.type!="textarea"){alert("colorpicker.select: Input object passed is not a valid form input object");window.ColorPicker_targetInput=null;return;}window.ColorPicker_targetInput = inputobj;this.show(linkname);}
function ColorPicker_highlightColor(c){var thedoc =(arguments.length>1)?arguments[1]:window.document;var d = thedoc.getElementById("colorPickerSelectedColor");d.style.backgroundColor = c;d = thedoc.getElementById("colorPickerSelectedColorValue");d.innerHTML = c;}
function ColorPicker(){var windowMode = false;if(arguments.length==0){var divname = "colorPickerDiv";}else if(arguments[0] == "window"){var divname = '';windowMode = true;}else{var divname = arguments[0];}if(divname != ""){var cp = new PopupWindow(divname);}else{var cp = new PopupWindow();cp.setSize(225,250);}cp.currentValue = "#FFFFFF";cp.writeDiv = ColorPicker_writeDiv;cp.highlightColor = ColorPicker_highlightColor;cp.show = ColorPicker_show;cp.select = ColorPicker_select;var colors = new Array("#000000","#000033","#000066","#000099","#0000CC","#0000FF","#330000","#330033","#330066","#330099","#3300CC",
"#3300FF","#660000","#660033","#660066","#660099","#6600CC","#6600FF","#990000","#990033","#990066","#990099",
"#9900CC","#9900FF","#CC0000","#CC0033","#CC0066","#CC0099","#CC00CC","#CC00FF","#FF0000","#FF0033","#FF0066",
"#FF0099","#FF00CC","#FF00FF","#003300","#003333","#003366","#003399","#0033CC","#0033FF","#333300","#333333",
"#333366","#333399","#3333CC","#3333FF","#663300","#663333","#663366","#663399","#6633CC","#6633FF","#993300",
"#993333","#993366","#993399","#9933CC","#9933FF","#CC3300","#CC3333","#CC3366","#CC3399","#CC33CC","#CC33FF",
"#FF3300","#FF3333","#FF3366","#FF3399","#FF33CC","#FF33FF","#006600","#006633","#006666","#006699","#0066CC",
"#0066FF","#336600","#336633","#336666","#336699","#3366CC","#3366FF","#666600","#666633","#666666","#666699",
"#6666CC","#6666FF","#996600","#996633","#996666","#996699","#9966CC","#9966FF","#CC6600","#CC6633","#CC6666",
"#CC6699","#CC66CC","#CC66FF","#FF6600","#FF6633","#FF6666","#FF6699","#FF66CC","#FF66FF","#009900","#009933",
"#009966","#009999","#0099CC","#0099FF","#339900","#339933","#339966","#339999","#3399CC","#3399FF","#669900",
"#669933","#669966","#669999","#6699CC","#6699FF","#999900","#999933","#999966","#999999","#9999CC","#9999FF",
"#CC9900","#CC9933","#CC9966","#CC9999","#CC99CC","#CC99FF","#FF9900","#FF9933","#FF9966","#FF9999","#FF99CC",
"#FF99FF","#00CC00","#00CC33","#00CC66","#00CC99","#00CCCC","#00CCFF","#33CC00","#33CC33","#33CC66","#33CC99",
"#33CCCC","#33CCFF","#66CC00","#66CC33","#66CC66","#66CC99","#66CCCC","#66CCFF","#99CC00","#99CC33","#99CC66",
"#99CC99","#99CCCC","#99CCFF","#CCCC00","#CCCC33","#CCCC66","#CCCC99","#CCCCCC","#CCCCFF","#FFCC00","#FFCC33",
"#FFCC66","#FFCC99","#FFCCCC","#FFCCFF","#00FF00","#00FF33","#00FF66","#00FF99","#00FFCC","#00FFFF","#33FF00",
"#33FF33","#33FF66","#33FF99","#33FFCC","#33FFFF","#66FF00","#66FF33","#66FF66","#66FF99","#66FFCC","#66FFFF",
"#99FF00","#99FF33","#99FF66","#99FF99","#99FFCC","#99FFFF","#CCFF00","#CCFF33","#CCFF66","#CCFF99","#CCFFCC",
"#CCFFFF","#FFFF00","#FFFF33","#FFFF66","#FFFF99","#FFFFCC","#FFFFFF");var total = colors.length;var width = 18;var cp_contents = "";var windowRef =(windowMode)?"window.opener.":"";if(windowMode){cp_contents += "<HTML><HEAD><TITLE>Select Color</TITLE></HEAD>";cp_contents += "<BODY MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 TOPMARGIN=0><CENTER>";}cp_contents += "<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=0>";var use_highlight =(document.getElementById || document.all)?true:false;for(var i=0;i<total;i++){if((i % width) == 0){cp_contents += "<TR>";}if(use_highlight){var mo = 'onMouseOver="'+windowRef+'ColorPicker_highlightColor(\''+colors[i]+'\',window.document)"';}else{mo = "";}cp_contents += '<TD BGCOLOR="'+colors[i]+'"><FONT SIZE="-3"><A HREF="#" onClick="'+windowRef+'ColorPicker_pickColor(\''+colors[i]+'\','+windowRef+'window.popupWindowObjects['+cp.index+']);return false;" '+mo+' STYLE="text-decoration:none;">&nbsp;&nbsp;&nbsp;</A></FONT></TD>';if( ((i+1)>=total) ||(((i+1) % width) == 0)){cp_contents += "</TR>";}}if(document.getElementById){var width1 = Math.floor(width/2);var width2 = width = width1;cp_contents += "<TR><TD COLSPAN='"+width1+"' BGCOLOR='#ffffff' ID='colorPickerSelectedColor'>&nbsp;</TD><TD COLSPAN='"+width2+"' ALIGN='CENTER' ID='colorPickerSelectedColorValue'>#FFFFFF</TD></TR>";}cp_contents += "</TABLE>";if(windowMode){cp_contents += "</CENTER></BODY></HTML>";}cp.populate(cp_contents+"\n");cp.offsetY = 25;cp.autoHide();return cp;}
var cp = new ColorPicker('window'); 

function CheckNewCalendarName(){
	var calendarname, dataRight = true;
	message = "";
	calendarname = document.frm.name.value;
	if (calendarname.length==0){
		message += "\n -  Calendar title is empty !";
		dataRight=false;
	}
	if (!dataRight){
	   alert(message);
	}
	return dataRight;
}

</script>

<STYLE type="text/css">
 BODY {
	margin:0px;	
}
TD {
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
}
a.topMenu:link {
	font-family:Verdana, Geneva, sans-serif;
	font-size:18px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
}     /* unvisited link */
a.topMenu:visited {
	font-family:Verdana, Geneva, sans-serif;
	font-size:18px;
	color:#FFFFFF;
	font-weight:bold;
	text-decoration:none;
}  /* visited link */
a.topMenu:hover {
	font-family:Verdana, Geneva, sans-serif;
	font-size:18px;
	color:#ffcc03;
	font-weight:bold;
	text-decoration:underline;
} 
a.topMenu:active {
	font-family:Verdana, Geneva, sans-serif;
	font-size:18px;
	color:#ffcc03;
	font-weight:bold;
}



a.subMenu:link {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#616161;
	font-weight:bold;
	text-decoration:none;
}     /* unvisited link */
a.subMenu:visited {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#616161;
	font-weight:bold;
	text-decoration:none;
}  /* visited link */
a.subMenu:hover {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#616161;
	font-weight:bold;
	text-decoration:underline;
} 
a.subMenu:active {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
	color:#616161;
	font-weight:bold;
}


a:link {
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	color:#3a30ff;
	font-weight:bold;
	text-decoration:underline;
}     /* unvisited link */
a:visited {
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	color:#3a30ff;
	font-weight:bold;
	text-decoration:underline;
}  /* visited link */
a:hover {
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	color:#ffcc03;
	font-weight:bold;
	text-decoration:underline;
} 
a:active {
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	color:#616161;
	font-weight:bold;
}
</STYLE>
</head>

<body>
<center>
<div style="width:981px">
  <h1>Calendar control mananger</h1>
</div>
<div style="width:100%; background-color:#242424; height:8px; font-size:1px">&nbsp;</div>
<?php
$isLogged = false;
if ( $SETTINGS["useCookie"] == false ){
	if (isset($_SESSION["AvailabilityCalendar"])) $temp_sid=$_SESSION["AvailabilityCalendar"];
}
else{
	if (isset($_COOKIE["AvailabilityCalendar"])) $temp_sid=$_COOKIE["AvailabilityCalendar"];
}

$md_sum=md5($SETTINGS["admin_username"].$SETTINGS["admin_password"]);
	$md_res=substr($temp_sid,0,strlen($md_sum));
	if (strcmp($md_sum,$md_res)==0) {
		$ts=substr($temp_sid,strlen($md_sum));
		if ($ts>time()) {
      $isLogged = true;
      $md_sum=md5($SETTINGS["admin_username"].$SETTINGS["admin_password"]);
  		$sess_id=$md_sum.strtotime("+1 hour");
  		if( $SETTINGS["useCookie"] == false )
  			$_SESSION["AvailabilityCalendar"] = $sess_id;
  		else{
  			setCookie("AvailabilityCalendar", $sess_id, time()+3600);
  			$_COOKIE["AvailabilityCalendar"] = $sess_id;
  		}
    }
	}

if ( $isLogged ){
	if ($_REQUEST["ac"]=='save_settings') {
		$options["font"]    = $_REQUEST["font"];
	    $options["monthColor"]    = str_replace("#","",$_REQUEST["monthColor"]);
		$options["monthText"]     = str_replace("#","",$_REQUEST["monthText"]);
		$options["dayBackground"] = str_replace("#","",$_REQUEST["dayBackground"]);
		$options["dayColor"]      = str_replace("#","",$_REQUEST["dayColor"]);
		$options["dayNumbers"]    = str_replace("#","",$_REQUEST["dayNumbers"]);
		$options["dayComment"]    = str_replace("#","",$_REQUEST["dayComment"]);
		$options["dayNoComment"]  = str_replace("#","",$_REQUEST["dayNoComment"]);
		$options["arrowCircle"]   = str_replace("#","",$_REQUEST["arrowCircle"]);
		$options["arrowColor"]    = str_replace("#","",$_REQUEST["arrowColor"]);
		$options["Sunday"]    = utf8_encode($_REQUEST["Sunday"]);
		$options["Monday"]    = utf8_encode($_REQUEST["Monday"]);
		$options["Tuesday"]   = utf8_encode($_REQUEST["Tuesday"]);
		$options["Wendesday"] = utf8_encode($_REQUEST["Wendesday"]);
		$options["Thursday"]  = utf8_encode($_REQUEST["Thursday"]);
		$options["Friday"]    = utf8_encode($_REQUEST["Friday"]);
		$options["Saturday"]  = utf8_encode($_REQUEST["Saturday"]);
		$options["Jan"] = utf8_encode($_REQUEST["Jan"]);
		$options["Feb"] = utf8_encode($_REQUEST["Feb"]);
		$options["Mar"] = utf8_encode($_REQUEST["Mar"]);
		$options["Apr"] = utf8_encode($_REQUEST["Apr"]);
		$options["May"] = utf8_encode($_REQUEST["May"]);
		$options["Jun"] = utf8_encode($_REQUEST["Jun"]);
		$options["Jul"] = utf8_encode($_REQUEST["Jul"]);
		$options["Aug"] = utf8_encode($_REQUEST["Aug"]);
		$options["Sep"] = utf8_encode($_REQUEST["Sep"]);
		$options["Oct"] = utf8_encode($_REQUEST["Oct"]);
		$options["Nov"] = utf8_encode($_REQUEST["Nov"]);
		$options["Dec"] = utf8_encode($_REQUEST["Dec"]);
		$options["startMonday"] = $_REQUEST["startMonday"];
		$options["width"] = $_REQUEST["width"];
	
		$options = serialize($options);
		$sql = "UPDATE ".$TABLES["CALENDARS"]." SET options='".mysql_escape_string($options)."' WHERE id='".$_REQUEST["cid"]."'";
		$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		$_REQUEST["ac"]='settings'; 
	    $message = '<strong style="color:#FF0000">Calendar options saved.</strong><br>';

} elseif ($_REQUEST["ac"]=='booked' OR $_REQUEST["ac"]=='morning' OR $_REQUEST["ac"]=='afternoon') {

	  $day   = $_REQUEST["day"];
	  $month = $_REQUEST["month"];
	  $year  = $_REQUEST["year"];
	  $fromDate = mktime(0,0,0,$month,$day,$year);
  
	  $day_to   = $_REQUEST["day_to"];
	  $month_to = $_REQUEST["month_to"];
	  $year_to  = $_REQUEST["year_to"];
	  $toDate   = mktime(0,0,0,$month_to,$day_to,$year_to);

	if($fromDate <= $toDate) {
		$from = date("Y-m-d", $fromDate);
		$to   = date("Y-m-d", $toDate);
		$current = '';
		$i=0;
		while ($current<>$to) {
			$current = date("Y-m-d",mktime(0, 0, 0, $month, $day+$i, $year));
			$i++;
			$sql = "DELETE FROM ".$TABLES["EVENTS"]." 
					WHERE dt = '". $current ."' 
					AND calendar_id='".$_REQUEST["cid"]."'";
			$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
			$sql = "INSERT INTO ".$TABLES["EVENTS"]." 
					SET id = null, 
						calendar_id =" . $_REQUEST["cid"] . ",
						dt = '" . $current . "',
						description = '" . $_REQUEST["ac"] . "'";
			$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		}
		$message = '<strong style="color:#FF0000">Availability set.</strong><br>';
	} else $message = '<strong style="color:#FF0000">Incorrect date range.</strong><br>';
	$_REQUEST["ac"]='events'; 
	
} elseif ($_REQUEST["ac"]=='available') {
	  $day   = $_REQUEST["day"];
	  $month = $_REQUEST["month"];
	  $year  = $_REQUEST["year"];
	  $fromDate = mktime(0,0,0,$month,$day,$year);
  
	  $day_to   = $_REQUEST["day_to"];
	  $month_to = $_REQUEST["month_to"];
	  $year_to  = $_REQUEST["year_to"];
	  $toDate   = mktime(0,0,0,$month_to,$day_to,$year_to);

	if($fromDate <= $toDate) {
		$from = date("Y-m-d", $fromDate);
		$to   = date("Y-m-d", $toDate);
		$sql = "DELETE FROM ".$TABLES["EVENTS"]." 
				WHERE dt between '". $from ."' and '".  $to ."'    
				AND calendar_id='".$_REQUEST["cid"]."'";
		$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		$message = '<strong style="color:#FF0000">Availability set.</strong><br>';
	} else 
		$message = '<strong style="color:#FF0000">Incorrect date range.</strong><br>';
	$_REQUEST["ac"]='events';	
} elseif ($_REQUEST["ac"]=='del') {
	$sql = "DELETE FROM ".$TABLES["CALENDARS"]." WHERE id='".$_REQUEST["cid"]."'";
   	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql." ".mysql_error($connection));
	$sql = "DELETE FROM ".$TABLES["EVENTS"]." WHERE calendar_id='".$_REQUEST["cid"]."'";
   	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql." ".mysql_error($connection));
 	$_REQUEST["ac"]='calendars'; $message = '<strong style="color:#FF0000">Calendar deleted.</strong><br>';

} elseif ($_REQUEST["ac"]=='add') {
	$sql = "INSERT INTO ".$TABLES["CALENDARS"]."
            SET id = null,
                name = '" . mysql_escape_string(utf8_encode($_REQUEST["name"])) . "', 
				options = '".
'a:31:{s:4:"font";s:5:"Arial";s:10:"monthColor";s:6:"000000";s:9:"monthText";s:6:"FFFFFF";s:13:"dayBackground";s:6:"999999";s:8:"dayColor";s:6:"FFFFFF";s:10:"dayNumbers";s:6:"FFFFFF";s:10:"dayComment";s:6:"CC0000";s:12:"dayNoComment";s:6:"669933";s:11:"arrowCircle";s:6:"FFFFFF";s:10:"arrowColor";s:6:"000000";s:6:"Sunday";s:1:"S";s:6:"Monday";s:1:"M";s:7:"Tuesday";s:1:"T";s:9:"Wendesday";s:1:"W";s:8:"Thursday";s:1:"T";s:6:"Friday";s:1:"F";s:8:"Saturday";s:1:"S";s:3:"Jan";s:7:"January";s:3:"Feb";s:8:"February";s:3:"Mar";s:5:"March";s:3:"Apr";s:5:"April";s:3:"May";s:3:"May";s:3:"Jun";s:4:"June";s:3:"Jul";s:4:"July";s:3:"Aug";s:6:"August";s:3:"Sep";s:9:"September";s:3:"Oct";s:7:"October";s:3:"Nov";s:8:"November";s:3:"Dec";s:8:"December";s:11:"startMonday";s:5:"false";s:5:"width";s:3:"300";}'."'";
		
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	$_REQUEST["ac"]='calendars'; 
	$message = '<strong style="color:#FF0000">Calendar added.</strong><br>';
};

if ($_REQUEST["ac"]=='' or !isset($_REQUEST["ac"]) )	$_REQUEST["ac"]='calendars';
?>
<table width="981" border="0" cellspacing="0" cellpadding="0">



  <tr>
    <td width="100%" height="49" style="background-image:url(images/menu-back.jpg); background-repeat:no-repeat"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" align="center"><a href="admin.php?ac=calendars" class="topMenu" <?php if (($_REQUEST["ac"]=='calendars')||($_REQUEST["ac"]=='events')||($_REQUEST["ac"]=='settings')||($_REQUEST["ac"]=='html')) echo 'style="color:#ffcc03"'; ?>>My Calendars</a></td>
        <td width="25%" align="center"><a href="admin.php?ac=new" class="topMenu" <?php if ($_REQUEST["ac"]=='new') echo 'style="color:#ffcc03"'; ?>> Create a Calendar </a></td>
        <td width="25%" align="center"><a href="admin.php?ac=search" class="topMenu" <?php if ($_REQUEST["ac"]=='search') echo 'style="color:#ffcc03"'; ?> > Availability Search</a></td>
        <td align="right" style="padding-right:10px"><a href="admin.php?ac=update" class="topMenu" style="font-size:12px<?php if ($_REQUEST["ac"]=='update') echo '; color:#ffcc03'; ?>"> UPDATE</a></td>
        <td width="10%" align="right" style="padding-right:10px"><a href="admin.php?ac=logout" class="topMenu" style="font-size:12px">LOGOUT</a></td>
      </tr>
    </table></td>
    </tr>

<?php
if ($_REQUEST["ac"]=='html' OR $_REQUEST["ac"]=='events' OR $_REQUEST["ac"]=='settings') {
	$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." WHERE id='".$_REQUEST["cid"]."'";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	$CALENDAR = mysql_fetch_assoc($sql_result);
	$OPTIONS = unserialize($CALENDAR["options"]);
?>


<tr>
    <td height="32" align="left" style="background-image:url(images/sub-menu-back.jpg); background-repeat:repeat-y; font-size:12px">
      
      <table border="0" cellspacing="0" cellpadding="0" width="100%">




  <tr>
    <td width="15%" height="30" align="center" ><a href="admin.php?ac=events&cid=<?php  echo $_REQUEST["cid"]; ?>" class="subMenu">
    <?php if ($_REQUEST["ac"]=='events') echo '<ins>'; ?>Availability
    <?php if ($_REQUEST["ac"]=='events') echo '</ins>'; ?></a></td>
    <td width="15%" align="center" ><a href="admin.php?ac=settings&cid=<?php  echo $_REQUEST["cid"]; ?>" class="subMenu">
    <?php if ($_REQUEST["ac"]=='settings') echo '<ins>'; ?>Options
    <?php if ($_REQUEST["ac"]=='settings') echo '</ins>'; ?>
    </a></td>
    <td width="15%" align="center"><a href="admin.php?ac=html&cid=<?php  echo $_REQUEST["cid"]; ?>" class="subMenu">
    <?php if ($_REQUEST["ac"]=='html') echo '<ins>'; ?>HTML code
    <?php if ($_REQUEST["ac"]=='html') echo '</ins>'; ?>
    </a></td>
    <td align="right"  class="subMenu">Preview calendar: <a href="1month.php?cid=<?php  echo $_REQUEST["cid"]; ?>" target="_blank">1 month</a> | <a href="12months.php?cid=<?php  echo $_REQUEST["cid"]; ?>" target="_blank">12 months</a>&nbsp; &nbsp;&nbsp;</td>
  </tr>
</table>


 </td>
    </tr>
      <?php }; ?>
  <tr>
    <td align="left" valign="top" style="background-image:url(images/main-middle.jpg); background-repeat:repeat-y; padding:20px">
	<?php  if(isset($message)) echo $message; ?>
	
<?php
if ($_REQUEST["ac"]=='calendars') {
?>
Below you can see all the availability calendars that you've created. You can create UNLIMITED amount of availability calendars - one for each item you rent - apartment, room, car, bike, etc...<br />
&bull; To create new availability calendar, click on the 'Create a Calendar' link at the top.<br />
 &bull; To find available date range among all calendars, click on the 'Availability Search' link at the top.<br />
 &bull; To manage calendar availability click on the 'Availability' link next to the  calendar.<br />
&bull; To edit availability calendar options click on 'Options' link next to the calendar.<br />
&bull; To put availability calendar on your web page click on the 'HTML code' link next to the calendar and follow the instructions.<br />
&bull; To delete availability calendar click on the 'DELETE' link next to the calendar.<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #CCCCCC" bgcolor="#FFFFFF">
  <tr>
    <td width="494" valign="top" bgcolor="#CCCCCC"><strong>Calendar Title</strong></td>
    <td bgcolor="#CCCCCC" colspan="5">&nbsp;</td>
  </tr>
  <?php
	$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." ORDER BY name ASC";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
    $rowCount = 1;
	while ($CALENDAR = mysql_fetch_assoc($sql_result)) {
?>
  <tr align="left">
    <td width="56%" style="border-bottom:1px solid #CCCCCC; cursor:pointer" id="c1-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,5)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,5)" onclick="window.location.href='admin.php?ac=events&cid=<?php echo $CALENDAR["id"]; ?>'"><?php echo stripslashes(utf8_decode($CALENDAR["name"])); ?></td>
    <td width="12%" align="center" style="border-bottom:1px solid #CCCCCC" id="c2-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,5)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,5)"><a href='admin.php?ac=events&cid=<?php echo $CALENDAR["id"]; ?>'><strong>Availability</strong></a></td>
    <td width="10%" align="center" style="border-bottom:1px solid #CCCCCC"id="c3-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,5)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,5)"><a href='admin.php?ac=settings&cid=<?php echo $CALENDAR["id"]; ?>'><strong>Options</strong></a></td>
    <td width="12%" align="center" style="border-bottom:1px solid #CCCCCC" id="c4-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,5)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,5)"><a href='admin.php?ac=html&cid=<?php echo $CALENDAR["id"]; ?>'><strong>HTML code</strong></a></td>
    <td width="10%" align="center" style="border-bottom:1px solid #CCCCCC" id="c5-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,5)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,5)"><a href='#' onclick='pass=confirm("Are you sure you want to delete it?",""); if (pass) window.location="admin.php?ac=del&cid=<?php echo $CALENDAR["id"]; ?>";'><strong style='color:red'>DELETE</strong></a></td>
  </tr>
  <?php
		  $rowCount++;
	};
?>
</table>
<?php
} elseif ($_REQUEST["ac"]=='search') {

	if (!isset($_REQUEST["year"]) OR !isset($_REQUEST["month"]) OR !isset($_REQUEST["day"])) {
		$_REQUEST["year"]  = date("Y");
		$_REQUEST["month"] = date("m");
		$_REQUEST["day"]   = date("d");	
	};
	if (!isset($_REQUEST["year_to"]) OR !isset($_REQUEST["month_to"]) OR !isset($_REQUEST["day_to"])) {
		$_REQUEST["year_to"]  = date("Y");
		$_REQUEST["month_to"] = date("m");
		$_REQUEST["day_to"]   = date("d");	
	};
?>
To find out availability status for all calendars please select dates from the drop down menus below  and click on Search button.<br /><br />
	<form action="admin.php" method="post" style="margin:0px; padding:0px" name="frm">
	<input type="hidden" name="ac" value="search" />
	<input type="hidden" name="do" value="find" />
	<table width="100%" border="0" cellspacing="4" cellpadding="5">
      <tr>
        <td bgcolor="#FFFFFF" style="border:1px solid #CCCCCC"><table border="0" cellpadding="5" cellspacing="0">
		<tr><td>From: </td><td>
          <select name="month"  id="month">
<?php
		  for ($i=1; $i<13; $i++) {
		  	if ($_REQUEST["month"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$monthnames_arr[$i].'</option>';
		  };
?>
          </select>
          <select name="day"  id="day">
		  <?php
		  for ($i=1; $i<32; $i++) {
		  	if ($_REQUEST["day"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
			</select>
          <select name="year"  id="year">
		  <?php
		  for ($i=2005; $i<2021; $i++) {
		  	if ($_REQUEST["year"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
          </select></td></tr>
		  <tr><td>
          To: </td><td>
          <select name="month_to"  id="month_to">
<?php
		  for ($i=1; $i<13; $i++) {
		  	if ($_REQUEST["month_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$monthnames_arr[$i].'</option>';
		  };
?>
          </select>
          <select name="day_to"  id="day_to">
		  <?php
		  for ($i=1; $i<32; $i++) {
		  	if ($_REQUEST["day_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
			</select>
          <select name="year_to"  id="year_to">
		  <?php
		  for ($i=2005; $i<2021; $i++) {
		  	if ($_REQUEST["year_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
          </select>	</td></tr></table>		  	  </td>
      </tr>
<?php
	$day   = $_REQUEST["day"];
	$month = $_REQUEST["month"];
	$year  = $_REQUEST["year"];
    $current = mktime(0,0,0,$month,$day,$year);

	$sql = "SELECT * FROM ".$TABLES["EVENTS"]." 
			WHERE dt = '". date("Y-m-d", $current) ."' 
			AND calendar_id='".$_REQUEST["cid"]."'";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	$data = mysql_fetch_assoc($sql_result);
	$open_month = $month - 1;
	$open = "&openyear=$year&openmonth=$open_month";
	
?>
      
      <tr>
        <td bgcolor="#FFFFFF"  style="border:1px solid #CCCCCC">
          <input type="submit" name="Submit4" value="Search" style="font-size:16px; cursor:pointer; font-weight:bold" /></td>
      </tr>
    </table>
	</form>
<br />
<?php
if ($_REQUEST["do"]=="find") {
	$FROM_check = mktime(0, 0, 0, $_REQUEST["month"], $_REQUEST["day"], $_REQUEST["year"]);
	$TO_check = mktime(0, 0, 0, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]);

	if ($FROM_check>$TO_check) {
?>
	<strong style="color:#FF0000">Invalid date range</strong>
<?php	
	} else {
?>
Click on any calendar below to change availability status.<br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #CCCCCC" bgcolor="#FFFFFF">
  <tr>
    <td width="552" valign="top" bgcolor="#CCCCCC"><strong>Calendar Title</strong></td>
    <td width="172" bgcolor="#CCCCCC"><strong>Status</strong></td>
  </tr>

<?php
		$sql = "SELECT * FROM ".$TABLES["CALENDARS"]." ORDER BY name ASC";
		$sql_resultC = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		$available_properties = '';
		$rowCount = 1;
		while ($CALENDAR = mysql_fetch_assoc($sql_resultC)) {

			$isBooked = false;
			if($FROM_check <= $TO_check) {
				$FROM = date("Y-n-d",$FROM_check);
				$TO = date("Y-n-d",$TO_check);
				$CURRENT = '';
				$i=0;
				while ($CURRENT<>$TO) {
					$CURRENT = date("Y-n-d",mktime(0, 0, 0, $_REQUEST["month"], $_REQUEST["day"]+$i, $_REQUEST["year"]));
					$i++;
					$sql = "SELECT * FROM ".$TABLES["EVENTS"]." WHERE dt='".$CURRENT."' AND calendar_id='".$CALENDAR["id"]."'";
					$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
					if (mysql_num_rows($sql_result)>0) {
						$isBooked = true;
					};
				};
			};
?>
			<tr>
			<td class="TableRow" style="border-bottom:1px solid #CCCCCC; cursor:pointer" id="c1-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,2)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,2)" onclick="window.location.href='admin.php?ac=events&cid=<?php echo $CALENDAR["id"]; ?>&year=<?php echo $_REQUEST["year"]; ?>&month=<?php echo $_REQUEST["month"]; ?>&day=<?php echo $_REQUEST["day"]; ?>&year_to=<?php echo $_REQUEST["year_to"]; ?>&month_to=<?php echo $_REQUEST["month_to"]; ?>&day_to=<?php echo $_REQUEST["day_to"]; ?>'"><?php echo stripslashes(utf8_decode($CALENDAR["name"])); ?></td>
			<td class="TableRow" style="border-bottom:1px solid #CCCCCC; cursor:pointer" id="c2-<?php echo $rowCount; ?>" onMouseOver="highlightrow(<?php echo $rowCount; ?>,2)" onMouseOut="outhighlightrow(<?php echo $rowCount; ?>,2)" onclick="window.location.href='admin.php?ac=events&cid=<?php echo $CALENDAR["id"]; ?>&year=<?php echo $_REQUEST["year"]; ?>&month=<?php echo $_REQUEST["month"]; ?>&day=<?php echo $_REQUEST["day"]; ?>&year_to=<?php echo $_REQUEST["year_to"]; ?>&month_to=<?php echo $_REQUEST["month_to"]; ?>&day_to=<?php echo $_REQUEST["day_to"]; ?>'">
			  <?php			
			if ($isBooked) { echo "booked"; } else { echo "available"; };
?>
			</td>
			</tr>
<?php		$rowCount++;
		};
?>
</table>
<?php	
	}; /// invalid date range
};
?>
<?php
} elseif ($_REQUEST["ac"]=='update') {
?>
Below you can see available script updates, current promotions and latest news.<br /><br />
<iframe width="90%" height="350" src="http://www.phpscripthelper.com/updates.php?script=<?php echo $SETTINGS["scriptid"]; ?>&version=<?php echo $SETTINGS["version"]; ?>" scrolling="auto" frameborder="0"></iframe>
<?php
} elseif ($_REQUEST["ac"]=='new') {
?>
<form action="admin.php" method="post" onSubmit="return CheckNewCalendarName();" name="frm">
<input type="hidden" name="ac" value="add" />
&nbsp;&nbsp;&nbsp;&nbsp; 
To create availability calendar enter its title so you can easily identify it among all calendars that you create and click on 'Create Calendar' button. To view all availability calendars click on the 'My Calendars' link at the top.<br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #CCCCCC" bgcolor="#FFFFFF">
  <tr>
    <td colspan="5" valign="top" bgcolor="#CCCCCC"><strong>New Calendar</strong></td>
  </tr>
  <tr>
     <td width="7%">Title:</td>
     <td width="93%"><input type="text" name="name" value="" size="50" maxlength="250" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" value="Create calendar" style="font-size:16px; cursor:pointer; font-weight:bold" /></td>
  </tr>
 </table>
</form>
<?php
} elseif ($_REQUEST["ac"]=='html') {
    $height = ceil($OPTIONS["width"] * 5 / 6);
?>
&nbsp;&nbsp;&nbsp;&nbsp;You can either put a single month calendar view on your web page or 12 months view. Select one of the HTML codes below and copy it. Open your web page using some web page editing software and paste the code where you want the availability calendar to appear on the page. Once you put this code on your web page, you can make changes to your availability calendar using the administration page but there is no need to update the HTML code. Please, note that you should NOT change the code below. In case you do so, it is quite possible that your availability calendar will not work properly.<br />
<br />
<strong>1 month calendar view</strong><br />
<textarea name="textarea" cols="120" rows="15" style="width:90%">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
<param name="allowScriptAccess" value="always" />
<param name="movie" value="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" />
<param name="quality" value="high" />
<embed src="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object></textarea>
<br />
<br /> 
<strong>12 months calendar view</strong><br />
<textarea cols="120" rows="4" style="width:90%">
<iframe src="http://<?php echo trim($SETTINGS["installURL"]); ?>12months.php?cid=<?php echo $_REQUEST["cid"]; ?>" width="600" height="650" style="border:none" frameborder="0"></iframe>
</textarea>

<?php	
} elseif ($_REQUEST["ac"]=='events') {
	if (!isset($_REQUEST["year"]) OR !isset($_REQUEST["month"]) OR !isset($_REQUEST["day"])) {
		$_REQUEST["year"]  = date("Y");
		$_REQUEST["month"] = date("m");
		$_REQUEST["day"]   = date("d");	
	};
	if (!isset($_REQUEST["year_to"]) OR !isset($_REQUEST["month_to"]) OR !isset($_REQUEST["day_to"])) {
		$_REQUEST["year_to"]  = date("Y");
		$_REQUEST["month_to"] = date("m");
		$_REQUEST["day_to"]   = date("d");	
	};
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="450" valign="top">
	<form action="admin.php" method="post" style="margin:0px; padding:0px" name="frm">
	<input type="hidden" name="ac" value="" />
    <input type="hidden" name="cid" value="<?php echo $_REQUEST["cid"]; ?>" />
	<table width="100%" border="0" cellspacing="4" cellpadding="5">
      <tr>
        <td bgcolor="#FFFFFF"  style="border:1px solid #CCCCCC">To change date availability select date range using the drop down menus below and click on the any of the 4 buttons. Booked - selected date range will be booked. Available - selected date range will be available. Morning - selected date range will be half-booked for the morning. Afternoon - selected date range will be half-booked for the afternoon. If you want to change the availability for a single date just select the same date for both From and To drop down menus. </td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border:1px solid #CCCCCC"><table border="0" cellpadding="5" cellspacing="0">
		<tr><td>From: </td><td>
          <select name="month"  id="month">
<?php
		  for ($i=1; $i<13; $i++) {
		  	if ($_REQUEST["month"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$monthnames_arr[$i].'</option>';
		  };
?>
          </select>
          <select name="day"  id="day">
		  <?php
		  for ($i=1; $i<32; $i++) {
		  	if ($_REQUEST["day"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
			</select>
          <select name="year"  id="year">
		  <?php
		  for ($i=2005; $i<2021; $i++) {
		  	if ($_REQUEST["year"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
          </select></td></tr>
		  <tr><td>
          To: </td><td>
          <select name="month_to"  id="month_to">
<?php
		  for ($i=1; $i<13; $i++) {
		  	if ($_REQUEST["month_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$monthnames_arr[$i].'</option>';
		  };
?>
          </select>
          <select name="day_to"  id="day_to">
		  <?php
		  for ($i=1; $i<32; $i++) {
		  	if ($_REQUEST["day_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
			</select>
          <select name="year_to"  id="year_to">
		  <?php
		  for ($i=2005; $i<2021; $i++) {
		  	if ($_REQUEST["year_to"]==$i) { $selected=' selected="selected"'; } else { $selected=''; };
		  	echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
		  };
		  ?>
          </select>	</td></tr></table>		  	  </td>
      </tr>
<?php
	$day   = $_REQUEST["day"];
	$month = $_REQUEST["month"];
	$year  = $_REQUEST["year"];
    $current = mktime(0,0,0,$month,$day,$year);

	$sql = "SELECT * FROM ".$TABLES["EVENTS"]." 
			WHERE dt = '". date("Y-m-d", $current) ."' 
			AND calendar_id='".$_REQUEST["cid"]."'";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	$data = mysql_fetch_assoc($sql_result);
	$open_month = $month - 1;
	$open = "&openyear=$year&openmonth=$open_month";
	
?>
      
      <tr>
        <td bgcolor="#FFFFFF"  style="border:1px solid #CCCCCC">
          <input type="submit" name="Submit4" value="Booked" onclick="document.frm.ac.value='booked'" style="cursor:pointer" />
	      <input type="submit" name="Submit5" value="Available" onclick="document.frm.ac.value='available'" style="cursor:pointer" />
          <input type="submit" name="Submit6" value="Morning" onclick="document.frm.ac.value='morning'" style="cursor:pointer" />
          <input type="submit" name="Submit7" value="Afternoon" onclick="document.frm.ac.value='afternoon'" style="cursor:pointer" />	  	</td>
      </tr>
    </table>
	</form>	</td>
    <td align="center"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="270" height="225" align="middle">
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" />
      <param name="quality" value="high" />
      <param name="BGCOLOR" value="#f2f2f0" />
      <embed src="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?><?php echo $open; ?>&owner=phpjabbers.com" width="270" height="225" align="middle" quality="high" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" bgcolor="#f2f2f0" />    
</object></td>
  </tr>
</table>

<?php
} elseif ($_REQUEST["ac"]=='settings') {
?>
	<form action="admin.php" method="post" name="frm" id="frm" style="margin:0px; padding:0px">
      <input type="hidden" name="ac" value="save_settings" />
      <input type="hidden" name="cid" value="<?php  echo $_REQUEST["cid"]; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="380" valign="top">
      <table width="100%" height="380" border="0" cellpadding="5" cellspacing="4">
        <tr>
              <td bgcolor="#FFFFFF" style="border:1px solid #CCCCCC">
		 Week starts from 
		           <input name="startMonday" type="radio" value="false" <?php  if ($OPTIONS["startMonday"]=='false') echo 'checked="checked" '; ?>/>
		          Sunday or <input name="startMonday" type="radio" value="true" <?php  if ($OPTIONS["startMonday"]=='true') echo 'checked="checked" '; ?>/>Monday  
		  <br>
		  Calendar width 
              <input name="width" type="text" id="width" size="3" maxlength="3" value="<?php echo $OPTIONS["width"]; ?>" />
              pixels	      </td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#FFFFFF" style="border:1px solid #CCCCCC">Below you can set colors for the calendar. You can either add color codes in HTML format or click on the 'select color' link next to each color field. <br />
	         <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td>Font name: </td>
                <td><select name="font" id="font" style="width:120px">
					<?php
						foreach($fonts_arr as $value){
							if($OPTIONS["font"]==$value)
								echo "<option value='".$value."'  style='font-family:".$value."' selected>".$value."</option>";
							else
								echo "<option value='".$value."' style='font-family:".$value."'>".$value."</option>";		
						}
					?>
					</select></td>
              </tr>
              <tr>
                <td width="40%">Month name background</td>
              	<td><input name="monthColor" type="text" id="monthColor" size="7" maxlength="7" value="<?php echo $OPTIONS["monthColor"]; ?>" />
        	        <a href="#" onclick="cp.select(frm.monthColor,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
              </tr>
              <tr>
		        <td>Month name</td>
              	<td><input name="monthText" type="text" id="monthText" size="7" maxlength="7" value="<?php  echo $OPTIONS["monthText"]; ?>" />
	              <a href="#" onclick="cp.select(frm.monthText,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
	            </tr>
              <tr>
	  	      	<td>Days background</td>
   		      	<td><input name="dayBackground" type="text" id="dayBackground" size="7" maxlength="7" value="<?php  echo $OPTIONS["dayBackground"]; ?>" />
	         	<a href="#" onclick="cp.select(frm.dayBackground,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
	          </tr>
    	      <tr>
		        <td>Days titles</td>
		        <td><input name="dayColor" type="text" id="dayColor" size="7" maxlength="7" value="<?php  echo $OPTIONS["dayColor"]; ?>" />
	            <a href="#" onclick="cp.select(frm.dayColor,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
              </tr>
              <tr>
		        <td>Day number</td>
		        <td><input name="dayNumbers" type="text" id="dayNumbers" size="7" maxlength="7" value="<?php  echo $OPTIONS["dayNumbers"]; ?>" />
	   	            <a href="#" onclick="cp.select(frm.dayNumbers,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
	          </tr>
	          <tr>
          		<td>Booked days</td>
		        <td><input name="dayComment" type="text" id="dayComment" size="7" maxlength="7" value="<?php  echo $OPTIONS["dayComment"]; ?>" />
		            <a href="#" onclick="cp.select(frm.dayComment,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
              </tr>
              <tr>
          		<td>Available days</td>
		        <td><input name="dayNoComment" type="text" id="dayNoComment" size="7" maxlength="7" value="<?php  echo $OPTIONS["dayNoComment"]; ?>" />
		        	<a href="#" onclick="cp.select(frm.dayNoComment,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
              </tr>
	          <tr>
		          <td>Navigation arrow circle </td>
		          <td><input name="arrowCircle" type="text" id="arrowCircle" size="7" maxlength="7" value="<?php  echo $OPTIONS["arrowCircle"]; ?>" />
			          <a href="#" onclick="cp.select(frm.arrowCircle,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
	          </tr>
	          <tr>			
    		      <td>Navigation arrow </td>
		          <td><input name="arrowColor" type="text" id="arrowColor" size="7" maxlength="7" value="<?php  echo $OPTIONS["arrowColor"]; ?>" />
		          <a href="#" onclick="cp.select(frm.arrowColor,'pick2');return false;" name="pick2" id="pick2">select color</a></td>
        </tr>
            </table>            </td></tr>
</table>    </td>
    <td align="center" valign="top">

      <table width="100%" height="380" border="0" cellpadding="5" cellspacing="4">
        <tr>
       	    	<td valign="top" bgcolor="#FFFFFF" style="border:1px solid #CCCCCC">Below you can set your own text message for the calendar including month and days names. <br />
		  <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="4"><em>Translate in your language</em> </td>
              </tr>
            <tr>
              <td width="13%">January:</td>
                  <td width="40%"><input name="Jan" type="text" id="Jan" size="20" maxlength="20" value="<?php  echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Jan"]))); ?>" /></td>
              <td><strong>S</strong>unday</td>
                  <td><input name="Sunday" type="text" id="Sunday" size="1" maxlength="1" value="<?php  echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Sunday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>February:</td>
              <td><input name="Feb" type="text" id="Feb" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Feb"]))); ?>" /></td>
              <td width="15%"><strong>M</strong>onday</td>
              <td width="32%"><input name="Monday" type="text" id="Monday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Monday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>March:</td>
              <td><input name="Mar" type="text" id="Mar" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Mar"]))); ?>" /></td>
              <td><strong>T</strong>uesday</td>
              <td><input name="Tuesday" type="text" id="Tuesday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Tuesday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>April:</td>
              <td><input name="Apr" type="text" id="Apr" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Apr"]))); ?>" /></td>
              <td><strong>W</strong>endesday</td>
              <td><input name="Wendesday" type="text" id="Wendesday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Wendesday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>May:</td>
              <td><input name="May" type="text" id="May" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["May"]))); ?>" /></td>
              <td><strong>T</strong>hursday</td>
              <td><input name="Thursday" type="text" id="Thursday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Thursday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>June:</td>
              <td><input name="Jun" type="text" id="Jun" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Jun"]))); ?>" /></td>
              <td><strong>F</strong>riday</td>
              <td><input name="Friday" type="text" id="Friday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Friday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>July:</td>
              <td><input name="Jul" type="text" id="Jul" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Jul"]))); ?>" /></td>
              <td><strong>S</strong>aturday</td>
              <td><input name="Saturday" type="text" id="Saturday" size="1" maxlength="1" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Saturday"]))); ?>" /></td>
            </tr>
            <tr>
              <td>August:</td>
              <td><input name="Aug" type="text" id="Aug" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Aug"]))); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>September:</td>
              <td><input name="Sep" type="text" id="Sep" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Sep"]))); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>October:</td>
              <td><input name="Oct" type="text" id="Oct" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Oct"]))); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>November:</td>
              <td><input name="Nov" type="text" id="Nov" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Nov"]))); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>December:</td>
              <td><input name="Dec" type="text" id="Dec" size="20" maxlength="20" value="<?php echo str_replace('"','&quot;',stripslashes(utf8_decode($OPTIONS["Dec"]))); ?>" /></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
         <td colspan="2" align="center" valign="middle">
      <table width="100%" border="0" cellspacing="4" cellpadding="5">
        <tr>
       	    	<td align="center" bgcolor="#FFFFFF" style="border:1px solid #CCCCCC"><input type="submit" name="Submit3" value="Save"  style="font-size:16px; cursor:pointer; font-weight:bold" />				</td>
		</tr>
	</table>
		 
		 </td>
    </tr>
</table>

    </form>
<br /><br />
<center>
<?php
$height = ceil($OPTIONS["width"] * 5 / 6);
?>

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle">
      <param name="allowScriptAccess" value="always" />
      <param name="movie" value="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" />
      <param name="quality" value="high" />
<embed src="http://<?php echo trim($SETTINGS["installURL"]); ?>calendar.swf?phpURL=<?php echo trim($SETTINGS["installURL"]); ?>calendar-data.php&cid=<?php echo $_REQUEST["cid"]; ?>&owner=phpjabbers.com" quality="high" width="<?php echo $OPTIONS["width"]; ?>" height="<?php echo $height; ?>" align="middle" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
</object>
<?php
};
?>
</center>
</td>
</tr>
<tr>
    <td align="left" valign="top"><img src="images/main-bottom.jpg" width="981" height="8" /></td>
    </tr>
  <tr>
    <td height="20" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="bottom" style="padding-top:0px">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="top" style="padding-top:0px">&nbsp;</td>
  </tr>
</table>

<?php
} else { /////////// LOGIN BOX
?><br /><br /><br /><br />
<?php echo $message; ?>
<form action="admin.php" method="post">
<input type="hidden" name="ac" value="login">
<table width="267" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="267" height="55" valign="top" style="background-image:url(images/help-middle-back.jpg); background-repeat:repeat-y"><img src="images/login-title.jpg" width="267" height="49" /></td>
  </tr>
  <tr>
    <td valign="top" class="HelpCell" style="background-image:url(images/help-middle-back.jpg); background-repeat:repeat-y">
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="33%" align="right"><strong>Username:</strong></td>
        <td width="67%" align="left"><input name="user" type="text" id="user" style="width:90px" /></td>
      </tr>
      <tr>
        <td align="right"><strong>Password:</strong></td>
        <td align="left"><input name="pass" type="password" id="pass" style="width:90px"  /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input type="submit" name="button" id="button" value="Login"  style="font-size:16px; cursor:pointer; font-weight:bold" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="55" valign="bottom" style="background-image:url(images/help-middle-back.jpg); background-repeat:repeat-y">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/logo-bottom.jpg" width="267" height="8" /></td>
  </tr>
</table>
</form>
<?php
};
?>
</center>
</body>
</html>
